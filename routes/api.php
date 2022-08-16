<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use Illuminate\Support\Facades\Route;

Route::get('/',function(){
    return response()->json('Funcionou',200);
});
Route::post('/auth', [AuthController::class, 'login'])->name('auth');

Route::middleware('auth:sanctum')->group(function() {
    Route::apiResource('/clientes', ClientController::class);
    Route::apiResource('/produtos', ProductController::class);
    Route::apiResource('/pedidos', SaleController::class);
    Route::put('/pedidos/{id}/pagamento', [SaleController::class, 'changeStatus'])->name('pedidos.changeStatus');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

