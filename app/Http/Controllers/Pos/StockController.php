<?php

namespace App\Http\Controllers\Pos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\Unit;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class StockController extends Controller
{
    public function StockReport(){
        $allData = Product::orderBy('supplier_id', 'ASC')->orderBy('category_id', 'ASC')->get();
        return view('backend.stock.stockReport', compact('allData'));
    }

    public function StockReportPdf(){
        $allData = Product::orderBy('supplier_id', 'ASC')->orderBy('category_id', 'ASC')->get();
        return view('backend.pdf.stockReportPdf', compact('allData'));
    }

    public function StockSupplierWise(){
        $suppliers = Supplier::all();
        $categories = Category::all();
        return view('backend.stock.supplierProductWiseReport', compact('suppliers', 'categories'));
    }

    public function SupplierWisePdf(Request $request){
        $allData = Product::orderBy('supplier_id', 'ASC')->orderBy('category_id', 'ASC')
        ->where('supplier_id', $request->supplier_id)
        ->get();
        return view('backend.pdf.supplierWiseReportPdf', compact('allData'));
    }

    public function ProductWisePdf(Request $request){
        $product = Product::where('category_id', $request->category_id)
        ->where('id', $request->product_id)
        ->first();
        return view('backend.pdf.productWiseReportPdf', compact('product'));
    }
}
