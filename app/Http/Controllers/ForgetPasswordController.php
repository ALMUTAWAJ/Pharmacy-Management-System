<?php

namespace App\Http\Controllers;

use App\Models\User;
use DB;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Mail;

class ForgetPasswordController extends Controller
{
    function ForgetPassword()
    {
        return view("pages.auth.forget-password");
    }

    function forgetPasswordPost(Request $request)
    {
        $request->validate([
            "email" => "required|email|exists:users|unique:password_reset_tokens,email",
        ],
    [
        'email.unique'=> 'A password reset link has already been sent to your email address. Please check your inbox.'
    ]);

        $token = Str::random(79);

        $data = [
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now(),
        ];

        DB::table('password_reset_tokens')->insert($data);


        Mail::send('pages.auth.emails.forget-password', ['token' => $token], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Reset Password');
            $message->from('example@example.com','Code-Pharmacy');
        });

        return redirect()->to(route('forget.password'))->with('success', 'We have sent an email to reset your password');

    }


    function resetPassword($token)
    {
        return view('pages.auth.new-password', compact('token'));
    }


    function resetPasswordPost(Request $request)
    {
        $request->validate(
            [
                'password' => [
                    'required',
                    'string',
                    'min:8',
                    'max:40',
                    // Minimum length of 8 characters
                    'confirmed',
                    // Requires password_confirmation field
                    'different:email',
                    // Password must be different from email
                    'regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[\.@$!%*?&#_-])[A-Za-z\d@$\.!%*?&#_-]+$/',
                    // At least one uppercase, one lowercase, one digit, one special character
                ],

                'password_confirmation' => "required",
            ],

            [
                'password.regex' => 'The password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, one digit, and one special character.',
            ]
        );

        $tokenFound = DB::table('password_reset_tokens')->where('token', $request->token)->first();

        if (!$tokenFound) {
            return redirect()->to(route('reset.password'))->with('fail', 'Make sure you enter this link from your email');
        }

        # Find the email associated with the token received 
        $email = $tokenFound->email;

        # Update the password in the users table 
        $updated_answer = User::where('email', $email)->update(['password' => Hash::make($request->password)]);

        if ($updated_answer) {
            DB::table('password_reset_tokens')->where('email', $email)->delete();
            return redirect(route('login'))->with('success', 'Congratulations, your password has been reset successfully.');
        }

        return redirect(route('reset.password'))->with('fail', 'Your password has not been changed, please try again !');

    }


}
