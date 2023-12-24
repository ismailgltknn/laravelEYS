@extends('admin.admin_master')
@section('admin')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Tedarikçi / Ürün Bazlı Rapor</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <strong>Tedarikçi Bazlı Rapor</strong>
                                <input type="radio" name="supplier_product_wise" value="supplier_wise" class="search_value">
                                &nbsp;&nbsp;
                                <strong>Ürün Bazlı Rapor</strong>
                                <input type="radio" name="supplier_product_wise" value="product_wise" class="search_value">
                            </div>
                        </div>
                        <div class="show_supplier" style="display: none;">
                            <form method="GET" action="{{ route('supplier.wise.pdf')}}" target="_blank" id="myForm">
                                <div class="row">
                                    <div class="col-sm-8 form-group">
                                        <label>Tedarikçi Adı</label>
                                        <select class="form-control select2" name="supplier_id" id="supplier_id" aria-label="Tedarikçi Adı">
                                            <option value="">Tedarikçi seçiniz.</option>
                                            @foreach($suppliers as $sup)
                                            <option value="{{ $sup->id}}">{{ $sup->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="mt-4 p-1">
                                            <button type="submit" class="btn btn-primary"><i class="fas fa-search me-2"></i>Ara</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="show_product" style="display: none;">
                            <form method="GET" action="{{ route('product.wise.pdf')}}" target="_blank" id="myForm2">
                                <div class="row">
                                    <div class="col-md-4 form-group">
                                        <label for="category_id" class="form-label">Kategori: </label>
                                        <select class="form-control select2" id="category_id" name="category_id" aria-label="Kategori Adı">
                                            <option value="">Kategori seçiniz.</option>
                                            @foreach($categories as $cat)
                                            <option value="{{ $cat->id}}">{{ $cat->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="product_id" class="form-label">Ürün: </label>
                                        <select class="form-control select2" id="product_id" name="product_id" aria-label="Ürün Adı">
                                            <option value="">Ürün seçiniz.</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="mt-4 p-1">
                                            <button type="submit" class="btn btn-primary"><i class="fas fa-search me-2"></i>Ara</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
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
        $('#myForm').validate({
            rules: {
                supplier_id: {
                    required : true,
                },
            },
            messages :{
                supplier_id: {
                    required : 'Lütfen Tedarikçi Seçiniz.',
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
        $('#myForm2').validate({
            rules: {
                category_id: {
                    required : true,
                },
                product_id: {
                    required : true,
                },
            },
            messages :{
                category_id: {
                    required : 'Lütfen Kategori Seçiniz.',
                },
                product_id: {
                    required : 'Lütfen Ürün Seçiniz.',
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
        $(document).on('change', '.search_value', function () {
            var search_value = $(this).val();
            if (search_value == "supplier_wise") {
                $('.show_supplier').show();                
            }else{
                $("#supplier_id").val(null).trigger("change");
                $('.show_supplier').hide();
            }
            if (search_value == "product_wise") {
                $('.show_product').show();                
            }else{
                $('#category_id').val(null).trigger("change");
                $('#product_id').val(null).trigger("change");
                $('.show_product').hide();
            }
        });
        $(document).on('change', '#category_id', function () {
            var categoryId = $(this).val();
            axios.get('/get/product/'+ categoryId)
            .then(function (response) {
                var html = '<option value="">Ürün Seçiniz.</option>';
                $.each(response.data, function (key, v) { 
                    html += '<option value="'+ v.id+'">'+ v.name+'</option>';
                });
                $('#product_id').html(html);
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