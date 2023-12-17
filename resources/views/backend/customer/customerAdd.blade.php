@extends('admin.admin_master')
@section('admin')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Müşteri Ekle</h4>
                        <form method="POST" id="customerAdd" action="{{ route('customer.store')}}" enctype="multipart/form-data" class="p-3">
                            @csrf
                            <div class="row mb-3">
                                <label for="customerName" class="col-sm-2 col-form-label">Müşteri Adı: </label>
                                <div class="form-group col-sm-10">
                                    <input name="customerName" id="customerName" required class="form-control" type="text">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="customerPhone" class="col-sm-2 col-form-label">Müşteri Tel. No.: </label>
                                <div class="form-group col-sm-10">
                                    <input name="customerPhone" id="customerPhone" required class="form-control" type="tel" pattern="[0-9]{3}[0-9]{3}[0-9]{4}" placeholder="5555555555">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="customerEmail" class="col-sm-2 col-form-label">Müşteri Email: </label>
                                <div class="form-group col-sm-10">
                                    <input name="customerEmail" id="customerEmail" required class="form-control" type="email">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="customerAddress" class="col-sm-2 col-form-label">Müşteri Adres: </label>
                                <div class="form-group col-sm-10">
                                    <input name="customerAddress" id="customerAddress" required class="form-control" type="text">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="customerImage" class="col-sm-2 col-form-label">Müşteri Profil Resmi: </label>
                                <div class="form-group col-sm-10">
                                    <input name="customerImage" id="customerImage" class="form-control" type="file">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="showImage" class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <img id="showImage" class="rounded avatar-lg mx-auto" src="{{ url('/files/noavatar.png') }}" alt="customerAvatar">
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
        $(document).ready(function () {
            $('#customerImage').change(function (e) { 
                var reader = new FileReader();
                reader.onload = function(e){
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
            
            $('#customerAdd').validate({
                rules: {
                    customerName: {
                        required : true,
                    }, 
                    customerPhone: {
                        required : true,
                    },
                    customerEmail: {
                        required : true,
                    },
                    customerAddress: {
                        required : true,
                    },
                },
                messages :{
                    customerName: {
                        required : 'Lütfen Müşteri Adı Giriniz.',
                    },
                    customerPhone: {
                        required : 'Lütfen Müşteri Tel. No. Giriniz.',
                    },
                    customerEmail: {
                        required : 'Lütfen Müşteri Email Giriniz.',
                    },
                    customerAddress: {
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
        });
    </script>    
@endpush