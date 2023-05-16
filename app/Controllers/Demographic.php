<?php

// namespace App\Controllers;

// use App\Controllers\BaseController;

// use function PHPUnit\Framework\returnSelf;

// class Demographic extends BaseController
// {
//     public function getObj($type,$stateCode)
//     {
//         $curl = curl_init();
//         curl_setopt_array($curl, array(
//             CURLOPT_URL => "kitintellect.tech/demographic-info/public/$type/find/$stateCode",
//             CURLOPT_RETURNTRANSFER => true,
//             CURLOPT_ENCODING => '',
//             CURLOPT_MAXREDIRS => 10,
//             CURLOPT_TIMEOUT => 0,
//             CURLOPT_FOLLOWLOCATION => true,
//             CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//             CURLOPT_CUSTOMREQUEST => 'GET',
//         ));

//      $response = curl_exec($curl);
        
//         curl_close($curl);
//         $response=json_decode($response);

//         if($response->status==200)
//         {
//             return json_encode($response->data[0]);
//         }
//         else
//         {
//             $response->status=204;
//             return $response;
//         }
//     }
   
// }



namespace App\Controllers;

use App\Controllers\BaseController;

use function PHPUnit\Framework\returnSelf;

class Demographic extends BaseController
{
    public function getObj($type,$stateCode)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "kitintellect.tech/demographic-info/public/$type/find/$stateCode",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

     $response = curl_exec($curl);
        
        curl_close($curl);
        $response=json_decode($response);

        if($response->status==200)
        {
            return json_encode($response->data[0]);
        }
        else
        {
            $response->status=204;
            return $response;
        }
    }
   
}
?>









