<table>
    <tr>
        <td colspan="10" style="text-align: center">
            <img src="{{ public_path('metronic/media/logos/logo-letter-13.png') }}" alt="">
        </td>
    </tr>
    <tr>
        <td colspan="10" style="text-align: left">
            Listado de Usuarios
        </td>
    </tr>
</table>
<table>
    <thead>
        <tr>
            <th style="background-color:#f6f6f6; width:15px; border: 1px solid #000000;"><b>DNI</b></th>
            <th style="background-color:#f6f6f6; width:45px; border: 1px solid #000000;"><b>NOMBRE DEL USUARIO</b></th>
            <th style="background-color:#f6f6f6; width:15px; border: 1px solid #000000;"><b>TELEFONO</b></th>
            <th style="background-color:#f6f6f6; width:30px; border: 1px solid #000000;"><b>CORREO</b></th>
            <th style="background-color:#f6f6f6; width:45px; border: 1px solid #000000;"><b>CARGO</b></th>
            <th style="background-color:#f6f6f6; width:45px; border: 1px solid #000000;"><b>PERFIL DEL USUARIO</b></th>
            <th style="background-color:#f6f6f6; width:45px; border: 1px solid #000000;"><b>PARTIDO</b></th>
            <th style="background-color:#f6f6f6; width:45px; border: 1px solid #000000;"><b>DEPARTAMENTO</b></th>
            <th style="background-color:#f6f6f6; width:45px; border: 1px solid #000000;"><b>MUNICIPIO</b></th>
            <th style="background-color:#f6f6f6; width:45px; border: 1px solid #000000;"><b>DIRECCION</b></th>
        </tr>
    </thead>

    <tbody>
        @foreach ($usuarios ?? '' as $item)
            <tr>
                <td style="vertical-align: center;">{{ $item->dni_usuario }}</td>
                <td style="vertical-align: center;">{{ $item->nombre_usuario }}</td>
                <td style="vertical-align: center;">{{ $item->tel_usuario }}</td>
                <td style="vertical-align: center;">{{ $item->correo_usuario }}</td>
                <td style="vertical-align: center;">{{ $item->cargo_usuario }}</td>
                <td style="vertical-align: center;">{{ !empty($item->rol[0]->name) ? $item->rol[0]->name : '-' }}</td>
                <td style="vertical-align: center;">{{ empty($data->partido->nombre_partido) ? '-' : $data->partido->nombre_partido }}</td>
                <td style="vertical-align: center;">{{ empty($data->departamento->nombre_departamento) ? '-' : $data->departamento->nombre_departamento }}</td>
                <td style="vertical-align: center;">{{ empty($data->municipio->nombre_municipio) ? '-' : $data->municipio->nombre_municipio }}</td>
                <td style="vertical-align: center;">{{ $item->dir_usuario }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
