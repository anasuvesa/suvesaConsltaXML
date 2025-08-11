<?php

use App\Http\Controllers\ComprobanteController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::middleware('throttle:30,1')->group(function () {
    Route::get('/comprobante/{clave}', [ComprobanteController::class, 'show']);
});

Route::get('/comprobantes/{clave}/descargar/{tipo}', [ComprobanteController::class, 'descargarWeb'])->name('comprobantes.descargar');