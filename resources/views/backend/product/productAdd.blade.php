@extends('admin.admin_master')
@section('admin')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Ürün Ekle</h4>
                        <form method="POST" id="productAdd" action="{{ route('product.store')}}" class="p-3">
                            @csrf
                            <div class="row mb-3">
                                <label for="productName" class="col-sm-2 col-form-label">Ürün Adı: </label>
                                <div class="form-group col-sm-10">
                                    <input name="productName" id="productName" required class="form-control" type="text">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="" class="col-sm-2 col-form-label">Tedarikçi: </label>
                                <div class="form-group col-sm-10">
                                    <select class="form-select" name="supplier_id" aria-label="Tedarikçi Adı">
                                        <option>Tedarikçi seçiniz.</option>
                                        @foreach($suppliers as $sup)
                                        <option value="{{ $sup->id}}">{{ $sup->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="" class="col-sm-2 col-form-label">Birim: </label>
                                <div class="form-group col-sm-10">
                                    <select class="form-select" name="unit_id" aria-label="Tedarikçi Adı">
                                        <option>Birim seçiniz.</option>
                                        @foreach($units as $unit)
                                        <option value="{{ $unit->id}}">{{ $unit->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="" class="col-sm-2 col-form-label">Kategori: </label>
                                <div class="form-group col-sm-10">
                                    <select class="form-select" name="category_id" aria-label="Tedarikçi Adı">
                                        <option>Kategori seçiniz.</option>
                                        @foreach($categories as $category)
                                        <option value="{{ $category->id}}">{{ $category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mx-auto">
                                <input type="submit" class="btn btn-info waves-effect waves-light" value="Ürün Ekle">
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
    $('#productAdd').validate({
        rules: {
            productName: {
                required : true,
            },
        },
        messages :{
            productName: {
                required : 'Lütfen Ürün Adı Giriniz.',
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