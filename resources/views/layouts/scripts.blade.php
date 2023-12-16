<!-- JAVASCRIPT -->
<script src="/backend/assets/libs/jquery/jquery.min.js"></script>
<script src="/backend/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/backend/assets/libs/metismenu/metisMenu.min.js"></script>
<script src="/backend/assets/libs/simplebar/simplebar.min.js"></script>
<script src="/backend/assets/libs/node-waves/waves.min.js"></script>
<!-- jquery.vectormap map -->
<script src="/backend/assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="/backend/assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-us-merc-en.js"></script> 
<!-- Required datatable js -->
<script src="/backend/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="/backend/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<!-- Responsive examples -->
<script src="/backend/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="/backend/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
<!-- App js -->
<script src="/backend/assets/js/app.js"></script>
<!-- Toastr js -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    @if(Session::has('message'))
    var type = "{{ Session::get('alert-type','info') }}"
    switch(type){
        case 'info':
        toastr.info(" {{ Session::get('message') }} ");
        break;
        case 'success':
        toastr.success(" {{ Session::get('message') }} ");
        break;
        case 'warning':
        toastr.warning(" {{ Session::get('message') }} ");
        break;
        case 'error':
        toastr.error(" {{ Session::get('message') }} ");
        break; 
    }
    @endif 
</script>
<!-- JAVASCRIPT END -->
<!-- App js -->
<script src="/backend/assets/js/validate.min.js"></script>
<!-- Axios js -->
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<!-- SweetAlert js -->
<script src="/backend/assets/js/sweetAlert211.js"></script>
<script src="/backend/assets/js/sweetAlertMessage.js"></script>
@stack('script')