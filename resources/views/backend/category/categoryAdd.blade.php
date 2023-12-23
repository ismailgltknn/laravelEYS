@extends('admin.admin_master')
@section('admin')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Kategori Ekle</h4>
                        <form method="POST" id="categoryAdd" action="{{ route('category.store')}}" class="p-3">
                            @csrf
                            <div class="row mb-3">
                                <label for="categoryName" class="col-sm-2 col-form-label">Kategori Adı: </label>
                                <div class="form-group col-sm-10">
                                    <input name="categoryName" id="categoryName" required class="form-control" type="text">
                                </div>
                            </div>
                            <div class="mx-auto">
                                <input type="submit" class="btn btn-success waves-effect waves-light" value="Kategori Ekle">
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
        $('#categoryAdd').validate({
            rules: {
                categoryName: {
                    required : true,
                },
            },
            messages :{
                categoryName: {
                    required : 'Lütfen Kategori Adı Giriniz.',
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