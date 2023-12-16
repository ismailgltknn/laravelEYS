@extends('admin.admin_master')
@section('admin')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 mx-auto">
                <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-row">
                        <div class="p-2 ms-2">
                            <span></span>
                            <img class="rounded-circle avatar-xl mx-auto" src="{{ 
                            !empty($adminData->profileImage) 
                            ? url('/files/profileImages/'.$adminData->profileImage)
                            : url('/files/noavatar.png')}}" alt="userAvatar">
                        </div>
                        <hr class="text-muted">
                        <div class="d-flex flex-row border border-secondary rounded mx-auto">
                            <div class="p-4 ms-4">
                                <h6 class="p-2">Ad</h6>
                                <span class="p-2">{{$adminData->name}}</span>
                            </div>
                            <div class="p-4 ms-4">
                                <h6 class="p-2">Email</h6>
                                <span class="p-2">{{$adminData->email}}</span>
                            </div>
                            <div class="p-4 ms-4">
                                <h6 class="p-2">Kullanıcı Adı</h6>
                                <span class="p-2">{{$adminData->username}}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <a href="{{ route('edit.profile')}}" class="btn btn-primary mb-2 waves-effect waves-light">Düzenle</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection