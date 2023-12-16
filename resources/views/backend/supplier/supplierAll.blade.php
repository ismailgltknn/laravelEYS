@extends('admin.admin_master')
@section('admin')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Tüm Müşteriler</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <a href="{{ route('supplier.add')}}" class="btn btn-success waves-effect waves-light" style="float:right;"><i class="fas fa-plus me-2"></i>Müşteri Ekle </a>
                        <h4 class="card-title">Tüm Müşteri Bilgileri </h4>
                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Ad</th> 
                                    <th>Telefon Numarası</th>
                                    <th>Email</th>
                                    <th>Adres</th> 
                                    <th>İşlem</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($suppliers as $key => $item)
                                <tr>
                                    <td> {{ $key+1}} </td>
                                    <td> {{ $item->name }} </td> 
                                    <td> {{ $item->phone }} </td> 
                                    <td> {{ $item->email }} </td> 
                                    <td> {{ $item->address }} </td> 
                                    <td>
                                        <a href="javascript:void(0);" class="supplierEdit" type="button" data-id="{{ $item->id}}" title="Düzenle"><i class="fas fa-edit"></i></a>
                                        <a href="{{ route('supplier.delete', $item->id) }}" class="" title="Sil" id="delete"><i class="text-danger fas fa-trash-alt"></i></a>
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
    <div class="modal" id="supplierEditModal">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Müşteri Düzenle</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light waves-effect" data-bs-dismiss="modal">Kapat</button>
                </div>
            </div>
        </div>
      </div>
</div>
@push('script')
<script type="text/javascript">
    $(document).ready(function () {

        $('#datatable').DataTable();
        
        $('.supplierEdit').click(function(){

            var supplierId = $(this).data('id');
            axios.get('/supplier/edit/'+ supplierId)
            .then(function (response) {
                $('.modal-body').html(response.data);
                $('#supplierEditModal').modal('show'); 
            })
            .catch(function (error) {
                console.log(error);
            })
            .finally(function () {
            });
        });
    });
</script>
@endpush
@endsection