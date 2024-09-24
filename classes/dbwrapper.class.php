<?php

class sqlParam{
    public $name;
    private $param;
    public $type;
    public $value;

    function pName(){
        return ':'.$this->name;
    }

    function trygetType($_value){
            if (strlen($_value) == 1){
                if ($_value == 't') return 'boolean';
                if ($_value == 'f') return 'boolean';
            } else {
                if (is_numeric($_value)) {
                  return 'numeric';
                }
                if (is_bool($_value)){
                    return 'boolean';
                }
                if (is_null($_value)){
                    return 'null';
                } else {
                    return 'string';
                }
                if (strtotime($_value) != 0) {
                  return 'date';
                }
            }
      }

    function stabforbool($_value){
        return ($_value == 't') ? 'true' : 'false' ;
    }

    function __construct($_name = '', $_value = '', $_is_not_new = 1, $_type = 0){
        $this->name = $_name;
        $this->param = $_name;
        if ($_type === 0) {
            $this->type = $this->trygetType($_value);
        } else {
            $this->type = $_type;
        }

        if ($_is_not_new == 1) {
            $this->setvalue($_value);
        }
    }

    function setValue($_value = ''){
        if ($this->type == 'date') {
            $this->value = strftime('%Y-%m-%d', strtotime($_value));
        } else if ($this->type == 'boolean'){
                $this->value = $this->stabforbool($_value);
            } else {
                $this->value = $_value;
            }
    }

    function getValue(){
        if (isset($this->value)) {
            if ($this->checktype('string')){
                return '\''.$this->value.'\'';
            } else if ($this->checktype('date')){
                return '\''.$this->value.'\'::date';
            } else {
                return $this->value;
            }
        } else { return null; }
    }

    function checktype($_type){
        if ($this->type == $_type){
            return true;
        } else {
            return false;
        }
    }
}

class dataWrapper {
    private $res_type;
    public $rdbms_type;
    private $query_val;
    private $param_val;
    public $host;
    public $port;
    public $base;
    public $user;
    public $pass;
    private $params = [];


    function getFullqueryText(){
        if (count($this->params) > 0) $this->prepare();
        return $this->query_val." ".$this->param_val;
    }

    function getQueryByName($_name){
        return new emi_query_val( $_name );
    }

    function __construct($_query, $_params = "", $_israndom = false){
        if (!$_israndom) {
                $this->query_val = $this->getQueryByName($_query);
                $this->param_val = $_params;
        } else {
                $this->param_val = $_params;
                $this->query_val = $_query;
        }
        $this->res_type = 0;
    }

    function setparams($_params = []){
        foreach ($_params as $_param => $_value){
            $this->params[] = new sqlParam($_param, $_value);
        }
    }

    function prepare(){
        foreach ($this->params as $_param){
            $this->query_val = str_replace($_param->pName(), $_param->getValue(), $this->query_val);
        }
    }

    function getconfigfile(){
    	return "../sets/_site";
    }

    function connectionstring($_conf = "sets/_site"){
      /*
          	if (!file_exists($_conf))
          		$_conf = $this->getconfigfile();

              $xml = simplexml_load_file($_conf) or die("Error: Cannot create object");
              $this->host = $xml->database[0]->server;
              $this->port = $xml->database[0]->port;
              $this->base = $xml->database[0]->databasename;
              $this->user = $xml->database[0]->username;
              $this->pass = $xml->database[0]->password;
              $this->rdbms_type = $xml->database[0]->rdbmstype;
      */
              $this->host = "postgres";
              $this->port = 5432;
              $this->base = "Erzus";
              $this->user = "postgres";
              $this->pass = "postgres";
              $this->rdbms_type = 1;
    }

    function setResultType($_value){
        $this->res_type = $_value;
    }

    function getRowCount(){
        $this->connectionstring();
        $db = new emidb_connection($this->rdbms_type, $this->host, $this->port, $this->base, $this->user, $this->pass);
        if ($this->param_val != "ER10001")
            $db->db_query($this->query_val);
        return Count($db->get_data(2));
    }

    function getData($_noresult = 0){
        if (count($this->params) > 0) $this->prepare();
        $this->connectionstring();
        $db = new emidb_connection($this->rdbms_type, $this->host, $this->port, $this->base, $this->user, $this->pass);
        if ($_noresult == 0) {
            if ($this->param_val != "ER10001")
                $db->db_query($this->query_val." ".$this->param_val);
            return $db->get_data($this->res_type);
        } else if ($this->param_val != "ER10001")
                $db->db_exec($this->query_val." ".$this->param_val);
    }

    function getJSON(){
        $this->setResultType(emi_res_type::rtJSON);
        return $this->getData();
    }

    function getJSONEXT(){
        $this->setResultType(emi_res_type::rtJSONEXT);
        return $this->getData();
    }
}

class dbLookupData{
	private $_query;
	private $_data;

	function __construct($_queryname){
        $_datawrapper = new dataWrapper('GETSQLTEXT', ' AND q_name = \''.$_queryname.'\'');
        $_datawrapper->setResultType(emi_res_type::rtARRAY);
        $temp =  $_datawrapper->getData();
        $this->_query = $temp[0]['sql_text'];
	}

	function getList($_keyField = '', $_listField = '', $_parentField = ''){
		$_result = '';
		$this->getData();
        for ($i = -1; $i++ < Count($this->_data) - 1;)
			if (trim($_parentField) != '')
          		$_result = $_result.'<option pid="'.$this->_data[$i][trim($_parentField)].'" value="'.$this->_data[$i][trim($_keyField)].'">'.$this->_data[$i][trim($_listField)].'</option>';
			else
				$_result = $_result.'<option value="'.$this->_data[$i][trim($_keyField)].'">'.$this->_data[$i][trim($_listField)].'</option>';
		return $_result;
	}

	function getListA($_keyField = '', $_listField = '', $_parentField = ''){
		$_result = '';
		$this->getData();
        for ($i = -1; $i++ < Count($this->_data) - 1;)
			if (trim($_parentField) != '')
          		$_result = $_result.'<option pid="'.$this->_data[$i][trim($_parentField)].'" value="'.htmlspecialchars($this->_data[$i][trim($_listField)]).'" id="'.$this->_data[$i][trim($_keyField)].'">';
			else
				$_result = $_result.'<option value="'.htmlspecialchars($this->_data[$i][trim($_listField)]).'" id="'.$this->_data[$i][trim($_keyField)].'">';
		return $_result;
	}

	function getData(){
        $_datawrapper = new dataWrapper($this->_query, '', true);
        $_datawrapper->setResultType(emi_res_type::rtARRAY);
        $this->_data = $_datawrapper->getData();
	}

    function getJSON(){
        $_datawrapper = new dataWrapper($this->_query, '', true);
        $_datawrapper->setResultType(emi_res_type::rtJSON);
        return $_datawrapper->getData();
    }
}

class xmlViewSpec{
    public $_viewName;
    public $_xmlspec;
    public $_id;
    public $_source;

    function __construct($_xmlname = ''){
     //   $this->_source =
        $_db = new dataWrapper('GETXMLSPEC', " AND grid_name = '".$_xmlname."' ");
        $_db->setResultType(2);
        $result = $_db->getData();

        $instance = new self('database');
        $instance->_id = $result[0]["id"];
        $instance->_viewName = $result[0]["name"];
        $instance->_xmlspec = $result[0]["xml_spec"];
    //    new logger($this->_xmlspec, $_xmlname.'.xml');
    }

    function createbyname($_xmlname = ''){
        $_db = new dataWrapper('GETXMLSPEC', " AND grid_name = '".$_xmlname."' ");
        $_db->setResultType(2);
        $result = $_db->getData();

        $instance = new self('database');
        $instance->_id = $result[0]["id"];
        $instance->_viewName = $result[0]["name"];
        $instance->_xmlspec = $result[0]["xml_spec"];

    //    new logger($this->_xmlspec, $_xmlname.'.xml');
    }

//    function createfromfile($_xmlname =''){
//        $instance = new self('file');
//        $instance->_id = $result[0]["id"];
//        $instance->_viewName = $result[0]["name"];
//        $instance->_xmlspec = $result[0]["xml_spec"];
//    }
}

function getSettingByName($_name){
    $_dbw = new dataWrapper("SELECT gorgona.ad_get_setting_value('".$_name."') AS result", "", TRUE);
    $_dbw->setResultType(emi_res_type::rtARRAY);
    $_data = $_dbw->getData();
    return $_data[0]['result'];
}

class logger{
    private $file;

    function __construct($_message = '', $_file = 'site.log'){
        $this->file = $_file;
        if ($_message <> '')
            file_put_contents($this->file, date('Y-m-d H:i:s - ').$_message."\r\n", FILE_APPEND | LOCK_EX);
    }
}

?>
