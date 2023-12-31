@extends('admin.admin_master')
@section('admin')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Tüm Birimler</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <a href="{{ route('unit.add')}}" class="btn btn-success waves-effect waves-light" style="float:right;"><i class="fas fa-plus me-2"></i>Birim Ekle </a>
                        <h4 class="card-title mb-4 p-2">Tüm Birim Bilgileri </h4>
                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th width="5%">#</th>
                                    <th>Ad</th>
                                    <th>İşlem</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($units as $key => $item)
                                <tr>
                                    <td> {{ $key+1}} </td>
                                    <td> {{ $item->name }} </td>
                                    <td>
                                        <a href="javascript:void(0);" class="unitEdit" type="button" data-id="{{ $item->id}}" title="Düzenle"><i class="fas fa-edit"></i></a>
                                        <a href="{{ route('unit.delete', $item->id) }}" class="" title="Sil" id="deleteBtn"><i class="text-danger fas fa-trash-alt"></i></a>
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
    <div class="modal" id="unitEditModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Birim Düzenle</h4>
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
        
        $('.unitEdit').click(function(){

            var unitId = $(this).data('id');
            axios.get('/unit/edit/'+ unitId)
            .then(function (response) {
                $('.modal-body').html(response.data);
                $('#unitEditModal').modal('show'); 
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