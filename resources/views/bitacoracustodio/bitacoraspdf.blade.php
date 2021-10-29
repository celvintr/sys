<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Datos de bitacora de custodio</title>
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
            padding: 30px;
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
                    <p class="mg-bt-none font-sz"><span><strong>Fecha y Hora de Bitacora:</strong> {{ now() }}</span></p>
                    <p class="mg-bt-none font-sz"><span><strong>DNI de usuario que generó la acción:</strong> {{ $usuarioAccion->dni_usuario }}</span></p>
                    <p class="mg-bt-none font-sz"><span><strong>Nombre usuario que generó la acción:</strong> {{ $usuarioAccion->nombre_usuario }}</span></p>
                    <p class="mg-bt-none font-sz"><span><strong>Acción ejecutada:</strong> {{ $bitacora->accion }}</span></p>
                </div>
                <div class="info-personal">
                    <h2>Información de Bitacora</h2>
                    <ul>
                        <li class="font-sz">DNI Custodio afectado: {{ $bitacora->dni_custodio }}</li>
                        <li class="font-sz">Cod Custodio afectado: {{ $custodio->cod_custodio }}</li>
                        <li class="font-sz">Custodio afectado: {{ $custodio->nombre_custodio }}</li>
                    </ul>
                    <h2>Información Resumen del estado del custodio</h2>
                    <p>{{ $bitacora->descripcion }}</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>