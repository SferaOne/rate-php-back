<?php

class miShipScheduleApiService extends miApiService{

    function __construct($_json){
        parent::__construct($_json);
        switch ($this->getMethod()){
            case 'getShipScheduleByKey': $this->getShipScheduleByKey(); break;
        }
        $this->getJsonDataFromDb();
    }

    function getShipScheduleByKey(){
        $this->setDatatype(emi_res_type::rtARRAY);
        $this->setFieldName('result');
        $this->setQuery('SELECT fruityloops.fn_get_shipschedulebykey(\''
        .$this->getParamByName('key').'\',\''
        .$this->getParamByName('on_date').'\'::date'
        .') AS result');
    }
}