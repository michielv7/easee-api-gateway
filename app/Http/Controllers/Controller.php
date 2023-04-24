<?php
namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function getRickAndMorty($characterId){
        $response = Http::get('https://rickandmortyapi.com/api/character/'.$characterId);
        $jsonData = $response->json();

        return $jsonData;
    }

    public function createRandomFile(Request $request){
        $random = $request->all();
        Log::info($random);
        $data = [ 'status' => 'success'];
        return response()->json($data, 200);
    }
}
