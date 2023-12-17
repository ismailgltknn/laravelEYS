@extends('admin.admin_master')
@section('admin')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Satın Alım Ekle</h4>
                        <div class="row mt-4">
                            <div class="col-md-4">
                                <div class="col-md-6 ms-auto">
                                    <label for="date" class="form-label">Tarih: </label>
                                    <input class="form-control dateInput" type="date" name="date" id="date">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="">
                                    <label for="purchase_no" class="form-label">Satın Alım No.: </label>
                                    <input class="form-control" type="text" name="purchase_no" id="purchase_no">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="col-md-6">
                                    <label for="supplier_id" class="form-label">Tedarikçi: </label>
                                    <select class="form-select" id="supplier_id" name="supplier_id" aria-label="Tedarikçi Adı">
                                        <option>Tedarikçi seçiniz.</option>
                                        @foreach($suppliers as $sup)
                                        <option value="{{ $sup->id}}">{{ $sup->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            
                            <div class="col-md-4">
                                <div class="col-md-6 ms-auto">
                                    <label for="category_id" class="form-label">Kategori: </label>
                                    <select class="form-select" id="category_id" name="category_id" aria-label="Kategori Adı">
                                        <option>Kategori seçiniz.</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="">
                                    <label for="product_id" class="form-label">Ürün: </label>
                                    <select class="form-select" id="product_id" name="product_id" aria-label="Ürün Adı">
                                        <option>Ürün seçiniz.</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mt-4 p-2 ms-auto">
                                    <i class="btn btn-outline-secondary waves-effect waves-light addEventMore fas fa-plus"><span class="ms-2">Ekle</span></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('purchase.store')}}">
                            @csrf
                            <table class="table table-sm table-bordered" width="100%">
                                <thead>
                                    <tr>
                                        <th>Kategori</th>
                                        <th>Ürün</th>
                                        <th>Adet</th>
                                        <th>Ürün Birim Fiyatı</th>
                                        <th>Açıklama</th>
                                        <th>Toplam Fiyat</th>
                                        <th>İşlem</th>
                                    </tr>
                                </thead>
                                <tbody id="addRow" class="addRow">
                                </tbody>
                                <tbody>
                                    <tr>
                                        <td colspan="5"></td>
                                        <td>
                                            <input type="text" id="estimated_amount" name="estimated_amount" class="form-control estimated_amount" style="background-color: #ddd" readonly value="0">
                                        </td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="form-group">
                                <button type="submit" class="btn btn-info" id="storeButton">Satın Alım Kaydet</button>
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
<script id="document-template" type="text/x-handlebars-template">
    <tr class="deleteAddMoreItem" id="deleteAddMoreItem">
        <input type="hidden" name="date[]" value="@{{date}}">
        <input type="hidden" name="purchase_no[]" value="@{{purchase_no}}">
        <input type="hidden" name="supplier_id[]" value="@{{supplier_id}}">
        <td>
            <input type="hidden" name="category_id[]" value="@{{category_id}}">
            @{{ category_name}}
        </td>
        <td>
            <input type="hidden" name="product_id[]" value="@{{product_id}}">
            @{{ product_name}}
        </td>
        <td>
            <input type="number" min="1" class="form-control buying_quantity text-right" name="buying_quantity[]" value="">
        </td>
        <td>
            <input type="number" min="1" class="form-control unit_price text-right" name="unit_price[]" value="">
        </td>
        <td>
            <input type="text" class="form-control" name="description[]">
        </td>
        <td>
            <input type="number" class="form-control buying_price text-right" name="buying_price[]" value="0" readonly>
        </td>
        <td>
            <i class="btn btn-danger btn-sm fas fa-minus-circle removeEventMore"></i>
        </td>
    </tr>
</script>
<script type="text/javascript">
    $(function () {
        $(document).on('change', '#supplier_id', function () {
            var supplierId = $(this).val();
            axios.get('/get/category/'+ supplierId)
            .then(function (response) {
                var html = '<option value="">Kategori Seçiniz.</option>';
                $.each(response.data, function (key, v) { 
                    html += '<option value="'+ v.category_id+'">'+ v.category.name+'</option>';
                });
                $('#category_id').html(html);
            })
            .catch(function (error) {
                console.log(error);
            })
            .finally(function () {
            });
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
        $(document).on('click', '.addEventMore', function () {
            var date = $('#date').val();
            var purchase_no = $('#purchase_no').val();
            var supplier_id = $('#supplier_id').val();
            var category_id = $('#category_id').val();
            var category_name = $('#category_id').find('option:selected').text();
            var product_id = $('#product_id').val();
            var product_name = $('#product_id').find('option:selected').text();
            if (date == '') {
                $.notify("Tarih Seçimi Yapmadınız.", {globalPosition: 'top right', className: 'error'});    
                return false;      
            }
            if (purchase_no == '') {
                $.notify("Satın Alım No. Girmediniz.", {globalPosition: 'top right', className: 'error'});    
                return false;      
            }
            if (supplier_id == '' || supplier_id == 'Tedarikçi seçiniz.') {
                $.notify("Tedarikçi Seçimi Yapmadınız.", {globalPosition: 'top right', className: 'error'});    
                return false;      
            }
            if (category_id == '' || category_id == 'Kategori seçiniz.') {
                $.notify("Kategori Seçimi Yapmadınız.", {globalPosition: 'top right', className: 'error'});    
                return false;      
            }
            if (product_id == '' || product_id == 'Ürün seçiniz.') {
                $.notify("Ürün Seçimi Yapmadınız.", {globalPosition: 'top right', className: 'error'});    
                return false;      
            }

            var source = $("#document-template").html();
            var template = Handlebars.compile(source);
            var data = {
                date:date,
                purchase_no:purchase_no,
                supplier_id:supplier_id,
                category_id:category_id,
                category_name:category_name,
                product_id:product_id,
                product_name:product_name,
            };
            var html = template(data);
            $('#addRow').append(html);
        });

        $(document).on('click', '.removeEventMore', function (event) {
            $(this).closest('.deleteAddMoreItem').remove();
            totalAmountPrice();
        });

        $(document).on('keyup click', '.unit_price,.buying_quantity', function () {
            var unitPrice = $(this).closest("tr").find("input.unit_price").val();
            var quantity = $(this).closest("tr").find("input.buying_quantity").val();
            var totalPrice = unitPrice * quantity;
            $(this).closest("tr").find("input.buying_price").val(totalPrice);
            totalAmountPrice();
        });
        function totalAmountPrice() {
            var sum = 0;
            $('.buying_price').each(function () { 
                var value = $(this).val();
                if (!isNaN(value) && value.length != 0) {
                    sum += parseFloat(value);                    
                }
            });
            $('#estimated_amount').val(sum);
        }
    });
</script>    
@endpush