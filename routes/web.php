<?php

use App\Http\Controllers\BitacoraController;
use App\Http\Controllers\CustodiosController;
use App\Http\Controllers\DepartamentosController;
use App\Http\Controllers\MunicipiosController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\BitacoraCustodiosController;
use Illuminate\Support\Facades\Route;

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

Route::middleware(['auth', 'estadosesion'])->group(function () {
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

        #Usuarios
        Route::prefix('usuarios')->name('usuarios.')->group(function () {
            #Agregar usaurio
            Route::get('/', [UsuariosController::class, 'index'])->name('index');
            Route::get('/data', [UsuariosController::class, 'data'])->name('data');
            Route::get('/agregar', [UsuariosController::class, 'create'])->name('create');
            Route::get('/ficha/{dni_usuario}', [UsuariosController::class, 'ficha'])->name('ficha');
            Route::get('/ficha/imprimir/{dni_usuario}', [UsuariosController::class, 'fichaImprimir'])->name('ficha.imprimir');
            Route::post('/export', [UsuariosController::class, 'exportExcel'])->name('export');
            Route::get('/editar/{dni_usuario}', [UsuariosController::class, 'editar'])->name('editar');
            Route::post('/', [UsuariosController::class, 'store'])->name('store');
            Route::put('/{dni_usuario}', [UsuariosController::class, 'actualizar'])->name('actualizar');
            Route::post('/estatus', [UsuariosController::class, 'estatus'])->name('estatus');
            Route::delete('eliminar-usuario/{dni_usuario}', [UsuariosController::class, 'eliminarusuario'])->name('destroy');
            Route::post('/dni', [UsuariosController::class, 'dni'])->name('dni');
        });
        Route::group(['middleware' => ['role:3|4']], function () {
            Route::prefix('usuarios')->name('usuarios.')->group(function () {
                Route::get('/buscar', [UsuariosController::class, 'buscar'])->name('buscar');
            });
        });

        #Estado de Bitacora
        Route::prefix('bitacoras')->name('bitacoras.')->group(function () {
            Route::get('/', [BitacoraController::class, 'index'])->name('index');
        });

        Route::prefix('roles')->name('roles.')->group(function () {
            Route::get('/', [RolesController::class, 'index'])->name('index');
            Route::get('/data', [RolesController::class, 'data'])->name('data');
            Route::get('/agregar', [RolesController::class, 'create'])->name('create');
            Route::post('/agregar', [RolesController::class, 'store'])->name('store');
            Route::get('/editar/{role}', [RolesController::class, 'edit'])->name('edit');
            Route::get('/editar', [RolesController::class, 'edit'])->name('edit');
            //Route::get('/eliminar', [RolesController::class, 'destroy'])->name('destroy');
            //Route::get('/eliminar', [RolesController::class, 'destroy'])->name('destroy');
            Route::delete('eliminar/{role}', [RolesController::class, 'destroy'])->name('destroy');

            //Post

            Route::put('/update', [RolesController::class, 'update'])->name('update');

        });

        //  Route::group(['middleware' => ['role:Operador de sistema']], function () {
        #Custodios
        Route::prefix('custodios')->name('custodios.')->group(function () {
            // Agregar custodio
            Route::get('/', [CustodiosController::class, 'index'])->name('index');
            Route::get('/centros/{idMunicipio}/{idPartido}', [CustodiosController::class, 'getCentros'])->name('centros');
            Route::get('/data', [CustodiosController::class, 'data'])->name('data');
            Route::get('/agregar', [CustodiosController::class, 'create'])->name('create');
            Route::post('/dni', [CustodiosController::class, 'dni'])->name('dni');
            Route::post('/', [CustodiosController::class, 'store'])->name('store');

            // Delete
            Route::delete('/delete/{id_custodio}', [CustodiosController::class, 'destroy'])->name('delete');

            // Update
            Route::get('/edit/{id_custodio}', [CustodiosController::class, 'edit'])->name('edit');
            Route::post('/update/{id_custodio}', [CustodiosController::class, 'update'])->name('update');

            // PDF Custodio
            Route::get('/pdf/{id_custodio}', [CustodiosController::class, 'pdf'])->name('pdf');

            // EXCEL Custodio
            Route::get('/excel', [CustodiosController::class, 'descargarExcel'])->name('excel');
        });

        #BitacoraCustodios
        Route::prefix('bitacora-custodios')->name('bitacora-custodios.')->group(function () {
            // Index
            Route::get('/', [BitacoraCustodiosController::class, 'index'])->name('index');

            // PDF Bitacora Custodio
            Route::get('/pdf/{id_bitacora}', [BitacoraCustodiosController::class, 'pdf'])->name('pdf');

            // EXCEL Bitacora Custodio
            Route::get('/excel', [BitacoraCustodiosController::class, 'descargarExcel'])->name('excel');
        });

        Route::get('perfil', [UsuariosController::class, 'perfil'])->name('usuarios.perfil');
        Route::post('perfil', [UsuariosController::class, 'perfilUpdate'])->name('usuarios.perfil.update');

        Route::get('usuarios/password', [UsuariosController::class, 'password'])->name('auth.password');
        Route::post('usuarios/password/actualizar', [UsuariosController::class, 'passwordUpdate'])->name('auth.password.update');

    });
});

require __DIR__ . '/auth.php';
