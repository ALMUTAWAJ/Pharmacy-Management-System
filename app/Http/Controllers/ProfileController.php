<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Personal;
use App\Models\Address;
use Str;
use Hash;


class ProfileController extends Controller
{
    function showProfile()
    {
        $userID = auth()->user()->id;
        $credential = User::find($userID);
        $personal = Personal::where('userID', $userID)->first();
        $addresses = $personal->addresses ?? null;
        return view('pages.auth.profile', [
            'credential' => $credential,
            'personal' => $personal,
            'addresses' => $addresses
        ]);
    }


    function updateGeneral(Request $request)
    {


        $user = auth()->user();
        $personal = $user->personal();

        $request->validate(
            [
                'email' => "required|email|unique:users,email,{$user->id}",
                'firstname' => ['required', 'string', 'min:3', 'max:25', 'regex:/^[A-Za-z\s]+$/'],
                'lastname' => ['required', 'string', 'min:3', 'max:25', 'regex:/^[A-Za-z\s]+$/'],
                'phone_number' => ["required", "regex:/^((00|\+)973 ?)?((3\d|66)\d{6})$/", "unique:users,phone_number,{$user->id}"],
                'dob' => 'required|date|before_or_equal:today|after:' . now()->subYears(100)->format('Y-m-d'),
                "cpr" => ['required', 'regex:/^([0-9]{2}(0[0-9]|1[0-2])\d{5})$/', "unique:personals,cpr,{$user->id}"],
                'username' => "required|string|regex:/^\w*$/|max:24|unique:users,username,{$user->id}",
            ],
            [
                'dob.before_or_equal' => 'This human does not exist',
                'dob.after' => 'Are you still alive?',
                'phone_number.regex'=>'The phone number must follow Bahrain standards'
            ]
        );

        $cred['email'] = Str::lower($request->email);
        $cred['username'] = Str::lower($request->username);
        $cred['phone_number'] = $request->phone_number;

        $personal_info['firstname'] = $request->firstname;
        $personal_info['lastname'] = $request->lastname;
        $personal_info['cpr'] = $request->cpr;
        $personal_info['dob'] = $request->dob;



        $update_users = $user->update($cred);
        $update_personal = $personal->update($personal_info);

        if ($update_users && $update_personal) {
            return redirect()->back()->with('success', "Your data has been updated successfully ✔");
        } else {
            return redirect()->back()->with('fail', "Sorry, your data has not been updated, try again later!");
        }

    }



    function updatePassword(Request $request)
    {

        $old_password = $request->old_password;
        if (trim($old_password) != "")
            $ans = Hash::check($old_password, auth()->user()->password);

        if ($ans) {
            $request->validate(
                [
                    'password' => [
                        'required',
                        'string',
                        'min:8',
                        'confirmed',
                        'different:email',
                        'regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[\.@$!%*?&#_-])[A-Za-z\d@$\.!%*?&#_-]+$/',
                    ],
                ],
                [
                    'password.regex' => 'The password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, one digit, and one special character.',
                ]
            );

            $update_pass = auth()->user()->update(['password' => $request->password]);
            if ($update_pass)
                return redirect()->back()->with('success', 'Your password has been updated successfully!');
            else
                return redirect()->back()->with('fail', 'Please, enter you old password correctly !');
        } else {
            return redirect()->back()->with('fail', 'Please, enter you old password correctly !');
        }

    }

    function updateAddress(Request $request, $id)
    {
        
        $address = Address::find($id); // Retrieve the address by its ID

        if (!$address) {
            return redirect()->back()->with('fail', 'Address not found!');
        }

        $addressInfo = [];

        if ($request->city) {
            $addressInfo['city'] = $request->city;
        }

        if ($request->house) {
            $addressInfo['house'] = $request->house;
        }

        if ($request->road) {
            $addressInfo['road'] = $request->road;
        }

        if ($request->block) {
            $addressInfo['block'] = $request->block;
        }

        // Validate the incoming data
        $request->validate([
            'city' => 'required|regex:/^[a-zA-Z\s,]+$/|max:30',
            'house' => 'required|numeric|max:9999',
            'block' => 'required|numeric|max:9999',
            'road' => 'required|regex:/^[a-zA-Z0-9\s,]+$/|max:30',
        ], [

            'house' => 'House number must be only numbers without spaces or any other characters',
            'block' => 'Block number must be only numbers without spaces or any other characters',
            'city' => 'City name must not include numbers or special characters other than ","',
            'road' => 'Road must not include numbers or special characters other than ","',
        ]);

        // Update the address with the new information
        $success = $address->update($addressInfo);

        if ($success) {
            return redirect()->back()->with('success', 'Your address has been updated successfully!');
        } else {
            return redirect()->back()->with('fail', 'Please check your address details!');
        }
    }


    public function newAddress()
    {
        return view('pages.auth.new-address');
    }

    public function newAddressAdd(Request $request)
    {
        $user = auth()->user();
        $personal = $user->personal;

        if ($personal && $personal->addresses()->count() < 3) { //  Limit is 3 (I think it's enough)
            $request->validate([
                'city' => 'required|regex:/^[a-zA-Z\s,]+$/|max:30',
                'house' => 'required|numeric|max:9999',
                'block' => 'required|numeric|max:9999',
                'road' => 'required|regex:/^[a-zA-Z0-9\s,]+$/|max:30',
            ], [
                'house' => 'House number must be only numbers without spaces or any other characters',
                'block' => 'Block number must be only numbers without spaces or any other characters',
                'city' => 'City name must not include numbers or special characters other than ","',
                'road' => 'Road must not include numbers or special characters other than ","',
            ]);

            $newAddress = new Address([
                'city' => $request->city,
                'house' => $request->house,
                'block' => $request->block,
                'road' => $request->road,
            ]);

            // Save the new address for the user
            $personal->addresses()->save($newAddress);

            return redirect()->back()->with('success', 'New address added successfully!');
        }

        return redirect()->back()->with('fail', 'You have the maximum allowed addresses, Cannot add a new address !');
    }


    public function fetchAddress(Request $request)
    {
        $userID = auth()->user()->id;
        $credential = User::find($userID);
        $personal = Personal::where('userID', $userID)->first();
        $addresses = $personal->addresses ?? null;
        $chosen_address = Address::find($request->address_select);

        if ($chosen_address)
            return view('pages.auth.profile', [
                'credential' => $credential,
                'personal' => $personal,
                'chosen_address' => $chosen_address,
                'addresses' => $addresses
            ]);

        return redirect()->back()->with('fail', 'Sorry, there is a problem showing the chosen address!');





    }



}