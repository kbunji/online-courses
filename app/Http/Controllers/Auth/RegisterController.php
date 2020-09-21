<?php

namespace App\Http\Controllers\Auth;

use App\Models\Sms;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => 'required|string|max:255',
            'last_name' => 'string|max:255',
            'middle_name' => 'string|max:255',
            'email' => 'string|email|max:255|unique:users',
            'phone' => 'required|string|min:10|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return User
     */
    protected function create(array $data)
    {
        $phone = $data['country'] . substr($data['phone'], -10);
        $password = $data['password'];
        $user = User::create([
            'first_name' => $data['first_name'],
            'last_name' => (isset($data['last_name']) ? $data['last_name'] : null),
            'middle_name' => (isset($data['middle_name']) ? $data['middle_name'] : null),
            'email' => $data['email'],
            'phone' => $phone,
            'password' => bcrypt($password),
            'status' => User::STATUS_CREATED
        ]);

        if (isset($data['role']) && $data['role']) {
            $user->roles()->attach($data['role']);
        }

        return $user;
    }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        $user->phone_code = rand(100000, 999999);
        $user->save();
        $smsMessage = 'Ваш код подтверждения - ' . $user->phone_code;
        Sms::createSms($user->phone, $smsMessage);
        if ($user->status === User::STATUS_CREATED) {
            return redirect()->route('verify.phone', ['phone' => $user->phone]);
        }
        return false;
    }
}
