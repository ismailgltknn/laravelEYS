<?php

namespace App\Http\Controllers\Pos;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManagerStatic as Image;

class CustomerController extends Controller
{
    public function CustomerAll(){
        $customers = Customer::latest()->get();
        return view('backend.customer.customerAll', compact('customers'));
    }
    
    public function CustomerAdd(){
        return view('backend.customer.customerAdd');
    }
    
    public function CustomerStore(Request $request)
    {
        $customerEmail = Customer::where('email', $request->customerEmail)->first();
        if ($customerEmail === null) {
            $image = $request->file('customerImage');
            if ($image) {
                $generatedName = hexdec(uniqid()). '.' . $image->getClientOriginalExtension(); //465645.png
                Image::make($image)->resize(200,200)->save('files/customerImages/' . $generatedName);
                $saveUrl = 'files/customerImages/' . $generatedName;
            }
            else{
                $saveUrl = 'files/noavatar.png';
            }
            Customer::firstOrCreate([
                'email' => $request->customerEmail
            ],
            [
                'name' => $request->customerName,
                'phone' => $request->customerPhone,
                'email' => $request->customerEmail,
                'address' => $request->customerAddress,
                'customerImage' => $saveUrl,
                'createdBy' => Auth::user()->id,
                'created_at' => Carbon::now(),
            ]);
            
            $notification = array(
                'message' => 'Müşteri Ekleme İşlemi Başarılı',
                'alert-type' => 'success'
            );
            return redirect()->route('customer.all')->with($notification);
        }
        else{
            $notification = array(
                'message' => 'Müşteri Email Adresi kullanılıyor. Lütfen farklı bir email giriniz.',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }
    
    public function CustomerEdit($id){
        $customer = Customer::findOrFail($id);
        
        return view('backend.customer.customerEdit', compact('customer'));
    }
    
    public function CustomerUpdate(Request $request)
    {
        $customerId = $request->id;
        $oldImageUrl = Customer::where('id', $customerId)->pluck('customerImage')->toArray();
        $image = $request->file('customerImage');
        if ($image) {
            $generatedName = hexdec(uniqid()). '.' . $image->getClientOriginalExtension(); //465645.png
            Image::make($image)->resize(200,200)->save('files/customerImages/' . $generatedName);
            $saveUrl = 'files/customerImages/' . $generatedName;
        }
        else{
            $saveUrl = $oldImageUrl[0] ? $oldImageUrl[0] : 'files/noavatar.png';
        }
        Customer::findOrFail($customerId)->update(
            [
                'name' => $request->customerName,
                'phone' => $request->customerPhone,
                'email' => $request->customerEmail,
                'address' => $request->customerAddress,
                'customerImage' => $saveUrl,
                'updatedBy' => Auth::user()->id,
                'updated_at' => Carbon::now(),
            ]);
            
            $notification = array(
                'message' => 'Müşteri Güncelleme İşlemi Başarılı',
                'alert-type' => 'success'
            );
            return redirect()->route('customer.all')->with($notification);
    }
    
    public function CustomerDelete($id)
    {
        $customer = Customer::where('id', $id)->first();
        preg_match('/files\/customerImages\/(.*)/', $customer->customerImage, $getfileName);
        $fileName = $getfileName[1];
        @unlink(public_path('files/customerImages/' . $fileName));
        $customer->update(['updatedBy' => Auth::user()->id]);
        Customer::findOrFail($id)->delete();
        
        $notification = array(
            'message' => 'Müşteri Silme İşlemi Başarılı',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}