<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Datos del Custodio</title>
    <style>
        .page-break {
            page-break-after: always;
        }

        html{
            margin-left: 20px;
            margin-right: 20px;
        }

        body {
            font-family: 'Arial', sans-serif;
        }

        .contenedor{
            width: 100%;
            max-width: 1200px;
            margin: auto;
        }

        .encabezado {
            width: 100%;
            height: 110px;
            overflow: hidden;
        }

        .encabezado .logo {
            display: inline-block;
            width: 22%;
            vertical-align: middle;
        }

        .encabezado .logo img {
            width: 100%;
            height: 100%			
        }


        .textos {
            vertical-align: middle;
            display: inline-block;
            width: 53%;
            font-size: 11pt;
            text-align: center;
            top: 0;
        }

        .titulo {
            font-size: 20px;
            font-weight: bold;
        }

        .subtitulo {
            font-size: 16px;
            font-weight: bold;
            margin-top: -15px;
        }

        .contenido {
            width: 100%;
            margin: 0;
            height: 600px;
            vertical-align: top;
            margin-top: 130px;
            padding: 30px;
        }

        .contenido .info {
            width: 65%;
            height: 100%;
            display: inline-block;
        }

        .contenido .foto {
            width: 20%;
            height: 100%;
            display: inline-block;
            /* margin-top: -260px; */
            overflow: hidden;
        }

        .foto img {
            width: 100%;
            height: auto;
        }
        
        .mg-bt-none {
            margin: 0;
        }

        .font-sz {
            font-size: 18px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="encabezado">
			<div class="logo">
				<img src="{{ asset('images/logo-cne.jpeg') }}" alt="Logo">
			</div>
			<div class="textos">
				<p class="titulo">CONSEJO NACIONAL ELECTORAL</p>
				<p class="subtitulo">PROYECTO DE CUSTODIOS ELECTORALES</p>
				<p class="subtitulo">"Comprobante de Registro de Custodio Electoral"</p>
			</div>
            <div class="logo">
				<img src="{{ asset('images/logo-cne.jpeg') }}" alt="Logo">
			</div>
		</div>
        <div class="contenido">
            <div class="info">
                <div class="">
                    <p class="mg-bt-none font-sz"><span><strong>Fecha y Hora:</strong> {{ now() }}</span></p>
                    <p class="mg-bt-none font-sz"><span><strong>Código de custodio electoral:</strong> {{ $custodio->cod_custodio }}</span></p>
                </div>
                <div class="info-personal">
                    <h2>Información personal</h2>
                    <ul>
                        <li class="font-sz">DNI: {{ $custodio->dni_custodio }}</li>
                        <li class="font-sz">Nombre completo: {{ $custodio->nombre_custodio }}</li>
                        <li class="font-sz">Teléfono móvil: {{ $custodio->tel_moviel }}</li>
                        @if(!is_null($custodio->tel_fijo))
                        <li class="font-sz">Teléfono fijo: {{ $custodio->tel_movil }}</li>
                        @endif
                        <li class="font-sz">Correo 1: {{ $custodio->correo1_custodio }}</li>
                        @if(!is_null($custodio->correo2_custodio))
                        <li class="font-sz">Teléfono fijo: {{ $custodio->correo2_custodio }}</li>
                        @endif
                        <li class="font-sz">Dirección: {{ $custodio->dir_custodio }}</li>
                        @if($custodio->cod_tipo_custodio == 2)
                        <li class="font-sz">Tipo de custodio: {{ $custodio->tipoCustodio->tipo_custodio }}</li>
                        <li class="font-sz">Departamento: {{ $custodio->municipio->departamento->nombre_departamento }}</li>
                        @endif
                    </ul>
                </div>
                <h2>Información de su institución</h2>
                <ul>
                    <li class="font-sz">Nombre de institución política: {{ $custodio->partido->nombre_partido }}</li>
                </ul>
                @if($custodio->cod_tipo_custodio != 2)
                <h2>Información Centro de Votación</h2>
                <ul>
                    <li class="font-sz">Departamento: {{ $custodio->municipio->departamento->nombre_departamento }}</li>
                    <li class="font-sz">Municipio: {{ $custodio->municipio->nombre_municipio }}</li>
                    <li class="font-sz">Nombre centro de votación: {{ $custodio->centro->nombre_sector_electoral }}</li>
                    <li class="font-sz">Sector electoral: {{ $custodio->partido->nombre_partido }}</li>
                </ul>
                @endif
            </div>
            <div class="foto">
                <img src="{{ $custodio->avatar }}" alt="Foto del custodio">
            </div>
        </div>
    </div>
</body>
</html>