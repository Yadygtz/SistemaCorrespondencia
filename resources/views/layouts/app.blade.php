<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{{asset('assets/img/c3ico.png')}}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Styles -->
    <link id="pagestyle" href="../assets/css/soft-ui-dashboard.css?v=1.0.7" rel="stylesheet" />
    <link id="pagestyle" href="{{ asset('assets/css/datatables.css') }}" rel="stylesheet" />

    <style>
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

        /* tr {
          cursor: pointer;
        } */
    </style>
</head>

<body
    class="g-sidenav-show  bg-gray-100" style="overflow-y: hidden;">
    @auth
        @yield('auth')
    @endauth

    @if (session()->has('success'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)" x-show="show"
            class="position-fixed bg-success rounded right-3 text-sm py-2 px-4">
            <p class="m-0">{{ session('success') }}</p>
        </div>
    @endif
    <!--   Core JS Files   -->
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>
    <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script src="../assets/js/plugins/fullcalendar.min.js"></script>
    <script src="../assets/js/plugins/chartjs.min.js"></script>

    @stack('dashboard')
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>

    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="../assets/js/soft-ui-dashboard.min.js?v=1.0.3"></script>
    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables.js') }}"></script>
    <script src="{{ asset('assets/js/dataTables.bootstrap.min.js') }}"></script>
    @stack('scripts')
</body>

</html>
