<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Personal;
use App\Models\Address;
use App\Models\Supplier;
use Str;
use Hash;
use Auth;
use Illuminate\Validation\Rules\Unique;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filterType = $request->query('filter_type');
        $searchQuery = $request->query('search');

        // Query users based on the filter type and search query
        $users = User::query();

        if ($filterType) {
            $users->where('role', $filterType);
        }

        if ($searchQuery) {
            $users->where(function ($query) use ($searchQuery) {
                $query->where('username', 'like', '%' . $searchQuery . '%')
                    ->orWhere('email', 'like', '%' . $searchQuery . '%')
                    ->orWhereHas('personal', function ($subQuery) use ($searchQuery) {
                        $subQuery->where('firstname', 'like', '%' . $searchQuery . '%')
                            ->orWhere('lastname', 'like', '%' . $searchQuery . '%');
                    });
            });
        }

        $users = $users->get();

        return view('pages.admin.users')->with([
            'users' => $users,
            'searchQuery' => $searchQuery,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('/admin/add-user');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());

        $request->validate([ 
        'firstname' => ['required', 'string', 'min:3', 'max:25', 'regex:/^[A-Za-z\s]+$/'],
        'lastname' => ['required', 'string', 'min:3', 'max:25', 'regex:/^[A-Za-z\s]+$/'],
        'email' => "required|email|unique:users,email",
        'phone_number' => ["required", "regex:/^((00|\+)973 ?)?((3\d|66)\d{6})$/"],
        'password' => [
            'required',
            'string',
            'min:8',             // Minimum length of 8 characters
            'confirmed',         // Requires password_confirmation field
            'different:email',  // Password must be different from email
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
        'dob.before_or_equal' => 'This human does not exist',
        'dob.after' => 'Are you still alive?',
    ]);
    
        // Credentials Information
        $cred['email'] = Str::lower($request->email);
        $cred['password'] = Hash::make($request->password);
        $cred['username'] = Str::lower($request->username);
        $cred['role'] = Str::lower($request->role);
        $cred['phone_number'] = $request->phone_number;
    
        // Create the user
        $user = User::create($cred);
    
        if ($user) {
            if ($user->role === 'supplier') {
                $supplier_info['userID'] = $user->id;
                $supplier_info['company_name'] = $user->username;
                $supplier_info['commercial_register'] = rand(100000000, 999999999);

                $supplier = Supplier::create($supplier_info);

                if (!$supplier) {
                    $user->delete();
                    return redirect(route('users.index'))->with('fail', 'Sorry, there was a problem creating the user, please try again!');
                }
            }
            // Personal Information
            $personal_info['firstname'] = $request->firstname; 
            $personal_info['lastname'] = $request->lastname;
            $personal_info['cpr'] = $request->cpr;
            $personal_info['dob'] = $request->dob;
    
            // Create the personal information associated with the user
            $personal = $user->personal()->create($personal_info);
            
            if ($personal) {
                
                $address_info['city'] = $request->city;
                $address_info['house'] = $request->house;
                $address_info['block'] = $request->block;
                $address_info['road'] = $request->road;
    
                // Check if all address fields are not empty
                if (!empty($address_info['city']) && !empty($address_info['house']) && !empty($address_info['block']) && !empty($address_info['road'])) {
                    // Create the address associated with the personal information
                    $address_info['personalID'] = $personal->id;
                    $address = Address::create($address_info);
                }
    
                return redirect(route('users.index'))->with('success', 'Congratulations, the user has been created successfully!');
            } else {
                $user->delete();
                return redirect(route('users.index'))->with('fail', 'Sorry, there was a problem creating the user, please try again!');
            }
        } else {
            return redirect(route('users.index'))->with('fail', 'Sorry, there was a problem creating the user, please try again!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('pages/admin/user-details', compact('user'));
    }

    public function personal()
    {
        return $this->hasOne(Personal::class, 'userID');
    }

    public function address()
    {
        return $this->belongsTo(Address::class, 'addressID');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('pages.admin.user-edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    
     // Everything works except the phone number
     public function update(Request $request, User $user)
     {
         $request->validate([
             'firstname' => ['required', 'string', 'min:3', 'max:25', 'regex:/^[A-Za-z\s]+$/'],
             'lastname' => ['required', 'string', 'min:3', 'max:25', 'regex:/^[A-Za-z\s]+$/'],
             'email' => "required|email|unique:users,email,{$user->id}",
             // TODO
             // 'phone_number' => ["required", "regex:/^(\+|00)973(3|6)\d{7}$/"],
             'dob' => 'required|date|before_or_equal:today|after:' . now()->subYears(100)->format('Y-m-d'),
             'cpr' => [
                 'required',
                 'regex:/^([0-9]{2}(0[0-9]|1[0-2])\d{5})$/',
                 (new Unique('personals'))->ignore($user->personal->id),
             ],
             'username' => "required|string|regex:/^\w*$/|max:24|unique:users,username,{$user->id}",
             'addresses' => ['array'],
             'addresses.*.city' => ['string', 'max:255'],
             'addresses.*.house' => ['string', 'max:255'],
             'addresses.*.road' => ['string', 'max:255'],
             'addresses.*.block' => ['string', 'max:255'],
         ], [
             'dob.before_or_equal' => 'This human does not exist',
             'dob.after' => 'Are you still alive?',
         ]);
     
         $user->update([
             'username' => $request->username,
             'email' => $request->email,
             'phone_number' => $request->phone_number,
         ]);
     
         $user->personal->update([
             'firstname' => $request->firstname,
             'lastname' => $request->lastname,
             'cpr' => $request->cpr,
             'dob' => $request->dob,
         ]);
     
         if ($request->has('addresses')) {
            foreach ($request->addresses as $index => $addressData) {
                if ($user->personal->addresses->get($index)) {
                    $user->personal->addresses->get($index)->update([
                        'city' => $addressData['city'],
                        'road' => $addressData['road'],
                        'block' => $addressData['block'],
                        'house' => $addressData['house'],
                    ]);
                }
            }
        }
     
         $user->update(['role' => $request->role]);
     
         return redirect()->route('users.index')->with('success', 'User information has been updated successfully.');
     }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(User $user)
    {
        // Delete the associated address record
        if ($user->personal) {
            $user->personal->address()->delete();
        }
    
        // Delete the user record
        $user->delete();
    
        return redirect(route('users.index'))->with('success', 'User has been deleted successfully!');
    }
}
