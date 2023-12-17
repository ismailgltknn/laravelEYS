@extends('admin.admin_master')
@section('admin')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Satın Alım Onay</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4 p-2">Satın Alım Onayları </h4>
                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Satın Alım No.</th> 
                                    <th>Satın Alım Tarihi</th>
                                    <th>Tedarikçi</th>
                                    <th>Kategori</th> 
                                    <th>Miktar</th> 
                                    <th>Ürün Adı</th>
                                    <th>Durum</th>
                                    <th>İşlem</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($allData as $key => $item)
                                <tr>
                                    <td> {{ $key+1}} </td>
                                    <td> {{ $item->purchase_no }} </td> 
                                    <td> {{ date('d-m-Y H:i:s', strtotime($item->date)) }} </td> 
                                    <td> {{ $item->supplier->name }} </td> 
                                    <td> {{ $item->category->name }} </td> 
                                    <td> {{ $item->buying_quantity }} </td> 
                                    <td> {{ $item->product->name }} </td> 
                                    <td>
                                        @if($item->status == '0')
                                        <span class="badge alert-warning">Onay Bekliyor</span>
                                        @elseif($item->status == '1')
                                        <span class="badge alert-success">Onaylandı</span>
                                        @endif
                                    </td> 
                                    <td>
                                        @if($item->status == '0')
                                        <a href="{{ route('purchase.approve', $item->id) }}" class="btn btn-success btn-sm" title="Onayla" id="approveBtn"><i class=" fas fa-check-circle"></i>  Onayla</a>
                                        @endif
                                    </td>
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