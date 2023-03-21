<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Symfony\Bridge\PsrHttpMessage\Factory\HttpFoundationFactory;

class EaseeController extends Controller
{     
    public function getRequest($url, $bearerToken){
        $response = Http::withHeaders([
            'Authorization' => $bearerToken,
            'accept' => 'application/json',
        ])->get($url);
        $jsonData = $response->json(); 
        return $jsonData;
    }


    public function getState(string $chargerId, string $bearerToken)
    {       
        return $this->getRequest(env('URL').$chargerId.'/state', $bearerToken);
        
    }


    public function getPowerUsage(string $chargerId, string $from, string $to, string $bearerToken)
    {
        return $this->getRequest(env('URL').$chargerId.'/usage/hourly/'.$from.'/'.$to, $bearerToken);
    }


    public function getChargerDetails(string $chargerId, string $bearerToken)
    {
        return $this->getRequest(env('URL').$chargerId.'/details', $bearerToken);
    }

    public function getConfiguration(string $chargerId, string $bearerToken)
    {
        return $this->getRequest(env('URL').$chargerId.'/config', $bearerToken);
    }

    public function getStateOnline(string $chargerId, string $bearerToken)
    {
        $jsonData = $this->getRequest(env('URL').$chargerId.'/state', $bearerToken);
        return $jsonData['isOnline'] ? 'True' : 'False';
    }


    public function changeChargerSettingsEnabled(string $chargerId, $boolean, string $bearerToken){
        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', env('URL').$chargerId.'/settings', [
            'body' => '{"enabled":'.$boolean.'}',
            'headers' => [
              'Authorization' => $bearerToken,
              'content-type' => 'application/*+json',
            ],
          ]);
        return json_decode($response->getBody());
    }
    
    public function changeChargerSettingsMaxChargerCurrent(string $chargerId, $float, $bearerToken){
        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', env('URL').$chargerId.'/settings', [
            'body' => '{"maxChargerCurrent":'.$float.'}',
            'headers' => [
              'Authorization' => $bearerToken,
              'content-type' => 'application/*+json',
            ],
          ]);
        return json_decode($response->getBody());
    }

    public function changeChargerSettingsLedStripBrightness(string $chargerId, $int32, $bearerToken){
        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', env('URL').$chargerId.'/settings', [
            'body' => '{"ledStripBrightness":'.$int32.'}',
            'headers' => [
              'Authorization' => $bearerToken,
              'content-type' => 'application/*+json',
            ],
          ]);
        return json_decode($response->getBody());
    }

    public function changeChargerSettingsDynamicChargerCurrent(string $chargerId, $float, $bearerToken){
        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', env('URL').$chargerId.'/settings', [
            'body' => '{"dynamicChargerCurrent":'.$float.'}',
            'headers' => [
              'Authorization' => $bearerToken,
              'content-type' => 'application/*+json',
            ],
          ]);
        return json_decode($response->getBody());
    }
    
}

?>