@extends('admin.admin_master')
@section('admin')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Satın Alımlar</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <a href="{{ route('purchase.add')}}" class="btn btn-success waves-effect waves-light" style="float:right;"><i class="fas fa-plus me-2"></i>Satın Alım Ekle </a>
                        <h4 class="card-title">Satın Alım Bilgileri </h4>
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
                                    <td> {{ $item->date }} </td> 
                                    <td> {{ $item->supplier->name }} </td> 
                                    <td> {{ $item->category->name }} </td> 
                                    <td> {{ $item->quantity }} </td> 
                                    <td> {{ $item->unit->name }} </td> 
                                    <td> <span class="btn btn-warning">Onay Bekliyor</span> </td> 
                                    <td>
                                        <a href="{{ route('product.delete', $item->id) }}" class="" title="Sil" id="delete"><i class="text-danger fas fa-trash-alt"></i></a>
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