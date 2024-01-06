@extends('admin.admin_master')
@section('admin')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Müşteri Kredi</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <a href="{{ route('credit.customer.print.pdf')}}" target="_blank" class="btn btn-success waves-effect waves-light" style="float:right;"><i class="fas fa-print me-2"></i>Rapor Çıktısı </a>
                        <h4 class="card-title mb-4 p-2">Müşteri Kredileri </h4>
                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th width="5%">#</th>
                                    <th>Müşteri Adı</th> 
                                    <th>Fatura No.</th>
                                    <th>Fatura Tarihi</th>
                                    <th>Ödenmemiş Tutar</th> 
                                    <th>İşlem</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($allData as $key => $item)
                                <tr>
                                    <td> {{ $key+1}} </td>
                                    <td> {{ isset($item->customer->name) ? $item->customer->name : '' }} </td> 
                                    <td> #{{ $item->invoice->invoice_no }} </td> 
                                    <td> {{ date('d/m/Y', strtotime($item->invoice->date)) }} </td> 
                                    <td> ₺{{ $item->due_amount }} </td> 
                                    <td>
                                        <a href="javascript:void(0);" class="customerEditInvoice" type="button" data-id="{{ $item->invoice->id}}" title="Düzenle"><i class="fas fa-edit"></i></a>
                                        <a href="{{ route('customer.delete', $item->id) }}" class="" title="Müşteri Fatura Detayı"><svg xmlns="http://www.w3.org/2000/svg" class="mb-1" height="16" width="18" viewBox="0 0 576 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M288 80c-65.2 0-118.8 29.6-159.9 67.7C89.6 183.5 63 226 49.4 256c13.6 30 40.2 72.5 78.6 108.3C169.2 402.4 222.8 432 288 432s118.8-29.6 159.9-67.7C486.4 328.5 513 286 526.6 256c-13.6-30-40.2-72.5-78.6-108.3C406.8 109.6 353.2 80 288 80zM95.4 112.6C142.5 68.8 207.2 32 288 32s145.5 36.8 192.6 80.6c46.8 43.5 78.1 95.4 93 131.1c3.3 7.9 3.3 16.7 0 24.6c-14.9 35.7-46.2 87.7-93 131.1C433.5 443.2 368.8 480 288 480s-145.5-36.8-192.6-80.6C48.6 356 17.3 304 2.5 268.3c-3.3-7.9-3.3-16.7 0-24.6C17.3 208 48.6 156 95.4 112.6zM288 336c44.2 0 80-35.8 80-80s-35.8-80-80-80c-.7 0-1.3 0-2 0c1.3 5.1 2 10.5 2 16c0 35.3-28.7 64-64 64c-5.5 0-10.9-.7-16-2c0 .7 0 1.3 0 2c0 44.2 35.8 80 80 80zm0-208a128 128 0 1 1 0 256 128 128 0 1 1 0-256z"/></svg></i></a>
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
    <div class="modal" id="customerEditInvoice">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Müşteri Fatura Düzenle</h4>
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
        
        $('.customerEditInvoice').click(function(){
            
            var invoiceId = $(this).data('id');
            axios.get('/customer/edit/invoice/'+ invoiceId)
            .then(function (response) {
                $('.modal-body').html(response.data);
                $('#customerEditInvoice').modal('show'); 
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