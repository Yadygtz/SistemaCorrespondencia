@extends('layouts.user_type.auth')
@section('titulo2','Números')
@section('titulo','Registro de Números 2025')
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

    <!-- Modal Detalle Oficio Numeros -->
    <div class="modal fade" id="Adjuntos" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="detalleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bolder" id="detalleModalLabel">Archivos del Oficio</h5>
                </div>
                <div class="modal-body">
                    <div id="listadjuntos" class="list-group">
                        <!-- Los archivos se llenarán aquí -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-gradient-secondary mb-0" data-bs-dismiss="modal">Cerrar</button>

                </div>
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
                    "url":@json(route('dsdatanumerosAnt')),
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
                            + '<a href="#" class="btn btn-primary w-30 btn-icon mb-0 me-1" data-bs-toggle="modal" data-bs-target="#Adjuntos" data-id="'+ data["numeroId"] +'"> <svg xmlns="http://www.w3.org/2000/svg" width="24"'
                                        + 'height="24" viewBox="0 0 24 24" fill="none"'
                                        + 'stroke="currentColor" stroke-width="2" stroke-linecap="round" '
                                        + 'stroke-linejoin="round"'
                                        + 'class="icon icon-tabler icons-tabler-outline icon-tabler-eye">'
                                        + '<path stroke="none" d="M0 0h24v24H0z" fill="none" />'
                                        + '<path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />'
                                        + '<path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" /> </svg>'
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
                "order":[[0,'desc']]
            });



          $('#Adjuntos').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // El botón que activó el modal
            var id = button.data('id'); // Obtén el ID del botón

                $.ajax({
                    url: "{{ route('RegistroNumeros.listfiles', ':id') }}".replace(':id', id), // La URL de la solicitud AJAX
                    method: 'GET',
                    success: function(data) {
                        var listAdjuntos = $('#listadjuntos');
                        listAdjuntos.empty(); // Limpiar la lista existente
                        //console.log('Datos recibidos:', data);
                        if(data.success === false){
                            //mensaje para cuando no hay archivos
                            listAdjuntos.append('<p>No hay archivos disponibles</p>');
                        }else{
                            // Iterar sobre los archivos y agregarlos a la lista
                            $.each(data, function(key, value) {
                                // Crear un nuevo elemento de lista para cada archivo
                                var listItem = $('<a></a>')
                                    .addClass('list-group-item list-group-item-action')
                                    .attr('href', 'verPDF/' + id + '/' + value)
                                    .attr('target', '_blank')
                                    .text(value); // Muestra la URL del archivo

                                    listAdjuntos.append(listItem);

                            });

                        }

                    },
                    error: function(xhr, status, error) {
                        console.error('Error al cargar los archivos:', error);
                    }
                });
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
