<?php

class miRateApiService extends miApiService{

    function __construct($_json){
        parent::__construct($_json);
        switch ($this->getMethod()){
            case 'checkDB': $this->checkDB(); break;
			case 'getRateByKey':  $this->getRateByKey(); break;
            case 'getRateList': $this->getRateList(); break;
            /*TO DO*/
            /*
                load data from json (convert excel to json)
                get client info by token
            */
        }
        if ($this->getParamByName('reqType') != 'POST') {
            $this->getJsonDataFromDb();
        }
    }

    private function checkDB() {
        $this->setQuery('select current_database() as dbname, pg_size_pretty(pg_database_size(current_database())) as dbsize');
    }

    private function getRateByKey(){
        $this->setDatatype(emi_res_type::rtARRAY);
        $this->setFieldName('result');
        $this->setQuery('SELECT web.fn_get_ratebykey_json(\''
            .$this->getParamByName('on_date').'\'::date,\''
            .$this->getParamByName('key').'\', '
            .$this->getParamByName('client_id').') AS result');
    }

    private function getRateList(){
        $this->setDatatype(emi_res_type::rtARRAY);
        $this->setFieldName('result');
        $this->setQuery('SELECT web.fn_get_ratelist_json(\''
            .$this->getParamByName('on_date') . '\'::date, '
            .$this->getParamByName('place_to') . ', \''
            .$this->getParamByName('place_from') . '\', '
            .$this->getParamByName('unit_code') . ', '
            .$this->getParamByName('client_id') .', 0, \''
            .$this->getParamByName('token').'\') AS result');
    }

}