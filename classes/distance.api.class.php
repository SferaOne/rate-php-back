<?php

class miDistanceApiService{
    private $_url = "https://distanceto.p.rapidapi.com/distance/route";
    private $_key = "f072ea9339mshb7177d7ccef9737p133b4fjsn8d75dfe8411a";
    private $_placeFrom = '';
    private $_placeTo = '';

    function __construct(){ }

    function sendRequest(){
        $_curl = curl_init();
        curl_setopt_array($_curl, [
            CURLOPT_URL => $this->_url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode([
                'route' => [
                    [
                        'name' => $this->_placeFrom
                    ],
                    [
                        'name' => $this->_placeTo
                    ]
                ]
            ]),
            CURLOPT_HTTPHEADER => [
                "X-RapidAPI-Host: distanceto.p.rapidapi.com",
                "X-RapidAPI-Key: ".$this->_key,
                "content-type: application/json"
            ],
        ]);

        $response = curl_exec($_curl);
        $err = curl_error($_curl);
        curl_close($_curl);

        if ($err) {
            return "cURL Error #:" . $err;
        } else {
            return $response;
        }
    }

    function getData($_place_from, $_place_to){
        $this->_placeFrom = $_place_from;
        $this->_placeTo = $_place_to;
        return $this->sendRequest();
    }

    function getDataByJson($_json){
        $_param = json_decode($_json, TRUE);
        $this->_placeFrom = $_param['placeFrom'];
        $this->_placeTo = $_param['placeTo'];
        return $this->sendRequest();
    }
}



