<?php

namespace App\Http\Controllers;

use App\ExternalBook;
use Illuminate\Http\Request;

class ExternalController extends Controller
{

    public function searchExternalBooks(Request $request){

        $result = ExternalBook::getExternalBook($request->has($request->name)? $request->name: null);
        $results = json_decode($result, true);
        $data = array();
        if (!empty($result)){
            foreach ($results as $key => $result){
                $data[$key] = array(
                    'name' => $result['name'],
                    'isbn' => $result['isbn'],
                    'author' => $result["authors"],
                    'number Of Pages' => $result["numberOfPages"],
                    'publisher' => $result["publisher"],
                    'country' => $result["country"],
                    'release_date' => $result["released"]
                );
            }
            $response = array(
                "status_code" => 200,
                "status" => "success",
                "data" => $data
            );
            return response($response,200)->header('content-Type','application/json');
        }
        else{
            $response = array(
                "status_code" => 200,
                "status" => "success",
                "message" => $data
            );
            return response($response,200)->header('content-Type','application/json');
        }



    }

    public function renderIt(){
        dd("Ay is mad");
    }
}
