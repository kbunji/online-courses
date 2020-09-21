<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Sms;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
    }

    protected function credentials(Request $request)
    {
        $charSearch = array("+", "-", " ", "(", ")");
        $email = str_replace($charSearch, "", $request->email);

        if (is_numeric($email)) {
            return ['phone' => $email, 'password' => $request->get('password')];
        } elseif (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return ['email' => $email, 'password' => $request->get('password')];
        }
        return ['login' => $email, 'password' => $request->get('password')];
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {

        if ($user->status === User::STATUS_CREATED) {
            $user->phone_code = rand(100000, 999999);
            $user->save();
            $smsMessage = 'Ваш код подтверждения - ' . $user->phone_code;
            Sms::createSms($user->phone, $smsMessage);
            return redirect()->route('verify.phone', ['phone' => $user->phone]);
        }
        return redirect($this->redirectPath());
    }
}
