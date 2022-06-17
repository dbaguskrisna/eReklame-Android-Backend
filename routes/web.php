<?php

use App\Http\Controllers\MasterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UploadController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/master_kecamatan',[MasterController::class,'index']);
Route::get('/userCreate',[UserController::class,'create']);
Route::post('/userCreate',[UserController::class,'store']);

//uploadfile
