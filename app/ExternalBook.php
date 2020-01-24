<?php

namespace App;

use http\Env\Response;
use Illuminate\Database\Eloquent\Model;

class ExternalBook extends Model
{
    public static function getExternalBook($book_name = null){
        $curl_url = "https://www.anapioficeandfire.com/api/books?name=".$book_name;
        $curl_url = str_replace(" ", '%20', $curl_url);
        try{
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => $curl_url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array(
                    "Accept: */*",
                    "Cache-Control: no-cache",
                    "Connection: keep-alive",
                    "Host: www.anapioficeandfire.com",
                    "Postman-Token: 4ac17eb5-219d-4ce9-8342-38c3ef98173f,ab90241b-cd6d-4ce5-a2d4-57bcd0484203",
                    "User-Agent: PostmanRuntime/7.13.0",
                    "accept-encoding: gzip, deflate",
                    "cache-control: no-cache",
                    "cookie: __cfduid=dcde1155d02bd5c81ca65e4872588e8fa1579762609; ARRAffinity=8f31b81e775d9a1e3d38d067119638547ca220388d8401d23b711188f8639de7"
                ),
            ));
            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);
            return $response;

        }
        catch (\Exception $exception) {
            return redirect()->back()->with("failure", $exception->getMessage())->withInput();
        }

    }
}
