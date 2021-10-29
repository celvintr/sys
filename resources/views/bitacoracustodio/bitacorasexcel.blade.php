<table>
    <tr>
        <td colspan="5" style="text-align: center">
            <img src="{{ public_path('metronic/media/logos/logo-letter-13.png') }}" alt="">
        </td>
    </tr>
    <tr>
        <td colspan="5" style="text-align: left">
            <strong>Bitacora de estados de Custodio</strong>
        </td>
    </tr>
</table>
<table>
    <thead>
        <tr>
            <th style="background-color:#f6f6f6; border: 1px solid #000000;"><b>FECHA HORA BITACORA</b></th>
            <th style="background-color:#f6f6f6; border: 1px solid #000000;"><b>DNI USUARIO ACCIÓN</b></th>
            <th style="background-color:#f6f6f6; border: 1px solid #000000;"><b>DNI CUSTODIO AFECTADO</b></th>
            <th style="background-color:#f6f6f6; border: 1px solid #000000;"><b>ACCIÓN EJECUTADA</b></th>
            <th style="background-color:#f6f6f6; border: 1px solid #000000;"><b>DESCRIPCIÓN CUSTODIO</b></th>
        </tr>
    </thead>

    <tbody>
        @foreach ($bitacoras ?? '' as $item)
            <tr>
                <td style="vertical-align: center; border: 1px solid #000000;">{{ $item->fecha_hora_bitacora }}</td>
                <td style="vertical-align: center; border: 1px solid #000000;">{{ $item->dni_usuario }}</td>
                <td style="vertical-align: center; border: 1px solid #000000;">{{ $item->dni_custodio }}</td>
                <td style="vertical-align: center; border: 1px solid #000000;">{{ $item->accion }}</td>
                <td style="vertical-align: center; border: 1px solid #000000;">{{ $item->descripcion }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
