<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form method="POST" id="categoryUpdate" action="{{ route('category.update')}}" class="p-3">
                    @csrf
                    <div class="row mb-3">
                        <label for="categoryName" class="col-sm-2 col-form-label">Kategori Adı: </label>
                        <div class="form-group col-sm-10">
                            <input name="categoryName" id="categoryName" value="{{ $category->name}}" required class="form-control" type="text">
                        </div>
                    </div>
                    <input type="hidden" name="id" value="{{ $category->id}}">
                    <input type="submit" class="btn btn-success waves-effect waves-light col-lg-12 mt-2" value="Güncelle">
                </form>
            </div>
        </div>
    </div>
</div>