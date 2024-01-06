<?php

namespace App\Http\Controllers\Pos;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Payment;
use App\Models\PaymentDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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

    public function CreditCustomer(){
        $allData = Payment::whereIn('paid_status', ['full_due', 'partial_paid'])->get();
        return view('backend.customer.customerCredit', compact('allData'));
    }
    
    public function CreditCustomerPrintPdf(){
        $allData = Payment::whereIn('paid_status', ['full_due', 'partial_paid'])->get();
        return view('backend.pdf.customerCreditPdf', compact('allData'));
    }

    public function CustomerEditInvoice($id){
        $payment = Payment::where('invoice_id', $id)->first();
        return view('backend.customer.customerEditInvoice', compact('payment'));
    }

    public function CustomerUpdateInvoice(Request $request, $invoiceId){
        if ($request->new_paid_amount > $request->paid_amount) {
            $notification = array(
                'message' => 'Kalan Tutardan Fazla Ödeme Giremezsiniz.',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
        else{
            $payment = Payment::where('invoice_id', $invoiceId)->first();
            $paymentDetails = new PaymentDetail();
            $payment->paid_status = $request->paid_status;
            if ($request->paid_status == 'full_paid') {
                $payment->paid_amount = $payment->paid_amount + $request->paid_amount;
                $payment->due_amount = '0';
                $paymentDetails->current_paid_amount = $request->paid_amount;
            }
            elseif (!$request->new_paid_amount || $request->new_paid_amount == '0' || $request->new_paid_amount < 0) {
                $notification = array(
                    'message' => 'Ödeme miktarını hatalı girdiniz.',
                    'alert-type' => 'error'
                );
                return redirect()->back()->with($notification);
            }
            elseif ($request->paid_status == 'partial_paid') {
                $payment->paid_amount = $payment->paid_amount + $request->new_paid_amount;
                $payment->due_amount = $payment->due_amount - $request->new_paid_amount;
                $paymentDetails->current_paid_amount = $request->new_paid_amount;
            }
            $paymentDetails->invoice_id = $invoiceId;
            $paymentDetails->date = date('Y-d-m', strtotime($request->date));
            $paymentDetails->updated_by = Auth::user()->id;
            $payment->save();
            $paymentDetails->save();

            $notification = array(
                'message' => 'Fatura ödeme işlemi başarılı.',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }
    }

    public function CustomerInvoiceDetails($invoiceId){
        $payment = Payment::where('invoice_id', $invoiceId)->first();
        return view('backend.pdf.invoiceDetailsPdf', compact('payment'));
    }
}