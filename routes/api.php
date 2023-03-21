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
Route::get('/character/{characterId}', [Controller::class, 'getRickAndMorty']);

Route::get('/getConfiguration/{chargerId}/{bearerToken}', [EaseeController::class, 'getConfiguration']);
Route::get('/state/{chargerId}/{bearerToken}',  [EaseeController::class, 'getState']);
Route::get('/stateOnline/{chargerId}/{bearerToken}',  [EaseeController::class, 'getStateOnline']);
Route::get('/powerUsage/{chargerId}/{from}/{to}/{bearerToken}',  [EaseeController::class, 'getPowerUsage']);
Route::get('/chargingDetails/{chargerId}/{bearerToken}',  [EaseeController::class, 'getChargerDetails']);
Route::get('/changeChargerSettings/changeChargerState/{chargerId}/{boolean}/{bearerToken}', [EaseeController::class, 'changeChargerSettingsEnabled']);
Route::get('/changeChargerSettings/maxChargerCurrent/{chargerId}/{float}/{bearerToken}',  [EaseeController::class, 'changeChargerSettingsMaxChargerCurrent']); //SET MAX AMPERE
Route::get('/changeChargerSettings/ledStripBrightness/{chargerId}/{int32}/{bearerToken}',  [EaseeController::class, 'changeChargerSettingsLedStripBrightness']); //SET LEDBAR BRIGHTNESS HIGHER / LOWER
Route::get('/changeChargerSettings/dynamicChargerCurrent/{chargerId}/{float}/{bearerToken}',  [EaseeController::class, 'changeChargerSettingsDynamicChargerCurrent']);

Route::fallback(function(){
    return response()->json([
        'message' => 'Route Not Found'], 404);
});
            
?>




