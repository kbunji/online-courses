<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PhoneController extends Controller
{
    protected function checkVerifyRequest(Request $request)
    {
        $this->validate($request, [
            'phone' => 'required|string|min:10|max:255'
        ]);
    }

    public function verify(Request $request)
    {
        $this->checkVerifyRequest($request);

        $phoneNumber = $request->phone;
        return view('auth.verify')->with([
            'phoneNumber' => $phoneNumber
        ]);
    }

    protected function checkUpdateRequest(Request $request)
    {
        $this->validate($request, [
            'phone_number' => 'required|string|min:10|max:255',
            'phone_code' => 'required|integer'
        ]);
    }

    public function update(Request $request)
    {
        $this->checkUpdateRequest($request);

        $phone = $request->phone_number;
        $phoneCode = $request->phone_code;
        $user = User::where('phone', '=', $phone)->firstOrFail();

        if (User::checkPhone($user, $phoneCode)) {
            return view('home');
        }

        return redirect()->back()->withErrors(['error' => 'неверный код']);
    }
}
