<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form method="POST" id="customerUpdate" action="{{ route('customer.update')}}" enctype="multipart/form-data" class="p-3">
                    @csrf
                    <div class="row mb-3">
                        <label for="customerName" class="col-sm-2 col-form-label">Müşteri Adı: </label>
                        <div class="form-group col-sm-10">
                            <input name="customerName" id="customerName" value="{{ $customer->name}}" required class="form-control" type="text">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="customerPhone" class="col-sm-2 col-form-label">Müşteri Tel. No.: </label>
                        <div class="form-group col-sm-10">
                            <input name="customerPhone" id="customerPhone" value="{{ $customer->phone}}" required class="form-control" type="tel" pattern="[0-9]{3}[0-9]{3}[0-9]{4}" placeholder="5555555555">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="customerEmail" class="col-sm-2 col-form-label">Müşteri Email: </label>
                        <div class="form-group col-sm-10">
                            <input name="customerEmail" id="customerEmail" value="{{ $customer->email}}" required class="form-control" type="email">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="customerAddress" class="col-sm-2 col-form-label">Müşteri Adres: </label>
                        <div class="form-group col-sm-10">
                            <input name="customerAddress" id="customerAddress" value="{{ $customer->address}}" required class="form-control" type="text">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="customerImage" class="col-sm-2 col-form-label">Müşteri Profil Resmi: </label>
                        <div class="form-group col-sm-10">
                            <input name="customerImage" id="customerImage" class="form-control" type="file">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="showImage" class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-10">
                            <img id="showImage" class="rounded avatar-lg mx-auto" src="{{ $customer->customerImage 
                            ?url($customer->customerImage)
                            :url('/files/noavatar.png') }}" alt="customerAvatar">
                        </div>
                    </div>
                    <input type="hidden" name="id" value="{{ $customer->id}}">
                    <input type="submit" class="btn btn-success waves-effect waves-light col-lg-12 mt-2" value="Güncelle">
                </form>
            </div>
        </div>
    </div>
</div>
{{-- scriptler push edilmezse modal açılmaz --}}
@push('script')
<script type="text/javascript">
</script>   
@endpush