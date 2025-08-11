<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ComprobanteController;
use App\Http\Controllers\SolicitudapiController;
use illuminate\Support\Facades\Route;


Route::get('saludo', function(){
    return 'Hola';
});
//Route::post('register', [AuthController::class, 'register']);
Route::post('v1/login', [AuthController::class, 'login'])->name('login');

Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers', 'middleware' => 'jwt.auth'], function () {
    Route::get('who', [AuthController::class, 'who']);    
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('comprobante', [ComprobanteController::class, 'store']);
    Route::get('solicitud', [SolicitudapiController::class, 'index']);    
});

