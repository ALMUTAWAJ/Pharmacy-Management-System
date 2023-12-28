<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Prescription;

class ManageOrderController extends Controller
{
    public function index(Request $request) // for view order page
    {
        $filterType = $request->query('filter_type');
        $searchQuery = $request->query('search');

        // Query products based on the filter type and search query
        $orders = Order::query();

        if ($filterType) {
            $orders->where('status', $filterType);
        }

        if ($searchQuery) {
            $orders->where(function ($query) use ($searchQuery) {
                $query->where('ID', 'like', '%' . $searchQuery . '%')
                    ->orWhere('total_price', 'like', '%' . $searchQuery . '%');
            });
        }

        $orders = $orders->get();

        return view('pages.staff.order.view-orders')->with([
            'orders' => $orders,
            'searchQuery' => $searchQuery,
            'filter' => $filterType
        ]);

    }




    public function edit_and_show($id, Request $request)
{
    $order = Order::with([
        'orderDetails.product',
        'user.personal'
    ])->find($id);

    $filterType = $request->query('filter_type');
    $searchQuery = $request->query('search');

    $orderDetails = $order->orderDetails();

    if ($filterType) {
        $orderDetails->whereHas('product', function ($query) use ($filterType) {
            $query->where('category', $filterType);
        });
    }

    if ($searchQuery) {
        $orderDetails->where(function ($query) use ($searchQuery) {
            $query->whereHas('product', function ($query) use ($searchQuery) {
                $query->where('name', 'like', '%' . $searchQuery . '%')
                    ->orWhere('ID', 'like', '%' . $searchQuery . '%');
            });
        });
    }

    $orderDetails = $orderDetails->get();

    $user = $order->user;
    $personal = $user->personal;

    $prescriptionFiles = Prescription::where('orderID', $id)->get(); // Retrieve prescriptions associated with the order ID

    return view('pages.staff.order.edit-order', compact('searchQuery', 'filterType', 'order', 'orderDetails', 'personal', 'prescriptionFiles'));
}


    public function updateOrder($id, Request $request)
    {
        $order = Order::with('orderDetails.product')->find($id);

        if ($request->status === 'Delivered') {
            $order->status = 'Delivered';
            $order->save();
            return redirect(route('staff.edit.order', ['id' => $id]))->with('success', 'The status set to "Delivered" successfully!');
        }

        // Add staffID to prescriptions
        $staffID = auth()->user()->id;
        $prescriptions = Prescription::where('orderID', $id)->get();

        if ($prescriptions->isNotEmpty()) {
            foreach ($prescriptions as $prescription) {
                $prescription->staffID = $staffID;
                $prescription->save();
            }
        }

        $indicesToSave = [];
        $indicesToDelete = [];
        $quantitiesSum = 0;


        foreach ($order->orderDetails as $orderDetail) {
            $index= $orderDetail->id;
            $newQuantity = $request->input('quantity')[$index];
            $quantitiesSum += $newQuantity;
        }

        if ($quantitiesSum==0)
            return redirect(route('staff.view.order'))->with('fail', 'You cannot make the order empty. Mark it as Cancelled instead!');


        foreach ($order->orderDetails as $orderDetail) {
            $index= $orderDetail->id;
            $newQuantity = $request->input('quantity')[$index];
            if ($newQuantity == 0) {
                $deletedOrderDetail = $order->orderDetails[$index];
                $deletedProduct = $deletedOrderDetail->product;

                // Increase stock for deleted product quantity
                $deletedProduct->stock += $deletedOrderDetail->quantity;
                $deletedProduct->save();

                // save it here to delete it later
                $indicesToDelete[] = $index;
            } else {
                // Add index to save array for non-zero quantities
                $indicesToSave[] = $index;

                $diff = $newQuantity - $orderDetail->quantity;

                if ($diff > 0) {
                    $product = $orderDetail->product;
                    // Check if enough stock is available for increasing the quantity
                    if ($product->stock >= $diff) {
                        $product->stock -= $diff;
                        $product->save();
                    } else {
                        return redirect(route('staff.edit.order', ['id' => $id]))->with('fail', 'Insufficient stock for the product: ' . $product->name);
                    }
                } elseif ($diff < 0) {
                    $product = $orderDetail->product;
                    // Increase stock for removed quantities
                    $product->stock += abs($diff);
                    $product->save();
                }

                // Update the order detail quantity
                $orderDetail->quantity = $newQuantity;
                $orderDetail->save();
            }
        }

        // Delete the empty products of the order
        OrderDetail::whereIn('id', $indicesToDelete)->delete();


        // Recalculate total price for orderDetails that remain and update the order table
        $remainingOrderDetails = $order->orderDetails()->whereIn('id', $indicesToSave)->get();
        $totalPrice = 0;

        foreach ($remainingOrderDetails as $orderDetail) {
            $product = $orderDetail->product;
            $totalPrice += $orderDetail->quantity * $product->price; 
        }

        $order->total_price = $totalPrice;
        $order->status = $request->status;
        $order->save();

        return redirect(route('staff.edit.order', ['id' => $id]))->with('success', 'Order updated successfully!');

    }


    
    public function cancel(string $id)
    {
        $order = Order::with('orderDetails.product')->find($id);
    
        if ($order->status == 'Cancelled') {
            return redirect(route('staff.view.order', ['id' => $id]))->with('fail', 'The order is already cancelled!');
        }
    
        $order->status = 'Cancelled';
        $order->save();
    
        // Increase stock for the products in the cancelled order
        foreach ($order->orderDetails as $orderDetail) {
            $product = $orderDetail->product;
            $product->stock += $orderDetail->quantity;
            $product->save();
        }
    
        return redirect(route('staff.view.order', ['id' => $id]))->with('success', 'The order has been cancelled successfully!');
    }
    


}
