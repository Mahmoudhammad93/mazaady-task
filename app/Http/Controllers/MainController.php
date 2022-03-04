<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function get_all_cats(Client $client){
        $res = $client->request('GET', 'https://staging.mazaady.com/api/get_all_cats');
        return $res->getBody();
    }

    public function get_sub_cats(Client $client, $id){
        $res = $client->request('GET', 'https://staging.mazaady.com/api/get_all_cats/');
        return $res->getBody();
    }

    public function get_models(Client $client, $id){
        $res = $client->request('GET', 'https://staging.mazaady.com/api/get-options-child/'.$id);
        return $res->getBody();
    }

    public function get_properties(Client $client, $id){
        $res = $client->request('GET', 'https://staging.mazaady.com/api/properties?cat='.$id);
        return $res->getBody();
    }
}
