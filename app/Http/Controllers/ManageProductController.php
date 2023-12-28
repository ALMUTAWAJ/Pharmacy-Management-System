<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Supplier;
use Carbon\Carbon;
use Storage;

class ManageProductController extends Controller
{

    public function index(Request $request)
    {
        $filterType = $request->query('filter_type');
        $searchQuery = $request->query('search');

        // Query products based on the filter type and search query
        $products = Product::query();

        if ($filterType) {
            $products->where('category', $filterType);
        }


        if ($searchQuery) {
            $products->where(function ($query) use ($searchQuery) {
                $query->where('name', 'like', '%' . $searchQuery . '%')
                    ->orWhere('category', 'like', '%' . $searchQuery . '%')
                    ->orWhere('description', 'like', '%' . $searchQuery . '%');
            });
        }

        $products = $products->get();


        return view('pages.staff.product.view-products')->with([
            'products' => $products,
            'searchQuery' => $searchQuery,
            'filter' => $filterType
        ]);
    }



    public function create()
    {
        $suppliers = Supplier::all();
        return view("pages.staff.product.add-product",['suppliers'=>$suppliers]);
    }


    public function rules()
    {
        return [
            'name' => [
                'required',
                'max:50',
                'regex:/^[A-Za-z0-9\s]+$/',
            ],
            'price' => [
                'required',
                'numeric',
                'min:0.5',
                'max:299.999',
            ],
            'category' => [
                'required',
                'string',
                'max:30',
                'not_in:Select a category',
            ],
            'product-image' => [
                'required',
                'image',
                'mimes:svg,jpeg,jpg,png',
                'max:1024',
            ],
            'description' => [
                'required',
                'max:500',
                'regex:/^[A-Za-z0-9\s\'",.()-]+$/',
            ],
            'prescription_req' => [
                'boolean',
            ],
            'supplierID' => [
                'required',
                'not_in:Select product supplier',
            ],
            'stock' => [
                'required',
                'integer',
                'min:0',
                'max:3000',
            ],
            'expiry' => [
                'required',
                'date',
                'after:' . now()->toDateString(),
            ],
        ];
    }

    private function feedback()
    {
        return [
            'product-image.image' => 'Sorry, the uploaded file is not an image',
            'product-image.max' => 'Sorry, the maximum size is 2MB for the product image',
            'product-image.mimes' => 'Only SVG, JPEG, JPG, and PNG files are allowed.',
            'category.not_in' => 'Please, select a product category',
            'supplierID.not_in' => 'Please, select a product supplier',
            'expiry.date' => 'Please provide a valid date for the expiration date field.',
            'expiry.after' => 'The expiration date must be in the future.',
            'description.regex' => 'Description field accept only alphabet letters, number, and the following special characters ( ) . - , and quotation marks '
        ];
    }


    public function store(Request $request)
    {
        $request->validate($this->rules(), $this->feedback());

        $image = $request->file("product-image");

        $path = $image->store('products-images', 'public');


        $checked = false;
        if ($request->has('pres_req')) {
            $checked = true;
        }

        $expiry = Carbon::createFromFormat('m/d/Y', $request->expiry)->format('Y-m-d');


        $data = [
            'name' => $request->input("name"),
            'price' => $request->input("price"),
            'category' => $request->input("category"),
            'prescription_req' => $checked,
            'image' => $path,
            'description' => $request->input("description"),
            'supplierID' => $request->input("supplierID"),
            'stock' => $request->input("stock"),
            'exp_date' => $expiry,
            'created_at' => date('Y-m-d H:i:s') // Current timestamp
        ];


        $done = Product::create($data);

        if ($done)
            return redirect(route('staff.view.product'))->with('success', 'The product has been inserted successfully !');
        return redirect(route('staff.add.product'))->with('fail', 'Sorry, there was a problem inserting the product, please try again !');
    }


    public function show(string $id)
    {
        $found = Product::find($id);
        if (!$found)
            return redirect(route('staff.view.product'))->with('fail', 'Sorry, there was a problem showing the product detail, please try again !');

        $supplier = Supplier::find($found->supplierID) ? Supplier::find($found->supplierID)->company_name : 'Supplier is not found';
        return view('pages.staff.product.product-detail', ['product' => $found, 'supplier' => $supplier]);
    }

    public function edit($id)
    {
        $suppliers = Supplier::all();
        $product = Product::findOrFail($id);
        $supplier = Supplier::findOrFail($product->supplierID);
        $expiry = Carbon::createFromFormat('Y-m-d', $product->exp_date)->format('m/d/Y');
        return view('pages.staff.product.edit-product', ['product' => $product, 'expiry' => $expiry,'suppliers'=>$suppliers,'selectedSupplier'=>$supplier]);
    }

    public function update(Request $request, string $id)
    {
        $rules = $this->rules();
        $rules['stock'] = [
            'required',
            'integer',
            'min:0',
            'max:1000',
        ];

        $feedback = $this->feedback();
        $product = Product::findOrFail($id);



        $checked = $request->has('pres_req');
        $expiry = Carbon::createFromFormat('m/d/Y', $request->expiry)->format('Y-m-d');

        $data = [
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'category' => $request->input('category'),
            'prescription_req' => $checked,
            'description' => $request->input('description'),
            'supplierID' => $request->input('supplierID'),
            'stock' => $request->input('stock'),
            'exp_date' => $expiry,
        ];

        if ($request->hasFile('product-image')) {
            $image = $request->file('product-image');
            $path = $image->store('products-images', 'public');
            $data['image'] = $path;
        } else { // if image is not given
            unset($rules['product-image']);
            unset($feedback['product-image.file']);
            unset($feedback['product-image.mimes']);
        }

        $request->validate($rules, $feedback); // validate after the possible change on the rules and its feedback

        $done = $product->update($data);

        if ($done) {
            return redirect(route('staff.edit.product', ['id' => $id]))->with('success', 'The product has been updated successfully!');
        } else {
            return redirect(route('staff.edit.product', ['id' => $id]))->with('fail', 'Sorry, there was a problem updating the product. Please try again!');
        }
    }


    public function destroy(string $id)
    {
        $success = Product::destroy($id);

        if ($success)
            return redirect(route('staff.view.product'))->with('success', 'The product has been deleted successfully!');
        else {
            return redirect(route('staff.view.product'))->with('fail', 'Sorry, the product cannot be deleted at the moment. Try again later!');
        }
    }
}
