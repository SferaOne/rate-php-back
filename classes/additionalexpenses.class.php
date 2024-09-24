<?php

class miAdditionalExpensesApiService extends miApiService{

    function __construct($_json){
        parent::__construct($_json);
        switch ($this->getMethod()){
            case 'getAdditionalExpensesByKey': $this->getAdditionalExpensesByKey(); break;
        }
        $this->getJsonDataFromDb();
    }

    function getAdditionalExpensesByKey(){
        $this->setDatatype(emi_res_type::rtARRAY);
        $this->setFieldName('result');
        $this->setQuery('SELECT fruityloops.fn_get_additional_expenses_rate(\''.$this->getParamByName('key').'\''.') AS result');
    }
}