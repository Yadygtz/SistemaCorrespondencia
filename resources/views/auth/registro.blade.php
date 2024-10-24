@extends('layouts.user_type.auth')
@section('titulo','Usuarios del Sistema')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Registro de Usuarios') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ isset($id) ? route('usuarios.update',$id) : route('usuarios.store')}} " id="frmRegistrar">
                        @csrf
                        @isset($id)
                            @method("PUT")
                        @endisset
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Nombre') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="paterno" class="col-md-4 col-form-label text-md-end">{{ __('Paterno') }}</label>

                            <div class="col-md-6">
                                <input id="paterno" type="text" class="form-control @error('paterno') is-invalid @enderror" name="paterno" value="{{ old('paterno') }}" required autocomplete="paterno" autofocus>

                                @error('paterno')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="materno" class="col-md-4 col-form-label text-md-end">{{ __('Materno') }}</label>

                            <div class="col-md-6">
                                <input id="materno" type="text" class="form-control @error('materno') is-invalid @enderror" name="materno" value="{{ old('materno') }}" required autocomplete="materno" autofocus>

                                @error('materno')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="tusuario" class="col-md-4 col-form-label text-md-end">{{ __('Tipo de Usuario') }}</label>

                            <div class="col-md-6">
                                <input id="tusuario" type="text" class="form-control @error('tusuario') is-invalid @enderror" name="tusuario" value="{{ old('tusuario') }}" required autocomplete="tusuario" autofocus>

                                @error('tusuario')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="area" class="col-md-4 col-form-label text-md-end">{{ __('Area') }}</label>

                            <div class="col-md-6">
                                <input id="area" type="text" class="form-control @error('area') is-invalid @enderror" name="area" value="{{ old('area') }}" required autocomplete="area" autofocus>

                                @error('area')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="clave" class="col-md-4 col-form-label text-md-end">{{ __('Clave') }}</label>

                            <div class="col-md-6">
                                <input id="clave" type="text" class="form-control @error('clave') is-invalid @enderror" name="clave" value="{{ old('clave') }}" required autocomplete="clave">

                                @error('clave')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Contraseña') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>



                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Registrar') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>

        let usuario = @json($usuario);
        //console.log(usuario);
        if(usuario != "usuario"){
            //url = '{{ url("/usuarios/update")}}/' + usuario.id;
           // $('#frmRegistrar').attr('action',url);
            $("#name").val(usuario.name);
            $("#paterno").val(usuario.paterno);
            $("#materno").val(usuario.materno);
            $("#tusuario").val(usuario.tipo_usuario);
            $("#area").val(usuario.area);
            $("#email").val(usuario.email);
            $("#clave").val(usuario.clave);
            $("#password").val(usuario.password);

        }else{
            //$('#frmRegistrar').attr('action', @json(route('usuarios.store')));

        }
</script>
@endpush
