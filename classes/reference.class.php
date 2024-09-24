<?php

class miReferenceConnector extends miApiService{
    function __construct($_json){
        parent::__construct($_json);
        switch ($this->getMethod()){
            case 'countryfrom': $this->getCountryFromList(); break;
            case 'countryto': $this->getCountryToList(); break;
            case 'placefrom':  $this->getPlaceFromList(); break;
            case 'placeto':  $this->getPlaceToList(); break;
            case 'unitcode': $this->getUnitCodeList(); break;
        }
        if ($this->getParamByName('reqType') != 'POST') {
            $this->getJsonDataFromDb();
        }
    }

    function getCountryFromList(){
        $this->setQuery('SELECT * FROM web.vw_ref_country_from_list ORDER BY name');
    }

    function getCountryToList(){
        $this->setQuery('SELECT * FROM web.vw_ref_country_to_list ORDER BY name');
    }

    function getPlaceFromList(){
        $this->setQuery('SELECT * FROM web.vw_ref_place_from_list ORDER BY name');
    }

    function getPlaceToList(){
        $this->setQuery('SELECT * FROM web.vw_ref_place_to_list ORDER BY name');
    }

    function getUnitCodeList(){
        $this->setQuery('SELECT * FROM web.vw_ref_unit_code_list ORDER BY name');
    }

}