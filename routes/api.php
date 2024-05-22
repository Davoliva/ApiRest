<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\InvoceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers', 'middleware' => 'auth:sanctum'], function(){
    Route::apiResource('customers',CustomerController::class);
    Route::apiResource('invoices',InvoceController::class);
    //crea una nueva ruta y llama a bukStore
    Route::post('invoices/bulk',['uses' => 'InvoceController@bulkStore']);
});
