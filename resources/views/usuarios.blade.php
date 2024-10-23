@extends('layouts.user_type.auth')
@section('titulo','Usuarios del Sistema')
@section('content')
    <div class="">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">


                        <div class="row">
                            <div class="col-6 d-flex align-items-center">
                                <h6 class="mb-0">Usuarios</h6>
                            </div>
                            <div class="col-6 text-end">
                                <a class="btn btn-primary btn-sm mb-0" href="{{route("usuarios.create")}}"
                                     data-tipo="agregar">Agregar</a>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="card-header pb-0">
                        <h6>Correspondencia</h6>
                    </div> --}}
                    <div class="card-body px-0">
                        <div class="table-responsive p-0" style="max-height: 80vh">
                            <table class="table align items-center pb-0 mt-1" id="DStabla">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            NOMBRE</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            PATERNO</th>
                                        {{-- <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Asunto</th> --}}
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            MATERNO</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            TIPO DE USUARIO</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            ÁREA</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            EMAIL</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            CLAVE</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            CONTRASEÑA</th>
                                        <th class="text-center"></th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @isset($RegUsuarios)
                                    @foreach ($RegUsuarios as $row)
                                        <tr>
                                            <td class="align-middle">
                                                <span class="text-xs font-weight-bold">{{ $row->name }}</span>
                                            </td>
                                            <td class="align-middle">
                                                <span class="text-xs font-weight-bold">{{ $row->paterno }}</span>
                                            </td>
                                            <td class="align-middle">
                                                <span class="text-xs font-weight-bold">{{ $row->materno }}</span>
                                            </td>
                                            <td class="align-middle">
                                                <span class="text-xs font-weight-bold">{{ $row->tipo_usuario }}</span>
                                            </td>
                                            <td class="align-middle">
                                                <span class="text-xs font-weight-bold">{{ $row->area }}</span>
                                            </td>
                                            <td class="align-middle">
                                                <span class="text-xs font-weight-bold">{{ $row->email }}</span>
                                            </td>
                                            <td class="align-middle">
                                                <span class="text-xs font-weight-bold">{{ $row->clave }}</span>
                                            </td>
                                            <td class="align-middle">
                                                <span class="text-xs font-weight-bold">{{ $row->password }}</span>
                                            </td>
                                            <td>
                                                <div class="d-flex">
                                                <a href="{{route("usuarios.edit",$row->id)}}" class="btn btn-outline-secondary w-100 btn-icon mb-0">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                                    stroke-linejoin="round"
                                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
                                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                                    <path
                                                                        d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                                                    <path
                                                                        d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                                                    <path d="M16 5l3 3" />
                                                                </svg>
                                                </a>
                                            </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    @endisset
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




@endsection
