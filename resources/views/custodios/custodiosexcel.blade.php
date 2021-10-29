<table>
    <tr>
        <td colspan="10" style="text-align: center">
            <img src="{{ public_path('metronic/media/logos/logo-letter-13.png') }}" alt="">
        </td>
    </tr>
    <tr>
        <td colspan="10" style="text-align: left">
            <strong>Listado de Custodios</strong>
        </td>
    </tr>
</table>
<table>
    <thead>
        <tr>
            <th style="background-color:#f6f6f6; border: 1px solid #000000;"><b>ID_CUSTODIO</b></th>
            <th style="background-color:#f6f6f6; border: 1px solid #000000;"><b>COD_CUSTODIO</b></th>
            <th style="background-color:#f6f6f6; border: 1px solid #000000;"><b>DNI CUSTODIO</b></th>
            <th style="background-color:#f6f6f6; border: 1px solid #000000;"><b>NOMBRE</b></th>
            <th style="background-color:#f6f6f6; border: 1px solid #000000;"><b>TEL MOVIL</b></th>
            <th style="background-color:#f6f6f6; border: 1px solid #000000;"><b>TEL FIJO</b></th>
            <th style="background-color:#f6f6f6; border: 1px solid #000000;"><b>CORREO 1</b></th>
            <th style="background-color:#f6f6f6; border: 1px solid #000000;"><b>CORREO 2</b></th>
            <th style="background-color:#f6f6f6; border: 1px solid #000000;"><b>DIRECCION</b></th>
            <th style="background-color:#f6f6f6; border: 1px solid #000000;"><b>COD_DEPARTAMENTO</b></th>
            <th style="background-color:#f6f6f6; border: 1px solid #000000;"><b>NOMBRE_DEPARTAMENTO</b></th>
            <th style="background-color:#f6f6f6; border: 1px solid #000000;"><b>COD_MUNICIPIO</b></th>
            <th style="background-color:#f6f6f6; border: 1px solid #000000;"><b>NOMBRE_MUNICIPIO</b></th>
            <th style="background-color:#f6f6f6; border: 1px solid #000000;"><b>COD_CENTRO</b></th>
            <th style="background-color:#f6f6f6; border: 1px solid #000000;"><b>NOMBRE_CENTRO</b></th>
            <th style="background-color:#f6f6f6; border: 1px solid #000000;"><b>COD_PARTIDO</b></th>
            <th style="background-color:#f6f6f6; border: 1px solid #000000;"><b>NOMBRE_PARTIDO</b></th>
            <th style="background-color:#f6f6f6; border: 1px solid #000000;"><b>COD_ESTADO</b></th>
            <th style="background-color:#f6f6f6; border: 1px solid #000000;"><b>NOMBRE_ESTADO</b></th>
            <th style="background-color:#f6f6f6; border: 1px solid #000000;"><b>COD_TIPO_CUSTODIO</b></th>
            <th style="background-color:#f6f6f6; border: 1px solid #000000;"><b>TIPO_CUSTODIO</b></th>
            <th style="background-color:#f6f6f6; border: 1px solid #000000;"><b>FECHA_HORA_REGISTRO</b></th>
            <th style="background-color:#f6f6f6; border: 1px solid #000000;"><b>DNI_USUARIO_REGISTRO</b></th>
        </tr>
    </thead>

    <tbody>
        @foreach ($custodios ?? '' as $item)
            <tr>
                <td style="vertical-align: center; border: 1px solid #000000;">{{ $item->idc_custodio }}</td>
                <td style="vertical-align: center; border: 1px solid #000000;">{{ $item->cod_custodio }}</td>
                <td style="vertical-align: center; border: 1px solid #000000;">{{ $item->dni_custodio }}</td>
                <td style="vertical-align: center; border: 1px solid #000000;">{{ $item->nombre_custodio }}</td>
                <td style="vertical-align: center; border: 1px solid #000000;">{{ $item->tel_movil }}</td>
                <td style="vertical-align: center; border: 1px solid #000000;">{{ $item->tel_fijo != null ? $item->tel_fijo : 'NULL' }}</td>
                <td style="vertical-align: center; border: 1px solid #000000;">{{ $item->correo1_custodio }}</td>
                <td style="vertical-align: center; border: 1px solid #000000;">{{ $item->correo2_custodio != null ? $item->correo2_custodio : 'NULL' }}</td>
                <td style="vertical-align: center; border: 1px solid #000000;">{{ $item->dir_custodio }}</td>
                <td style="vertical-align: center; border: 1px solid #000000;">{{ $item->municipio->departamento->cod_departamento }}</td>
                <td style="vertical-align: center; border: 1px solid #000000;">{{ $item->municipio->departamento->nombre_departamento }}</td>
                <td style="vertical-align: center; border: 1px solid #000000;">{{ $item->municipio->cod_municipio }}</td>
                <td style="vertical-align: center; border: 1px solid #000000;">{{ $item->municipio->nombre_municipio }}</td>
                <td style="vertical-align: center; border: 1px solid #000000;">{{ $item->cod_centro != null ? $item->centro->cod_centro : 'NULL' }}</td>
                <td style="vertical-align: center; border: 1px solid #000000;">{{ $item->cod_centro != null ? $item->centro->nombre_centro : 'NULL' }}</td>
                <td style="vertical-align: center; border: 1px solid #000000;">{{ $item->partido->cod_partido }}</td>
                <td style="vertical-align: center; border: 1px solid #000000;">{{ $item->partido->nombre_partido }}</td>
                <td style="vertical-align: center; border: 1px solid #000000;">{{ $item->estado->cod_estado }}</td>
                <td style="vertical-align: center; border: 1px solid #000000;">{{ $item->estado->nombre_estado }}</td>
                <td style="vertical-align: center; border: 1px solid #000000;">{{ $item->tipoCustodio->cod_tipo_custodio }}</td>
                <td style="vertical-align: center; border: 1px solid #000000;">{{ $item->tipoCustodio->tipo_custodio }}</td>
                <td style="vertical-align: center; border: 1px solid #000000;">{{ $item->fecha_registro }}</td>
                <td style="vertical-align: center; border: 1px solid #000000;">{{ $item->dni_usuario_registro }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
