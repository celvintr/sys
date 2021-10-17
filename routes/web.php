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
        Route::get('/usuarios', [UsuariosController::class, 'index'])->name('usuarios.index');
    });

    Route::prefix('admin')->name('admin.')->group(function () {
        #Custodios
        Route::get('/custodios', [CustodiosController::class, 'index'])->name('custodios.index');
    });

    Route::prefix('admin')->name('admin.')->group(function () {
        #Agregar custodio
        Route::get('/custodios/agregar', [CustodiosController::class, 'create'])->name('custodios.create');
    });

});

require __DIR__.'/auth.php';
