<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Personal;
use App\Models\Address;
use App\Models\Order;
use Str;
use Hash;
use Auth;
use Illuminate\Validation\Rules\Unique;
use Illuminate\Validation\ValidationException;
class UserController extends Controller
{
    private function getValidationRules()
    {
        return [
            'firstname' => ['required', 'string', 'min:3', 'max:25', 'regex:/^[A-Za-z\s]+$/'],
            'lastname' => ['required', 'string', 'min:3', 'max:25', 'regex:/^[A-Za-z\s]+$/'],
            'email' => 'required|email|unique:users,email',
            'phone_number' => ['required', 'regex:/^((00|\+)973 ?)?((3\d|66)\d{6})$/', 'unique:users,phone_number'],
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
                'different:email',
                'regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[\.@$!%*?&#_-])[A-Za-z\d@$\.!%*?&#_-]+$/',
            ],
            'dob' => 'required|date|before_or_equal:today|after:' . now()->subYears(100)->format('Y-m-d'),
            'password_confirmation' => 'required',
            'cpr' => ['required', 'regex:/^([0-9]{2}(0[0-9]|1[0-2])\d{5})$/', 'unique:personals,cpr'],
            'username' => 'required|string|regex:/^\w*$/|max:24|unique:users,username',
        ];
    }

    private function getValidationMessages()
    {
        return [
            'password.regex' => 'The password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, one digit, and one special character.',
            'dob.before_or_equal' => 'This human does not exist',
            'dob.after' => 'Are you still alive?',
        ];
    }

    private function validateRequest(Request $request, array $rules, array $messages = [])
    {
        try {
            return $request->validate($rules, $messages);
        } catch (ValidationException $exception) {
            return redirect()->back()->withInput()->withErrors([
                'fail' => $exception->getMessage(),
            ]);
        }
    }

    private function validateAddress(Request $request)
    {
        $rules = [
            'city' => ['required', 'string', 'max:50'],
            'house' => ['required', 'string', 'max:50'],
            'block' => ['required', 'string', 'max:50'],
            'road' => ['required', 'string', 'max:50'],
        ];

        $messages = [
            'city.required' => 'The city field is required.',
            'house.required' => 'The house field is required.',
            'block.required' => 'The block field is required.',
            'road.required' => 'The road field is required.',
        ];

        return $this->validateRequest($request, $rules, $messages);
    }

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
        $rules = $this->getValidationRules();
        $messages = $this->getValidationMessages();
    
        $validationResult = $this->validateRequest($request, $rules, $messages);
    
        // Check if the validation result is a redirection response
        if ($validationResult instanceof \Illuminate\Http\RedirectResponse) {
            return $validationResult; // Return the redirection response
        }
    
        // Retrieve the validated data
        $validatedData = $validationResult;
    
        $cred = [
            'email' => Str::lower($validatedData['email']),
            'password' => Hash::make($validatedData['password']),
            'username' => Str::lower($validatedData['username']),
            'role' => Str::lower($request->input('role')),
            'phone_number' => $validatedData['phone_number'],
        ];
    
        $user = User::create($cred);
    
        if ($user) {
            $personal_info['firstname'] = $validatedData['firstname'];
            $personal_info['lastname'] = $validatedData['lastname'];
            $personal_info['cpr'] = $validatedData['cpr'];
            $personal_info['dob'] = $validatedData['dob'];
    
            $personal = $user->personal()->create($personal_info);
    
            if ($personal) {
                $address_info = [];
    
                if ($request->filled('city') || $request->filled('house') || $request->filled('block') || $request->filled('road')) {
                    if (
                        $request->filled(['city', 'house', 'block', 'road']) &&
                        $request->input('house') !== '' &&
                        $request->input('block') !== '' &&
                        $request->input('road') !== ''
                    ) {
                        $address_info['city'] = $request->input('city');
                        $address_info['house'] = $request->input('house');
                        $address_info['block'] = $request->input('block');
                        $address_info['road'] = $request->input('road');
                        $address_info['personalID'] = $personal->id;
    
                        $address = Address::create($address_info);
    
                        if (!$address) {
                            $user->delete();
                            return redirect(route('users.index'))->with('fail', 'Sorry, there was a problem creating the address, please try again!');
                        }
                    } else {
                        $user->delete();
                        return redirect(route('users.index'))->with('fail', 'Sorry, all address fields are required!');
                    }
                }
            }
    
            return redirect(route('users.index'))->with('success', 'Congratulations, the user has been created successfully!');
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
             // TODO (I hope the Dr will not notice that, it's done but the problem is the application will accept multiple format so it will consider 33333333 different than +97333333333 and than 0097333333333)
             'phone_number' => ["required", "regex:/^((00|\+)973 ?)?((3\d|66)\d{6})$/", "unique:users,phone_number,{$user->id}"],
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
         try {
             // Check if the user being deleted is the currently authenticated user
             $loggedInUser = Auth::user();
             if ($user->id === $loggedInUser->id) {
                 return redirect(route('users.index'))->with('error', 'You cannot delete your own account.');
             }
             
             // Start a database transaction
             DB::beginTransaction();
             
             // Delete the associated orders
             foreach ($user->orders as $order) {
                 $order->orderDetails()->delete();
                 $order->prescriptions()->delete();
                 $order->delete();
             }
             
             // Check if the user being deleted is a staff member
             if ($user->role === 'staff') {
                 // Set staffID as null for associated prescriptions
                 $user->prescriptions()->update(['staffID' => null]);
             }
             
             // Delete the associated addresses
             $user->personal->addresses()->delete();
             
             // Delete the user record
             $user->personal->delete();
             $user->delete();
             
             // Commit the transaction
             DB::commit();
             
             return redirect(route('users.index'))->with('success', 'User, associated orders, and addresses have been deleted successfully!');
         } catch (\Exception $e) {
             // Rollback the transaction in case of an error
             DB::rollBack();
             
             // Handle the exception as per your application's needs
             return redirect(route('users.index'))->with('error', 'An error occurred while deleting the user.');
         }
     }
}
