<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Personal;
use App\Models\Address;
use Str;
use Hash;
use Auth;



class RegisterController extends Controller
{
    // Authentication here
    function registerPage()
    {
        if (Auth::check())
            return redirect(route('home'));
        return view('pages.auth.register');
    }

    // Register Processes
    function registerPost(Request $request)
    {
        $request->validate(
            [
                'firstname' => ['required', 'string', 'min:3', 'max:25', 'regex:/^[A-Za-z\s]+$/'],
                'lastname' => ['required', 'string', 'min:3', 'max:25', 'regex:/^[A-Za-z\s]+$/'],
                'email' => "max:50|required|email|unique:users,email",
                'phone_number' => ["required", "regex:/^((00|\+)973 ?)?((3\d|66)\d{6})$/"],
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
                'dob' => 'required|date|before_or_equal:today|after:' . now()->subYears(100)->format('Y-m-d'),

                'password_confirmation' => "required",
                "cpr" => ['required', 'regex:/^([0-9]{2}(0[0-9]|1[0-2])\d{5})$/', 'unique:personals,cpr'],
                'username' => 'required|string|regex:/^\w*$/|max:24|unique:users,username',
            ],
            
            [
                'password.regex' => 'The password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, one digit, and one special character.',
                'dob.before_or_equal' => 'This human is still does not exist',
                'dob.after' => 'Are you still alive?',
            ],
            
        );
        
        // dd($request->phone_number);
        
        // Credentials Information
        $cred['email'] = Str::lower($request->email);
        $cred['password'] = Hash::make($request->password); // You must hash the password 
        $cred['username'] = Str::lower($request->username);
        $cred['phone_number'] = $request->phone_number;
        $cred['name'] = $request->firstname . ' ' . $request->lastname;

        
        // Personal Information
        $personal_info['userID'] = '0';
        $personal_info['firstname'] = $request->firstname;
        $personal_info['lastname'] = $request->lastname;
        $personal_info['cpr'] = $request->cpr;
        $personal_info['dob'] = $request->dob;


        $var1 = User::create($cred);

        if ($var1) {
            $user_id = $var1->id; // Last inserted user ID
            $personal_info['userID'] = $user_id;
        
            // Create personal information for the user
            $var2 = Personal::create($personal_info);
        
            if ($var2) {
                // Create an empty address record associated with the user
                $emptyAddress = new Address();
                $savedEmptyAddress = $var1->personal->addresses()->save($emptyAddress);
        
                if ($savedEmptyAddress) {
                    return redirect(route('login'))->with('success', 'Congratulations, your account has been created successfully!');
                } else {
                    $var1->delete();
                    return redirect(route('register'))->with('fail', 'Failed to create an initial address. Please try again.');
                }
            } else {
                $var1->delete();
                return redirect(route('register'))->with('fail', 'Failed to create personal information. Please try again.');
            }
        } else {
            return redirect(route('register'))->with('fail', 'Failed to create user. Please try again.');
        }
    }        
}