<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hoja de Incidencias</title>

    <style>
        table {
            width: 100%;
        }
        table td {
            height: 25px;
        }
        h1, h4, h5 {
            margin: 0;
        }
    </style>
</head>
<body>
    <table style="margin-bottom: 30px;">
        <tr>
            <td style="text-align: center;">
                <img src="{{ public_path('metronic/media/logos/logo-letter-13.png') }}" alt="">
            </td>
        </tr>
        <tr>
            <td style="text-align: center;">
                <h1 style="text-align: center;">HOJA DE INCIDENCIAS</h1>
                <h5 style="text-align: center;">CUSTODIO ELECTORAL DE CENTRO DE VOTACIÓN</h5>
            </td>
        </tr>
    </table>

    <table style="margin-bottom: 30px;">
        <tr>
            <td colspan="2"><h4>DATOS DEL CUSTODIO</h4></td>
        </tr>
        <tr>
            <td colspan="2">
                <b>Nombres y Apellidos completos:</b>
                {{ $custodio->nombre_custodio }}
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <b>Número de DNI:</b>
                {{ $custodio->dni_custodio }}
            </td>
        </tr>
        <tr>
            <td style="width: 50%;">
                <b>Número de Celular:</b>
                {{ $custodio->tel_movil }}
            </td>
            <td style="width: 50%; text-align: right;">
                <b>Firma:</b>
                ________________________
            </td>
        </tr>
    </table>

    <table style="margin-bottom: 30px;">
        <tr><td colspan="2"><h4>DATOS DEL CENTRO DE VOTACIÓN</h4></td></tr>
        <tr>
            <td style="width: 50%;">
                <b>Departamento:</b>
                {{ !empty($custodio->departamento->nombre_departamento) ? $custodio->departamento->nombre_departamento : '-' }}
            </td>
            <td style="width: 50%;">
                <b>Centro de Votación:</b>
                {{ !empty($custodio->centro->nombre_sector_electoral) ? $custodio->centro->nombre_sector_electoral : '-' }}
            </td>
        </tr>
        <tr>
            <td>
                <b>Municipio:</b>
                {{ $custodio->municipio->nombre_municipio }}
            </td>
            <td>
                <b>Cantidad de Junta(s) que atendió:</b>
                {{ $data1->respuesta }}
                   </td>
        </tr>
        <tr>
            <td colspan="2">
                <b>Sector Electoral:</b>
                {{ !empty($custodio->centro->nombre_sector_electoral) ? $custodio->centro->nombre_sector_electoral : '-' }}
            </td>
        </tr>
    </table>

    <table style="margin-bottom: 30px;">
        <tr><td><h4>INSTRUCCIONES</h4></td></tr>
        <tr>
            <td>
                TODAS las preguntas deben de ser respondidas para obtener el pago final de sus servicios. Terminado el proceso, ingresar esta hoja de incidencias en la primera maleta del centro de votación correspondiente. Tomar fotografía a esta hoja de incidencias una vez la haya llenado, esto para su respaldo. Indique marcando una X en el recuadro “SI” o “NO” según la pregunta.
            </td>
        </tr>
    </table>

    <table>
        @foreach ($data as $key => $item)
            @if ($item->id == 13)
                @php
                    $arr = json_decode($item->respuesta);
                @endphp
                <tr>
                    <td>
                        {{ $key + 1 }}
                        {{ $item->pregunta }}
                    </td>
                    <td style="text-align: right;">
                        <b>{{ $arr[0] }}</b>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        Si su respuesta es “NO”: ¿A qué hora se presentaron? <b>{{ $arr[1] }}</b>
                    </td>
                </tr>
            @elseif ($item->id == 21)
                @php
                    $arr = json_decode($item->respuesta);
                @endphp
                <tr>
                    <td>
                        {{ $key + 1 }}
                        {{ $item->pregunta }}
                    </td>
                    <td style="text-align: right;">
                        <b>{{ $arr[0] }}</b>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        ¿Cuántas veces? <b>{{ $arr[1] }}</b>
                    </td>
                </tr>
            @elseif ($item->id == 24)
                @php
                    $arr = json_decode($item->respuesta);
                @endphp
                <tr>
                    <td colspan="2">
                        {{ $key + 1 }}
                        {{ $item->pregunta }}
                    </td>
                </tr>
                @foreach ($arr as $a)
                    @if (!empty($a[0]))
                        <tr>
                            <td colspan="2">
                                <table>
                                    <tr>
                                        <td style="width: 80%;">
                                            {{ $a[0] }}
                                        </td>
                                        <td style="text-align: right;">
                                            {{ $a[1] }}
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    @endif
                @endforeach
            @elseif ($item->id == 30)
                @php
                    $arr = json_decode($item->respuesta);
                @endphp
                <tr>
                    <td>
                        {{ $key + 1 }}
                        {{ $item->pregunta }}
                    </td>
                    <td style="text-align: right;">
                        <b>{{ $arr[0] }}</b>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        ¿Cuántas maletas Electorales recibió? <b>{{ $arr[1] }}</b>
                    </td>
                </tr>
            @elseif ($item->id == 33)
                @php
                    $arr = json_decode($item->respuesta);
                @endphp
                <tr>
                    <td>
                        {{ $key + 1 }}
                        {{ $item->pregunta }}
                    </td>
                    <td style="text-align: right;">
                        <b>{{ $arr[0] }}</b>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        ¿Cuántos kits tecnológicos recibió? <b>{{ $arr[1] }}</b>
                    </td>
                </tr>
            @else
                <tr>
                    <td>
                        {{ $key + 1 }}
                        {{ $item->pregunta }}
                    </td>
                    <td style="text-align: right;">
                        <b>{{ $item->respuesta }}</b>
                    </td>
                </tr>
            @endif

        @endforeach
    </table>

</body>
</html>
