<?php

use App\Http\Middleware\LocaleCookieMiddleware;
use GuzzleHttp\Promise\Create;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/offline', function () {
    return view('vendor/laravelpwa/offline');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/index', function () {
        return view('index');
    })->name('index');
});



Auth::routes();




Route::get('/locale/{locale}', function ($locale) {
    session()->put('locale', $locale);
    return Redirect::back();
});

Route::get('/index', [App\Http\Controllers\HomeController::class, 'index'])->name('index');
Route::resource('servicios', App\Http\Controllers\ServicioController::class)->Middleware('auth');
Route::resource('actividades-fijas', App\Http\Controllers\ActividadesFijaController::class)->Middleware('auth');
Route::resource('clientes', App\Http\Controllers\ClienteController::class)->Middleware('auth');
Route::resource('embarques', App\Http\Controllers\EmbarqueController::class)->Middleware('auth');
Route::resource('actividadembarques', App\Http\Controllers\ActividadembarqueController::class)->Middleware('auth');
Route::resource('comentarios', App\Http\Controllers\ComentarioController::class)->Middleware('auth');
Route::resource('contactos', App\Http\Controllers\ContactoController::class)->Middleware('auth');
Route::resource('anticipos', App\Http\Controllers\AnticipoController::class)->Middleware('auth');

Route::get('comentariover/{id}', [App\Http\Controllers\ComentarioController::class, 'ver'])->name('comentario.ver');
Route::get('embarques.indexc', [App\Http\Controllers\EmbarqueController::class, 'indexc'])->name('embarques.indexc');
Route::get('/contacto/{empresa}', [App\Http\Controllers\ContactoController::class, 'create'])->name('contacto');
Route::get('/contactoe/{id}/{empresa}', [App\Http\Controllers\ContactoController::class, 'edit'])->name('contactoe');
Route::get('/anticipo/{empresa}', [App\Http\Controllers\AnticipoController::class, 'create'])->name('anticipo');
Route::get('/anticipoe/{id}/{empresa}', [App\Http\Controllers\AnticipoController::class, 'edit'])->name('anticipoe');
Route::get('pendientes', [App\Http\Controllers\ActividadembarqueController::class, 'pendientes'])->name('pendientes');

Route::get('/imprimir/{id}', [App\Http\Controllers\ClienteController::class, 'imprimir'])->name('imprimir');
Route::post('/embarquesporfecha', [App\Http\Controllers\EmbarqueController::class, 'embarquesporfecha'])->name('embarquesporfecha');
Route::post('/embarquesporfechac', [App\Http\Controllers\EmbarqueController::class, 'embarquesporfechac'])->name('embarquesporfechac');
Route::get('reporteembarques', [App\Http\Controllers\EmbarqueController::class, 'reportes'])->name('reporteembarques');
Route::post('reportependientes', [App\Http\Controllers\EmbarqueController::class, 'pendientes'])->name('reportependientes');


Route::get('/enviar', [App\Http\Controllers\ClienteController::class, 'enviar']);

Route::get('chart-data/Completada', [App\Http\Controllers\HomeController::class, 'getChartData']);
