<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BitacoraCustodio;
use App\Models\User;
use App\Models\Custodios;
use DB;
use PDF;
use Excel;
use App\Exports\BitacoraCustodioExport;

class BitacoraCustodiosController extends Controller
{
    public function index() {
        $mostrar = request()->has('mostrar') ? request('mostrar') : 10;

        $queries = [];
        $columns = ['dni_custodio', 'fecha_hora_bitacora'];
        $queries['mostrar'] = $mostrar;
        

        $dni = request('dni_custodio');
        $desde = request('fecha_desde') ? request('fecha_desde') : date('Y-m-d');
        $hasta = request('fecha_hasta') ? request('fecha_hasta') : date('Y-m-d');

        $bitacoras = new BitacoraCustodio;
        $totalBitacoras = BitacoraCustodio::all()->count();

        if($dni && $desde && $hasta) {
            $bitacoras = $bitacoras::where('dni_custodio', $dni)->whereDate('fecha_hora_bitacora', '>=', $desde)->whereDate('fecha_hora_bitacora', '<=', $hasta);
            $queries['dni_custodio'] = request('dni_custodio');
            $queries['fecha_desde'] = request('fecha_desde');
            $queries['fecha_hasta'] = request('fecha_hasta');
        }
        
        if(!$dni && $desde && $hasta) {
            $bitacoras = $bitacoras::whereDate('fecha_hora_bitacora', '>=', $desde)->whereDate('fecha_hora_bitacora', '<=', $hasta);
            $queries['fecha_desde'] = request('fecha_desde');
            $queries['fecha_hasta'] = request('fecha_hasta');
        }

        $bitacoras = $bitacoras->paginate($mostrar)->appends($queries);
        
        $ctx = [
            'bitacoras' => $bitacoras,
            'dni' => $dni,
            'desde' => $desde,
            'hasta' => $hasta,
            'total' => $totalBitacoras
        ];
        
        return view('bitacoracustodio.index', $ctx);
    }

    public function pdf($id_bitacora) {
        $bitacora = BitacoraCustodio::find($id_bitacora);
        $usuarioAccion = User::where('dni_usuario', $bitacora->dni_usuario_accion)->first();
        $datosCustodio = Custodios::where('dni_custodio', $bitacora->dni_custodio)->first();
        $ctx = ['bitacora' => $bitacora, 'usuarioAccion' => $usuarioAccion, 'custodio' => $datosCustodio];
        $pdf = PDF::loadView('bitacoracustodio.bitacoraspdf', $ctx);
        $pdf->setPaper('letter', 'letter');
        $pdf->output();
        $dom_pdf = $pdf->getDomPDF();

        $nombreArchivo = 'Bitacora_Custodio.pdf';

        $canvas = $dom_pdf->get_canvas();
        $canvas->page_text(500, 750, "Página {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(0, 0, 0));
        // return view('custodios.custodiopdf', ['custodio' => $bitacora]);
        return $pdf->stream($nombreArchivo);
    }

    public function descargarExcel(Request $request){
        // se obtienenn los datos
        $dni = request('dni_custodio');
        $desde = request('fecha_desde') ? request('fecha_desde') : date('Y-m-d');
        $hasta = request('fecha_hasta') ? request('fecha_hasta') : date('Y-m-d');


        if($dni && $desde && $hasta) {
            $bitacoras = BitacoraCustodio::where('dni_custodio', $dni)->whereDate('fecha_hora_bitacora', '>=', $desde)->whereDate('fecha_hora_bitacora', '<=', $hasta)->get();
        }
        
        if(!$dni && $desde && $hasta) {
            $bitacoras = BitacoraCustodio::whereDate('fecha_hora_bitacora', '>=', $desde)->whereDate('fecha_hora_bitacora', '<=', $hasta)->get();
        }

        // Tipo de excel
        $type = 'xlsx';

        // Fecha
        $now = new \DateTime();
        $now = $now->format('d-m-Y');

        // Nombre del archivo
        $nombreArchivo = 'Bitacora_Custodio_' . $now . '.' . $type;

        // Retorna el archivo de excel
        return Excel::download(new BitacoraCustodioExport($bitacoras), $nombreArchivo);
    }
}
