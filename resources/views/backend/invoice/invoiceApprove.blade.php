@extends('admin.admin_master')
@section('admin')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Fatura Onay</h4>
                </div>
            </div>
        </div>
        @php
            $payment = App\Models\Payment::where('invoice_id', $invoice->id)->first();
        @endphp
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4>Fatura No. : #{{ $invoice->invoice_no}} - {{ date('d/m/Y', strtotime($invoice->date))}}</h4>
                        <a href="{{ route('invoice.pending.list')}}" class="btn btn-success waves-effect waves-light" style="float:right;"><i class="fas fa-list me-2"></i>Onay Bekleyen Faturalar </a>
                        
                        <table class="table table-responsive table-hover" width='100%'>
                            <tbody>
                                <tr>
                                    <td><p> Müşteri Bilgi</p></td>
                                    <td><p> Ad: <strong> {{ $payment->customer->name}}</strong></p></td>
                                    <td><p> Telefon: <strong> {{ $payment->customer->phone}}</strong></p></td>
                                    <td><p> Email: <strong> {{ $payment->customer->email}}</strong></p></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td colspan="3"><p> Açıklama: <strong> {{ $invoice->description}}</strong></p></td>
                                </tr>
                            </tbody>
                        </table>
                        <form method="POST" action="{{ route('approval.store', $invoice->id)}}">
                            @csrf
                            <table border="1" class="table table-responsive" width='100%'>
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">Kategori</th>
                                        <th class="text-center">Ürün</th>
                                        <th class="text-center bg-warning">Bulunan Stok</th>
                                        <th class="text-center">Satılan Miktar</th>
                                        <th class="text-center">Birim Fiyat</th>
                                        <th class="text-center">Toplam Tutar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $totalSum = '0';
                                    @endphp
                                    @foreach ($invoice->invoiceDetails as $key => $details)
                                    <tr>
                                        <input type="hidden" name="category_id[]" value="{{ $details->category_id}}">
                                        <input type="hidden" name="product_id[]" value="{{ $details->product_id}}">
                                        <input type="hidden" name="selling_quantity[{{ $details->id}}]" value="{{ $details->selling_quantity}}">
                                        <td class="text-center">{{ $key+1}}</td>
                                        <td class="text-center">{{ $details->category->name}}</td>
                                        <td class="text-center">{{ $details->product->name}}</td>
                                        <td class="text-center bg-warning">{{ $details->product->quantity}}</td>
                                        <td class="text-center">{{ $details->selling_quantity}}</td>
                                        <td class="text-center">₺{{ $details->unit_price}}</td>
                                        <td class="text-center">₺{{ $details->selling_price}}</td>
                                    </tr>
                                    @php
                                        $totalSum += $details->selling_price;
                                    @endphp
                                    @endforeach
                                    <tr>
                                        <td colspan="6"><strong>Ara Toplam</strong></td>
                                        <td class="text-center"><strong>₺{{ $totalSum}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td colspan="6"><strong>İskonto</strong></td>
                                        <td class="text-center"><strong>₺{{ $payment->discount_amount}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td colspan="6"><strong>Ödenen Tutar</strong></td>
                                        <td class="text-center"><strong>₺{{ $payment->paid_amount}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td colspan="6"><strong>Kalan Tutar</strong></td>
                                        <td class="text-center"><strong>₺{{ $payment->due_amount}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td colspan="6"><strong>Genel Toplam</strong></td>
                                        <td class="text-center"><strong>₺{{ $payment->total_amount}}</strong></td>
                                    </tr>
                                </tbody>
                            </table>
                            <button type="submit" class="btn btn-success">Fatura Onayla</button>
                        </form>
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