@extends('admin.admin_master')
@section('admin')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Faturalar</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <a href="{{ route('invoice.add')}}" class="btn btn-success waves-effect waves-light" style="float:right;"><i class="fas fa-plus me-2"></i>Fatura Ekle </a>
                        <h4 class="card-title mb-4 p-2">Fatura Bilgileri </h4>
                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Müşteri Adı</th> 
                                    <th>Fatura No.</th>
                                    <th>Tarih</th>
                                    <th>Açıklama</th>
                                    <th>Tutar</th>
                                    <th>Durum</th>
                                    <th>İşlem</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($allData as $key => $item)
                                <tr>
                                    <td>{{ $key+1}}</td>
                                    <td>{{ $item->payment->customer->name}}</td>
                                    <td>#{{ $item->invoice_no}}</td> 
                                    <td>{{ date('d-m-Y H:i:s', strtotime($item->date))}}</td> 
                                    <td>{{ $item->description}}</td>
                                    <td>{{ $item->payment->total_amount}}₺</td>
                                    <td>
                                        @if($item->status == '0')
                                        <span class="badge alert-warning">Onay Bekliyor</span>
                                        @elseif($item->status == '1')
                                        <span class="badge alert-success">Onaylandı</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($item->status == '0')
                                        <a href="{{ route('invoice.approve', $item->id) }}" class="btn btn-success btn-sm" title="Onayla"><i class=" fas fa-check-circle"></i>  Onayla</a>
                                        <a href="{{ route('invoice.delete', $item->id) }}" class="btn btn-danger btn-sm" title="Sil" id="deleteBtn"><i class=" fas fa-trash-alt"></i>  Sil</a>
                                        @endif
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
</div>
@push('script')
<script type="text/javascript">
    $(document).ready(function () {
        $('#datatable').DataTable();
    });
</script>
@endpush
@endsection