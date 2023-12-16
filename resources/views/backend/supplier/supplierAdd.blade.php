@extends('admin.admin_master')
@section('admin')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Müşteri Ekle</h4>
                        <form method="POST" id="supplierAdd" action="{{ route('supplier.store')}}" class="p-3">
                            @csrf
                            <div class="row mb-3">
                                <label for="supplierName" class="col-sm-2 col-form-label">Müşteri Adı: </label>
                                <div class="form-group col-sm-10">
                                    <input name="supplierName" id="supplierName" required class="form-control" type="text">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="supplierPhone" class="col-sm-2 col-form-label">Müşteri Tel. No.: </label>
                                <div class="form-group col-sm-10">
                                    <input name="supplierPhone" id="supplierPhone" required class="form-control" type="tel" pattern="[0-9]{3}[0-9]{3}[0-9]{4}" placeholder="5555555555">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="supplierEmail" class="col-sm-2 col-form-label">Müşteri Email: </label>
                                <div class="form-group col-sm-10">
                                    <input name="supplierEmail" id="supplierEmail" required class="form-control" type="email">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="supplierAddress" class="col-sm-2 col-form-label">Müşteri Adres: </label>
                                <div class="form-group col-sm-10">
                                    <input name="supplierAddress" id="supplierAddress" required class="form-control" type="text">
                                </div>
                            </div>
                            <div class="mx-auto">
                                <input type="submit" class="btn btn-info waves-effect waves-light" value="Müşteri Ekle">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
    <script>
        $('#supplierAdd').validate({
            rules: {
                supplierName: {
                    required : true,
                }, 
                supplierPhone: {
                    required : true,
                },
                supplierEmail: {
                    required : true,
                },
                supplierAddress: {
                    required : true,
                },
            },
            messages :{
                supplierName: {
                    required : 'Lütfen Müşteri Adı Giriniz.',
                },
                supplierPhone: {
                    required : 'Lütfen Müşteri Tel. No. Giriniz.',
                },
                supplierEmail: {
                    required : 'Lütfen Müşteri Email Giriniz.',
                },
                supplierAddress: {
                    required : 'Lütfen Müşteri Adresi Giriniz.',
                },
            },
            errorElement : 'span', 
            errorPlacement: function (error,element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight : function(element, errorClass, validClass){
                $(element).addClass('is-invalid');
            },
            unhighlight : function(element, errorClass, validClass){
                $(element).removeClass('is-invalid');
            },
        });
    </script>    
@endpush