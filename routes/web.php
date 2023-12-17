<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Pos\CategoryController;
use App\Http\Controllers\Pos\CustomerController;
use App\Http\Controllers\Pos\ProductController;
use App\Http\Controllers\Pos\SupplierController;
use App\Http\Controllers\Pos\UnitController;

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

Route::get('/', function () {
    return view('auth/login');
});

Route::get('/dashboard', function () {
    return view('admin.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Admin all routes
Route::middleware('auth')->group(function () {
    Route::get('/admin/logout', [AdminController::class, 'Destroy'])->name('admin.logout');
    Route::get('/admin/profile', [AdminController::class, 'Profile'])->name('admin.profile');
    Route::get('/edit/profile', [AdminController::class, 'EditProfile'])->name('edit.profile');
    Route::post('/store/profile', [AdminController::class, 'StoreProfile'])->name('store.profile');
    Route::get('/change/password', [AdminController::class, 'ChangePassword'])->name('change.password');
    Route::post('/update/password', [AdminController::class, 'UpdatePassword'])->name('update.password');
});

//Supplier all routes
Route::middleware('auth')->group(function () {
    Route::get('/supplier/all', [SupplierController::class, 'SupplierAll'])->name('supplier.all');
    Route::get('/supplier/add', [SupplierController::class, 'SupplierAdd'])->name('supplier.add');
    Route::post('/supplier/store', [SupplierController::class, 'SupplierStore'])->name('supplier.store');
    Route::get('/supplier/edit/{id}', [SupplierController::class, 'SupplierEdit'])->name('supplier.edit');
    Route::post('/supplier/update', [SupplierController::class, 'SupplierUpdate'])->name('supplier.update');
    Route::get('/supplier/delete/{id}', [SupplierController::class, 'SupplierDelete'])->name('supplier.delete');
});

//Customer all routes
Route::middleware('auth')->group(function () {
    Route::get('/customer/all', [CustomerController::class, 'CustomerAll'])->name('customer.all');
    Route::get('/customer/add', [CustomerController::class, 'CustomerAdd'])->name('customer.add');
    Route::post('/customer/store', [CustomerController::class, 'CustomerStore'])->name('customer.store');
    Route::get('/customer/edit/{id}', [CustomerController::class, 'CustomerEdit'])->name('customer.edit');
    Route::post('/customer/update', [CustomerController::class, 'CustomerUpdate'])->name('customer.update');
    Route::get('/customer/delete/{id}', [CustomerController::class, 'CustomerDelete'])->name('customer.delete');
});

//Units all routes
Route::middleware('auth')->group(function () {
    Route::get('/unit/all', [UnitController::class, 'UnitAll'])->name('unit.all');
    Route::get('/unit/add', [UnitController::class, 'UnitAdd'])->name('unit.add');
    Route::post('/unit/store', [UnitController::class, 'UnitStore'])->name('unit.store');
    Route::get('/unit/edit/{id}', [UnitController::class, 'UnitEdit'])->name('unit.edit');
    Route::post('/unit/update', [UnitController::class, 'UnitUpdate'])->name('unit.update');
    Route::get('/unit/delete/{id}', [UnitController::class, 'UnitDelete'])->name('unit.delete');
});

//Category all routes
Route::middleware('auth')->group(function () {
    Route::get('/category/all', [CategoryController::class, 'CategoryAll'])->name('category.all');
    Route::get('/category/add', [CategoryController::class, 'CategoryAdd'])->name('category.add');
    Route::post('/category/store', [CategoryController::class, 'CategoryStore'])->name('category.store');
    Route::get('/category/edit/{id}', [CategoryController::class, 'CategoryEdit'])->name('category.edit');
    Route::post('/category/update', [CategoryController::class, 'CategoryUpdate'])->name('category.update');
    Route::get('/category/delete/{id}', [CategoryController::class, 'CategoryDelete'])->name('category.delete');
});

//Product all routes
Route::middleware('auth')->group(function () {
    Route::get('/product/all', [ProductController::class, 'ProductAll'])->name('product.all');
    Route::get('/product/add', [ProductController::class, 'ProductAdd'])->name('product.add');
    Route::post('/product/store', [ProductController::class, 'ProductStore'])->name('product.store');
    Route::get('/product/edit/{id}', [ProductController::class, 'ProductEdit'])->name('product.edit');
    Route::post('/product/update', [ProductController::class, 'ProductUpdate'])->name('product.update');
    Route::get('/product/delete/{id}', [ProductController::class, 'ProductDelete'])->name('product.delete');
});

require __DIR__.'/auth.php';
