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
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/character/{characterId}', [Controller::class, 'getRickAndMorty']);

Route::get('/state/{chargerId}',  [EaseeController::class, 'getState']);

Route::get('/power-usage/{chargerId}/{from}/{to}',  [EaseeController::class, 'getPowerUsage']);

Route::get('/charging-details/{chargerId}',  [EaseeController::class, 'getChargerDetails']);

Route::post('/change-charger-settings{chargerId}/{enabled}/
            {enableIdleCurrent}/{limitToSinglePhaseCharging}/
            {lockCablePermanently}/{smartButtonEnabled}/
            {phaseMode}/{smartCharging}/{localPreAuthorizeEnabled}
            {localAuthorizeOfflineEnabled}/{allowOfflineTxForUnknownId}
            {offlineChargingMode}/{authorizationRequired}/{remoteStartRequired}
            {ledStripBrightness}/{maxChargerCurrent}/{dynamicChargerCurrent}', [EaseeController::class, 'changeChargerSettings']);
            
Route::post('/get-configuration/{chargerId}', [EaseeController::class, 'getConfiguration']);




