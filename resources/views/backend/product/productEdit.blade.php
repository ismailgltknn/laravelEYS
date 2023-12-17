<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form method="POST" id="productUpdate" action="{{ route('product.update')}}" class="p-3">
                    @csrf
                    <div class="row mb-3">
                        <label for="productName" class="col-sm-2 col-form-label">Ürün Adı: </label>
                        <div class="form-group col-sm-10">
                            <input name="productName" id="productName" value="{{ $product->name}}" required class="form-control" type="text">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="" class="col-sm-2 col-form-label">Tedarikçi: </label>
                        <div class="form-group col-sm-10">
                            <select class="form-select" name="supplier_id" aria-label="Tedarikçi Adı">
                                @foreach($suppliers as $sup)
                                <option value="{{ $sup->id}}" {{ $sup->id == $product->supplier_id ? 'selected' : ''}}>{{ $sup->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="" class="col-sm-2 col-form-label">Birim: </label>
                        <div class="form-group col-sm-10">
                            <select class="form-select" name="unit_id" aria-label="Tedarikçi Adı">
                                @foreach($units as $unit)
                                <option value="{{ $unit->id}}" {{ $unit->id == $product->unit_id ? 'selected' : ''}}>{{ $unit->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="" class="col-sm-2 col-form-label">Kategori: </label>
                        <div class="form-group col-sm-10">
                            <select class="form-select" name="category_id" aria-label="Tedarikçi Adı">
                                @foreach($categories as $category)
                                <option value="{{ $category->id}}" {{ $category->id == $product->category_id ? 'selected' : ''}}>{{ $category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <input type="hidden" name="id" value="{{ $product->id}}">
                    <input type="submit" class="btn btn-success waves-effect waves-light col-lg-12 mt-2" value="Güncelle">
                </form>
            </div>
        </div>
    </div>
</div>