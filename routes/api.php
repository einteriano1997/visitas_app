<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\VisitanteController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'api'], function () {


        // Rutas para el controlador de visitantes
      
        Route::post('/visitors', [VisitanteController::class, 'store']);
        Route::get('/visitors/{id}', [VisitanteController::class, 'show']);
        Route::put('/visitors/{id}', [VisitanteController::class, 'update']);
        Route::delete('/visitors/{id}', [VisitanteController::class, 'destroy']);
        

    // Rutas para el controlador de reportes
    Route::get('/reports', [ReportController::class, 'index']);
    Route::post('/reports', [ReportController::class, 'store']);
    Route::get('/reports/{id}', [ReportController::class, 'show']);
    Route::put('/reports/{id}', [ReportController::class, 'update']);
    Route::delete('/reports/{id}', [ReportController::class, 'destroy']);


});

