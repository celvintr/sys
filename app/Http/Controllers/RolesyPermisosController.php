<?php 
namespace App\Http\Controllers;
use Illuminate\Http\Request;
class RolesyPermisosController extends Controller
{


    public function index()
    {
        return view('Roles.index');
    }

 
    public function create()
    {
        return view('Roles.AgregarRol');
    }



}
