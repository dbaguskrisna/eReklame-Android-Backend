<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\UserController;

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

Route::get('/master_kecamatan',[MasterController::class,'index']);
Route::post('/daftar_user',[UserController::class,'store']);
Route::post('/login',[UserController::class,'login']);
Route::post('/read_user',[UserController::class,'readUser']);
Route::put('/update_password',[UserController::class,'updatePassword']);
