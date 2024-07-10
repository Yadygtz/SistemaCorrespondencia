<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('assets/img/c3ico.png') }}" type="image/png">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Sistema Correspondencia | C3') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <style>
        .bg-image-vertical {
            position: relative;
            overflow: hidden;
            background-repeat: no-repeat;
            background-position: right center;
            background-size: auto 100%;
        }

        @media (min-width: 1025px) {
            .h-custom-2 {
                height: 95%;
            }
        }
    </style>

</head>

<body>
    <section class="vh-100">
        <div class="container-fluid h-100">
            <div class="row h-100">
                <div class="col-sm-6 text-black d-flex align-items-center justify-content-center">
                    <div class="w-100" style="max-width: 23rem;">
                        <div class="mb-4 text-center">
                            <img src="{{ asset('assets/img/C3-horizontal.png') }}" style="max-width: 60%;height: auto;">
                        </div>
                        <form role="form" method="POST" action="{{ route('login') }}">
                            @csrf
                            <h5 class="text-center mb-4">Sistema C3 - Correspondencia</h5>
                            <div data-mdb-input-init class="form-floating form-outline mb-4">
                                <input type="text" class="form-control form-control-lg" name="email" id="email"
                                    placeholder="" value="" aria-label="Email"
                                    aria-describedby="email-addon">
                                @error('email')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror

                                <label class="form-label" for="email">Clave</label>
                            </div>
                            <div data-mdb-input-init class="form-floating form-outline mb-4">
                                <input type="password" class="form-control form-control-lg" name="password"
                                    id="password" placeholder="" value="secret" aria-label="Password"
                                    aria-describedby="password-addon">
                                @error('password')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                                <label class="form-label" for="password">Contraseña</label>
                            </div>

                            <div class="pt-1 mb-4">
                                <button data-mdb-button-init data-mdb-ripple-init
                                    class="btn btn-danger btn-pill btn-lg btn-block w-100" style="background-color: #ab0033;" type="submit">Ingresar</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-sm-6 px-0 d-none d-sm-block">
                    <img src="{{ asset('assets/img/docsbg.jpg') }}" alt="Login image" class="w-100 vh-100"
                        style="object-fit: cover;">
                </div>
            </div>
        </div>
    </section>

</body>
