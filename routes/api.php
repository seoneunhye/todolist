<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\TodoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/todos',[TodoController::class,'index']);
Route::post('/todos',[TodoController::class,'create']);
Route::get('/todos/{id}',[TodoController::class,'read']);
Route::put('/todos/{id}',[TodoController::class,'update']);
Route::delete('/todos/{id}',[TodoController::class,'delete']);

