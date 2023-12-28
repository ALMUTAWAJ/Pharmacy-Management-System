<?php

namespace App\Http\Controllers;

use App\Models\LoginAttempt;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use Str;
use Redirect;

class LoginController extends Controller
{


    function checkRoles()
    {

        switch (auth()->user()->role) {
            case 'admin':
                return Redirect::route('admin.index');
            case 'staff':
                return Redirect::route('staff.index');
            case 'customer':
                return Redirect::route('customer.index');
            // case 'supplier':
            //     return Redirect::route('supplier.index');
            default:
                // Handle any other roles or scenarios here.
                break;
        }
    }


    function checkUser()
    {
        if (!Auth::check())
            return view('pages.auth.login');

        // User is authenticated then 
        return $this->checkRoles();
    }


    

    function loginPost(Request $request)
    {
        $request->validate([
            'username_or_email' => 'required',
            'password' => 'required',
        ]);

        $username_or_email = Str::lower($request->username_or_email);
        $password = $request->password;
        $remember = $request->has('remember');

        // Handling login attempts
        if (User::where('email', $username_or_email)->exists() || User::where('username', $username_or_email)->exists()) {

            $attempt_wrong = !(Auth::validate(['username' => $username_or_email, 'password' => $password]) || Auth::validate(['email' => $username_or_email, 'password' => $password]));

            $user = User::where('email', $username_or_email)->orWhere('username', $username_or_email)->first();

            // Check for login attempts
            $loginAttempts = LoginAttempt::where('userID', $user->id)->first();

            if ($loginAttempts) {

                // Since there is a record check if attempts wrongly
                if ($attempt_wrong) { 
                    $loginAttempts->attempts += 1;
                    $loginAttempts->save();
                    // Check if attempts exceed the limit after increment
                    if ($loginAttempts->attempts == 5) {
                        // Set suspend time to 5 minutes from now
                        $loginAttempts->suspend_till = now()->addMinutes(5);
                        $loginAttempts->save();
                    }

                }


                // Check if attempts exceed the limit
                if ($loginAttempts->attempts >= 5 && now() < $loginAttempts->suspend_till) {
                    // dd($loginAttempts->attempts >= 5 && now() < $loginAttempts->suspend_till);
                    // Suspend the login
                    return redirect()->back()->with(['fail' => 'Account suspended due to multiple failed login attempts. Please try again again at ' . $loginAttempts->suspend_till . '.'])->withInput($request->only('username_or_email'));
                } elseif ($loginAttempts->attempts >= 5 && now() >= $loginAttempts->suspend_till) {
                    $loginAttempts->delete();
                    // if you delete it, but the credentials are wrong?? so recreate it
                    if($attempt_wrong){
                        $loginAttempts = new LoginAttempt();
                        $loginAttempts->userID = $user->id;
                        // $loginAttempts->attempts  default value is already 1
                        $loginAttempts->save();
                    }
                    
                }

            } else {
                // Create a new login attempts record for the user if no record for the user and attempting wrongly
                if ($attempt_wrong) {
                    $loginAttempts = new LoginAttempt();
                    $loginAttempts->userID = $user->id;
                    // $loginAttempts->attempts  default value is already 1
                    $loginAttempts->save();
                }
            }

        }


        // Attempt login again after handling attempts
        if (Auth::attempt(['username' => $username_or_email, 'password' => $password], $remember) || Auth::attempt(['email' => $username_or_email, 'password' => $password], $remember)) {
            return $this->checkRoles();
        }

        // Invalid Credentials
        $identification = 'email';
        if (!str_contains($username_or_email, '@')) {
            $identification = 'username';
        }
        return redirect()->back()->with(['fail' => "Invalid $identification or password"])->withInput($request->only('username_or_email'));
    }




}
