@extends('admin.admin_master')
@section('admin')
<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Günlük Satın Alma Raporu</h4>
                    
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active">Günlük Satın Alma Raporu</li>
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
                                        <h3 class="font-size-16">
                                            <strong>Günlük Satın Alma Raporu</strong>
                                            <span class="badge alert-warning">{{ date('d/m/Y', strtotime($start_date))}}</span>
                                             - <span class="badge alert-warning">{{ date('d/m/Y', strtotime($end_date))}}</span>
                                        </h3>
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
                                                        <th>Satın Alma No.</th>
                                                        <th>Tarih</th>
                                                        <th>Ürün Adı</th>
                                                        <th>Alınan Miktar / Birim Adı</th>
                                                        <th>Birim Fiyat</th>
                                                        <th>Toplam Tutar</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                    $totalSum = '0';
                                                    @endphp
                                                    @foreach ($allData as $key => $item)
                                                    <tr>
                                                        <td>{{ $key+1}}</td>
                                                        <td>{{ $item->purchase_no}}</td>
                                                        <td>{{ date('d/m/Y', strtotime($item->date))}}</td>
                                                        <td>{{ $item->product->name}}</td>
                                                        <td>{{ $item->buying_quantity}} / {{ $item->product->unit->name}}</td>
                                                        <td>{{ $item->unit_price}}</td>
                                                        <td>{{ $item->buying_price}}</td>
                                                    </tr>
                                                    @php
                                                    $totalSum += $item->buying_price;
                                                    @endphp
                                                    @endforeach
                                                    <tr>
                                                        <td class="no-line"></td>
                                                        <td class="no-line"></td>
                                                        <td class="no-line"></td>
                                                        <td class="no-line"></td>
                                                        <td class="no-line text-end"><strong>Genel Toplam</strong></td>
                                                        <td class="no-line"><h4 class="m-0">₺{{ $totalSum}}</h4></td>
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