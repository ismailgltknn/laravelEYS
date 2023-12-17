<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form method="POST" id="unitUpdate" action="{{ route('unit.update')}}" class="p-3">
                    @csrf
                    <div class="row mb-3">
                        <label for="unitName" class="col-sm-2 col-form-label">Birim Adı: </label>
                        <div class="form-group col-sm-10">
                            <input name="unitName" id="unitName" value="{{ $unit->name}}" required class="form-control" type="text">
                        </div>
                    </div>
                    <input type="hidden" name="id" value="{{ $unit->id}}">
                    <input type="submit" class="btn btn-success waves-effect waves-light col-lg-12 mt-2" value="Güncelle">
                </form>
            </div>
        </div>
    </div>
</div>