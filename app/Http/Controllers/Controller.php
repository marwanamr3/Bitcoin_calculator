<?php

namespace App\Http\Controllers;

use GuzzleHttp\Exception\RequestException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use GuzzleHttp\Client;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function index(Request $request){
        $client = new Client();
        try {
            $response = $client->request('GET', 'https://api.coindesk.com/v1/bpi/historical/close.json?start='.$request['from'].'&end='.$request['to']);
            $body = $response->getBody()->getContents();
        }catch (RequestException $e){
            var_dump($e->getMessage());
        }

        return view('welcome', ['body' => $body]);
    }
}
