<?php

namespace App\Http\Controllers\Pos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Purchase;
use App\Models\Supplier;
use App\Models\Product;
use App\Models\Unit;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    public function PurchaseAll(){
        $allData = Purchase::orderBy('date', 'DESC')->orderBy('id', 'DESC')->get();
        return view('backend.purchase.purchaseAll', compact('allData'));
    }

    public function PurchaseAdd(){
        $suppliers = Supplier::all();
        $units = Unit::all();
        $categories = Category::all();
        $products = Product::all();
        return view('backend.purchase.purchaseAdd', compact('suppliers', 'units', 'categories', 'products'));
    }
}
