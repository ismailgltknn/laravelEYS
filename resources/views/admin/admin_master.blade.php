<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Anasayfa | Envanter Yönetim Sistemi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Inventory Management System" name="description" />
    <meta content="Management System" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="/backend/assets/images/favicon.ico">
    <!-- jquery.vectormap css -->
    <link href="/backend/assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
    <!-- DataTables -->
    <link href="/backend/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="/backend/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />  
    <!-- Bootstrap Css -->
    <link href="/backend/assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="/backend/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="/backend/assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
    <!-- Toastr Css-->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" >
    
</head>
<body data-topbar="dark">
    
    <div id="layout-wrapper">
        @include('admin.body.header')
        @include('admin.body.sidebar')
        <div class="main-content">
            @yield('admin')
            @include('admin.body.footer')
        </div>
    </div>
    <div class="rightbar-overlay"></div>
    
    @include('layouts.scripts')
</body>
</html>