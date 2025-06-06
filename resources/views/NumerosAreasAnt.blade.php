@extends('layouts.user_type.auth')
@section('titulo2','Números')
@section('titulo','Registro de Números 2024')
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


        // document.getElementById("nfolios").addEventListener('input',function(e){
        //     $("#ultfolio").val((parseInt($("#numeroId").val()) + parseInt(e.target.value))-1);
        // })


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

        @if (session('error'))
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
                icon: "error",
                title: @json(session('error'))
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
                    "url":@json(route('dsdatanumeros2Ant')),
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
                            + '<a href="#" class="btn btn-primary w-30 btn-icon mb-0 me-1" data-bs-toggle="modal" data-bs-target="#Adjuntos" data-id="'+ data["numeroId"] +'"> '
                                + '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"'
                                    + 'fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"'
                                    + 'stroke-linejoin="round" class="icon">'
                                    + '<path stroke="none" d="M0 0h24v24H0z" fill="none" />'
                                    + '<path d="M14 3v4a1 1 0 0 0 1 1h4" />'
                                    + '<path d="M5 12v-7a2 2 0 0 1 2 -2h7l5 5v4" />'
                                    + '<path d="M5 18h1.5a1.5 1.5 0 0 0 0 -3h-1.5v6" />'
                                    + '<path d="M17 18h2" />'
                                    + '<path d="M20 15h-3v6" />'
                                    + '<path d="M11 15v6h1a2 2 0 0 0 2 -2v-2a2 2 0 0 0 -2 -2h-1z" />'
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
                "order":[[0,'desc']]
            });




            $("#oficioAnexo").on('change', function() {
            var carpeta = $("#numeroId").val();
            var file = this.files[0];
            var name = file.name;
            if (file) {
                if (!name.includes(carpeta)) {

                    alert("El nombre del archivo debe contener la palabra " + carpeta);
                    this.value = ""; // Resetea el input

                }
                $("#oficioAnexo").html("Archivo seleccionado");
                //console.log(nombrepdf);
            }
            });

            $('#addupdNumModal2').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var id = button.data('id');
                var tipo = button.data('tipo');
                if (tipo == "agregar") {
                    // Limpiar el formulario
                    limpiarForm();
                    // Asignar la URL para agregar
                    $("#formUpdNum").attr('action', 'NumerosAreas/add');
                    $("#titlemodal").text("Agregar Registro de Número");

                    // Traer el ultimo folio
                    $.ajax({
                        url: "{{ route('RegistroNumeros.GetId2') }}",
                        method: 'GET',
                        success: function(data) {
                             //console.log($lastId);
                            // $("#nfolios").attr("readOnly", false); //
                            $("#numeroId").attr("readOnly", false); //
                            // $("#ultfolio").attr("readOnly", false); //
                            $("#oficioAnexo").attr("disabled", true); //Deshabilitar el input
                            $("#oficioAnexo").hide();
                            // var $numId = data.numeroId;

                            // var $lastId = $numId.split("-");
                            // //console.log($lastId);
                            // var $n;

                            // if ($lastId == $numId){
                            //     $n =  parseInt($numId)+1;

                            // }else if
                            // ($lastId[1]=== " "){
                            //     $n =  parseInt($lastId[0])+1;

                            // }else{
                            //     $n = parseInt($lastId[1])+1;

                            // }

                            //console.log($n);
                            // $("#numeroId").val($n);
                            // $("#ultfolio").val($n);

                        }
                    });


                } else {
                    // Asignar la URL para actualizar
                    $("#formUpdNum").attr('action', "{{ route('NumerosAreas.editar', ':id') }}".replace(':id', id));
                    $("#titlemodal").text("Editar Registro de Número");

                    // Traer los datos del oficio
                    $.ajax({
                                url: "{{ route('NumerosAreas.show', ':id') }}".replace(':id', id),
                                method: 'GET',
                                success: function(data) {
                                    // var $numId = data.numeroId;
                                    // var $lastId = $numId.split("-");
                                    // if($lastId == $numId){
                                    //     var $n = $numId;
                                    // }else if($lastId[1]== ''){
                                    //     $n = $numId;
                                    // }else{
                                    //     $n = $lastId[1];
                                    // }
                                    //console.log($lastId);
                                    // $("#nfolios").attr("readOnly", true); //
                                    $("#numeroId").attr("readOnly", true); //
                                    // $("#ultfolio").attr("readOnly", true); //
                                    $("#oficioAnexo").attr("disabled", false); //habilitar el input
                                    $("#oficioAnexo").show(); //mostrar el input
                                    //$("#nfolios").show();

                                    // $("#ultfolio").val($n);
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



            $('#Adjuntos').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // El botón que activó el modal
            var id = button.data('id'); // Obtén el ID del botón

                $.ajax({
                    url: "{{ route('NumerosAreas.list2', ':id') }}".replace(':id', id), // La URL de la solicitud AJAX
                    method: 'GET',
                    success: function(data) {
                        var $listAdjuntos = $('#listadjuntos');
                        $listAdjuntos.empty(); // Limpiar la lista existente
                        console.log('Datos recibidos:', data);
                        if(!data.archivos || data.archivos.length === 0){
                            //mensaje para cuando no hay archivos
                            $listAdjuntos.append('<p>No hay archivos disponibles</p>');
                        }else{
                            // Iterar sobre los archivos y agregarlos a la lista
                            $.each(data.archivos, function(key, value) {
                                // Crear un nuevo elemento de lista para cada archivo
                                var listItem = $('<a></a>')
                                    .addClass('list-group-item list-group-item-action')
                                    .attr('href', 'verPDF2/' + data.area +'/' + value)
                                    .attr('target', '_blank')
                                    .text(value); // Muestra la URL del archivo

                                    $listAdjuntos.append(listItem);

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
