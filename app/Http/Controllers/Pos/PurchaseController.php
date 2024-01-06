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
        $allData = Purchase::with('supplier', 'product', 'category')->orderBy('date', 'DESC')->orderBy('id', 'DESC')->get();
        $allStatusControl = Purchase::where('status', '0')->first();
        return view('backend.purchase.purchaseAll', compact('allData', 'allStatusControl'));
    }

    public function PurchaseAdd(){
        $suppliers = Supplier::all();
        $units = Unit::all();
        $categories = Category::all();
        $products = Product::all();
        return view('backend.purchase.purchaseAdd', compact('suppliers', 'units', 'categories', 'products'));
    }

    public function PurchaseStore(Request $request){
        if ($request->category_id == null) {
            $notification = array(
                'message' => 'Herhangi bir satın alım eklemediniz.',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
        else
        {
            $countCtg = count($request->category_id);
            for ($i=0; $i < $countCtg; $i++) { 
                $reqDate = date('Y-m-d', strtotime($request->date[$i]));
                $currentTime = date("H:i:s");
                $reqDateTime =  date("Y-m-d H:i:s", strtotime($reqDate . $currentTime));
                
                $purchase = new Purchase();
                $purchase->date = $reqDateTime;
                $purchase->purchase_no = $request->purchase_no[$i];
                $purchase->supplier_id = $request->supplier_id[$i];
                $purchase->category_id = $request->category_id[$i];
                $purchase->product_id = $request->product_id[$i];
                $purchase->buying_quantity = $request->buying_quantity[$i];
                $purchase->unit_price = $request->unit_price[$i];
                $purchase->buying_price = $request->buying_price[$i];
                $purchase->description = $request->description[$i];

                $purchase->createdBy = Auth::user()->id;
                $purchase->status = "0";
                $purchase->save();
            }
        }

        $notification = array(
            'message' => 'Satın Alım Başarıyla Kaydedildi.',
            'alert-type' => 'success'
        );
        return redirect()->route('purchase.all')->with($notification);
    }

    public function PurchaseDelete($id){
        Purchase::findOrFail($id)->update(['updatedBy' => Auth::user()->id,]);
        Purchase::findOrFail($id)->delete();
        
        $notification = array(
            'message' => 'Satın Alım Silme İşlemi Başarılı',
            'alert-type' => 'success'
        );
        sleep(1);
        return redirect()->back()->with($notification);
    }

    public function PurchasePending(){
        $allData = Purchase::where('status', '0')->with('supplier', 'product', 'category')->orderBy('date', 'DESC')->orderBy('id', 'DESC')->get();
        return view('backend.purchase.purchasePending', compact('allData'));
    }

    public function PurchaseApprove($id){
        $purchase = Purchase::findOrFail($id);
        $product = Product::where('id', $purchase->product_id)->first();
        $purchaseQuantity = ((float)$purchase->buying_quantity) + ((float)$product->quantity);
        $product->quantity = $purchaseQuantity;

        if ($product->save()) {
            
            Purchase::findOrFail($id)->update([
                'updatedBy' => Auth::user()->id,
                'status' => '1',
            ]);

            $notification = array(
                'message' => 'Satın Alım Onaylama İşlemi Başarılı',
                'alert-type' => 'success'
            );
            sleep(1);
            return redirect()->route('purchase.all')->with($notification);
        }
    }

    public function DailyPurchaseReport(){
        return view('backend.purchase.dailyPurchaseReport');
    }

    public function DailyPurchasePdf(Request $request){
        $start_date = date('Y-m-d', strtotime($request->start_date));
        $end_date = date('Y-m-d', strtotime($request->end_date));
        $allData = Purchase::whereBetween('date', [$start_date, $end_date])->where('status', '1')->get();
        
        return view('backend.pdf.dailyPurchaseReportPdf', compact('allData', 'start_date' ,'end_date'));
    }
}
