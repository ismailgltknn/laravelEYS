<?php

namespace App\Http\Controllers\Pos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supplier;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Console\Input\Input;

class SupplierController extends Controller
{
    public function SupplierAll(){
        $suppliers = Supplier::latest()->get();
        return view('backend.supplier.supplierAll', compact('suppliers'));
    }
    
    public function SupplierAdd(){
        return view('backend.supplier.supplierAdd');
    }
    
    public function SupplierStore(Request $request)
    {
        Supplier::updateOrCreate([
            'email' => $request->supplierEmail
        ],
        [
            'name' => $request->supplierName,
            'phone' => $request->supplierPhone,
            'email' => $request->supplierEmail,
            'address' => $request->supplierAddress,
            'createdBy' => Auth::user()->id,
            'created_at' => Carbon::now(),
        ]);
        
        $notification = array(
            'message' => 'Müşteri Ekleme İşlemi Başarılı',
            'alert-type' => 'success'
        );
        return redirect()->route('supplier.all')->with($notification);
    }
    
    public function supplierEdit($id){
        $supplier = Supplier::findOrFail($id);

        return view('backend.supplier.supplierEdit', compact('supplier'));
    }

    public function SupplierUpdate(Request $request)
    {
        $supId = $request->id;
        Supplier::findOrFail($supId)->update(
        [
            'name' => $request->supplierName,
            'phone' => $request->supplierPhone,
            'email' => $request->supplierEmail,
            'address' => $request->supplierAddress,
            'updatedBy' => Auth::user()->id,
            'updated_at' => Carbon::now(),
        ]);
        
        $notification = array(
            'message' => 'Müşteri Güncelleme İşlemi Başarılı',
            'alert-type' => 'success'
        );
        return redirect()->route('supplier.all')->with($notification);
    }

    public function SupplierDelete($id){
        Supplier::findOrFail($id)->update(['updatedBy' => Auth::user()->id,]);
        Supplier::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Müşteri Silme İşlemi Başarılı',
            'alert-type' => 'success'
        );
        sleep(2);
        return redirect()->back()->with($notification);
    }
}
