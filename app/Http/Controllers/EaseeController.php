<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Symfony\Bridge\PsrHttpMessage\Factory\HttpFoundationFactory;
use Illuminate\Support\Facades\Log;

class EaseeController extends Controller
{     
    public function getRequest($url, $username, $password){
        $token = $this->getBearerToken($username, $password);
        $response = Http::withHeaders([
            'Authorization' => 'Bearer '.$token,
            'accept' => 'application/json',
        ])->get($url);
        $jsonData = $response->json(); 
        return $jsonData;
    }


    public function getBearerToken($username, $password){
        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', env('URL').'accounts/login', [
          'body' => '{"userName":"'.$username.'","password":"'.$password.'"}',
          'headers' => [
            'content-type' => 'application/*+json',
          ],
        ]);
        $data = json_decode($response->getBody());
        $bearerToken = $data->accessToken;
        return $bearerToken;
    }


    public function getState(string $chargerId, $username, $password)
    {       
        return $this->getRequest(env('URL').'chargers/'.$chargerId.'/state', $username, $password);
        
    }


    public function getPowerUsage(string $chargerId, string $from, string $to, $username, $password)
    {
        return $this->getRequest(env('URL').'chargers/'.$chargerId.'/usage/hourly/'.$from.'/'.$to, $username, $password);
    }


    public function getChargerDetails(string $chargerId, $username, $password)
    {
        return $this->getRequest(env('URL').'chargers/'.$chargerId.'/details', $username, $password);
    }

    public function getConfigurationOld(string $chargerId, $username, $password)
    {
        $response =  $this->getRequest(env('URL').'chargers/'.$chargerId.'/config', $username, $password);
        return $response;
    }

    //outdated
    public function getStateOnline(string $chargerId, $username, $password)
    {
        $jsonData = $this->getRequest(env('URL').'chargers/'.$chargerId.'/state', $username, $password);
        return $jsonData['isOnline'] ? 'True' : 'False';
    }


    public function getConfiguration(Request $request){
        $username = $request->input('username');
        $password = $request->input('password');
        $chargerId = $request->input('chargerId');
        $response =  $this->getRequest(env('URL').'chargers/'.$chargerId.'/config', $username, $password);
        return $response;
    }
    
    
    
    public function setIsEnabled(Request $request){
        $username = $request->input('username');
        $password = $request->input('password');
        $isEnabled = $request->input('brightness');
        $chargerId = $request->input('chargerId');

        $token = $this->getBearerToken($username, $password);
        
        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', env('URL').'chargers/'.$chargerId.'/settings', [
          'body' => '{"enabled":'.$isEnabled.'}',
          'headers' => [
            'Authorization' => 'Bearer '.$token,
            'content-type' => 'application/*+json',
          ],
        ]);
        return json_decode($response->getBody());
    }


    public function setDynamicChargerCurrent(Request $request){
        $username = $request->input('username');
        $password = $request->input('password');
        $dynamicChargerCurrent = $request->input('brightness');
        $chargerId = $request->input('chargerId');

        $token = $this->getBearerToken($username, $password);
        
        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', env('URL').'chargers/'.$chargerId.'/settings', [
          'body' => '{"dynamicChargerCurrent":"'.$dynamicChargerCurrent.'"}',
          'headers' => [
            'Authorization' => 'Bearer '.$token,
            'content-type' => 'application/*+json',
          ],
        ]);
        return json_decode($response->getBody());
    }
    
    public function setLedstripBrightness(Request $request){
        $username = $request->input('username');
        $password = $request->input('password');
        $brigtness = $request->input('brightness');
        $chargerId = $request->input('chargerId');

        $token = $this->getBearerToken($username, $password);
        
        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', env('URL').'chargers/'.$chargerId.'/settings', [
          'body' => '{"ledStripBrightness":"'.$brigtness.'"}',
          'headers' => [
            'Authorization' => 'Bearer '.$token,
            'content-type' => 'application/*+json',
          ],
        ]);
        return json_decode($response->getBody());
    }

    public function setMaxChargerCurrent(Request $request){
        $username = $request->input('username');
        $password = $request->input('password');
        $maxChargerCurrent = $request->input('maxChargerCurrent');
        $chargerId = $request->input('chargerId');

        $token = $this->getBearerToken($username, $password);
        
        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', env('URL').'chargers/'.$chargerId.'/settings', [
          'body' => '{"maxChargerCurrent":"'.$maxChargerCurrent.'"}',
          'headers' => [
            'Authorization' => 'Bearer '.$token,
            'content-type' => 'application/*+json',
          ],
        ]);
        return json_decode($response->getBody());
    }
    
}

?>