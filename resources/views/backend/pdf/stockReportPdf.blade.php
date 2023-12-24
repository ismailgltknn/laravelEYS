@extends('admin.admin_master')
@section('admin')
<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Stok Raporu</h4>
                    
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active">Stok Raporu</li>
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
                                        </address>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div>
                                    <div class="p-2">
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
                                                        <th>Tedarikçi Adı</th>
                                                        <th>Birim</th>
                                                        <th>Kategori</th>
                                                        <th>Ürün Adı</th>
                                                        <th>Önceki Stok</th>
                                                        <th title="Fatura Onayı Verilmiş">Çıkan Stok</th>
                                                        <th>Mevcut Stok</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($allData as $key => $item)
                                                    @php
                                                    $buying_total = App\Models\Purchase::where('category_id', $item->category_id)
                                                    ->where('product_id', $item->id)->where('status', '1')->sum('buying_quantity');
                                                    $selling_total = App\Models\InvoiceDetail::where('category_id', $item->category_id)
                                                    ->where('product_id', $item->id)->where('status', '1')->sum('selling_quantity');
                                                    @endphp
                                                    <tr>
                                                        <td> {{ $key+1}} </td>
                                                        <td> {{ $item->supplier->name }} </td> 
                                                        <td> {{ $item->unit->name }} </td> 
                                                        <td> {{ $item->category->name }} </td> 
                                                        <td> {{ $item->name }} </td>
                                                        <td> {{ $buying_total }} </td>
                                                        <td> {{ $selling_total }} </td>
                                                        <td> {{ $item->quantity }} </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        @php
                                        $date = new DateTime('now', new DateTimeZone('Europe/Istanbul'));
                                        @endphp
                                        <i>Alınma Tarihi: {{ $date->format('d/m/Y, H:i:s')}}</i>
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