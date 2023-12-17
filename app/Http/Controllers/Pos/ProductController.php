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

class ProductController extends Controller
{
    public function ProductAll(){
        $products = Product::latest()->get();
        return view('backend.product.productAll', compact('products'));
    }

    public function ProductAdd(){
        $suppliers = Supplier::all();
        $units = Unit::all();
        $categories = Category::all();
        return view('backend.product.productAdd', compact('suppliers', 'units', 'categories'));
    }

    public function ProductStore(Request $request)
    {
        if ($request->supplier_id === "Tedarikçi seçiniz.") {
            $notification = array(
                'message' => 'Lütfen Tedarikçi Seçiniz.',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
        if ($request->unit_id === "Birim seçiniz.") {
            $notification = array(
                'message' => 'Lütfen Birim Seçiniz.',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
        if ($request->category_id === "Kategori seçiniz.") {
            $notification = array(
                'message' => 'Lütfen Kategori Seçiniz.',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
        Product::insert(
        [
            'name' => $request->productName,
            'supplier_id' => $request->supplier_id,
            'unit_id' => $request->unit_id,
            'category_id' => $request->category_id,
            'quantity' => '0',
            'createdBy' => Auth::user()->id,
            'created_at' => Carbon::now(),
        ]);
        
        $notification = array(
            'message' => 'Ürün Ekleme İşlemi Başarılı',
            'alert-type' => 'success'
        );
        return redirect()->route('product.all')->with($notification);
    }

    public function ProductEdit($id){
        $product = Product::findOrFail($id);
        $suppliers = Supplier::all();
        $units = Unit::all();
        $categories = Category::all();
        
        return view('backend.product.productEdit', compact('product', 'suppliers', 'units', 'categories'));
    }
    
    public function ProductUpdate(Request $request)
    {
        $productId = $request->id;
        Product::findOrFail($productId)->update(
            [
                'name' => $request->productName,
                'supplier_id' => $request->supplier_id,
                'unit_id' => $request->unit_id,
                'category_id' => $request->category_id,
                'updatedBy' => Auth::user()->id,
                'updated_at' => Carbon::now(),
            ]);
            
            $notification = array(
                'message' => 'Ürün Güncelleme İşlemi Başarılı',
                'alert-type' => 'success'
            );
            return redirect()->route('product.all')->with($notification);
    }

    public function ProductDelete($id){
        Product::findOrFail($id)->update(['updatedBy' => Auth::user()->id,]);
        Product::findOrFail($id)->delete();
        
        $notification = array(
            'message' => 'Ürün Silme İşlemi Başarılı',
            'alert-type' => 'success'
        );
        sleep(1);
        return redirect()->back()->with($notification);
    }

}
