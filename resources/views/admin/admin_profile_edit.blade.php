@extends('admin.admin_master')
@section('admin')
<script src="/backend/assets/libs/jquery/jquery.min.js"></script>
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Profil Düzenleme</h4>
                        <form method="POST" action="{{ route('store.profile')}}" enctype="multipart/form-data" class="p-3">
                            @csrf
                            <div class="row mb-3">
                                <label for="name" class="col-sm-2 col-form-label">Ad: </label>
                                <div class="col-sm-10">
                                    <input name="name" id="name" required class="form-control" type="text" value="{{ $editData->name}}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="email" class="col-sm-2 col-form-label">Email: </label>
                                <div class="col-sm-10">
                                    <input name="email" id="email" required class="form-control" type="email" value="{{ $editData->email}}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="username" class="col-sm-2 col-form-label">Kullanıcı Adı: </label>
                                <div class="col-sm-10">
                                    <input name="username" id="username" required class="form-control" type="text" value="{{ $editData->username}}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="profileImage" class="col-sm-2 col-form-label">Profil Resmi: </label>
                                <div class="col-sm-10">
                                    <input name="profileImage" id="profileImage" class="form-control" type="file">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="showImage" class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <img id="showImage" class="rounded avatar-lg mx-auto" src="{{ 
                                        !empty($editData->profileImage) 
                                        ? url('/files/profileImages/'.$editData->profileImage)
                                        : url('/files/profileImages/noavatar.png')}}" alt="userAvatar">
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
<script type="text/javascript">
        $(document).ready(function () {
            $('#profileImage').change(function (e) { 
                var reader = new FileReader();
                reader.onload = function(e){
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
</script>
@endsection