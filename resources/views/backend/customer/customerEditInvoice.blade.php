<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                @if (!empty($errors->all()))
                @foreach ($errors->all() as $error)
                toastr.error("{{$error}}")
                @endforeach
                @endif
                <div class="row">
                    <div class="col-12">
                        <div class="invoice-title">
                            <strong>Fatura Tarihi: {{ date('d/m/Y', strtotime($payment->invoice->date))}}</strong>
                            <strong class="float-end">Fatura No. #{{ $payment->invoice->invoice_no}}</strong>
                        </div>
                        <hr>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div>
                            <div class="p-2">
                                <h3 class="font-size-16"><strong>Müşteri Bilgileri</strong></h3>
                            </div>
                            <div class="">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Ad</th>
                                                <th>Telefon</th>
                                                <th>Email</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- foreach ($order->lineItems as $line) or some such thing here -->
                                            <tr>
                                                <td>{{ $payment->customer->name}}</td>
                                                <td>{{ $payment->customer->phone}}</td>
                                                <td>{{ $payment->customer->email}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- end row -->
                <div class="row">
                    <div class="col-12">
                        <form method="POST" action="{{ route('customer.update.invoice', $payment->invoice_id)}}">
                            @csrf
                            <div>
                                <div class="p-2">
                                </div>
                                <div class="">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Kategori</th>
                                                    <th>Ürün</th>
                                                    <th>Stok</th>
                                                    <th>Alınan Miktar</th>
                                                    <th>Birim Fiyat</th>
                                                    <th>Toplam Fiyat</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                $totalSum = '0';
                                                @endphp
                                                @foreach ($payment->invoice->invoiceDetails as $key => $details)
                                                <tr>
                                                    <td>{{ $key+1}}</td>
                                                    <td>{{ $details->category->name}}</td>
                                                    <td>{{ $details->product->name}}</td>
                                                    <td>{{ $details->product->quantity}}</td>
                                                    <td>{{ $details->selling_quantity}}</td>
                                                    <td>₺{{ $details->unit_price}}</td>
                                                    <td>₺{{ $details->selling_price}}</td>
                                                </tr>
                                                @php
                                                $totalSum += $details->selling_price;
                                                @endphp
                                                @endforeach
                                                <tr>
                                                    <td class="thick-line"></td>
                                                    <td class="thick-line"></td>
                                                    <td class="thick-line"></td>
                                                    <td class="thick-line"></td>
                                                    <td class="thick-line"></td>
                                                    <td class="thick-line text-end"><strong>Ara Toplam</strong></td>
                                                    <td class="thick-line">₺{{ $totalSum}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="no-line"></td>
                                                    <td class="no-line"></td>
                                                    <td class="no-line"></td>
                                                    <td class="no-line"></td>
                                                    <td class="no-line"></td>
                                                    <td class="no-line text-end"><strong>İskonto</strong></td>
                                                    <td class="no-line">₺{{ $payment->discount_amount}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="no-line"></td>
                                                    <td class="no-line"></td>
                                                    <td class="no-line"></td>
                                                    <td class="no-line"></td>
                                                    <td class="no-line"></td>
                                                    <td class="no-line text-end"><strong>Ödenen Tutar</strong></td>
                                                    <td class="no-line">₺{{ $payment->paid_amount}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="no-line"></td>
                                                    <td class="no-line"></td>
                                                    <td class="no-line"></td>
                                                    <td class="no-line"></td>
                                                    <td class="no-line"></td>
                                                    <td class="no-line text-end"><strong>Kalan Tutar</strong></td>
                                                    <input type="hidden" name="paid_amount" value="{{ $payment->due_amount}}">
                                                    <td class="no-line">₺{{ $payment->due_amount}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="no-line"></td>
                                                    <td class="no-line"></td>
                                                    <td class="no-line"></td>
                                                    <td class="no-line"></td>
                                                    <td class="no-line"></td>
                                                    <td class="no-line text-end"><strong>Genel Toplam</strong></td>
                                                    <td class="no-line"><h4 class="m-0">₺{{ $payment->total_amount}}</h4></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-3">
                                            <label>Ödeme Durumu</label>
                                            <select name="paid_status" id="paid_status" class="form-control select2">
                                                <option value="">Ödeme Durumu Seçiniz</option>
                                                <option value="full_paid">Tamamı Ödendi</option>
                                                <option value="partial_paid">Kısmen Ödendi</option>
                                            </select>
                                            <input type="text" name="new_paid_amount" style="display: none;" class="form-control new_paid_amount mt-2 text-end" placeholder="Ödeme Miktarını Giriniz.">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="date" class="form-label">Tarih: </label>
                                            <div class="input-group" id="datepicker2">
                                                <input type="text" autocomplete="off" name="date" id="date" class="form-control dateInput"
                                                data-date-format="dd/mm/yyyy" data-date-container='#datepicker2' data-provide="datepicker"
                                                data-date-autoclose="true">
                                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <div class="p-4 mt-1">
                                                <input type="submit" class="btn btn-success waves-effect waves-light col-lg-12" value="Güncelle">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div> <!-- end row -->
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->
<script type="text/javascript">
    $(document).on('change', '#paid_status', function () {
        var paid_status = $(this).val();
        if (paid_status == 'partial_paid') {
            $('.new_paid_amount').show();                
        }else{
            $('.new_paid_amount').hide();
        }
    });
</script>