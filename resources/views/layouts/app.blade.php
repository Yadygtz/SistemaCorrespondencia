<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{{asset('assets/img/c3ico.png')}}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Correspondencia') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.11.1/dist/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.11.1/dist/sweetalert2.min.css">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href="{{asset('assets/css/nucleo-icons.css')}}" rel="stylesheet" />
    {{-- <link href="../assets/css/nucleo-svg.css" rel="stylesheet" /> --}}
    {{-- <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script> --}}
    <!-- Styles -->
    <link id="pagestyle" href="{{asset('assets/css/soft-ui-dashboard.css?v=1.0.7')}}" rel="stylesheet" />
    <link id="pagestyle" href="{{ asset('assets/css/datatables.css') }}" rel="stylesheet" />

    <style>
        body{
            overflow-y: hidden !important;
        }
        .dataTables_length select {
            width: 60px !important;

        }

        .dataTables_filter {
            padding-right: 1.5em;
        }

        .dataTables_filter input {
            width: 200px !important;
        }

        label {
            margin-left: 0 !important;
        }



        .btn-icon .icon {
            margin: calc(-1* 1rem);
        }

        .dataTables_wrapper{
            margin-top: 0.25rem !important;
        }

        /* .icon {
            --tblr-icon-size: 1.25rem;
            width: var(--tblr-icon-size);
            height: var(--tblr-icon-size);
            font-size: var(--tblr-icon-size);
            stroke-width: 1.5;
        } */

        /* tr {
          cursor: pointer;
        } */
    </style>
</head>

<body
    class="g-sidenav-show  bg-gray-100">
    @auth
        @yield('auth')
    @endauth
    @guest
      @yield('guest')
    @endguest
    <!--   Core JS Files   -->
    <script src="{{ asset('assets/js/core/popper.min.js')}}"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js')}}"></script>
    <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js')}}"></script>
    <script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js')}}"></script>
    <script src="{{ asset('assets/js/plugins/fullcalendar.min.js')}}"></script>
    <script src="{{ asset('assets/js/plugins/chartjs.min.js')}}"></script>

    @stack('dashboard')


    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('assets/js/soft-ui-dashboard.min.js?v=1.0.3')}}"></script>
    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables.js') }}"></script>
    <script src="{{ asset('assets/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/moment.min.js') }}"></script>
    <script src="{{ asset('assets/js/datetime-moment.js') }}"></script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }

        $.fn.dataTable.moment('DD/MM/YYYY');

    </script>
    @stack('scripts')
</body>

</html>
