<?php

use App\Http\Controllers\ForgetPasswordController;
use App\Http\Controllers\ManageProductController;
use App\Http\Controllers\ManageOrderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StockRequestController;
use Illuminate\Support\Facades\Session;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Public Pages
Route::get('/try', function () {
    return view('testzeena');
});
Route::get('/', [PublicController::class, 'main'])->name('home');


// Register related
Route::get('/register', [RegisterController::class, 'registerPage'])->name('register');
Route::post('/register', [RegisterController::class, 'registerPost'])->name('register.post');

// Login related
Route::get('/login', [LoginController::class, 'checkUser'])->name('login');
Route::post('/login', [LoginController::class, 'loginPost'])->name('login.post');

// Logout
Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');

// Reset Password
Route::get('/forget-password', [ForgetPasswordController::class, 'forgetPassword'])->name('forget.password');
Route::post('/forget-password', [ForgetPasswordController::class, 'forgetPasswordPost'])->name('forget.password.post');
Route::get('/reset-password/{token}', [ForgetPasswordController::class, 'resetPassword'])->name('reset.password')->middleware('verifyResetToken');
Route::post('/reset-password', [ForgetPasswordController::class, 'resetPasswordPost'])->name('reset.password.post');
Route::get('/forget-password', [ForgetPasswordController::class, 'forgetPassword'])->name('forget.password');
Route::post('/forget-password', [ForgetPasswordController::class, 'forgetPasswordPost'])->name('forget.password.post');
Route::get('/reset-password/{token}', [ForgetPasswordController::class, 'resetPassword'])->name('reset.password')->middleware('verifyResetToken');
Route::post('/reset-password', [ForgetPasswordController::class, 'resetPasswordPost'])->name('reset.password.post');


// Routes accessible only to authenticated users.
Route::middleware(['auth'])->group(function () {

    // Admin routes
    Route::middleware(['admin'])->group(function () {
        // Routes accessible only to users with the "admin" role.
        Route::get('/admin/index', function () {
            return view('pages.admin.index');
        })->name('admin.index');

        Route::get('/admin/users', function () {
            return view('pages.admin.users');
        })->name('admin.users');

        Route::get('/admin/add-user', function () {
            return view('pages.admin.add-user');
        })->name('admin.add.user');

        Route::get('/admin/users/details', function () {
            return view('pages.admin.user-details');
        })->name('admin.user.details');

        Route::get('/admin/users/details/edit', function () {
            return view('pages.admin.user-edit');
        })->name('admin.user.edit');

        Route::get('/admin/staff', function () {
            return view('pages.admin.manage-staff');
        });
        Route::get('/admin/report', [ReportController::class, 'summary'])->name('admin.report');

        Route::resource('/admin/users', UserController::class);
        Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');

        Route::get('/admin/interactive/report', function () {
            return view('pages.admin.interactive-report');
        })->name('admin.interactive-report');
    });

    // Staff routes
    Route::middleware(['staff'])->group(function () {
        // Routes accessible only to users with the "staff" role.
        Route::get('/staff/index', function () {
            return view('pages.staff.index');
        })->name('staff.index');

        Route::resource('manage_products', ManageProductController::class);
        Route::get('staff/products/add', [ManageProductController::class, 'create'])->name('staff.add.product');
        Route::post('staff/products/add', [ManageProductController::class, 'store'])->name('staff.add.product.post');
        Route::get('staff/products/list', [ManageProductController::class, 'index'])->name('staff.view.product');
        Route::get('staff/product/detail/{id}', [ManageProductController::class, 'show'])->name('staff.show.product');
        Route::get('staff/product/edit/{id}', [ManageProductController::class, 'edit'])->name('staff.edit.product');
        Route::patch('/staff/product/update/{id}', [ManageProductController::class, 'update'])->name('product.update');
        // I prefer to access implicit methods routes such as manage_products.destroy directly, but others it is better to give a new route

        Route::resource('manage_orders', ManageOrderController::class);
        Route::get('staff/orders/add', [ManageOrderController::class, 'create'])->name('staff.add.order');
        Route::post('staff/orders/add', [ManageOrderController::class, 'store'])->name('staff.add.order.post');
        Route::get('staff/orders/list', [ManageOrderController::class, 'index'])->name('staff.view.order');
        Route::get('staff/order/edit/{id}', [ManageOrderController::class, 'edit_and_show'])->name('staff.edit.order');
        Route::put('/staff/order/update/{id}', [ManageOrderController::class, 'updateOrder'])->name('staff.order.updateGeneral');
        Route::put('/staff/order/cancel/{id}', [ManageOrderController::class, 'cancel'])->name('staff.order.update');

        // Send Mail to Staff
        Route::get('prepare/stock/mail/request/{id}', [StockRequestController::class, 'prepareEmail'])->name('prepare.email');
        Route::post('send/stock/mail/request/', [StockRequestController::class, 'sendEmail'])->name('send.email');

    });




    // Customer routes
    Route::middleware(['customer'])->group(function () {
        // Routes accessible only to users with the "customer" role.
        Route::get('/customer/index', function () {
            return view('pages.customer.index');
        })->name('customer.index');


        Route::get('/profile', [ProfileController::class, 'showProfile'])->name('profile');
        Route::put('/profile/general', [ProfileController::class, 'updateGeneral'])->name('update.general');
        Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('update.password');
        Route::put('/profile/address/{id}', [ProfileController::class, 'updateAddress'])->name('update.address');
        Route::get('/profile/new/address', [ProfileController::class, 'newAddress'])->name('new.address');
        Route::post('/profile/new/address', [ProfileController::class, 'newAddressAdd'])->name('new.address.add');
        Route::get('/selected/address/view', [ProfileController::class, 'fetchAddress'])->name('fetch.address');

        // Cart routes
        // Temporary session to test the cart
        // To run it, go to the test route
        Route::get('/test', function () {
            session()->put('cart', [
                [
                    'productID' => 1,
                    'quantity' => 3,
                ],
            ]);
            $cart = session('cart', []);
            dump($cart);
        });
        Route::get('/customer/cart', [CartController::class, 'showCart'])->name('customer.cart');
        Route::get('/cart/remove/{productId}', [CartController::class, 'removeItem'])->name('cart.remove');

        // Checkout routes
        Route::get('/customer/cart/checkout', [CheckoutController::class, 'showCheckout'])->name('customer.checkout');
        Route::get('/customer/user/info', [CheckoutController::class, 'getUserInfo'])->name('customer.user.info');
        Route::post('/customer/cart/checkout/order', [CheckoutController::class, 'placeOrder'])->name('customer.order');

        Route::post('/customer/cart/checkout/address', [CheckoutController::class, 'updateAddressInfo'])
            ->name('customer.cart.checkout.address');

        Route::post('/customer/cart/checkout/user', [CheckoutController::class, 'updateUserInfo'])
            ->name('customer.cart.checkout.user');
    });

    // Supplier routes
    Route::middleware(['supplier'])->group(function () {
        // Routes accessible only to users with the "supplier" role.
        Route::get('/supplier/index', function () {
            return view('pages.supplier.index');
        })->name('supplier.index');
    });



    Route::get('/customer/products', [ProductController::class, 'index']);
    Route::get('/customer/products/{id}', [ProductController::class, 'show']);

    // Route::get('/customer/details', function () {
    //     return view('pages.customer.details');
    // });

    Route::get('/customer/details/{id}', [ProductController::class, 'show']);
});
