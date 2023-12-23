<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="{{ route('dashboard')}}" class="logo">
                    <span class="logo-sm">
                        <img src="/logo/logo-trs-white.png" alt="logo-sm" width="50px" height="50px">
                    </span>
                    <span class="logo-lg">
                        <img src="/logo/logo-trs-white.png" alt="logo-dark" width="100px" height="50px">
                    </span>
                </a>
            </div>
            
            <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect" id="vertical-menu-btn">
                <i class="ri-menu-2-line align-middle"></i>
            </button>
            
            <!-- App Search-->
            <form class="app-search d-none d-lg-block">
                <div class="position-relative">
                    <input type="text" class="form-control" placeholder="Arama...">
                    <span class="ri-search-line"></span>
                </div>
            </form>
            
        </div>
        
        <div class="d-flex">
            
            <div class="dropdown d-none d-lg-inline-block ms-1">
                <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                    <i class="ri-fullscreen-line"></i>
                </button>
            </div>
            @php
            $id = Auth::user()->id;
            $userData = App\Models\User::find($id);
            @endphp
            <div class="dropdown d-inline-block user-dropdown">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img class="rounded-circle header-profile-user" src="{{ 
                    !empty($userData->profileImage) 
                    ? url('/files/profileImages/'.$userData->profileImage)
                    : url('/files/noavatar.png')}}"
                    alt="Header Avatar">
                    <span class="d-none d-xl-inline-block ms-1">{{ $userData->name }}</span>
                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <!-- item-->
                    <a class="dropdown-item" href="{{ route('admin.profile')}}"><i class="ri-user-line align-middle me-1"></i> Profil</a>
                    <a class="dropdown-item" href="{{ route('change.password')}}"><i class="ri-lock-password-line align-middle me-1"></i> Şifre Değiştir</a>
                    <a class="dropdown-item d-block" href="#"><span class="badge bg-success float-end mt-1">11</span><i class="ri-settings-2-line align-middle me-1"></i> Settings</a>
                    <a class="dropdown-item" href="#"><i class="ri-lock-unlock-line align-middle me-1"></i> Lock screen</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-danger" href="{{ route('admin.logout')}}"><i class="ri-shut-down-line align-middle me-1 text-danger"></i> Çıkış</a>
                </div>
            </div>
            
        </div>
    </div>
</header>