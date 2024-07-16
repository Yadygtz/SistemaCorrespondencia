@extends('layouts.user_type.auth')
@section('titulo','Registro de Números')
@section('content')
    <div class="">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">

                        <div class="row">
                            <div class="col-6 d-flex align-items-center">
                                <h6 class="mb-0">Números de Oficio</h6>
                            </div>
                            <div class="col-6 text-end">
                                <a class="btn btn-primary btn-sm mb-0" data-bs-toggle="modal"
                                    data-bs-target="#addupdNumModal" data-tipo="agregar">Agregar</a>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="card-header pb-0">
                        <h6>Correspondencia</h6>
                    </div> --}}
                    <div class="card-body px-0">
                        <div class="table-responsive p-0">
                            <table class="table align items-center pb-0 mt-1" id="DNtabla">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Id</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            N° Oficio</th>
                                        {{-- <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Asunto</th> --}}
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Fecha Oficio</th>

                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Área </th>

                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Quién solicita </th>

                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Observaciones </th>
                                        <th class="text-center"></th>

                                    </tr>
                                </thead>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- Modal Add/Upd Oficio --}}
    <div class="modal fade" id="addupdNumModal" data-bs-keyboard=false data-bs-backdrop="static" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bolder" id="titlemodal">Agregar Número de Oficio</h5>
                    {{-- <button type="button" wire:click.prevent="cancel" class="btn-close"
                        data-bs-dismiss="modal"></button> --}}
                </div>
                <form action="correspondencia/upd/id_correspondencia" method="POST" id="formUpdNum"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col-md-2">
                                <label class="form-label required">No. Oficio</label>
                                <input type="text" class="form-control @error('numeroId') is-invalid @enderror"
                                    name="numeroId" id="numeroId" required>
                                @error('numeroId')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-2">
                                <label class="form-label required">No. Folios</label>
                                <input type="number" value="1" class="form-control @error('nfolios') is-invalid @enderror"
                                    name="nfolios" id="nfolios" required>
                                @error('nfolios')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Fecha</label>
                                <input type="date" class="form-control @error('fecha') is-invalid @enderror"
                                    name="fecha" id="fecha">
                                @error('fecha')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Area</label>
                                <select  class="form-select"  @error('area') is-invalid @enderror"
                                    name="area" id="area" required>
                                        <option value=""></option>
                                        {{!! $areasCB !!}}
                                </select>

                                @error('area')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">

                            <div class="col-md-6">
                                <label class="form-label">Asunto</label>
                                <input type="text" class="form-control @error('asunto') is-invalid @enderror"
                                    name="asunto" id="asunto" required>
                                @error('asunto')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Quien lo solicita</label>
                                <input type="text" class="form-control @error('solicita') is-invalid @enderror"
                                    name="solicita" id="solicita" required>
                                @error('solicita')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label class="form-label">Observaciones</label>
                                <input type="text" class="form-control @error('observaciones') is-invalid @enderror"
                                    name="observaciones" id="observaciones">
                                @error('observaciones')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer align-items-center flex-nowrap">
                        <button type="button" class="btn bg-gradient-secondary me-auto mb-0" data-bs-dismiss="modal">
                            Cerrar
                        </button>
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

        @if (session('success'))
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });
            Toast.fire({
                icon: "success",
                title: @json(session('success'))
            });
        @endif
        window.onload = function() {
            // $(".alert").fadeTo(1000, 0).slideUp(1000, function() {
            //     $(this).remove();
            // });

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

            let table = new DataTable('#DNtabla', {
                "ajax":{
                    "url":@json(route('dsdatanumeros')),
                    "dataSrc":''
                },
                "columns":[
                    {"data": "id"},
                    {"data": null,
                    "render": function (data, type) {
                            return '<div class="d-flex flex-column justify-content-center">'
                                        + '<h6 class="mb-0 text-sm">'+ data["numeroId"] +'</h6>'
                                        + '<p class="text-xs text-secondary mb-0">Asunto: ' + data["asunto"] + '</p>'
                                 + '</div>'
                        }
                    },
                    {"data":"fecha"},
                    {"data":"area"},
                    {"data":"solicita"},
                    {"data":"observaciones"},
                    {"orderable": false,
                        "data":null,
                        "render": function (data,type){
                        return '<div class="d-flex">'
                                   + '<a href="#" class="btn btn-outline-secondary w-100 btn-icon mb-0"'
                                   + 'data-bs-toggle="modal" data-bs-target="#addupdNumModal"'
                                   + 'data-id="'+ data["numeroId"]+'">'
                                      + '<svg xmlns="http://www.w3.org/2000/svg" width="24"'
                                        + 'height="24" viewBox="0 0 24 24" fill="none"'
                                        + 'stroke="currentColor" stroke-width="2" stroke-linecap="round"'
                                        + 'stroke-linejoin="round"'
                                        + 'class="icon icon-tabler icons-tabler-outline icon-tabler-edit">'
                                        + '<path stroke="none" d="M0 0h24v24H0z" fill="none" />'
                                        + '<path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /> <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /> <path d="M16 5l3 3" />'
                                        + '</svg>'
                                    + '</a>'
                                + '</div>'

                    }


                    }
                ],
                "language": confidioma,
                "autoWidth":false,
                "columnDefs": [
                    {
                    "targets": "_all",
                    "className": "text-xs font-weight-bold align-middle"
                    },

                ],
            });

            $('#addupdNumModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var id = button.data('id');
                var tipo = button.data('tipo');
                if (tipo == "agregar") {
                    // Limpiar el formulario
                    limpiarForm();
                    // Asignar la URL para agregar
                    $("#formUpdNum").attr('action', 'RegistroNumeros/add');
                    $("#titlemodal").text("Agregar Registro de Número");

                    // Traer el ultimo folio
                    $.ajax({
                        url: '/GetId',
                        method: 'GET',
                        success: function(data) {
                            var $numId = data.numeroId;
                            var $lastId = $numId.split("-");
                            var $n;
                            if ($lastId == $numId){
                                $n =  parseInt($numId)+1;
                            }else if
                            ($lastId[1]=== " "){
                                $n =  parseInt($lastId[0])+1;
                            }else{
                                $n = parseInt($lastId[1])+1;
                            }


                            //console.log($n);
                            $("#numeroId").val($n);



                        }
                    });


                } else {
                    // Asignar la URL para actualizar
                    $("#formUpdNum").attr('action', 'RegistroNumeros/upd/' + id);
                    $("#titlemodal").text("Editar Registro de Número");

                    // Traer los datos del oficio
                    $.ajax({
                        url: '/RegistroNumeros/' + id,
                        method: 'GET',
                        success: function(data) {

                            $("#numeroId").val(data.numeroId);
                            $("#fecha").val(convertirFecha(data.fecha));
                            $("#area").val(data.area);
                            $("#asunto").val(data.asunto);
                            $("#solicita").val(data.solicita);
                            $("#observaciones").val(data.observaciones);


                        }
                    });
                }
            });

            function limpiarForm() {
                $('#formUpdNum')[0].reset();
                $('#fecha').val(@json(date('Y-m-d')));

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
