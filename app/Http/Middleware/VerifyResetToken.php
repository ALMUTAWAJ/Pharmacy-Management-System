<?php

namespace App\Http\Middleware;

use Closure;
use DB;

class VerifyResetToken
{
    public function handle($request, Closure $next)
    {
        $token = $request->token;
        // Check if the token exists in the password_reset_tokens table
        $tokenExists = DB::table('password_reset_tokens')
            ->where(['token'=> $token])
            ->exists();
            if ($tokenExists) {
                // Token is invalid, redirect to the login page
                return $next($request);
            }
            return redirect(route('login'))->with('fail', 'Invalid or expired password reset link.');
      }
}



