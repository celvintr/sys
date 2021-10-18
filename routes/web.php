<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\CustodiosController;


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

Route::middleware(['auth'])->group(function () {
    #Dashboard (ESTO VA A CAMBIR EN EL FUTURO POR EL DASHBOAR REAL)
    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');

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
        });
          

        #Custodios
        Route::prefix('custodios')->name('custodios.')->group(function () {
            #Agregar custodio
            Route::get('/', [CustodiosController::class, 'index'])->name('index');
            Route::get('/data', [CustodiosController::class, 'data'])->name('data');
            Route::post('/dni', [CustodiosController::class, 'dni'])->name('dni');
            Route::get('/agregar', [CustodiosController::class, 'create'])->name('create');
        });



    });





});

require __DIR__.'/auth.php';
