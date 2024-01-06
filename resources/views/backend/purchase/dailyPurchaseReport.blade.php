@extends('admin.admin_master')
@section('admin')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Günlük Satın Alma Raporu</h4>
                        <div>
                            <form method="GET" action="{{ route('daily.purchase.pdf')}}" target="_blank" id="dailyPurchaseReport">
                                <div class="row mt-4">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="date" class="form-label">Başlangıç Tarihi: </label>
                                            <div class="input-group" id="datepicker1">
                                                <input type="date" name="start_date" id="start_date" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="date" class="form-label">Bitiş Tarihi: </label>
                                            <div class="input-group" id="datepicker2">
                                                <input type="date" name="end_date" id="end_date" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="date" class="form-label"></label>
                                        <div class="mt-2">
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
@endsection
@push('script')
<script>
    $(document).ready(function () {
        $('#dailyPurchaseReport').validate({
            rules: {
                start_date: {
                    required : true,
                }, 
                end_date: {
                    required : true,
                },
            },
            messages :{
                start_date: {
                    required : 'Lütfen Başlangıç Tarihi Seçiniz.',
                },
                end_date: {
                    required : 'Lütfen Bitiş Tarihi Seçiniz.',
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