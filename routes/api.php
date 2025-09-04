<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\LoginController;
use App\Http\Controllers\API\VehicalController;

Route::get('/vehical-list', [VehicalController::class,'vehicleList'])->middleware('auth:sanctum');

Route::post('/vehical-map/{vehicalNo}', [VehicalController::class,'vehicalMap'])->middleware('auth:sanctum');
     
Route::get('/vehical-matrixview', [VehicalController::class,'matrixView'])->middleware('auth:sanctum');


Route::post('/route-playback/{imeiNo}', [VehicalController::class,'routePlayBack'])->middleware('auth:sanctum');

Route::post('/stopage/{imeiNo}', [VehicalController::class,'stopage'])->middleware('auth:sanctum');

Route::post('/over-speed/{imeiNo}', [VehicalController::class,'overSpeed'])->middleware('auth:sanctum');

Route::get('geofences/{imeiNo}', [VehicalController::class,'geofences'])->middleware('auth:sanctum');

Route::post('/check-geofence', [VehicalController::class,'checkGeofence'])->middleware('auth:sanctum');
Route::post('/set-geofences', [VehicalController::class,'setGeoFence'])->middleware('auth:sanctum');
Route::get('/geofences/{imeiNo}', [VehicalController::class,'getGeoFence'])->middleware('auth:sanctum');
Route::get('/geofences',[VehicalController::class,'getGeoFenceAll'])->middleware('auth:sanctum');
Route::get('/sos-alert/{imeiNo}', [VehicalController::class,'sosAlert'])->middleware('auth:sanctum');
Route::get('/trip-report/{imei}/{from}/{to}',[VehicalController::class,'tripReport'])->middleware('auth:sanctum');
Route::get('/distance-report/{imei}/{from}/{to}',[VehicalController::class,'getDistanceReport'])->middleware('auth:sanctum');
Route::get('/ignition-report/{imei}/{from}/{to}',[VehicalController::class,'getIgnitionReport'])->middleware('auth:sanctum');
Route::get('/idle-report/{imei}/{from}/{to}',[VehicalController::class,'getIdleReport'])->middleware('auth:sanctum');
Route::get('/moving-report/{imei}/{from}/{to}',[VehicalController::class,'getMovingReport'])->middleware('auth:sanctum');
Route::get('/parking-report/{imei}/{from}/{to}',[VehicalController::class,'getParkingReport'])->middleware('auth:sanctum');

Route::post('/login', [LoginController::class,'login']);
