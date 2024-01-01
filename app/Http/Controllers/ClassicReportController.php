<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClassicReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */public function index($tableName)
{
    $columns = [];
    $users = null;

    if ($tableName === 'users') {
        $columns = ['id', 'username', 'name', 'phone_number', 'email', 'role'];
        $users = User::select($columns)->get();
    } else if ($tableName === 'products') {
        $columns = ['id', 'name', 'price', 'category', 'description', 'prescription_req', 'supplierID', 'stock', 'exp_date'];
        $users = Product::select($columns)->get(); 
    } else if ($tableName === 'orders') {
        $columns = ['id', 'customerID', 'total_price', 'status'];
        $users = Order::select($columns)->get(); 
    }
    else if ($tableName === 'suppliers') {
        $columns = ['id', 'company_name', 'commercial_register', 'email', 'phone'];
        $users = Supplier::select($columns)->get(); 
    }
    // rest of the tables

    return view('pages.admin.classic-report', ['columns' => $columns, 'users' => $users]);
}






// public function getTableData($tableName)
// {
//     $users = DB::table($tableName)->get();
//      dd($users);
//      return view('pages.admin.classic-report', ['users' => $users]);
// }

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
