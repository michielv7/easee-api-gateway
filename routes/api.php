<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\EaseeController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
|  !!!! ID in API SPEC = Serial Number on device !!!

*/

Route::get('/', [EaseeController::class, 'index']);

Route::get('/getConfiguration/{chargerId}/{username}/{password}', [EaseeController::class, 'getConfigurationOld']);
Route::get('/state/{chargerId}/{username}/{password}',  [EaseeController::class, 'getState']);
Route::get('/powerUsage/{chargerId}/{from}/{to}/{username}/{password}',  [EaseeController::class, 'getPowerUsage']);


Route::get('/chargingDetails/{chargerId}/{username}/{password}',  [EaseeController::class, 'getChargerDetails']);

Route::post('/ledstripbrightness', [EaseeController::class, 'setLedstripBrightness']);

Route::post('/maxChargerCurrent', [EaseeController::class, 'setMaxChargerCurrent']);

Route::post('/dynamicChargerCurrent', [EaseeController::class, 'setDynamicChargerCurrent']);

Route::post('/isEnabled', [EaseeController::class, 'setIsEnabled']);

Route::post('/getConfiguration', [EaseeController::class, 'getConfiguration']);

Route::fallback(function(){
    return response()->json([
        'message' => 'Route Not Found'], 404);
});
            
?>




