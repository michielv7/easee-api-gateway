<?php
namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Http;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function getRickAndMorty($characterId){
        $response = Http::get('https://rickandmortyapi.com/api/character/'.$characterId);
        $jsonData = $response->json();

        $xml_data = new \SimpleXMLElement('<?xml version="1.0"?><data></data>');

        $this->arrayToXML($jsonData, $xml_data);
        
        $result = $xml_data->asXML('test.xml');

        return response(file_get_contents(public_path('test.xml')), 200, [
            'Content-Type' => 'application/xml'
        ]);
    }

    function arrayToXML($data, $xml_data){
        foreach( $data as $key => $value ) {
            if( is_array($value) ) {
                if( is_numeric($key) ){
                    $key = 'item'.$key;
                }
                $subnode = $xml_data->addChild($key);
                $this->arrayToXML($value, $subnode);
            } else {
                $xml_data->addChild("$key",htmlspecialchars("$value"));
            }
         }
    }
}
