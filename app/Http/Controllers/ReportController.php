<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    // function count_customer(){
    //     //count customer
    //     $customers = DB::table('users')->where('role', 'customer')->count();
    //     return view('pages.admin.report', ['customers'=>$customers]);

    // }
    function summary(){
        //count customer
        $customers = DB::table('users')->where('role', 'customer')->count();

        // $orders = DB::table('orders')->where('status', 'delivered')->count();
        $orders = Order::where('status', 'delivered')->count();

        $itemsSold = DB::table('order_details')->sum('quantity');

        $totalRevenue = DB::table('payments')->where('status', 'successful')->sum('amount');
        //category Bar
        $totalRevenueForCategories = DB::select('SELECT products.category, SUM(order_details.quantity * products.price) AS total_value
        FROM order_details
        JOIN payments ON order_details.orderID = payments.orderID
        JOIN products ON order_details.productID = products.id
        WHERE payments.status = "successful"
        GROUP BY products.category');

        $sortCategoryByTotal = collect($totalRevenueForCategories)->sortByDesc('total_value')->values()->all();
        $totalValueSum = collect($totalRevenueForCategories)->sum('total_value');
        
        $categoryRevenuePercentage = array_map(function ($item) {
            $item->percentage = null;
            return $item;
        }, $sortCategoryByTotal);

        foreach ($categoryRevenuePercentage as $item) {
            $category = $item->category;
            $revenue = $item->total_value;
            $calcPercentage = ($revenue / $totalValueSum) * 100;
           $item->percentage = $calcPercentage;
        }

        // heighest rating products
        
        // heighest rating products with there details
        $heighRate = DB::select('
        SELECT average_rate, P.*
        FROM (
            SELECT AVG(R.rate) AS average_rate, R.productID
            FROM reviews R
            GROUP BY R.productID
        ) AS subquery
            JOIN products P ON subquery.productID = P.id
            ORDER BY average_rate DESC
        ');
        //take first three images: 
        // $heighimages = [$heighRate[0]->image, $heighRate[1]->image, $heighRate[2]->image];
        $heighOrders = DB::select('
    SELECT COUNT(OD.orderID) AS order_count, P.*
    FROM order_details OD
    INNER JOIN products P ON OD.productID = P.id
    GROUP BY OD.productID
    ORDER BY order_count DESC
');

if(!empty($heighOrders)) {
    $heighOrderCount = $heighOrders[0]->order_count;
    $heighimages = [$heighOrders[0]->image];
} else {
    $heighOrderCount = 0;
    $heighimages = [];
}

  
        // return in reprot view
        return view('pages.admin.report', 
        ['customers' =>$customers,
         'orders' =>$orders,
         'itemsSold' =>$itemsSold,
         'totalRevenue' =>$totalRevenue,
         'totalValueSum' => $totalValueSum,
         'categoryRevenuePercentage' => $categoryRevenuePercentage,
         'heighimages' => $heighimages
         ]);

    }
}
