<?php

//  TODO Обертка ответа сервиса в стандартный ответ REST API

class miAutodispetcherConnector {
    private $_user = "AmsMILaPHEAc";
    private $_pass = "siDiANinGeHe";
    private $_uri = "https://api.avtodispetcher.ru/v1/";
    private $_result = '';
    private $_is_alive = 1;

//    https://api.avtodispetcher.ru/v1/route?from=Уфа&to=Казань
//    https://api.avtodispetcher.ru/v1/cities?q=Ростов&limit=5&onlyCountries[]=RU
//    https://api.avtodispetcher.ru/v1/geocode?q=Воронеж

    function geturl($_param){
        return $this->_uri.'route?from='.urlencode($_param['place_from']).'&to='.urlencode($_param['place_to']);
    }

    function getresult(){
        return $this->_result;
    }

    function __construct($_json){
        $_param = json_decode($_json, TRUE);
	    switch ($_param['method']) {
            case 'getRoute': $this->getRoute($_param); break;
            case 'getRouteExt': $this->getRouteExt($_param); break;
            case 'getCityList': $this->getCityList($_param); break;
            case 'getGeoCode': $this->getGeoCode($_param); break;
        }
    }

    function sendRequest($_url){
      if ($this->_is_alive != 0){
        $ch = curl_init($_url);

        curl_setopt($ch, CURLOPT_USERPWD, join(":", [$this->_user, $this->_pass]));
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['accept: application/json']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        return curl_exec($ch);
      } else {
          return json_encode(array(
            "name" => "Сервис автодиспетчер.ру не доступен в данный момент."
          ));
      }
    }

    function getRoute($_param){
        try {
            $this->_result = json_encode(
                array(
                   'error' => 0,
                   'message' => $this->sendRequest($this->_uri.'route?from='.urlencode($_param['place_from']).'&to='.urlencode($_param['place_to'])),
                   'emessage' => ''
                )
            );
        } catch (Exception $e) {
            $this->_result = json_encode(
                array(
                    'error' => 1,
                    'message' => 'При обращении к сервису возникли ошибки!',
                    'emessage' => $e->getMessage()
                )
            );
        }
    }

    function getRouteExt($_param){
        try {
            $this->_result = json_encode(
                array(
                    'error' => 0,
                    'message' => $this->sendRequest($this->_uri.'route?from='.urlencode($_param['place_from']).'&to='.urlencode($_param['place_to']).'&v='.urlencode($_param['place_across'])),
                    'emessage' => ''
                )
            );
        } catch (Exception $e) {
            $this->_result = json_encode(
                array(
                    'error' => 1,
                    'message' => 'При обращении к сервису возникли ошибки!',
                    'emessage' => $e->getMessage()
                )
            );
        }
    }

    function getCityList($_param){
        try {
            $this->_result = json_encode(
                array(
                    'error' => 0,
                    'message' => $this->sendRequest($this->_uri.'cities?q='.urlencode($_param['place_name']).'&limit=5&onlyCountries[]=RU'),
                    'emessage' => ''
                )
            );
        } catch (Exception $e) {
            $this->_result = json_encode(
                array(
                    'error' => 1,
                    'message' => 'При обращении к сервису возникли ошибки!',
                    'emessage' => $e->getMessage()
                )
            );
        }
    }

    function getGeoCode($_param){
        try {
            $this->_result = json_encode(
                array(
                    'error' => 0,
                    'message' => $this->sendRequest($this->_uri.'geocode?q='.urlencode($_param['place_name'])),
                    'emessage' => ''
                )
            );
        } catch (Exception $e) {
            $this->_result = json_encode(
                array(
                    'error' => 1,
                    'message' => 'При обращении к сервису возникли ошибки!',
                    'emessage' => $e->getMessage()
                )
            );
        }
    }
}
