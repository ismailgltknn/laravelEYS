<?php

namespace App\Http\Controllers\Pos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Purchase;
use App\Models\Supplier;
use App\Models\Product;
use App\Models\Unit;
use App\Models\Category;
use Carbon\Carbon;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Models\Payment;
use App\Models\PaymentDetail;

class InvoiceController extends Controller
{
    public function InvoiceAll(){
        $allData = Invoice::orderBy('date', 'DESC')->orderBy('id', 'DESC')
        ->where('status', 1)
        ->get();
        return view('backend.invoice.invoiceAll', compact('allData'));
    }
    
    public function InvoiceAdd(){
        $categories = Category::all();
        $customers = Customer::all();
        $products = Product::all();
        $invoiceData = Invoice::orderBy('id', 'DESC')->first();
        if ($invoiceData == null) {
            $firstReg = '0';
            $invoiceNo = $firstReg + 1;
        }else{
            $invoiceData = Invoice::orderBy('id', 'DESC')->first()->invoice_no;
            $invoiceNo = $invoiceData + 1;
        }
        $date = date('d-m-Y');
        return view('backend.invoice.invoiceAdd', compact('customers', 'categories', 'products', 'invoiceNo', 'date'));
    }
    
    public function InvoiceStore(Request $request){
        if ($request->category_id == null) {
            $notification = array(
                'message' => 'Herhangi bir fatura ekleme işlemi yapmadınız.',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }else{
            if ($request->paid_amount > $request->estimated_amount) {
                $notification = array(
                    'message' => 'Ödenen miktar toplam tutardan fazla.',
                    'alert-type' => 'error'
                );
                return redirect()->back()->with($notification);
            }else{
                $invoice = new Invoice();
                $invoice->invoice_no = $request->invoice_no;
                $invoice->date = date('Y-m-d', strtotime($request->date));
                $invoice->description = $request->description;
                $invoice->status = '0';
                $invoice->createdBy = Auth::user()->id;
                
                DB::transaction(function() use($request, $invoice){
                    if ($invoice->save()) {
                        $count_category = count($request->category_id);
                        for ($i=0; $i < $count_category; $i++) { 
                            $invoice_detail = new InvoiceDetail();
                            $invoice_detail->date = date('Y-m-d', strtotime($request->date));
                            $invoice_detail->invoice_id = $invoice->id;
                            $invoice_detail->category_id = $request->category_id[$i];
                            $invoice_detail->product_id = $request->product_id[$i];
                            $invoice_detail->selling_quantity = $request->selling_quantity[$i];
                            $invoice_detail->unit_price = $request->unit_price[$i];
                            $invoice_detail->selling_price = $request->selling_price[$i];
                            $invoice_detail->status = "0";
                            $invoice_detail->save();
                        }
                        if ($request->customer_id == '0') {
                            $customer = new Customer();
                            $customer->name = $request->name;
                            $customer->phone = $request->phone;
                            $customer->email = $request->email;
                            $customer->createdBy = Auth::user()->id;
                            $customer->save();
                            $customer_id = $customer->id;
                        }else{
                            $customer_id = $request->customer_id;
                        }
                        $payment = new Payment();
                        $payment_detail = new PaymentDetail();
                        
                        $payment->invoice_id = $invoice->id;
                        $payment->customer_id = $customer_id;
                        $payment->paid_status = $request->paid_status;
                        $payment->discount_amount = $request->discount_amount;
                        $payment->total_amount = $request->estimated_amount;
                        
                        if ($request->paid_status == 'full_paid') {
                            $payment->paid_amount = $request->estimated_amount;
                            $payment->due_amount = '0';
                            $payment_detail->current_paid_amount = $request->estimated_amount;
                        }elseif ($request->paid_status == 'full_due') {
                            $payment->paid_amount = '0';
                            $payment->due_amount = $request->estimated_amount;
                            $payment_detail->current_paid_amount = '0';
                        }elseif ($request->paid_status == 'partial_paid') {
                            $payment->paid_amount = $request->paid_amount;
                            $payment->due_amount = $request->estimated_amount - $request->paid_amount;
                            $payment_detail->current_paid_amount = $request->paid_amount;
                        }
                        $payment->save();
                        $payment_detail->invoice_id = $invoice->id;
                        $payment_detail->date = date('Y-m-d', strtotime($request->date));
                        $payment_detail->save();
                    }
                });
            }
        }
        
        $notification = array(
            'message' => 'Fatura Başarıyla Oluşturuldu.',
            'alert-type' => 'success'
        );
        return redirect()->route('invoice.pending.list')->with($notification);
    }
    
    public function InvoicePendingList(){
        $allData = Invoice::orderBy('date', 'DESC')->orderBy('id', 'DESC')
        ->where('status', 0)
        ->get();
        return view('backend.invoice.invoicePendingList', compact('allData'));
        
    }
    
    public function InvoiceDelete($id){
        $invoice = Invoice::findOrFail($id);
        $invoice->delete();
        InvoiceDetail::where('invoice_id', $invoice->id)->delete();
        Payment::where('invoice_id', $invoice->id)->delete();
        PaymentDetail::where('invoice_id', $invoice->id)->delete();
        
        $notification = array(
            'message' => 'Fatura Başarıyla Silindi.',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    
    public function InvoiceApprove($id){
        $invoice = Invoice::with('invoiceDetails')->findOrFail($id);
        return view('backend.invoice.invoiceApprove', compact('invoice'));
    }
    
    public function ApprovalStore(Request $request, $id){
        foreach ($request->selling_quantity as $key => $value) {
            $invoiceDetails = InvoiceDetail::where('id', $key)->first();
            $product = Product::where('id', $invoiceDetails->product_id)->first();
            if ($product->quantity < $request->selling_quantity[$key]) {
                $notification = array(
                    'message' => 'Stokta yeterli ürün bulunmadığı için Fatura Onayı Başarısız.',
                    'alert-type' => 'error'
                );
                return redirect()->back()->with($notification);     
            }
        }
        $invoice = Invoice::findOrFail($id);
        $invoice->updatedBy = Auth::user()->id;
        $invoice->status = '1';
        
        DB::transaction(function() use($request, $invoice, $id){
            foreach ($request->selling_quantity as $key => $val) {
                $invoiceDetails = InvoiceDetail::where('id', $key)->first();
                $invoiceDetails->status = '1';
                $invoiceDetails->save();
                $product = Product::where('id', $invoiceDetails->product_id)->first();
                $product->quantity = ((float)$product->quantity) - ((float)$request->selling_quantity[$key]);
                $product->save();
            }
            $invoice->save();
        });
        $notification = array(
            'message' => 'Fatura Başarıyla Onaylandı.',
            'alert-type' => 'success'
        );
        return redirect()->route('invoice.pending.list')->with($notification);  
    }

    public function PrintInvoiceList(){
        $allData = Invoice::orderBy('date', 'DESC')->orderBy('id', 'DESC')
        ->where('status', 1)
        ->get();
        return view('backend.invoice.printInvoiceList', compact('allData'));
    }

    public function PrintInvoice($id){
        $invoice = Invoice::with('invoiceDetails')->findOrFail($id);
        return view('backend.pdf.invoicePdf', compact('invoice'));
    }

    public function DailyInvoiceReport(){
        return view('backend.invoice.dailyInvoiceReport');
    }
    
    public function DailyInvoicePdf(Request $request){
        $start_date = date('Y-m-d', strtotime($request->start_date));
        $end_date = date('Y-m-d', strtotime($request->end_date));
        $allData = Invoice::whereBetween('date', [$start_date, $end_date])->where('status', '1')->get();
        
        return view('backend.pdf.dailyInvoiceReportPdf', compact('allData', 'start_date' ,'end_date'));
    }
}
