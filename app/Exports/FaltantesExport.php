<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class UsuariosExport implements FromView
{
    protected $request;

    function __construct($request)
    {
        $this->request = $request;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        #obtener el filtro del datatable
        $buscar = $this->request['buscar'];
        $estado_usuario = $this->request['estado_usuario'];
        $cod_rol = $this->request['cod_rol'];

        #usuarios
        $query = User::query();

        #filtro lista
        if ($buscar) {
            $query->where(function($q) use ($buscar) {
                $q->where('nombre_usuario', 'LIKE', '%' . $buscar . '%');
                $q->orWhere('dni_usuario', 'LIKE', '%' . $buscar . '%');
                $q->orWhere('cargo_usuario', 'LIKE', '%' . $buscar . '%');
                $q->orWhere('correo_usuario', 'LIKE', '%' . $buscar . '%');
                $q->orWhere('tel_usuario', 'LIKE', '%' . $buscar . '%');
            });
        }
        if ($estado_usuario) {
            $query->where('estado_usuario', $estado_usuario);
        }
        if ($estado_usuario) {
            $query->where('estado_usuario', $estado_usuario);
        }
        if ($cod_rol) {
            $query->whereHas('rol', function($q) use ($cod_rol) {
                $q->where('role_id', $cod_rol);
            });
        }

        #usuarios
        $usuarios = $query->with(['rol', 'partido'])->get();

        return view('usuarios.excel', [
            'usuarios' => $usuarios,
        ]);
    }
}
