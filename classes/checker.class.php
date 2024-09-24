<?php

class miChecker{
    private $_result = '';

    function getresult(){
        return $this->_result;
    }

    function __construct(){
        try {
            $_dbw = new dataWrapper('select current_database() as dbname, pg_size_pretty(pg_database_size(current_database())) as dbsize', '', true);
            $this->_result = json_encode(
                array(
                    'error' => 0,
                    'message' => $_dbw->getJSON(),
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