@extends('admin.admin_master')
@section('admin')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Kredi / Ödeme Bazlı Rapor</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <strong>Kredi Bazlı Rapor</strong>
                                <input type="radio" name="customer_wise_report" value="credit_wise" class="search_value">
                                &nbsp;&nbsp;
                                <strong>Ödeme Bazlı Rapor</strong>
                                <input type="radio" name="customer_wise_report" value="paid_wise" class="search_value">
                            </div>
                        </div>
                        <div class="show_credit" style="display: none;">
                            <form method="GET" action="{{ route('customer.wise.credit.report')}}" target="_blank" id="myForm">
                                <div class="row">
                                    <div class="col-sm-8 form-group">
                                        <label>Müşteri Adı</label>
                                        <select class="form-control select2" name="customer_id_credit" id="customer_id_credit" aria-label="Müşteri Adı">
                                            <option value="">Müşteri seçiniz.</option>
                                            @foreach($customers as $customer)
                                            <option value="{{ $customer->id}}">{{ $customer->name}}</option>
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
                        <div class="show_paid" style="display: none;">
                            <form method="GET" action="{{ route('customer.wise.paid.report')}}" target="_blank" id="myForm2">
                                <div class="row">
                                    <div class="col-sm-8 form-group">
                                        <label>Müşteri Adı</label>
                                        <select class="form-control select2" name="customer_id_paid" id="customer_id_paid" aria-label="Müşteri Adı">
                                            <option value="">Müşteri seçiniz.</option>
                                            @foreach($customers as $customer)
                                            <option value="{{ $customer->id}}">{{ $customer->name}}</option>
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
                customer_id_credit: {
                    required : true,
                },
            },
            messages :{
                customer_id_credit: {
                    required : 'Lütfen Müşteri Seçiniz.',
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
                customer_id_paid: {
                    required : true,
                },
            },
            messages :{
                customer_id_paid: {
                    required : 'Lütfen Müşteri Seçiniz.',
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
            if (search_value == "credit_wise") {
                $('.show_credit').show();                
            }else{
                $('.show_credit').hide();
            }
            if (search_value == "paid_wise") {
                $('.show_paid').show();                
            }else{
                $('.show_paid').hide();
            }
        });
    });
</script>
@endpush
@endsection