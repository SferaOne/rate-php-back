<?php

class miLoaderController extends miApiService{
    private $_map = [];
    private $_error_flag = 0;

    function __construct($_json)
    {
        parent::__construct($_json);
        $this->getLoaderMap();
        if ($this->_error_flag == 0) {
            switch ($this->getMethod()) {
                case 'rate.validate': $this->ratevalidate();break;
                case 'ship.schedule.validate': $this->shipschedulevalidate(); break;
                case 'additional.expenses.validate': $this->additionalexpensesvalidate(); break;
            }
        }
 //       $this->getJsonDataFromDb();
    }

    function getLoaderMap(){
        $this->setDatatype(emi_res_type::rtARRAY);
        $this->setQuery('SELECT file_field_name, tbl_field_name FROM web.ref_map_loader_bc WHERE loader_type = '.$this->getParamByName('type'));
        $this->_map = $this->getDataResultFromDb();
        if ($this->_map['error'] != 1){
            $this->_map = $this->_map['data'];
        } else {
            $this->_error_flag = 1;
            $this->setResult(json_encode($this->_map));
        }
    }

    function ratevalidate(){
        $_clientId = $this->getClientId();
        foreach($this->getParamByName('data') as $_record) {
            foreach($this->_map as $_entry) {
                if ($_entry['file_field_name'] == 'ClientID')
                    $_rec[$_entry['tbl_field_name']] = $_clientId;
                else
                    if (isset($_record[$_entry['file_field_name']]))
                        $_rec[$_entry['tbl_field_name']] = $_record[$_entry['file_field_name']];
            }
        }
        $_miRec = new miRec('temp.temp_data_loader', 'id');
        echo json_encode($_rec);
        $_miRec->setPartData(json_encode($_rec));
        $this->setStab();
    }

    function shipschedulevalidate(){
        $this->setStab();
    }

    function additionalexpensesvalidate(){
        $this->setStab();
    }
}