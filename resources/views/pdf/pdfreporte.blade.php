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
                <th width=40%>Oficio</th>
                <th width =5%>Fecha Oficio</th>
                <th width =10%>Area</th>
                <th width =20%>Recibe</th>
                <th width =23%>Anexos</th>

            </tr>
        </thead>
        <tbody>
            @foreach($datos as $dato)

                <tr>
                    <td rowspan="2">{{ $loop->iteration }}</td>
                    <td ><b>N° Oficio :</b> {{ $dato->no_oficio }} <br> <b>Remitente:</b> {{ $dato->enviado_por }} <br> <b>Asunto:</b> {{ $dato->asunto }}</td>
                    <td>{{ $dato->fecha_oficio }}</td>
                    <td>{{ $dato->area }}</td>
                    <td>{{ $dato->recibe }}</td>
                    <td>{{ $dato->recibido_por }}</td>
                </tr>
                <tr>
                    <td colspan="5"><b>Observaciones:</b> {{ $dato->folder }}</td>
                </tr>

            @endforeach
        </tbody>
    </table>
</body>
</html>
