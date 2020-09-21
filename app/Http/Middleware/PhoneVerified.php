<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class PhoneVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::user();
        if ($user->status === User::STATUS_VERIFIED) {
            return $next($request);
        } elseif ($user->status === User::STATUS_CREATED) {
            return redirect()->route('verify.phone', ['phone' => $user->phone]);
        }
        return redirect('/');
    }
}
