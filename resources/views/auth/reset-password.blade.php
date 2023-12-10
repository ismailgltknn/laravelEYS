<!doctype html>
<html lang="en">

    <head>
        
        <meta charset="utf-8" />
        <title>Şifre Sıfırlama | Envanter Yönetim Sistemi</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Inventory Management System" name="description" />
        <meta content="Management System" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="../backend/assets/images/favicon.ico">

        <!-- Bootstrap Css -->
        <link href="../backend/assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="../backend/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="../backend/assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

    </head>

    <body>
        <div class="wrapper-page">
            <div class="container-fluid p-0">
                <div class="card">
                    <div class="card-body">
    
                        <div class="text-center mt-4">
                            <div class="mb-3">
                                <a href="" class="auth-logo">
                                    <img src="../logo/images.png" height="100%" width="100%" class="mx-auto" alt="">
                                </a>
                            </div>
                        </div>
    
                        <h4 class="text-muted text-center font-size-18"><b>Şifre Sıfırlama</b></h4>
    
                        <div class="p-3">
                            <form class="form-horizontal mt-3" method="POST" action="{{ route('password.store') }}">
                                @csrf
                                <!-- Password Reset Token -->
                                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                                <div class="form-group mb-3">
                                    <div class="col-xs-12">
                                        <input class="form-control" id="email" name="email" type="email" placeholder="Email" required autofocus>
                                    </div>
                                </div>
                                <div class="form-group mb-3 row">
                                    <div class="col-12">
                                        <input class="form-control" id="password" name="password" type="password" placeholder="Şifre" required>
                                    </div>
                                </div>
                                <div class="form-group mb-3 row">
                                    <div class="col-12">
                                        <input class="form-control" id="password_confirmation" name="password_confirmation" type="password" placeholder="Şifre Tekrar" required>
                                    </div>
                                </div>  
    
                                <div class="form-group pb-2 text-center row mt-3">
                                    <div class="col-12">
                                        <button class="btn btn-primary w-100 waves-effect waves-light" type="submit">Şifre Sıfırla</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- end cardbody -->
                </div>
                <!-- end card -->
            </div>
            <!-- end container -->
        </div>
        <!-- end -->
        

        <!-- JAVASCRIPT -->
        <script src="../backend/assets/libs/jquery/jquery.min.js"></script>
        <script src="../backend/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="../backend/assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="../backend/assets/libs/simplebar/simplebar.min.js"></script>
        <script src="../backend/assets/libs/node-waves/waves.min.js"></script>

        <script src="../backend/assets/js/app.js"></script>

    </body>
</html>
