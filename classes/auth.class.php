<?php

class miAuthConnector extends miApiService {

    private function getUserId(){
        $this->setQuery('SELECT auth.fn_get_userid_by_token(\''
            . $this->getParamByName('token') . '\') as user_id;');
        $_res = $this->getDataResultFromDb();
        return $_res['data'][0]['user_id'];
    }

    function __construct($_json){
        parent::__construct($_json);
        switch ($this->getMethod()){
            case 'auth': $this->auth(); break;
            case 'check': $this->check(); break;
            case 'getClientByToken': $this->getClientByToken(); break;
            case 'addUser': $this->addUser(); break;
            case 'removeUser': $this->removeUser(); break;
            case 'patchUser': $this->patchUser(); break;
            case 'getClientUserList': $this->getClientUserList(); break;
        }
            $this->getJsonDataFromDb();
    }

    function auth(){
        $this->setDatatype(emi_res_type::rtARRAY);
        $this->setFieldName('data');
        $this->setQuery('SELECT auth.fn_auth(\''
            .$this->getParamByName('user') .'\', \''
            .$this->getParamByName('mixed') .'\', '
            .$this->getParamByName('key') .') as data;');
    }

    function check(){
        $this->setDatatype(emi_res_type::rtARRAY);
        $this->setFieldName('result');
        $this->setQuery('SELECT auth.fn_checkkey(\''
            .$this->getParamByName('token') .'\') as result;');
    }

    function getClientByToken(){
        if ($this->checkToken()){
            $this->setQuery('SELECT auth.fn_get_client_id_by_token(\''
                . $this->getParamByName('token') . '\') as client_id;');
        }
    }

    function addUser(){
        $this->setDatatype(emi_res_type::rtARRAY);
        $this->setFieldName('data');
        $this->setQuery('SELECT auth.fn_add_user(\''
            .$this->getParamByName('user') .'\', \''
            .$this->getParamByName('mixed') .'\', '
            .$this->getParamByName('key') .') as data;');
    }

    function removeUser(){
        if ($this->checkToken()) {
            $this->setDatatype(emi_res_type::rtARRAY);
            $this->setFieldName('data');
            $this->setQuery('SELECT auth.fn_delete_user(\''
                . $this->getParamByName('user') . '\', \''
                . $this->getParamByName('token') . '\') as data;');
        }
    }

    function patchUser(){
        if ($this->checkToken()){
            $this->patchRecord('auth.prc_users', 'id', $this->getUserId(),
                json_encode(
                    array(
                        'first_name' => $this->getParamByName('first_name'),
                        'second_name' => $this->getParamByName('second_name'),
                        'midle_name' => $this->getParamByName('midle_name'),
                        'phone_number' => $this->getParamByName('phone_number'),
                        'email' => $this->getParamByName('email'),
                    )
                ));
        }
    }

    function getClientUserList(){
        if ($this->checkToken()){
            $this->setQuery('SELECT auth.fn_get_client_list() as client_list;');
        }
    }
}