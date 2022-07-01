<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\ReklameController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UploadController;

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

Route::post('/daftar_user',[UserController::class,'store']);

//Login
Route::post('/login_petugas',[UserController::class,'loginPetugas']);
Route::post('/login',[UserController::class,'login']);

//Insert API
Route::post('/insert_reklame',[ReklameController::class,'store']);
Route::post('/insert_data_survey',[ReklameController::class,'insertDataSurvey']);

//Read API
Route::post('/read_petugas_wastib',[UserController::class,'readPetugasWastib']);
Route::post('/read_maps',[ReklameController::class,'showMaps']);
Route::post('/read_maps_petugas',[ReklameController::class,'showReklamePetugas']);
Route::post('/read_reklame_belum_di_verifikasi',[ReklameController::class,'readReklameBelumDiVerifikasi']);
Route::post('/read_reklame_sudah_di_verifikasi',[ReklameController::class,'readBerkasSudahDiverifikasi']);
Route::post('/read_reklame_kurang',[ReklameController::class,'readBerkasKurang']);
Route::post('/read_reklame',[ReklameController::class,'readReklame']);
Route::post('/read_reklame_detail',[ReklameController::class,'readDetailReklame']);
Route::post('/read_user',[UserController::class,'readUser']);
Route::post('/detail_survey_reklame',[ReklameController::class,'detailDataSurvey']);
Route::post('/read_data_survey',[ReklameController::class,'dataSurvey']);
Route::post('/show_image_survey',[ReklameController::class,'showImageReklame']);

//Update API
Route::put('/update_status_reklame',[ReklameController::class,'changeStatus']);
Route::put('/update_status_reklame_belum_diverifikasi',[ReklameController::class,'changeStatusBerkasSudahDiVerifikasi']);
Route::put('/update_status_reklame_berkas_kurang',[ReklameController::class,'changeStatusBerkasKurang']);
Route::put('/update_password',[UserController::class,'updatePassword']);
Route::put('/update_user',[UserController::class,'updateUser']);

//Delete 
Route::post('/delete_reklame',[ReklameController::class,'deleteReklame']);

//Upload
Route::post('/upload_reklame',[UploadController::class,'proses_upload']);

Route::post('/read_upload_reklame',[UploadController::class,'readUploadData']);
Route::post('/delete_berkas',[UploadController::class,'deleteBerkas']);

//Download Image
Route::post('/download_file',[UploadController::class,'downloadBerkas']);








