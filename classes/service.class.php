<?php

if (!include("miRec.php")) { include "miRec.php"; }

class miApiService{
    private $_result = '';
    private $_param = [];
    private $_query = '';
    private $_datatype = emi_res_type::rtJSON;
    private $_fieldName = 'result';

    public function checkToken() {
        $this->setQuery('SELECT auth.fn_checktoken(\''
            .$this->getParamByName('token') .'\') AS result');
        $_res = $this->getDataResultFromDb();
        return $_res['data'][0]['result'] == 1;
    }

    public function getClientId() {
        $this->setQuery('SELECT auth.fn_get_client_id_by_token(\''
            . $this->getParamByName('token') . '\') as client_id;');
        $_res = $this->getDataResultFromDb();
        return $_res['data'][0]['client_id'];
    }

    public static function getClientIdByToken($_token) {
        try {
            $_dbw = new dataWrapper('SELECT auth.fn_get_client_id_by_token(\'' . $_token . '\') as client_id;', '', true);
            $_dbw->setResultType(emi_res_type::rtARRAY);
            $_data = $_dbw->getData();
            return $_data[0]['client_id'];
        } catch (Exception $e) {
            return -1;
        }
    }

    public function getResult(): string
    {
        return $this->_result;
    }

    public function getJsonDataFromDb(){
        try {
            $_dbw = new dataWrapper($this->_query, '', true);
            if ($this->_datatype == emi_res_type::rtARRAY){
                $_dbw->setResultType(emi_res_type::rtARRAY);
                $_data = $_dbw->getData();
                $_result = $_data[0][$this->_fieldName];
            } else {
                $_result = $_dbw->getJSON();
            }
            $this->setResult(
                json_encode(
                    array(
                        'error' => 0,
                        'message' => $_result,
                        'emessage' => ''
                    )
                )
            );

        } catch (Exception $e) {
            $this->setResult(
                json_encode(
                    array(
                        'error' => 1,
                        'message' => 'При обращении к сервису возникли ошибки!',
                        'emessage' => $e->getMessage()
                    )
                )
            );
        }
    }

    public function getDataResultFromDb() {
        try {
            $_dbw = new dataWrapper($this->_query, '', true);
            $_dbw->setResultType(emi_res_type::rtARRAY);
            $_data = $_dbw->getData();
            return array(
                'error' => 0,
                'data' => $_data,
                'emessage' => ''
            );
            } catch (Exception $e) {
                return array(
                        'error' => 1,
                        'message' => 'При обращении к сервису возникли ошибки!',
                        'emessage' => $e->getMessage()
                );
            }
    }

    public function getParamByName($_name){
        return $this->_param[$_name] ?? null;
    }

    public function getMethod(){
        return $this->getparambyname('method');
    }

    public function setQuery(string $_query){
        $this->_query = $_query;
    }

    public function setFieldName(string $_fieldName){
        $this->_fieldName = $_fieldName;
    }

    public function getFieldName(): string {
        return $this->_fieldName;
    }

    /**
     * @param int $datatype
     */
    public function setDatatype(int $datatype)
    {
        $this->_datatype = $datatype;
    }

    /**
     * @return string
     */
    public function getQuery(): string
    {
        return $this->_query;
    }
/*
    public function getResultValueByName($_name){
        $_res = json_decode($this->_result);
        if ($_res['error'] != 1) {
            $_data = json_decode($this->_result)['message'];
            return $_data[$_name]?? null;
        } else { return null;}
    }
*/
    function patchRecord($_tableName, $_keyField, $_keyValue, $_args){
        try {
            $_miRec = new miRec($_tableName, $_keyField, $_keyValue);
            $_miRec->setPartData($_args);
            $this->setResult(
                json_encode(
                    array(
                        'error' => 0,
                        'message' => 'Запрос успешно отправлен!',
                        'emessage' => ''
                    )
                )
            );
        } catch (Exception $e) {
            $this->setResult(
                json_encode(
                    array(
                        'error' => 1,
                        'message' => 'При сохранении возникли ошибки!',
                        'emessage' => $e->getMessage()
                    )
                )
            );
        }
    }

    function __construct($_json){
        $this->_param = json_decode($_json, TRUE);
    }

    function setResult($_result){
        $this->_result = $_result;
    }

    function setStab(){
        $this->setResult(
            json_encode(
                array(
                    'error' => 0,
                    'message' => json_encode($this->_param),
                    'emessage' => ''
                )
            )
        );
    }
}