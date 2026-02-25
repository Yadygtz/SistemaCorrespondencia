<!DOCTYPE html>
<html>
<head>
    <title>Reporte de oficios recibidos</title>
    {{-- <link href="{{ public_path('css/tabler-ui.css') }}" rel="stylesheet"> --}}
    <style>
        /* Puedes agregar estilos personalizados aquí */
        h1 {
            font-family: Arial, sans-serif;
            font-size: 17px;
        }
        img {
            width: 150px; /* Ajusta el tamaño según sea necesario */

            margin-bottom: 10px; /* Espacio debajo del logo */
        }
        @page {
		margin-left: 0.5cm;
		margin-right: 0;
        margin-top: 0;
	    }
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse; /* Para evitar bordes duplicados */
        }
        th, td {
            border: 1px solid #000; /* Añadir borde */
            padding: 12px; /* Aumentar el padding */
            text-align: left;
        }
        th {
            background-color: #ab0033; /* Fondo para encabezados */
            color: #f9f9f9;
            font-size: 12px;
            text-align: center;

        }
        /* th {

        width: auto-size;
        } */

        tr:nth-child(even) {
            background-color: #f9f9f9e0; /* Alternar filas para mejor legibilidad */

        }
        tr {
            font-size: 11px;

        }

        tr.grupo {
            page-break-inside: avoid;

        }

    </style>
</head>
<body>

        <img src="{{ public_path('assets/img/C3-horizontal.png') }}" alt="">

    <h1>Informe de oficios del {{ $fecha_inicial }} al {{ $fecha_final }}</h1>
    <table>
        <thead>
            <tr>
                <th width=2%>N°</th>
                <th width=2%>N° Oficio</th>
                <th width =5%>Fecha Oficio</th>
                <th width =10%>Area</th>
                <th width=30%>Asunto</th>
                <th width =30%>Solicita</th>
                {{-- @if(auth()->user()->area === 'INFORMÁTICA')
                <th width =23%>Anexos</th>
                @endif --}}


            </tr>
        </thead>
        <tbody>
            @foreach($datos as $dato)

                <tr>
                    <td rowspan="1">{{ $loop->iteration }}</td>
                    <td >{{ $dato->numeroId }}</td>
                    <td>{{ $dato->fecha }}</td>
                    <td>{{ $dato->area }}</td>
                    <td>{{ $dato->asunto }}</td>
                    <td>{{ $dato->solicita }}</td>
                    {{-- <td>{{ $dato->recibido_por }}</td> --}}
                </tr>
                {{-- @if(auth()->user()->area === 'INFORMÁTICA')
                <tr>
                    <td colspan="5"><b>Observaciones:</b> {{ $dato->folder }}</td>
                </tr>
                @endif --}}
            @endforeach
        </tbody>
    </table>
</body>
</html>
