<?php

namespace App\Http\Controllers\master;

class Api
{
    public static  function send_curl($url = null, $postfield = null)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $postfield
        ));

        $result1 = curl_exec($curl);
        $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $error_msg = curl_errno($curl) ? curl_error($curl) : "";
        curl_close($curl);

        return array(
            "http_code" => $http_code,
            "error_msg" => $error_msg,
            "data" => json_decode($result1)
        );
    }

    public static  function send_curl_raw($url = null, $postfield = null)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($postfield),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: text/plain'
            ),
        ));

        $result = curl_exec($curl);
        $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $error_msg = curl_errno($curl) ? curl_error($curl) : "";
        curl_close($curl);

        return array(
            "http_code" => $http_code,
            "error_msg" => $error_msg,
            "result" => json_decode($result)
        );
    }

    public static  function send_curl_get($url = null)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $result1 = curl_exec($curl);
        $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $error_msg = curl_errno($curl) ? curl_error($curl) : "";
        curl_close($curl);

        return  $result1;
    }

    // public static function send_curl_raw($url, $postfield)
    // {
    //     $curl = curl_init();
    //     curl_setopt($curl, CURLOPT_URL, $url);
    //     curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    //     curl_setopt($curl, CURLOPT_POST, 1);
    //     curl_setopt($curl, CURLOPT_POSTFIELDS, $postfield);
    //     curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    //     // curl_setopt($curl, CURLOPT_VERBOSE,true);

    //     $result = curl_exec($curl);
    //     $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    //     $error_msg = curl_errno($curl) ? curl_error($curl) : "";
    //     curl_close($curl);

    //     return array(
    //         "http_code" => $http_code,
    //         "error_msg" => $error_msg,
    //         "result" => $result,
    //         "postfield" => $postfield
    //     );
    // }
}
