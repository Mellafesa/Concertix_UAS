<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\tiketController;
use App\Http\Controllers\adminController;
use App\Http\Controllers\pembayaranController;
use App\Http\Controllers\userController;
use App\Http\Controllers\kategoriController;

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


Route::middleware('auth:sanctum')->group(function () {
    Route::post("/logout", [adminController::class,'logout']);
    
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post("/user/logout", [userController::class,'logout']);
    
});

//Public route register login admin
Route::post('/register',[adminController::class, 'register']);
Route::post('/login',[adminController::class, 'login']);
Route::delete("/user/{id}", [adminController::class, 'delete']);

//Public route register login 
Route::post('/user/register',[userController::class, 'register']);
Route::post('/user/login',[userController::class, 'login']);


Route::resource('tikets', tiketController::class)->except(
    ['create', 'edit']
);

Route::resource('pembayarans', pembayaranController::class)->except(
    ['create', 'edit']
);

//KATEGORI
Route::post('/kategoris', [kategoriController::class, 'store']);
Route::get('/kategoris', [kategoriController::class, 'index']);
Route::get('/kategoris/{kategori}', [kategoriController::class, 'show']);
Route::put('/kategoris/{kategori}', [kategoriController::class, 'update']);
Route::delete('/kategoris/{kategori}', [kategoriController::class, 'destroy']);
