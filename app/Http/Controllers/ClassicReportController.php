<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\User;

use Illuminate\View\View;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClassicReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
//     public function index($tableName)
// {
//     $columns = [];
//     $users = null;
  
//     if ($tableName === 'users') {
//         $columns = ['id', 'username', 'name', 'phone_number', 'email', 'role'];
//         // $users = User::select($columns)->paginate(3)->get();
//         $users = User::paginate(10);
//     } else if ($tableName === 'products') {
//         $columns = ['id', 'name', 'price', 'category', 'description', 'prescription_req', 'supplierID', 'stock', 'exp_date'];
//         $users = Product::paginate(10);
//     } else if ($tableName === 'orders') {
//         $columns = ['id', 'customerID', 'total_price', 'status'];
//         $users = Order::paginate(10);
//     }
//     else if ($tableName === 'suppliers') {
//         $columns = ['id', 'company_name', 'commercial_register', 'email', 'phone'];
//         $users = Supplier::paginate(10);
//     }
//     else if ($tableName === 'payments') {
//         $columns = ['id', 'status', 'amount', 'transaction', 'phone'];
//         $users = Payment::paginate(10);
//     }
//     // rest of the tables

//     return view('pages.admin.classic-report', ['columns' => $columns, 'users' => $users]);
// }

public function index($tableName)
{
    $columns = [];
    $users = null;
    $searchQuery = request()->query('search');

    if ($tableName === 'users') {
        $columns = ['id', 'username', 'name', 'phone_number', 'email', 'role'];

        $users = User::where(function ($query) use ($searchQuery) {
            $query->where('username', 'LIKE', '%' . $searchQuery . '%')
                ->orWhere('name', 'LIKE', '%' . $searchQuery . '%')
                ->orWhere('phone_number', 'LIKE', '%' . $searchQuery . '%')
                ->orWhere('email', 'LIKE', '%' . $searchQuery . '%');
        })->paginate(8);
    } else if ($tableName === 'products') {
        $columns = ['id', 'name', 'price', 'category', 'description', 'prescription_req', 'supplierID', 'stock', 'exp_date'];

        $users = Product::where(function ($query) use ($searchQuery) {
            $query->where('name', 'LIKE', '%' . $searchQuery . '%')
                ->orWhere('category', 'LIKE', '%' . $searchQuery . '%')
                ->orWhere('description', 'LIKE', '%' . $searchQuery . '%');
        })->paginate(8);
    } else if ($tableName === 'orders') {
        $columns = ['id', 'customerID', 'total_price', 'status'];

        $users = Order::where(function ($query) use ($searchQuery) {
            $query->where('customerID', 'LIKE', '%' . $searchQuery . '%')
                ->orWhere('status', 'LIKE', '%' . $searchQuery . '%');
        })->paginate(8);
        $users = Supplier::where(function ($query) use ($searchQuery) {
            $query->where('company_name', 'LIKE', '%' . $searchQuery . '%')
                ->orWhere('commercial_register', 'LIKE', '%' . $searchQuery . '%')
                ->orWhere('email', 'LIKE', '%' . $searchQuery . '%')
                ->orWhere('phone', 'LIKE', '%' . $searchQuery . '%');
        })->paginate(8);
    } else if ($tableName === 'payments') {
        $columns = ['id', 'status', 'amount', 'transaction', 'phone'];

        $users = Payment::where(function ($query) use ($searchQuery) {
            $query->where('status', 'LIKE', '%' . $searchQuery . '%')
                ->orWhere('amount', 'LIKE', '%' . $searchQuery . '%')
                ->orWhere('transaction', 'LIKE', '%' . $searchQuery . '%')
                ->orWhere('method', 'LIKE', '%' . $searchQuery . '%');
        })->paginate(10);
    }
    

    return view('pages.admin.classic-report', [
        'columns' => $columns, 
        'users' => $users,
        'searchQuery' => $searchQuery,
        'tableName' => $tableName,
    ]);
}







    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
