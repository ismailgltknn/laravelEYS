<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form method="POST" id="supplierUpdate" action="{{ route('supplier.update')}}" class="p-3">
                    @csrf
                    <div class="row mb-3">
                        <label for="supplierName" class="col-sm-2 col-form-label">Tedarikçi Adı: </label>
                        <div class="form-group col-sm-10">
                            <input name="supplierName" id="supplierName" value="{{ $supplier->name}}" required class="form-control" type="text">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="supplierPhone" class="col-sm-2 col-form-label">Tedarikçi Tel. No.: </label>
                        <div class="form-group col-sm-10">
                            <input name="supplierPhone" id="supplierPhone" value="{{ $supplier->phone}}" required class="form-control" type="tel" pattern="[0-9]{3}[0-9]{3}[0-9]{4}" placeholder="5555555555">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="supplierEmail" class="col-sm-2 col-form-label">Tedarikçi Email: </label>
                        <div class="form-group col-sm-10">
                            <input name="supplierEmail" id="supplierEmail" value="{{ $supplier->email}}" required class="form-control" type="email">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="supplierAddress" class="col-sm-2 col-form-label">Tedarikçi Adres: </label>
                        <div class="form-group col-sm-10">
                            <input name="supplierAddress" id="supplierAddress" value="{{ $supplier->address}}" required class="form-control" type="text">
                        </div>
                    </div>
                    <input type="hidden" name="id" value="{{ $supplier->id}}">
                    <input type="submit" class="btn btn-success waves-effect waves-light col-lg-12 mt-2" value="Güncelle">
                </form>
            </div>
        </div>
    </div>
</div>