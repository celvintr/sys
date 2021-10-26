<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ficha del Usuario</title>

    <style>
        table {
            width: 100%;
        }
    </style>
</head>
<body>
    <table>
        <tr>
            <td style="text-align: center;">
                <img src="{{ public_path('metronic/media/logos/logo-light.png') }}" alt="">
            </td>
        </tr>
        <tr>
            <td style="text-align: center;">
                <h3 style="text-align: center;">Ficha del Usuario</h3>
            </td>
        </tr>
    </table>

    <table>
        <tr>
            <td style="width 50%;">
                <b>DNI</b>
                <p>{{ $data->dni_usuario }}</p>
            </td>
            <td style="width 50%;">
                <b>Nombre del usuario</b>
                <p>{{ $data->nombre_usuario }}</p>
            </td>
        </tr>
        <tr>
            <td>
                <b>Teléfono</b>
                <p>{{ $data->tel_usuario }}</p>
            </td>
            <td>
                <b>Correo</b>
                <p>{{ $data->correo_usuario }}</p>
            </td>
        </tr>
        <tr>
            <td>
                <b>Cargo</b>
                <p>{{ $data->cargo_usuario }}</p>
            </td>
            <td>
                <b>Rol</b>
                <p>{{ !empty($data->rol[0]->name) ? $data->rol[0]->name : '-' }}</p>
            </td>
        </tr>
        <tr>
            <td>
                <b>Partido</b>
                <p>{{ empty($data->partido->nombre_partido) ? '-' : $data->partido->nombre_partido }}</p>
            </td>
        </tr>
        <tr>
            <td>
                <b>Departamento</b>
                <p>{{ empty($data->departamento->nombre_departamento) ? '-' : $data->departamento->nombre_departamento }}</p>
            </td>
            <td>
                <b>Municipio</b>
                <p>{{ empty($data->municipio->nombre_municipio) ? '-' : $data->municipio->nombre_municipio }}</p>
            </td>
        </tr>
        <tr>
            <td>
                <b>Dirección</b>
                <p>{{ $data->dir_usuario }}</p>
            </td>
        </tr>
    </table>
</body>
</html>
