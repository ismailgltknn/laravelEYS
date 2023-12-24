@extends('admin.admin_master')
@section('admin')
<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Fatura</h4>
                    
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active">Fatura</li>
                        </ol>
                    </div>
                    
                </div>
            </div>
        </div>
        <!-- end page title -->
        
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        
                        <div class="row">
                            <div class="col-12">
                                <div class="invoice-title">
                                    <h4 class="float-end font-size-16"><strong>Fatura No. #{{ $invoice->invoice_no}}</strong></h4>
                                    <h3>
                                        <img src="{{ asset('logo/logo-trs.png')}}" alt="logo" height="50"/> Envanter Yönetim Sistemi
                                    </h3>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-6 mt-4">
                                        <address>
                                            <strong>Envanter Yönetim Sistemi</strong><br>
                                            Ankara/Türkiye<br>
                                            destek@eys.com
                                        </address>
                                    </div>
                                    <div class="col-6 mt-4 text-end">
                                        <address>
                                            <strong>Fatura Tarihi:</strong><br>
                                            {{ date('d/m/Y', strtotime($invoice->date))}}<br><br>
                                        </address>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @php
                        $payment = App\Models\Payment::where('invoice_id', $invoice->id)->first();
                        @endphp
                        <div class="row">
                            <div class="col-12">
                                <div>
                                    <div class="p-2">
                                        <h3 class="font-size-16"><strong>Müşteri Bilgileri</strong></h3>
                                    </div>
                                    <div class="">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Ad</th>
                                                        <th>Telefon</th>
                                                        <th>Email</th>
                                                        <th>Açıklama</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <!-- foreach ($order->lineItems as $line) or some such thing here -->
                                                    <tr>
                                                        <td>{{ $payment->customer->name}}</td>
                                                        <td>{{ $payment->customer->phone}}</td>
                                                        <td>{{ $payment->customer->email}}</td>
                                                        <td>{{ $invoice->description}}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end row -->
                        <div class="row">
                            <div class="col-12">
                                <div>
                                    <div class="p-2">
                                    </div>
                                    <div class="">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Kategori</th>
                                                        <th>Ürün</th>
                                                        <th>Stok</th>
                                                        <th>Alınan Miktar</th>
                                                        <th>Birim Fiyat</th>
                                                        <th>Toplam Fiyat</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                    $totalSum = '0';
                                                    @endphp
                                                    @foreach ($invoice->invoiceDetails as $key => $details)
                                                    <tr>
                                                        <td>{{ $key+1}}</td>
                                                        <td>{{ $details->category->name}}</td>
                                                        <td>{{ $details->product->name}}</td>
                                                        <td>{{ $details->product->quantity}}</td>
                                                        <td>{{ $details->selling_quantity}}</td>
                                                        <td>₺{{ $details->unit_price}}</td>
                                                        <td>₺{{ $details->selling_price}}</td>
                                                    </tr>
                                                    @php
                                                    $totalSum += $details->selling_price;
                                                    @endphp
                                                    @endforeach
                                                    <tr>
                                                        <td class="thick-line"></td>
                                                        <td class="thick-line"></td>
                                                        <td class="thick-line"></td>
                                                        <td class="thick-line"></td>
                                                        <td class="thick-line"></td>
                                                        <td class="thick-line text-end"><strong>Ara Toplam</strong></td>
                                                        <td class="thick-line">₺{{ $totalSum}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="no-line"></td>
                                                        <td class="no-line"></td>
                                                        <td class="no-line"></td>
                                                        <td class="no-line"></td>
                                                        <td class="no-line"></td>
                                                        <td class="no-line text-end"><strong>İskonto</strong></td>
                                                        <td class="no-line">₺{{ $payment->discount_amount}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="no-line"></td>
                                                        <td class="no-line"></td>
                                                        <td class="no-line"></td>
                                                        <td class="no-line"></td>
                                                        <td class="no-line"></td>
                                                        <td class="no-line text-end"><strong>Ödenen Tutar</strong></td>
                                                        <td class="no-line">₺{{ $payment->paid_amount}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="no-line"></td>
                                                        <td class="no-line"></td>
                                                        <td class="no-line"></td>
                                                        <td class="no-line"></td>
                                                        <td class="no-line"></td>
                                                        <td class="no-line text-end"><strong>Kalan Tutar</strong></td>
                                                        <td class="no-line">₺{{ $payment->due_amount}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="no-line"></td>
                                                        <td class="no-line"></td>
                                                        <td class="no-line"></td>
                                                        <td class="no-line"></td>
                                                        <td class="no-line"></td>
                                                        <td class="no-line text-end"><strong>Genel Toplam</strong></td>
                                                        <td class="no-line"><h4 class="m-0">₺{{ $payment->total_amount}}</h4></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="d-print-none">
                                            <div class="float-end">
                                                <a href="javascript:window.print()" title="Çıktı Al" class="btn btn-success waves-effect waves-light"><i class="fa fa-print"></i> Çıktı Al</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end row -->
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
        
    </div> <!-- container-fluid -->
</div>
@push('script')
<script type="text/javascript">
</script>
@endpush
@endsection