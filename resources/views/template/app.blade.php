<!doctype html>
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sufee Admin - HTML5 Admin Template</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">

    <link rel="stylesheet" href="{{asset('template/assets/vendors/bootstrap/dist/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('template/assets/vendors/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('template/assets/vendors/themify-icons/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{asset('template/assets/vendors/flag-icon-css/css/flag-icon.min.css')}}">
    <link rel="stylesheet" href="{{asset('template/assets/vendors/selectFX/css/cs-skin-elastic.css')}}">
    <link rel="stylesheet" href="{{asset('template/assets/vendors/jqvmap/dist/jqvmap.min.css')}}">
    <link rel="stylesheet"
          href="{{asset('template/assets/vendors/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet"
          href="{{asset('template/assets/vendors/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}">


    <link rel="stylesheet" href="{{asset('template/assets/css/style.css')}}">
{{--    <link rel="stylesheet" href="{{asset('template/jquery.dataTables.min.css')}}">--}}
{{--    <style>--}}
{{--        div.dataTables_wrapper {--}}
{{--            margin-bottom: 3em;--}}
{{--        }--}}
{{--    </style>--}}

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

</head>

<body>


<!-- Left Panel -->

<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">

        <div class="navbar-header">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu"
                    aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand" href="#">Fuzzy C-Means Bpjs</a>
            <a class="navbar-brand hidden" href="../layouts"><img src="template/images/logo2.png" alt="Logo"></a>
        </div>

        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="@yield('dashboard')">
                    <a href="{{url('dashboard')}}"> <i class="menu-icon fa fa-home"></i>Dashboard </a>
                </li>
                <li class="@yield('data')">
                    <a href="{{url('data')}}"> <i class="menu-icon fa  fa-book"></i>Data </a>
                </li>
                <li class="@yield('dataset')">
                    <a href="{{url('dataset')}}"> <i class="menu-icon fa fa-table"></i>Dataset </a>
                </li>
                <li class="@yield('perhitungan')">
                    <a href="{{url('perhitungan')}}"> <i class="menu-icon fa fa-superscript"></i>Perhitungan </a>
                </li>
{{--                <li class="@yield('pengujian')">--}}
{{--                    <a href="{{url('pengujian')}}"> <i class="menu-icon fa fa-dashboard"></i>Pengujian </a>--}}
{{--                </li>--}}
{{--                8--}}

            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
</aside><!-- /#left-panel -->

<!-- Left Panel -->

<!-- Right Panel -->

<div id="right-panel" class="right-panel">

    <!-- Header-->
    <header id="header" class="header">

        <div class="header-menu">

            <div class="col-sm-7">

            </div>

            <div class="col-sm-5">
                <div class="user-area dropdown float-right">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                       aria-expanded="false">
                        <img class="user-avatar rounded-circle" src="{{asset('template/images/admin.jpg')}}" alt="User Avatar">
                    </a>

                    <div class="user-menu dropdown-menu">
{{--                        <a class="nav-link" href="#"><i class="fa fa-user"></i> My Profile</a>--}}

{{--                        <a class="nav-link" href="#"><i class="fa fa-user"></i> Notifications <span--}}
{{--                                class="count">13</span></a>--}}

{{--                        <a class="nav-link" href="#"><i class="fa fa-cog"></i> Settings</a>--}}
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                        <a class="nav-link" href="route('logout')" onclick="event.preventDefault();
                                        this.closest('form').submit();"><i class="fa fa-power-off"></i> Logout</a>
                        </form>
                    </div>
                </div>

            </div>
        </div>

    </header><!-- /header -->
    <!-- Header-->

    <div class="breadcrumbs">
        <div class="col-sm-4">
            <div class="page-header float-left">
                <div class="page-title">
                    <h1>@yield('dash')</h1>
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="page-header float-right">
                <div class="page-title">
                    <ol class="breadcrumb text-right">
                        <li class="active">@yield('dash')</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content mt-3">
        @yield('content')
    </div> <!-- .content -->
</div><!-- /#right-panel -->

<!-- Right Panel -->

<script src="{{asset('template/assets/vendors/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('template/assets/vendors/popper.js/dist/umd/popper.min.js')}}"></script>
<script src="{{asset('template/assets/vendors/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script src="{{asset('template/assets/js/main.js')}}"></script>

{{--javascript table--}}
<script src="{{asset('template/assets/vendors/chart.js/dist/Chart.bundle.min.js')}}"></script>
<script src="{{asset('template/assets/js/dashboard.js')}}"></script>
<script src="{{asset('template/assets/js/widgets.js')}}"></script>
<script src="{{asset('template/assets/vendors/jqvmap/dist/jquery.vmap.min.js')}}"></script>
<script src="{{asset('template/assets/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js')}}"></script>
<script src="{{asset('template/assets/vendors/jqvmap/dist/maps/jquery.vmap.world.js')}}"></script>
<script src="{{asset('template/assets/vendors/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('template/assets/vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('template/assets/vendors/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('template/assets/vendors/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('template/assets/vendors/jszip/dist/jszip.min.js')}}"></script>
<script src="{{asset('template/assets/vendors/pdfmake/build/pdfmake.min.js')}}"></script>
<script src="{{asset('template/assets/vendors/pdfmake/build/vfs_fonts.js')}}"></script>
<script src="{{asset('template/assets/vendors/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('template/assets/vendors/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('template/assets/vendors/datatables.net-buttons/js/buttons.colVis.min.js')}}"></script>
<script src="{{asset('template/assets/js/init-scripts/data-table/datatables-init.js')}}"></script>
<script src="{{asset('template/assets/js/init-scripts/data-table/datatables-init2.js')}}"></script>
<script>
    (function ($) {
        "use strict";

        jQuery('#vmap').vectorMap({
            map: 'world_en',
            backgroundColor: null,
            color: '#ffffff',
            hoverOpacity: 0.7,
            selectedColor: '#1de9b6',
            enableZoom: true,
            showTooltip: true,
            values: sample_data,
            scaleColors: ['#1de9b6', '#03a9f5'],
            normalizeFunction: 'polynomial'
        });
    })(jQuery);
</script>

{{--<script src="{{asset('template/jquery.dataTables.min.js')}}"></script>--}}
{{--<script src="{{asset('template/jquery-3.5.1.js')}}"></script>--}}

{{--<script>--}}
{{--    $(document).ready(function() {--}}
{{--        $('table.display').DataTable();--}}
{{--    } );--}}
{{--</script>--}}


</body>

</html>
