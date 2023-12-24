@extends('admin.admin_master')
@section('admin')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Fatura Ekleme</h4>
                        <div class="row mt-4">
                            <div class="col-md-1">
                                <div class="">
                                    <label for="invoice_no" class="form-label">Fatura No.: </label>
                                    <input class="form-control text-end" value="{{$invoiceNo}}" type="text" name="invoice_no" id="invoice_no" readonly style="background-color: #ddd">
                                </div>
                            </div>
                            <div class="col-md-2">
                                    <label for="date" class="form-label">Tarih: </label>
                                    <div class="input-group" id="datepicker2">
                                        <input type="text" name="date" id="date" value="{{ $date }}" class="form-control dateInput"
                                        data-date-format="d-m-yyyy" data-date-container='#datepicker2' data-provide="datepicker"
                                        data-date-autoclose="true">
                                        <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                    </div>
                            </div>
                            <div class="col-md-3">
                                    <label for="category_id" class="form-label">Kategori: </label>
                                    <select class="form-control select2" id="category_id" name="category_id" aria-label="Kategori Adı">
                                        <option>Kategori seçiniz.</option>
                                        @foreach($categories as $cat)
                                        <option value="{{ $cat->id}}">{{ $cat->name}}</option>
                                        @endforeach
                                    </select>
                            </div>
                            <div class="col-md-3">
                                    <label for="product_id" class="form-label">Ürün: </label>
                                    <select class="form-control select2" id="product_id" name="product_id" aria-label="Ürün Adı">
                                        <option>Ürün seçiniz.</option>
                                    </select>
                            </div>
                            <div class="col-md-1">
                                <div class="">
                                    <label for="current_stock_quantity" class="form-label">Stok: </label>
                                    <input class="form-control text-end" type="text" name="current_stock_quantity" id="current_stock_quantity" readonly style="background-color: #ddd">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="mt-4 p-2 ms-auto">
                                    <i class="btn btn-outline-success waves-effect waves-light addEventMore fas fa-plus"><span class="ms-2">Ekle</span></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('invoice.store')}}">
                            @csrf
                            <table class="table table-sm table-bordered" width="100%">
                                <thead>
                                    <tr>
                                        <th>Kategori</th>
                                        <th>Ürün</th>
                                        <th width="7%">Adet</th>
                                        <th width="10%">Ürün Birim Fiyatı</th>
                                        <th width="15%">Toplam Fiyat</th>
                                        <th width="7%">İşlem</th>
                                    </tr>
                                </thead>
                                <tbody id="addRow" class="addRow">
                                </tbody>
                                <tbody>
                                    <tr>
                                        <td colspan="4" class="text-end align-middle">İskonto</td>
                                        <td>
                                            <input type="text" id="discount_amount" name="discount_amount" class="form-control estimated_amount text-end" placeholder="İskonto Giriniz">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" class="text-end align-middle">Genel Toplam</td>
                                        <td>
                                            <input type="text" id="estimated_amount" name="estimated_amount" class="form-control estimated_amount text-end" style="background-color: #ddd" readonly value="0">
                                        </td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>

                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <textarea id="description" name="description" class="form-control" maxlength="512" rows="3" placeholder="Açıklamayı buraya yazınız."></textarea><br>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label>Ödeme Durumu</label>
                                    <select name="paid_status" id="paid_status" class="form-control select2">
                                        <option value="">Ödeme Durumu Seçiniz</option>
                                        <option value="full_paid">Tamamı Ödendi</option>
                                        <option value="full_due">Vadesi Geçti</option>
                                        <option value="partial_paid">Kısmen Ödendi</option>
                                    </select>
                                    <input type="text" name="paid_amount" style="display: none;" class="form-control paid_amount mt-2 text-end" placeholder="Ödeme Miktarını Giriniz.">
                                </div>
                                <div class="form-group col-md-9">
                                    <label>Müşteriler</label>
                                    <select name="customer_id" id="customer_id" class="form-control select2">
                                        <option value="">Müşteri Seçiniz</option>
                                        @foreach($customers as $customer)
                                        <option value="{{ $customer->id}}">{{ $customer->name}} - {{ $customer->phone}}</option>
                                        @endforeach
                                        <option value="0">Yeni Müşteri</option>
                                    </select>
                                </div>
                            </div><br>

                            <div class="row new_customer" style="display: none;">
                                <div class="form-group col-md-4">
                                    <input type="text" name="name" id="name" class="form-control" placeholder="Müşteri Adı Giriniz">
                                </div>
                                <div class="form-group col-md-4">
                                    <input type="text" name="phone" id="phone" class="form-control" placeholder="Müşteri Telefonu Giriniz">
                                </div>
                                <div class="form-group col-md-4">
                                    <input type="text" name="email" id="email" class="form-control" placeholder="Müşteri Email Giriniz">
                                </div>
                            </div><br>

                            <div class="form-group">
                                <button type="submit" class="btn btn-success" id="storeButton">Kaydet</button>
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
        <input type="hidden" name="date" value="@{{date}}">
        <input type="hidden" name="invoice_no" value="@{{invoice_no}}">
        <td>
            <input type="hidden" name="category_id[]" value="@{{category_id}}">
            @{{ category_name}}
        </td>
        <td>
            <input type="hidden" name="product_id[]" value="@{{product_id}}">
            @{{ product_name}}
        </td>
        <td>
            <input type="number" min="1" class="form-control selling_quantity text-end" name="selling_quantity[]" value="">
        </td>
        <td>
            <input type="number" min="1" class="form-control unit_price text-end" name="unit_price[]" value="">
        </td>
        <td>
            <input type="number" class="form-control selling_price text-end" name="selling_price[]" value="0" readonly>
        </td>
        <td>
            <i class="btn btn-danger btn-sm fas fa-minus-circle removeEventMore"></i>
        </td>
    </tr>
</script>
<script type="text/javascript">
    $(document).ready(function () {
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
        $(document).on('change', '#product_id', function () {
            var productId = $(this).val();
            axios.get('/get/productStock/'+ productId)
            .then(function (response) {
                $('#current_stock_quantity').val(response.data);
            })
            .catch(function (error) {
                console.log(error);
            })
            .finally(function () {
            });
        });
        $(document).on('click', '.addEventMore', function () {
            var date = $('#date').val();
            var invoice_no = $('#invoice_no').val();
            var category_id = $('#category_id').val();
            var category_name = $('#category_id').find('option:selected').text();
            var product_id = $('#product_id').val();
            var product_name = $('#product_id').find('option:selected').text();
            if (date == '') {
                $.notify("Tarih Seçimi Yapmadınız.", {globalPosition: 'top right', className: 'error'});    
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
                invoice_no:invoice_no,
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
        
        $(document).on('keyup click', '.unit_price,.selling_quantity', function () {
            var unitPrice = $(this).closest("tr").find("input.unit_price").val();
            var quantity = $(this).closest("tr").find("input.selling_quantity").val();
            var totalPrice = unitPrice * quantity;
            $(this).closest("tr").find("input.selling_price").val(totalPrice);
            $('#discount_amount').trigger('keyup');
        });
        
        $(document).on('keyup', '#discount_amount', function () {
                totalAmountPrice();
        });
        function totalAmountPrice() {
            var sum = 0;
            $('.selling_price').each(function () { 
                var value = $(this).val();
                if (!isNaN(value) && value.length != 0) {
                    sum += parseFloat(value);                    
                }
            });
            
            var discount_amount = parseFloat($('#discount_amount').val());
            if (!isNaN(discount_amount) && discount_amount.length != 0) {
                if(discount_amount <= sum){
                    sum -= parseFloat(discount_amount);                    
                }else{$('#discount_amount').val("");}
            }

            $('#estimated_amount').val(sum);
        }
        $(document).on('change', '#paid_status', function () {
            var paid_status = $(this).val();
            if (paid_status == 'partial_paid') {
                $('.paid_amount').show();                
            }else{
                $('.paid_amount').hide();
            }
        });
        $(document).on('change', '#customer_id', function () {
            var customer_id = $(this).val();
            if (customer_id == 0 && customer_id != "") {
                $('.new_customer').show();                
            }else{
                $('.new_customer').hide();
            }
        });
    });
</script>    
@endpush