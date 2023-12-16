<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Pos\SupplierController;

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

require __DIR__.'/auth.php';
