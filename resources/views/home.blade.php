@extends('layouts.app')

@section('content')
<div>
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        Solicitudes de Evaluación
                    </div>
                    <h2 class="page-title">
                       
                    </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <button class="" data-bs-toggle="modal" href="" wire:click="subir_click">
                            <x-upload-icon />
                            Subir Oficio
                        </button>
                        <button class="btn btn-primary" data-bs-toggle="modal" href="">
                            <x-add-icon />
                            Agregar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
   

   
</div>
 
@endsection
