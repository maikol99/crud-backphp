<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\productoController;


Route::middleware('auth:sanctum')->get('/user',function (request $request){
    return $request->user();
});



Route::get('producto',[productoController::class,'index']);
Route::post('producto',[productoController::class, 'store']);
Route::get('producto/{id}', [productoController::class, 'show']);
Route::get('producto/{id}/edit', [productoController::class, 'edit']);
Route::put('producto/{id}/edit', [ProductoController::class, 'update']);
Route::delete('producto/{id}/delete', [productoController::class, 'destroy']);










