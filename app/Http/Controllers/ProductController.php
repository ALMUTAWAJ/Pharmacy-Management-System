<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ReviewController;

use App\Models\Product;
use App\Models\Review;
use Illuminate\Support\Facades\DB;


use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * isplay a listing of the resource in home page
     */
    public function homeIndex()
    {
        $newArrivals = Product::orderBy('created_at', 'desc')->get();

        $bestSellers = Product::select('products.id', 'products.name', 'products.image', 'products.price', 'products.category', 'products.description', 'products.category', DB::raw('SUM(order_details.quantity) as total_quantity'))
            ->join('order_details', 'products.id', '=', 'order_details.productID')
            ->groupBy('products.id', 'products.name', 'products.image', 'products.price', 'products.category', 'products.description', 'products.category')
            ->orderByDesc('total_quantity')
            ->get();

        $customerReviews = Product::leftJoin('reviews', 'products.id', '=', 'reviews.productID')
            ->select('products.id', 'products.name', 'products.description', 'products.price', 'products.image', DB::raw('COALESCE(AVG(reviews.rate), 0) AS average_rating'))
            ->groupBy('products.id', 'products.name', 'products.description', 'products.price', 'products.image')
            ->orderByDesc('average_rating')
            ->get();



        return view(
            'pages.customer.index',
            [
                'newArrivals' => $newArrivals,
                'bestSellers' => $bestSellers,
                'customerReviews' => $customerReviews
            ]
        );
    }

    /**
     * Display a listing of the resource in product page
     */
    public function index()
    {
        $products = Product::leftJoin('reviews', 'products.id', '=', 'reviews.productID')
            ->select('products.id', 'products.name', 'products.description', 'products.price', 'products.image', DB::raw('COALESCE(AVG(reviews.rate), 0) AS average_rating'))
            ->groupBy('products.id', 'products.name', 'products.description', 'products.price', 'products.image')
            ->get();




        return view(
            'pages.customer.products',
            [
                'products' => $products,
            ]
        );
    }
    /**
     * Display list of product in product page filtered by category
     */
    public function showCategory(string $category)
    {
        $products = Product::leftJoin('reviews', 'products.id', '=', 'reviews.productID')
            ->select('products.id', 'products.name', 'products.description', 'products.price', 'products.image', DB::raw('COALESCE(AVG(reviews.rate), 0) AS average_rating'))
            ->groupBy('products.id', 'products.name', 'products.description', 'products.price', 'products.image')
            ->where('category', $category)
            ->get();

        return view(
            'pages.customer.products',
            [
                'products' => $products,
            ]
        );
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


        $product = Product::leftJoin('reviews', 'products.id', '=', 'reviews.productID')
            ->select('products.id', 'products.name', 'products.description', 'products.price', 'products.image', 'products.category', 'products.prescription_req', DB::raw('COALESCE(AVG(reviews.rate), 0) AS average_rating'))
            ->groupBy('products.id', 'products.name', 'products.description', 'products.price', 'products.image', 'products.category', 'products.prescription_req')
            ->find($id);

        // $product = Product::where('category', $id)->get();

        return view(
            'pages.customer.details',
            [
                'product' => $product,

            ]
        );
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