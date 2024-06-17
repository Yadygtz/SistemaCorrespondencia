@extends('layouts.user_type.auth')

@section('content')
    <div class="">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        @if (session('success'))
                            <div class="alert alert-secondary alert-dismissible fade show" role="alert">
                                <span class="alert-icon text-white"><i class="ni ni-like-2"></i></span>
                                <span class="alert-text text-white"><strong>{{ session('success') }}</strong></span>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <span class="alert-icon text-white"><i class="ni ni-like-2"></i></span>
                                <span class="alert-text text-white"><strong>{{ session('error') }}</strong></span>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-6 d-flex align-items-center">
                                <h6 class="mb-0">Correspondencia</h6>
                            </div>
                            <div class="col-6 text-end">
                                <a class="btn btn-primary btn-sm mb-0" data-bs-toggle="modal"
                                    data-bs-target="#addupdOfiModal" data-tipo="agregar">Agregar</a>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="card-header pb-0">
                        <h6>Correspondencia</h6>
                    </div> --}}
                    <div class="card-body px-0">
                        <div class="table-responsive p-0">
                            <table class="table align items-center pb-0 mt-1" id="tabla">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            No.Oficio</th>
                                        {{-- <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Asunto</th> --}}
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Fecha</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Enviado por</th>

                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Recibido por</th>
                                        <th class="text-center"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @isset($correspondencia)
                                        @foreach ($correspondencia as $row)
                                            <tr>
                                                <td class="align-middle">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $row->no_oficio }}</h6>
                                                        <p class="text-xs text-secondary mb-0">Asunto: {{ $row->asunto }}</p>
                                                    </div>
                                                </td>
                                                {{-- <td class="align-middle">
                                                    <span class="text-xs font-weight-bold">{{ $row->no_oficio }}</span>
                                                </td>
                                                <td class="align-middle">
                                                    <span class="text-xs font-weight-bold">{{ $row->asunto }}</span>
                                                </td> --}}
                                                <td class="align-middle">
                                                    <span class="text-xs font-weight-bold">{{ $row->fecha_oficio }}</span>
                                                </td>
                                                <td class="align-middle">
                                                    <span class="text-xs font-weight-bold">{{ $row->enviado_por }}</span>
                                                </td>

                                                <td class="align-middle">
                                                    <span class="text-xs font-weight-bold">{{ $row->recibido_por }}</span>
                                                </td>
                                                <td>
                                                    <div class="d-flex">
                                                        <a href="#" class="btn btn-primary w-100 btn-icon mb-0 me-1"
                                                            data-bs-toggle="modal" data-bs-target="#detalleModal"
                                                            data-id="{{ $row->id_correspondencia }}">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                height="24" viewBox="0 0 24 24" fill="none"
                                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                                stroke-linejoin="round"
                                                                class="icon icon-tabler icons-tabler-outline icon-tabler-eye">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                                <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                                                <path
                                                                    d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                                            </svg>
                                                        </a>
                                                        <a href="#" class="btn btn-outline-secondary w-100 btn-icon mb-0"
                                                            data-bs-toggle="modal" data-bs-target="#addupdOfiModal"
                                                            data-id="{{ $row->id_correspondencia }}">
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

    <!-- Modal Detalle Oficio -->
    <div class="modal fade" id="detalleModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="detalleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bolder" id="detalleModalLabel">Detalles del Oficio</h5>
                </div>
                <div class="modal-body">
                    <p><strong>No. Oficio:</strong> <span id="modal_no_oficio"></span></p>
                    <p><strong>Asunto:</strong> <span id="modal_asunto"></span></p>
                    <p><strong>Fecha Oficio:</strong> <span id="modal_fecha_oficio"></span></p>
                    <p><strong>Enviado Por:</strong> <span id="modal_enviado_por"></span></p>
                    <p><strong>Recibido Por:</strong> <span id="modal_recibido_por"></span></p>
                    <p><strong>Recibido Fecha:</strong> <span id="modal_recibido_fecha"></span></p>
                    <p><strong>Area:</strong> <span id="modal_area"></span></p>
                    <p><strong>Folder:</strong> <span id="modal_folder"></span></p>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-gradient-secondary mb-0" data-bs-dismiss="modal">Cerrar</button>
                    <a type="button" class="ms-auto btn bg-gradient-primary mb-0" id="urloficio"
                        href="veroficio/SSP-00189-2022.pdf" target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                            <path d="M5 12v-7a2 2 0 0 1 2 -2h7l5 5v4" />
                            <path d="M5 18h1.5a1.5 1.5 0 0 0 0 -3h-1.5v6" />
                            <path d="M17 18h2" />
                            <path d="M20 15h-3v6" />
                            <path d="M11 15v6h1a2 2 0 0 0 2 -2v-2a2 2 0 0 0 -2 -2h-1z" />
                        </svg>
                        Ver Oficio</a>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Add/Upd Oficio --}}
    <div class="modal fade" id="addupdOfiModal" data-bs-keyboard=false data-bs-backdrop="static" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bolder" id="titlemodal">Agregar Oficio</h5>
                    {{-- <button type="button" wire:click.prevent="cancel" class="btn-close"
                        data-bs-dismiss="modal"></button> --}}
                </div>
                <form action="correspondencia/upd/id_correspondencia" method="POST" id="formUpdOfi" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label required">No. Oficio</label>
                                <input type="text" class="form-control @error('no_oficio') is-invalid @enderror"
                                    name="no_oficio" id="no_oficio" required>
                                @error('no_oficio')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Fecha de Oficio</label>
                                <input type="date" class="form-control @error('fecha_oficio') is-invalid @enderror"
                                    name="fecha_oficio" id="fecha_oficio">
                                @error('fecha_oficio')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Enviado por</label>
                                <input type="text" class="form-control @error('enviado_por') is-invalid @enderror"
                                    name="enviado_por" id="enviado_por" required>
                                @error('enviado_por')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Asunto</label>
                                <input type="text" class="form-control @error('asunto') is-invalid @enderror"
                                    name="asunto" id="asunto" required>
                                @error('asunto')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Recibido por</label>
                                <input type="text" class="form-control @error('recibido_por') is-invalid @enderror"
                                    name="recibido_por" id="recibido_por" required>
                                @error('recibido_por')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Fecha de Recibido</label>
                                <input type="date" class="form-control @error('fecha_recibido') is-invalid @enderror"
                                    name="fecha_recibido" id="fecha_recibido">
                                @error('fecha_recibido')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label @error('area') is-invalid @enderror">Área</label>
                                <select class="form-select" {{ $areaCB_activo ? '' : 'disabled' }} name="areaCB"
                                    id="areaCB" required>
                                    <option value=""></option>
                                    {{!! $areasCB !!}}
                                </select>
                                @error('area')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Folder</label>
                                <input type="text" class="form-control @error('folder') is-invalid @enderror"
                                    name="folder" id="folder">
                                @error('folder')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer align-items-center flex-nowrap">
                        <button type="button" class="btn bg-gradient-secondary me-auto mb-0" data-bs-dismiss="modal">
                            Cerrar
                        </button>

                        <input class="form-control mb-0 w-50" type="file" id="oficioPDF" name="oficioPDF" accept=".pdf">

                        <a type="button" class="btn btn-icon bg-gradient-secondary mb-0" id="urloficio2"
                        href="veroficio/SSP-00189-2022.pdf" target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"
                            class="icon icon-tabler">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                            <path d="M5 12v-7a2 2 0 0 1 2 -2h7l5 5v4" />
                            <path d="M5 18h1.5a1.5 1.5 0 0 0 0 -3h-1.5v6" />
                            <path d="M17 18h2" />
                            <path d="M20 15h-3v6" />
                            <path d="M11 15v6h1a2 2 0 0 0 2 -2v-2a2 2 0 0 0 -2 -2h-1z" />
                        </svg></a>

                        <button type="submit" class="btn bg-gradient-primary mb-0">
                            GUARDAR
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection
@push('scripts')
    <script>
        window.onload = function() {
            // $(".alert").fadeTo(1000, 0).slideUp(1000, function() {
            //     $(this).remove();
            // });

            $('#areaCB').val(@json($area));

            var confidioma = {
                "info": "<span class='text-sm text-secondary opacity-9'>Mostrando _START_ a _END_ de _TOTAL_ registros</span>",
                "infoEmpty": "Mostrando 0 a 0 de 0 registros",
                "infoFiltered": "<span class='text-sm text-secondary opacity-9'>(filtrado de _MAX_ registros en total)</span>",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "<span class='ps-4'> _MENU_ registros por página</span>",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscar:",
                "zeroRecords": "No se encontraron registros",
                "paginate": {
                    "first": "Primero",
                    "last": "Último",
                    "next": ">",
                    "previous": "<"
                },
                "aria": {
                    "sortAscending": ": activar para ordenar la columna ascendente",
                    "sortDescending": ": activar para ordenar la columna descendente"
                }
            };

            // $("#tabla").DataTable({});
            let table = new DataTable('#tabla', {
                "language": confidioma,
                "columnDefs": [{
                    "targets": 4,
                    "orderable": false
                }]
            });

            $("#no_oficio").on('change', function() {
                if (this.value  !== ""){
                    $("#oficioPDF").attr("disabled", false);
                }else{
                    $("#oficioPDF").attr("disabled", true);
                }
            });

            $('#detalleModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var id = button.data('id');

                // Deshabilitar el botón al inicio
                $("#urloficio").attr("href", "#");
                $("#urloficio").addClass("disabled");

                $.ajax({
                    url: '/correspondencia/' + id,
                    method: 'GET',
                    success: function(data) {
                        $('#modal_no_oficio').text(data.no_oficio);
                        $('#modal_asunto').text(data.asunto);
                        $('#modal_fecha_oficio').text(data.fecha_oficio);
                        $('#modal_enviado_por').text(data.enviado_por);
                        $('#modal_recibido_por').text(data.recibido_por);
                        $('#modal_recibido_fecha').text(data.fecha_recibido);
                        $('#modal_area').text(data.area);
                        $('#modal_folder').text(data.folder);

                        // Asigan URL del oficio en el FTP
                        if (data.tieneOficio == "SI") {
                            // Habiliar el boton de ver oficio
                            $("#urloficio").attr("href", "veroficio/" + data.no_oficio);
                            $("#urloficio").removeClass("disabled");
                            $("#urloficio").show();
                        } else {
                            // Deshabilitar el boton de ver oficio
                            $("#urloficio").attr("href", "#");
                            $("#urloficio").addClass("disabled");
                        }
                    }
                });
            });

            let nombrepdf = "";
            $('#addupdOfiModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var id = button.data('id');
                var tipo = button.data('tipo');
                if (tipo == "agregar") {
                    // Limpiar el formulario
                    limpiarForm();
                    // Asignar la URL para agregar
                    $("#formUpdOfi").attr('action', 'correspondencia/add');
                    $("#titlemodal").text("Agregar Oficio");

                    // Deshabilitar el boton de ver oficio
                    $("#urloficio2").hide();
                    $("#oficioPDF").hide();
                    $("#urloficio2").attr("href", "#");
                    $("#urloficio2").addClass("disabled");
                    $("#oficioPDF").attr("disabled", true);

                } else {
                    // Asignar la URL para actualizar
                    $("#formUpdOfi").attr('action', 'correspondencia/upd/' + id);
                    $("#titlemodal").text("Editar Oficio");

                    // Traer los datos del oficio
                    $.ajax({
                        url: '/correspondencia/' + id,
                        method: 'GET',
                        success: function(data) {
                            $("#no_oficio").val(data.no_oficio);
                            $("#fecha_oficio").val(convertirFecha(data.fecha_oficio));
                            $("#enviado_por").val(data.enviado_por);
                            $("#asunto").val(data.asunto);
                            $("#recibido_por").val(data.recibido_por);
                            $("#fecha_recibido").val(convertirFecha(data.fecha_recibido));
                            $("#areaCB").val(data.area);
                            $("#folder").val(data.folder);

                            nombrepdf = data.no_oficio + ".pdf";
                            // console.log(nombrepdf);
                            $("#oficioPDF").on('change', function() {
                                var file = this.files[0];
                                if (file) {
                                    if (file.name !== nombrepdf) {

                                        alert("El nombre del archivo debe ser " + nombrepdf);
                                        this.value = ""; // Resetea el input
                                    }
                                }
                            });

                            $("#oficioPDF").attr("disabled", false);
                            $("#oficioPDF").show();

                            if (data.tieneOficio == "SI") {
                                // Habiliar el boton de ver oficio
                                $("#urloficio2").attr("href", "veroficio/" + data.no_oficio);
                                $("#urloficio2").removeClass("disabled");
                                $("#urloficio2").show();
                            } else {
                                // Deshabilitar el boton de ver oficio
                                $("#urloficio2").attr("href", "#");
                                $("#urloficio2").addClass("disabled");
                            }

                        }
                    });
                }
            });


            $('#detalleModal').on('hide.bs.modal', function(event) {
                $('#modal_no_oficio').text('');
                $('#modal_asunto').text('');
                $('#modal_fecha_oficio').text('');
                $('#modal_enviado_por').text('');
                $('#modal_recibido_por').text('');
                $('#modal_recibido_fecha').text('');
                $('#modal_area').text('');
                $('#modal_folder').text('');
            });

            function limpiarForm() {
                $('#formUpdOfi')[0].reset();
                $('#areaCB').val(@json($area));
                $('#fecha_oficio').val(@json(date('Y-m-d')));
                $('#fecha_recibido').val(@json(date('Y-m-d')));
            }

            function convertirFecha(fecha) {
                var partes = fecha.split('/');
                var dia = partes[0];
                var mes = partes[1];
                var anio = partes[2];
                return `${anio}-${mes}-${dia}`;
            }
        }
    </script>
@endpush
