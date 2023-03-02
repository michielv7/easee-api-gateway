<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class EaseeController extends Controller
{
    public function getRequest($url){
        $response = Http::withHeaders([
            'Authorization' => env('AUTHENTICATION_TOKEN_EASEE'),
            'accept' => 'application/json',
        ])->get($url);

        $jsonData = $response->json(); 
        return $jsonData;
    }

    public function getState(string $chargerId)
    {       
        $response = $this->getRequest('https://api.easee.cloud/api/chargers/'.$chargerId.'/state');
        return $response;
    }

    public function getPowerUsage(string $chargerId, string $from, string $to)
    {
        if(validISO8601Date($from)&&validISO8601Date($to)){
            return getRequest('https://api.easee.cloud/api/chargers/'.$chargerId.'/usage/hourly/'.$from.'/'.$to);
        }else{
            return 'Invalid date format';
        }
    }

    function validISO8601Date($value){
        if (!is_string($value)){
            return false;
        }
        $dateTime = \DateTime::createFromFormat(\DateTime::ISO8601, $value);
        if ($dateTime) {
            return $dateTime->format(\DateTime::ISO8601) === $value;
        }
        return false;
    }


    public function getChargerDetails(string $chargerId)
    {
        return getRequest('https://api.easee.cloud/api/chargers/'.$chargerId.'/details');
    }



    public function changeChargerSettings(string $chargerId, 
                                          boolean $enabled, 
                                          boolean $enableIdleCurrent, 
                                          boolean $limitToSinglePhaseCharging, 
                                          boolean $lockCablePermanently, 
                                          boolean $smartButtonEnabled, 
                                          int32 $phaseMode,
                                          boolean $smartCharging,
                                          boolean $localPreAuthorizeEnabled,
                                          boolean $localAuthorizeOfflineEnabled,
                                          boolean $allowOfflineTxForUnknownId,
                                          int32 $offlineChargingMode,
                                          boolean $authorizationRequired,
                                          boolean $remoteStartRequired,
                                          int32 $ledStripBrightness,
                                          double $maxChargerCurrent,
                                          double $dynamicChargerCurrent)
    {
        //implement controle checks for charger

        $response = Http::withHeaders([
            'Authorization' => env('AUTHENTICATION_TOKEN_EASEE'),
            'accept' => 'application/json',
        ])->post('https://api.easee.cloud/api/chargers/'.$chargerId.'/settings',[
            'enabled' => $enabled,
            'enableIdleCurrent' => $enableIdleCurrent,
            'limitToSinglePhaseCharging' => $limitToSinglePhaseCharging,
            'lockCablePermanently' => $lockCablePermanently,
            'smartButtonEnabled' => $smartButtonEnabled,
            'phaseMode' => $phaseMode,
            'smartCharging' => $smartCharging,
            'localPreAuthorizeEnabled' => $localPreAuthorizeEnabled,
            'localAuthorizeOfflineEnabled' => $localAuthorizeOfflineEnabled,
            'allowOfflineTxForUnknownId' => $allowOfflineTxForUnknownId,
            'offlineChargingMode' => $offlineChargingMode,
            'authorizationRequired' => $authorizationRequired,
            'remoteStartRequired' => $remoteStartRequired,
            'ledStripBrightness' => $ledStripBrightness,
            'maxChargerCurrent' => $maxChargerCurrent,
            'dynamicChargerCurrent' => $dynamicChargerCurrent
        ]);
        $jsonData = $response->json(); 
        return $jsonData;
    }



    public function getConfiguration(string $chargerId)
    {
        return getRequest('https://api.easee.cloud/api/chargers/'.$chargerId.'/config');
    }

}

?>