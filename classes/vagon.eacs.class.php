<?php

if (!include("phpQuery.php")) { include_once "phpQuery.php"; }

class miVagonEacs {
    private $_base_url = "https://www.vagon-eacs.ru/onlayn-servisy/search_cargo/?q=";
    private $_url_tail = "&where=gng";
    private $_params = '';
    private $_result = '';

    private function createUrl(){
        return $this->_base_url.$this->_params['gng_code'].$this->_url_tail;
    }

    public function getresult(){
        return $this->_result;
    }

    public function __construct($_json){
        $this->_params = json_decode($_json, TRUE);
        $this->parseResponse($this->sendRequest());
    }

    private function sendRequest(){
        return phpQuery::newDocument(file_get_contents($this->createUrl()));
    }

    private function parseResponse($_data){
        $_table = $_data->find('#content table');
        $code_gng = pq($_table)->find("tr:eq(1) td:eq(0)")->text();
        $code_gng_desc = pq($_table)->find("tr:eq(1) td:eq(1)")->text();
        $code_etsng = pq($_table)->find("tr:eq(1) td:eq(2)")->text();
        $code_etsng_desc = pq($_table)->find("tr:eq(1) td:eq(3)")->text();
        $vokhr = pq($_table)->find("tr:eq(1) td:eq(4)")->text();
        $this->_result = json_encode(
            array(
                "code_gng" => $code_gng,
                "code_gng_desc" => $code_gng_desc,
                "code_etsng" => $code_etsng,
                "code_etsng_desc" => $code_etsng_desc,
                "vokhr" => $vokhr,
            )
        );
    }

}
