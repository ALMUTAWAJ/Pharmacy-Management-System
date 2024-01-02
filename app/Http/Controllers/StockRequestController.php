<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Supplier;
use Mail;
use Illuminate\Mail\Message;
use App\Models\StockRequest;

class StockRequestController extends Controller
{
    public function prepareEmail($productId)
    {
        // Retrieve supplier info related to the product ID
        $product = Product::findOrFail($productId);
        $supplier = $product->supplier;

        // Generate email subject with product and supplier details
        $subject = "New Stock Request for {$product->name} from {$supplier->company_name}";

        // Redirect to a page for the supplier to type the email body
        return view('pages.staff.stock-request.mail-to-supplier', compact('supplier', 'subject', 'productId'));
    }



    public function sendEmail(Request $request)
    {
        $request->validate([
            'emailBody' => 'required|string|max:500',
            'quantity' => [
                'required',
                'integer',
                'min:0',
                'max:3000',
            ],

        ], [
            'emailBody.required' => 'Email body is required.',
            'emailBody.string' => 'Invalid email body format.',
            'emailBody.max' => 'Email body should not exceed 500 characters.',
        ]);


        // Retrieve data from the form
        $productId = $request->productId;
        $supplierId = $request->supplierId;
        $content = $request->emailBody;
        $subject = $request->subject;
        $quantity = $request->quantity;


        // Find the supplier
        $supplier = Supplier::findOrFail($supplierId);

        // Find the product
        $product = Product::findOrFail($productId);

        // Compose and send the email
        $subject = "New Stock Request for {$product->name} from {$supplier->company_name}";
        

        $mailSent = Mail::raw($content, function (Message $message) use ($supplier, $subject) {
            $message->to($supplier->email)
                ->subject($subject)->from('example@example.com', 'Code-Pharmacy');
        });


        if ($mailSent) {
            // Save the record of the sent request
            $stockRequest = new StockRequest();
            $stockRequest->supplierID = $supplier->id;
            $stockRequest->productID = $productId;
            $stockRequest->staffID = auth()->user()->id;
            $stockRequest->quantity = $quantity;
            $stockRequest->subject = $subject;
            $stockRequest->save();

            return redirect()->back()->with('success', 'Email sent and request saved successfully.');
        } else {
            return redirect()->back()->with('fail', 'Failed to send email. Please try again.');
        }
    }



  
function showListInReport(Request $request)
{
    $sort = $request->sort ?? 'asc'; // Default sorting order

    // Fetch StockRequests with related Product, Supplier, and Staff data
    $stockRequests = StockRequest::with([
        'product:id,name',
        'supplier:id,company_name',
        'staff:id,name'
    ])
    ->orderBy('created_at', $sort)
    ->get();

    return view('pages/admin/show-stock-requests', compact('stockRequests'));
}


    function detailInReport($id){
        // Retrieve the StockRequest record by ID with its related data
        $stockRequest = StockRequest::with(['product', 'supplier', 'staff'])->find($id);
    
        // Accessing related data
        $productName = $stockRequest->product->name;
        $supplierCompanyName = $stockRequest->supplier->company_name;
        $staffName = $stockRequest->staff->name;
        $createdAt = $stockRequest->created_at;
        $quantity = $stockRequest->quantity;
    
        return view('pages/admin/show-stock-request-detail', [
            'stockRequest' => $stockRequest,
            'productName' => $productName,
            'supplierCompanyName' => $supplierCompanyName,
            'staffName' => $staffName,
            'createdAt' => $createdAt,
            'quantity' => $quantity
        ]);

    }

    






}



