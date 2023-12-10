@extends('admin.admin_master')
@section('admin')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Şifre Değiştir</h4>
                        @if(count($errors))
                            @foreach ($errors->all() as $error)
                                <p class="alert alert-danger alert-dismissible fade show">{{ $error }}</p>
                            @endforeach
                        @endif

                        <form method="POST" action="{{ route('update.password')}}" class="p-3">
                            @csrf
                            <div class="row mb-3">
                                <label for="oldPass" class="col-sm-2 col-form-label">Şifre: </label>
                                <div class="col-sm-10">
                                    <input name="oldPass" id="oldPass" required class="form-control" type="password">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="newPass" class="col-sm-2 col-form-label">Yeni Şifre: </label>
                                <div class="col-sm-10">
                                    <input name="newPass" id="newPass" required class="form-control" type="password">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="newPassConfirm" class="col-sm-2 col-form-label">Yeni Şifre Tekrar: </label>
                                <div class="col-sm-10">
                                    <input name="newPassConfirm" id="newPassConfirm" required class="form-control" type="password">
                                </div>
                            </div>
                            <input type="submit" class="btn btn-info waves-effect waves-light" value="Güncelle">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection