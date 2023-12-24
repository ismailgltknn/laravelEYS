@extends('admin.admin_master')
@section('admin')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Stok Rapor</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <a href="{{ route('stock.report.pdf')}}" target="_blank" class="btn btn-success waves-effect waves-light" style="float:right;"><i class="fas fa-print me-2"></i>Raporu Yazdır </a>
                        <h4 class="card-title mb-4 p-2">Stok Raporu </h4>
                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
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
                                @foreach($allData as $key => $item)
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
                                    <td> <span class="badge alert-info fs-6">{{ $buying_total }}</span></td>
                                    <td> <span class="badge alert-danger fs-6">{{ $selling_total }}</span></td>
                                    <td> <span class="badge alert-success fs-6">{{ $item->quantity }}</span></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('script')
<script type="text/javascript">
    $(document).ready(function () {
        $('#datatable').DataTable();
    });
</script>
@endpush
@endsection