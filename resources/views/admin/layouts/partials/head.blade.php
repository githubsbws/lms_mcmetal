<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{asset('asset_admin/plugins/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{asset('asset_admin/dist/css/adminlte.min.css')}}">
    <link rel="stylesheet" href="{{asset('asset_admin/includes/css/style.css')}}">

    <link rel="stylesheet" href="{{asset('asset_admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('asset_admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('asset_admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">

    <script src="{{asset('asset_admin/plugins/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('asset_admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('asset_admin/dist/js/adminlte.js')}}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.0/Sortable.min.js"></script>

    <!-- DataTables & Plugins -->
    <script src="{{asset('asset_admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('asset_admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('asset_admin/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('asset_admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{asset('asset_admin/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('asset_admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{asset('asset_admin/plugins/jszip/jszip.min.js')}}"></script>

    <script src="{{asset('asset_admin/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('asset_admin/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{asset('asset_admin/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>

    <!-- Toggle  -->
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>

    <!-- Summer Note -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.js"></script>

    <!-- Datepicker -->
    <script src="https://unpkg.com/gijgo@1.9.14/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.14/css/gijgo.min.css" rel="stylesheet" type="text/css" />

    <!-- Chosen -->
    <link href="{{asset('asset_admin/plugins/bootstrap4c-chosen/dist/css/component-chosen.css')}}" rel="stylesheet">

    <!--

    ตรงนี้มันทำให้ใช้ DataTables jquery ไม่ได้ เดี่ยวต้องหาวิธีเเก้

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    -->

    <!-- sweetalert2 -->
    <script src="{{asset('asset_admin/plugins/sweetalert2/sweetalert2.all.js')}}"></script>
    <script src="{{asset('asset_admin/plugins/sweetalert2/sweetalert2.all.min.js')}}"></script>
    <link rel="stylesheet" href="{{asset('asset_admin/plugins/sweetalert2/sweetalert2.min.css')}}">


    <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.6/chosen.jquery.min.js"></script>

    <link rel="stylesheet" href="{{asset('jstree/dist/themes/default/style.css')}}">
    <script src="{{asset('jstree/dist/jstree.js')}}"></script>
</head>
