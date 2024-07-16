<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;

class SupplierController extends Controller
{

    function rules()
    {
        return [
            'company_name' => [
                'required',
                'max:50',
                'regex:/^[A-Za-z0-9\s]+$/',
                'unique:suppliers,company_name',
            ],
            'email' => "max:50|required|email|unique:suppliers,email",
            'commercial_register' => 'required|digits:8|unique:suppliers,commercial_register',
            'phone' => ["required", "regex:/^((00|\+)973 ?)?((3\d|66)\d{6})$/", "unique:suppliers,phone"],
        ];
    }


    function feedback()
    {
        return [
            'commercial_register.digits' => 'The commercial register must be 8 digits',
            'phone.regex' => 'The phone number must follow Bahrain standards',
        ];
    }





    function index(Request $request)
    {
        $searchQuery = $request->query('search');

        // Query products based on the filter type and search query
        $suppliers = Supplier::query();

        if ($searchQuery) {
            $suppliers->where(function ($query) use ($searchQuery) {
                $query->where('company_name', 'like', '%' . $searchQuery . '%')
                    ->orWhere('commercial_register', 'like', '%' . $searchQuery . '%');
            });
        }

        $suppliers = $suppliers->get();

        return view('pages.admin.supplier.index')->with([
            'suppliers' => $suppliers,
            'searchQuery' => $searchQuery,
        ]);

    }


    public function add()
    {
        return view("pages.admin.supplier.add-supplier");
    }




    function store(Request $request)
    {

        // validate and give feedback
        $request->validate($this->rules(), $this->feedback());

        // insert the date into the database
        $data = [
            'company_name' => $request->input("company_name"),
            'commercial_register' => $request->input("commercial_register"),
            'phone' => $request->input("phone"),
            'email' => $request->input("email"),
        ];


        $done = Supplier::create($data);

        if ($done)
            return redirect(route('admin.view.supplier'))->with('success', 'Supplier data has been inserted successfully ✔');
        return redirect(route('admin.add.supplier'))->with('fail', 'Sorry, there was a problem inserting the supplier data, please try again !');
    }




    public function edit($id)
    {
        $supplier = Supplier::findOrFail($id);
        return view('pages.admin.supplier.edit-supplier', ['supplier' => $supplier]);
    }
    
    
    function update(Request $request, $id)
    {
        // find that supplier
        $supplier = Supplier::findOrFail($id);

        // update rules
       $rules = [
        'company_name' => [
            'required',
            'max:50',
            'regex:/^[A-Za-z0-9\s]+$/',
            "unique:suppliers,company_name,{$id}",
        ],
        'email' => "max:50|required|email|unique:suppliers,email,{$id}",
        'commercial_register' => "required|digits:8|unique:suppliers,commercial_register,{$id}",
        'phone' => ["required", "regex:/^((00|\+)973 ?)?((3\d|66)\d{6})$/", "unique:suppliers,phone,{$id}"],
    ];


        // validate and feedback
        $request->validate($rules, $this->feedback());


        // save the data
        $data = [
            'company_name' => $request->input("company_name"),
            'commercial_register' => $request->input("commercial_register"),
            'phone' => $request->input("phone"),
            'email' => $request->input("email"),
        ];


        $done = $supplier->update($data);

        if ($done) {
            return redirect(route('admin.edit.supplier', ['id' => $id]))->with('success', 'Supplier data has been updated successfully!');
        } else {
            return redirect(route('admin.edit.supplier', ['id' => $id]))->with('fail', 'Sorry, there was a problem updating supplier data. Please try again!');
        }

    }



    function delete($id)
    {

        $success = Supplier::destroy($id);

        if ($success)
            return redirect(route('admin.view.supplier'))->with('success', 'Supplier has been deleted successfully!');
        else {
            return redirect(route('admin.view.supplier'))->with('fail', 'Sorry, Supplier cannot be deleted at the moment. Try again later!');
        }

    }



}

