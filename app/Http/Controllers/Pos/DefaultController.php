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

class DefaultController extends Controller
{
    public function getCategory($supplierId){
        $getAllCategories = Product::with(['category'])
        ->select('category_id')
        ->where('supplier_id', $supplierId)
        ->groupBy('category_id')
        ->get();//Tedarikçinin tüm kategorilerini getir

        return response()->json($getAllCategories);
    }
    
    public function getProduct($categoryId){
        $getAllProducts = Product::where('category_id', $categoryId)->get();//Kategoride ki tüm ürünleri getir

        return response()->json($getAllProducts);
    }
}
