<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Pos\CategoryController;
use App\Http\Controllers\Pos\CustomerController;
use App\Http\Controllers\Pos\DefaultController;
use App\Http\Controllers\Pos\InvoiceController;
use App\Http\Controllers\Pos\ProductController;
use App\Http\Controllers\Pos\PurchaseController;
use App\Http\Controllers\Pos\SupplierController;
use App\Http\Controllers\Pos\UnitController;
use App\Http\Controllers\Pos\StockController;

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
    
    //Admin all routes
    Route::get('/admin/logout', [AdminController::class, 'Destroy'])->name('admin.logout');
    Route::get('/admin/profile', [AdminController::class, 'Profile'])->name('admin.profile');
    Route::get('/edit/profile', [AdminController::class, 'EditProfile'])->name('edit.profile');
    Route::post('/store/profile', [AdminController::class, 'StoreProfile'])->name('store.profile');
    Route::get('/change/password', [AdminController::class, 'ChangePassword'])->name('change.password');
    Route::post('/update/password', [AdminController::class, 'UpdatePassword'])->name('update.password');
    
    //Supplier all routes
    Route::get('/supplier/all', [SupplierController::class, 'SupplierAll'])->name('supplier.all');
    Route::get('/supplier/add', [SupplierController::class, 'SupplierAdd'])->name('supplier.add');
    Route::post('/supplier/store', [SupplierController::class, 'SupplierStore'])->name('supplier.store');
    Route::get('/supplier/edit/{id}', [SupplierController::class, 'SupplierEdit'])->name('supplier.edit');
    Route::post('/supplier/update', [SupplierController::class, 'SupplierUpdate'])->name('supplier.update');
    Route::get('/supplier/delete/{id}', [SupplierController::class, 'SupplierDelete'])->name('supplier.delete');
    
    
    //Customer all routes
    Route::get('/customer/all', [CustomerController::class, 'CustomerAll'])->name('customer.all');
    Route::get('/customer/add', [CustomerController::class, 'CustomerAdd'])->name('customer.add');
    Route::post('/customer/store', [CustomerController::class, 'CustomerStore'])->name('customer.store');
    Route::get('/customer/edit/{id}', [CustomerController::class, 'CustomerEdit'])->name('customer.edit');
    Route::post('/customer/update', [CustomerController::class, 'CustomerUpdate'])->name('customer.update');
    Route::get('/customer/delete/{id}', [CustomerController::class, 'CustomerDelete'])->name('customer.delete');
    Route::get('/credit/customer', [CustomerController::class, 'CreditCustomer'])->name('credit.customer');
    Route::get('/credit/customer/print/pdf', [CustomerController::class, 'CreditCustomerPrintPdf'])->name('credit.customer.print.pdf');
    Route::get('/customer/edit/invoice/{id}', [CustomerController::class, 'CustomerEditInvoice'])->name('customer.edit.invoice');
    Route::post('/customer/update/invoice/{id}', [CustomerController::class, 'CustomerUpdateInvoice'])->name('customer.update.invoice');
    Route::get('/customer/invoice/details/{id}', [CustomerController::class, 'CustomerInvoiceDetails'])->name('customer.invoice.details.pdf');
    
    //Units all routes
    Route::get('/unit/all', [UnitController::class, 'UnitAll'])->name('unit.all');
    Route::get('/unit/add', [UnitController::class, 'UnitAdd'])->name('unit.add');
    Route::post('/unit/store', [UnitController::class, 'UnitStore'])->name('unit.store');
    Route::get('/unit/edit/{id}', [UnitController::class, 'UnitEdit'])->name('unit.edit');
    Route::post('/unit/update', [UnitController::class, 'UnitUpdate'])->name('unit.update');
    Route::get('/unit/delete/{id}', [UnitController::class, 'UnitDelete'])->name('unit.delete');
    
    
    //Category all routes
    Route::get('/category/all', [CategoryController::class, 'CategoryAll'])->name('category.all');
    Route::get('/category/add', [CategoryController::class, 'CategoryAdd'])->name('category.add');
    Route::post('/category/store', [CategoryController::class, 'CategoryStore'])->name('category.store');
    Route::get('/category/edit/{id}', [CategoryController::class, 'CategoryEdit'])->name('category.edit');
    Route::post('/category/update', [CategoryController::class, 'CategoryUpdate'])->name('category.update');
    Route::get('/category/delete/{id}', [CategoryController::class, 'CategoryDelete'])->name('category.delete');
    
    
    //Product all routes
    Route::get('/product/all', [ProductController::class, 'ProductAll'])->name('product.all');
    Route::get('/product/add', [ProductController::class, 'ProductAdd'])->name('product.add');
    Route::post('/product/store', [ProductController::class, 'ProductStore'])->name('product.store');
    Route::get('/product/edit/{id}', [ProductController::class, 'ProductEdit'])->name('product.edit');
    Route::post('/product/update', [ProductController::class, 'ProductUpdate'])->name('product.update');
    Route::get('/product/delete/{id}', [ProductController::class, 'ProductDelete'])->name('product.delete');
    
    
    //Purchase all routes
    Route::get('/purchase/all', [PurchaseController::class, 'PurchaseAll'])->name('purchase.all');
    Route::get('/purchase/add', [PurchaseController::class, 'PurchaseAdd'])->name('purchase.add');
    Route::post('/purchase/store', [PurchaseController::class, 'PurchaseStore'])->name('purchase.store');
    Route::get('/purchase/delete/{id}', [PurchaseController::class, 'PurchaseDelete'])->name('purchase.delete');
    Route::get('/purchase/pending', [PurchaseController::class, 'PurchasePending'])->name('purchase.pending');
    Route::get('/purchase/approve/{id}', [PurchaseController::class, 'PurchaseApprove'])->name('purchase.approve');
    Route::get('/daily/purchase/report', [PurchaseController::class, 'DailyPurchaseReport'])->name('daily.purchase.report');
    Route::get('/daily/purchase/pdf', [PurchaseController::class, 'DailyPurchasePdf'])->name('daily.purchase.pdf');
    
    
    //Invoice all routes
    Route::get('/invoice/all', [InvoiceController::class, 'InvoiceAll'])->name('invoice.all');
    Route::get('/invoice/add', [InvoiceController::class, 'InvoiceAdd'])->name('invoice.add');
    Route::post('/invoice/store', [InvoiceController::class, 'InvoiceStore'])->name('invoice.store');
    Route::get('/invoice/pending/list', [InvoiceController::class, 'InvoicePendingList'])->name('invoice.pending.list');
    Route::get('/invoice/delete/{id}', [InvoiceController::class, 'InvoiceDelete'])->name('invoice.delete');
    Route::get('/invoice/approve/{id}', [InvoiceController::class, 'InvoiceApprove'])->name('invoice.approve');
    Route::post('/approval/store/{id}', [InvoiceController::class, 'ApprovalStore'])->name('approval.store');
    Route::get('/print/invoice/list', [InvoiceController::class, 'PrintInvoiceList'])->name('print.invoice.list');
    Route::get('/print/invoice/{id}', [InvoiceController::class, 'PrintInvoice'])->name('print.invoice');
    Route::get('/daily/invoice/report', [InvoiceController::class, 'DailyInvoiceReport'])->name('daily.invoice.report');
    Route::get('/daily/invoice/pdf', [InvoiceController::class, 'DailyInvoicePdf'])->name('daily.invoice.pdf');
    
    
    //Stock all routes
    Route::get('/stock/report', [StockController::class, 'StockReport'])->name('stock.report');
    Route::get('/stock/report/pdf', [StockController::class, 'StockReportPdf'])->name('stock.report.pdf');
    Route::get('/stock/supplier/wise', [StockController::class, 'StockSupplierWise'])->name('stock.supplier.wise');
    Route::get('/supplier/wise/pdf', [StockController::class, 'SupplierWisePdf'])->name('supplier.wise.pdf');
    Route::get('/product/wise/pdf', [StockController::class, 'ProductWisePdf'])->name('product.wise.pdf');
    
    
    //Default all routes
    Route::get('/get/category/{supplierId}', [DefaultController::class, 'getCategory'])->name('get.category');
    Route::get('/get/product/{categoryId}', [DefaultController::class, 'getProduct'])->name('get.product');
    Route::get('/get/productStock/{productId}', [DefaultController::class, 'getProductStock'])->name('get.productStock');

});

require __DIR__.'/auth.php';
