<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RolesyPermisosController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\CustodiosController;

use App\Http\Controllers\BitacoraController;


use App\Http\Controllers\DepartamentosController;
use App\Http\Controllers\MunicipiosController;
use App\Http\Controllers\RolesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

Route::get('/api/municipios/{cod_departamento}', [DepartamentosController::class, 'municipios'])->name('api.municipios');
Route::get('/api/centros/{cod_municipio}', [MunicipiosController::class, 'centros'])->name('api.centros');

Route::middleware(['auth'])->group(function () {
    #Dashboard (ESTO VA A CAMBIR EN EL FUTURO POR EL DASHBOAR REAL)
    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard2');

    /**
     * RUTAS PARA EL ADMIN
     */
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::group(['middleware' => ['role:Administrador del sistema']], function () {
            #Usuarios
            Route::prefix('usuarios')->name('usuarios.')->group(function () {
                #Agregar usaurio
                Route::get('/', [UsuariosController::class, 'index'])->name('index');
                Route::get('/data', [UsuariosController::class, 'data'])->name('data');
                Route::get('/agregar', [UsuariosController::class, 'create'])->name('create');
                Route::get('/editar/{dni_usuario}', [UsuariosController::class, 'editar'])->name('editar');
                Route::post('/', [UsuariosController::class, 'store'])->name('store');
                Route::put('/{dni_usuario}', [UsuariosController::class, 'actualizar'])->name('actualizar');
                Route::post('/estatus', [UsuariosController::class, 'estatus'])->name('estatus');
                Route::delete('eliminar-usuario/{dni_usuario}',[UsuariosController::class, 'eliminarusuario'])->name('destroy');
            });

            #Estado de Bitacora
            Route::prefix('bitacoras')->name('bitacoras.')->group(function () {
                Route::get('/', [BitacoraController::class, 'index'])->name('index');
            });

            #Roles y Permisos
            Route::prefix('roles')->name('roles.')->group(function () {
                Route::get('/', [RolesController::class, 'index'])->name('index');
                Route::get('/data', [RolesController::class, 'data'])->name('data');
                Route::get('/agregar', [RolesController::class, 'create'])->name('create');
                Route::get('/editar', [RolesController::class, 'edit'])->name('edit');
                Route::get('/eliminar', [RolesController::class, 'destroy'])->name('destroy');
                //Post
                Route::post('/agregar', [RolesController::class, 'store'])->name('store');
            });
        });

        Route::group(['middleware' => ['role:Operador de sistema']], function () {
            #Custodios
            Route::prefix('custodios')->name('custodios.')->group(function () {
                #Agregar custodio
                Route::get('/', [CustodiosController::class, 'index'])->name('index');
                Route::get('/data', [CustodiosController::class, 'data'])->name('data');
                Route::get('/agregar', [CustodiosController::class, 'create'])->name('create');
                Route::post('/dni', [CustodiosController::class, 'dni'])->name('dni');
                Route::post('/', [CustodiosController::class, 'store'])->name('store');
            });
        });
    });
});

require __DIR__.'/auth.php';
