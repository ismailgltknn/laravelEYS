@extends('admin.admin_master')
@section('admin')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Müşteri Bakiye</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <a href="{{ route('credit.customer.print.pdf')}}" target="_blank" class="btn btn-success waves-effect waves-light" style="float:right;"><i class="fas fa-print me-2"></i>Rapor Çıktısı </a>
                        <h4 class="card-title mb-4 p-2">Tüm Müşteri Bakiyeleri </h4>
                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th width="5%">#</th>
                                    <th>Müşteri Adı</th> 
                                    <th>Fatura No.</th>
                                    <th>Fatura Tarihi</th>
                                    <th>Vadesi Geçen Tutar</th> 
                                    <th>İşlem</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($allData as $key => $item)
                                <tr>
                                    <td> {{ $key+1}} </td>
                                    <td> {{ $item->customer->name }} </td> 
                                    <td> #{{ $item->invoice->invoice_no }} </td> 
                                    <td> {{ date('d/m/Y', strtotime($item->invoice->date)) }} </td> 
                                    <td> {{ $item->due_amount }} </td> 
                                    <td>
                                        <a href="javascript:void(0);" class="customerEdit" type="button" data-id="{{ $item->id}}" title="Düzenle"><i class="fas fa-edit"></i></a>
                                        <a href="{{ route('customer.delete', $item->id) }}" class="" title="Sil" id="deleteBtn"><i class="text-danger fas fa-trash-alt"></i></a>
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
    <div class="modal" id="customerEditModal">
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
        
        $('.customerEdit').click(function(){
            
            var customerId = $(this).data('id');
            axios.get('/customer/edit/'+ customerId)
            .then(function (response) {
                $('.modal-body').html(response.data);
                $('#customerEditModal').modal('show'); 
            })
            .catch(function (error) {
                console.log(error);
            })
            .finally(function () {
            });
        });
        $("#customerEditModal").on('shown.bs.modal', function(e){
            $('#customerImage').change(function (e) { 
                var reader = new FileReader();
                reader.onload = function(e){
                    // $('#showImage').removeAttr('src');
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    });
</script>
@endpush
@endsection