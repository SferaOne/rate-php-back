<?php

class miProp{
    public $name;
    private $param;
    public $type;
    public $value;
/*
    function trygetType($_value){
        if (strtotime($_value) == 0) {
            if (is_numeric($_value)) {
                return 'numeric';
            } else {
                if (is_bool($_value)){
                    return 'boolean';
                }else {
                    if (is_null($_value)){
                        return 'null';
                    } else {
                        return 'string';
                    }
                }
            }
        } else { return 'date'; }
      }
*/
      function trygetType($_value){
          if (is_int($_value)) return 'numeric';
          if (strtotime($_value) == 0) {
              if (is_numeric($_value)) {
                  return 'numeric';
              } else {
                  if (is_bool($_value)){
                      return 'boolean';
                  }else {
                      if (is_null($_value)){
                          return 'null';
                      } else {
                          return 'string';
                      }
                  }
              }
          } else { return 'date'; }
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
        switch ($this->type){
            case 'date': { $this->value = strftime('%Y-%m-%d', strtotime($_value)); } break;
            case 'boolean': {
                if (strlen($_value) == 0){
                    $this->value = FALSE;
                } else {
                    if ($_value == 'f'){
                        $this->value = FALSE;
                    } elseif ($_value == 't'){
                        $this->value = TRUE;
                    } elseif ($_value == 0){
                        $this->value = TRUE;
                    } else {
                        $this->value = $_value;
                    }
                }
            } break;
            case 'json': { $this->value = json_encode($_value); } break;
            default: { $this->value = $_value; } break;
        }
    }

    function getValue(){
    	if (isset($this->value)) {
            return $this->value;
        }
    }

    function checktype($_type){
        if ($this->type == $_type){
            return true;
        } else {
            return false;
        }
    }
}

class miPropList{
    public $list;

    function __construct($_json){
        $_data = get_object_vars(json_decode($_json));
        foreach($_data as $key => $item) {
            $this->list[] = new miProp($key, $item);
        }
    }

    function getPropValueByName($_name){
    	if (isset($this->list)) {
            for ($i = -1; $i++ < count($this->list) - 1;) {
                if (trim($this->list[$i]->name) == trim($_name)) {
                    break;
                }
            }
            return $this->list[$i]->getValue();
    	} else {
            return null;
        }
    }

    function getPropByName($_name){
        if (isset($this->list)) {
            for ($i = -1; $i++ < count($this->list) - 1;){
                if (trim($this->list[$i]->name) == trim($_name)) {
                    break;
                }
            }
            if ($i < count($this->list)){
                return $this->list[$i];
            } else
                return null;
    	} else {
            return null;
        }
    }

    function AsJSON(){
        return json_encode($this->list);
    }

    function dataAsJSON(){
        $_data = [];
        foreach ($this->list as $_prop) {
            $_data[$_prop->name] = $_prop->value;
        }
        return json_encode($_data);
    }
}

class miRec{
    public $propList;
    public $keyProp;
    public $tableName;
    public $keyField;
    public $keyValue;
    public $_insertSqlText;
    public $_updateSqlText;
    public $_deleteSqlText;

    function propCount(){
        $i = 0;
        foreach($this->propList as $_prop) {
            if ($_prop != $this->keyProp){
                $i++;
            }
        }
        return $i;
    }

    function addPropInList($_miProp){
        $this->propList[] = $_miProp;
    }

    function delPropByName($_name){
        for ($i = -1; $i++ < count($this->propList) - 1;){
            if (trim($this->propList[$i]->name) == trim($_name)) {
                unset($this->propList[$i]);
                break;
            }
        }
    }

    function getPropValueByName($_name){
    	if (isset($this->propList)) {
            for ($i = -1; $i++ < count($this->propList) - 1;) {
                if (trim($this->propList[$i]->name) == trim($_name)) {
                    break;
                }
            }
            return $this->propList[$i]->getValue();
    	} else {
            return null;
        }
    }

    function getPropByName($_name){
        if (isset($this->propList)) {
            for ($i = -1; $i++ < count($this->propList) - 1;){
                if (trim($this->propList[$i]->name) == trim($_name)) {
                    break;
                }
            }
            if ($i < count($this->propList)){
                return $this->propList[$i];
            } else
                return null;
    	} else {
            return null;
        }
    }

    function getRecData($_query, $_is_new = 0){
        $_datawrapper = new dataWrapper($_query, '', true);
        $_datawrapper->setResultType(2);
        $temp =  $_datawrapper->getData();
        if ($_is_new == 0) {
	        for ($i = -1; $i++ < count($temp[0]) - 1;){
    	         $_arkey = array_keys($temp[0]);
        	     $_arval = array_values($temp[0]);
            	  if ($_arkey[$i] != $this->keyField) {
                    if ($this->getPropByName($_arkey[$i]) != null) {
                        $this->getPropByName($_arkey[$i])->setValue($_arval[$i]);
                    }
                }
          }
        } else {
            for ($i = -1; $i++ < count($temp) - 1;){
        	if ($temp[$i]['column_name'] != $this->keyField)
                    if ($temp[$i]['data_type'] == 'json')
                        $this->addPropInList(new miProp($temp[$i]['column_name'], null, 0, 'json'));
                    if ($temp[$i]['data_type'] == 'text')
                        $this->addPropInList(new miProp($temp[$i]['column_name'], '', 0));
                    if ($temp[$i]['data_type'] == 'character varying')
                        $this->addPropInList(new miProp($temp[$i]['column_name'], '', 0));
                    else if ($temp[$i]['data_type'] == 'integer')
        		$this->addPropInList(new miProp($temp[$i]['column_name'], 0, 0));
                    else if ($temp[$i]['data_type'] == 'bigint')
        		$this->addPropInList(new miProp($temp[$i]['column_name'], 0, 0));
                    else if ($temp[$i]['data_type'] == 'numeric')
        		$this->addPropInList(new miProp($temp[$i]['column_name'], 0, 0));
                    else if ($temp[$i]['data_type'] == 'boolean')
        		$this->addPropInList(new miProp($temp[$i]['column_name'], false, 0));
                    else if ($temp[$i]['data_type'] == 'date'){
        		$this->addPropInList(new miProp($temp[$i]['column_name'], null, 0, 'date'));
                    }
                    else if ($temp[$i]['data_type'] == 'bytea')
        		$this->addPropInList(new miProp($temp[$i]['column_name'], '', 0));
        	}
        }
    }

    function getEmptyRec(){
        $this->getRecData('SELECT column_name, data_type FROM information_schema.columns WHERE table_schema||\'.\'||table_name = \''.$this->tableName.'\'', 1);
    }

    function getDataByKey($_is_new = 0){
    	$this->getEmptyRec();
        if (is_numeric($this->keyValue)) {
            $this->getRecData(
                'SELECT * FROM '.$this->tableName.' WHERE 1 = 1 AND '.$this->keyField.' = '.$this->keyValue);
        } else {
           $this->getRecData(
                "SELECT * FROM ".$this->tableName." WHERE 1 = 1 AND ".$this->keyField." = '".$this->keyValue."'");
        }
    }

    function setDeleteSqlText(){
        if (is_numeric($this->keyValue)) {
            $this->_deleteSqlText = ' DELETE FROM '.$this->tableName.' WHERE '.$this->keyField.' = '.$this->keyValue;
        } else {
            $this->_deleteSqlText = ' DELETE FROM '.$this->tableName.' WHERE '.$this->keyField.' = \''.$this->keyValue.'\'';
        }
    }

    function saveToDb($_query, $_is_updated = FALSE){
        $_datawrapper = new dataWrapper($_query, '', true);
        if (!$_is_updated)
          $_datawrapper->getData(1);
        else
          return $_datawrapper->getData(0);
    }

    function setInsertSqlText($_is_updated = False){
        $this->_insertSqlText = ' INSERT INTO '.$this->tableName.'(';
        $_insertSqlText = '';
            for ($i = -1; $i++ < count($this->propList) - 1;){
                if ($this->propList[$i]->name != $this->keyField){
                    switch($this->propList[$i]->type){
                        case 'string': {
                            if (isset($this->propList[$i]->value)){
                                if (strlen($this->propList[$i]->value) != 0){
                                    if (strlen($_insertSqlText) == 0) {
                                        $_insertSqlText .= '"'.$this->propList[$i]->name.'"';
                                    } else {
                                        $_insertSqlText .= ', "'.$this->propList[$i]->name.'"';
                                    }
                                }
                            }
                         } break;
                        case 'json': {
                            if (isset($this->propList[$i]->value)){
                                if (strlen($this->propList[$i]->value) != 0){
                                    if (strlen($_insertSqlText) == 0) {
                                        $_insertSqlText .= '"'.$this->propList[$i]->name.'"';
                                    } else {
                                        $_insertSqlText .= ', "'.$this->propList[$i]->name.'"';
                                    }
                                }
                            }
                         } break;
                        case 'integer': {
                            if (isset($this->propList[$i]->value)){
                                if ($this->propList[$i]->value != 0){
                                    if (strlen($_insertSqlText) == 0) {
                                        $_insertSqlText .= '"'.$this->propList[$i]->name.'"';
                                    } else {
                                        $_insertSqlText .= ', "'.$this->propList[$i]->name.'"';
                                    }
                                }
                            }
                         } break;
                        case 'numeric': {
                            if (isset($this->propList[$i]->value)){
                                if ($this->propList[$i]->value != 0){
                                    if (strlen($_insertSqlText) == 0) {
                                        $_insertSqlText .= '"'.$this->propList[$i]->name.'"';
                                    } else {
                                        $_insertSqlText .= ', "'.$this->propList[$i]->name.'"';
                                    }
                                }
                            }
                         } break;
                        case 'date': {
                            if (isset($this->propList[$i]->value)){
                                if ($this->propList[$i]->value != null){
                                    if (strlen($_insertSqlText) == 0) {
                                        $_insertSqlText .= '"'.$this->propList[$i]->name.'"';
                                    } else {
                                        $_insertSqlText .= ', "'.$this->propList[$i]->name.'"';
                                    }
                                }
                            }
                         } break;
                        case 'boolean': {
                            if (isset($this->propList[$i]->value)){
                                if (strlen($_insertSqlText) == 0) {
                                    $_insertSqlText .= '"'.$this->propList[$i]->name.'"';
                                } else {
                                    $_insertSqlText .= ', "'.$this->propList[$i]->name.'"';
                                }
                            }
                         } break;
                        default: {
                            if (isset($this->propList[$i]->value)){
                                if (strlen($_insertSqlText) == 0) {
                                    $_insertSqlText .= '"'.$this->propList[$i]->name.'"';
                                } else {
                                    $_insertSqlText .= ', "'.$this->propList[$i]->name.'"';
                                }
                            } } break;
                    }
                }
            }
        $this->_insertSqlText .= $_insertSqlText.') VALUES (';
        $_insertSqlText = '';
            for ($i = -1; $i++ < count($this->propList) - 1;) {
                if ($this->propList[$i]->name != $this->keyField){
                    switch($this->propList[$i]->type){
                        case 'string': {
                            if (isset($this->propList[$i]->value)){
                                if (strlen($this->propList[$i]->value) != 0){
                                    if (strlen($_insertSqlText) == 0) {
                                        $_insertSqlText .= '\''.$this->propList[$i]->value.'\'';
                                    } else {
                                        $_insertSqlText .= ', \''.$this->propList[$i]->value.'\'';
                                    }
                                }
                            }
                        } break;
                        case 'json': {
                            if (isset($this->propList[$i]->value)){
                                if (strlen($this->propList[$i]->value) != 0){
                                    if (strlen($_insertSqlText) == 0) {
                                        $_insertSqlText .= '\''.json_decode($this->propList[$i]->value).'\'';
                                    } else {
                                        $_insertSqlText .= ', \''.json_decode($this->propList[$i]->value).'\'';
                                    }
                                }
                            }
                        } break;
                        case 'integer': {
                            if (isset($this->propList[$i]->value)){
                                if ($this->propList[$i]->value != 0){
                                    if (strlen($_insertSqlText) == 0) {
                                        $_insertSqlText .= $this->propList[$i]->value;
                                    } else {
                                        $_insertSqlText .= ', '.$this->propList[$i]->value;
                                    }
                                }
                            }
                        } break;
                        case 'numeric': {
                            if (isset($this->propList[$i]->value)){
                                if ($this->propList[$i]->value != 0){
                                    if (strlen($_insertSqlText) == 0) {
                                        $_insertSqlText .= $this->propList[$i]->value;
                                    } else {
                                        $_insertSqlText .= ', '.$this->propList[$i]->value;
                                    }
                                }
                            }
                        } break;
                        case 'date': {
                            if (isset($this->propList[$i]->value)){
                                if ($this->propList[$i]->value != null){
                                    if (strlen($_insertSqlText) == 0) {
                                        $_insertSqlText .= '\''.$this->propList[$i]->value.'\'::date';
                                    } else {
                                        $_insertSqlText .= ', \''.$this->propList[$i]->value.'\'::date';
                                    }
                                }
                            }
                        } break;
                        case 'boolean': {
                            if (strlen($_insertSqlText) == 0) {
                                $_insertSqlText .= $this->propList[$i]->value;
                            } else {
                                $_insertSqlText .= ', '.$this->propList[$i]->value;
                            }
                        } break;
                        default: {

                        } break;
                    }
                }
            }
            if (!$_is_updated)
              $this->_insertSqlText .= $_insertSqlText.')';
            else
              $this->_insertSqlText .= $_insertSqlText.') RETURNING '.$this->keyField;
    }

    function setUpdateSqlText(){
        $this->_updateSqlText = ' UPDATE '.$this->tableName.' SET ';
        $_updateSqlText = '';
        for ($i = -1; $i++ < count($this->propList) - 1;){
            if ($this->propList[$i]->value != null){
                if ($this->propList[$i]->checktype('string')){
                    if (strlen($_updateSqlText) == 0) {
                        $_updateSqlText .= $this->propList[$i]->name.' = \''.$this->propList[$i]->value.'\'';
                    } else{
                        $_updateSqlText .= ', '.$this->propList[$i]->name.' =  \''.$this->propList[$i]->value.'\'';
                    }
                } else {
                    if ($this->propList[$i]->checktype('date')) {
                        if (strlen($_updateSqlText) == 0) {
                            $_updateSqlText .= $this->propList[$i]->name.' = \''.$this->propList[$i]->value.'\'::date';
                        } else {
                            $_updateSqlText .= ', '.$this->propList[$i]->name.' = \''.$this->propList[$i]->value.'\'::date';
                        }
                    } else {
                        if ($this->propList[$i]->checktype('json')){
                            if (strlen($_updateSqlText) == 0) {
                                $_updateSqlText .= $this->propList[$i]->name.' = \''.$this->propList[$i]->value.'\'';
                            } else{
                                $_updateSqlText .= ', '.$this->propList[$i]->name.' =  \''.$this->propList[$i]->value.'\'';
                            }
                        } else {
                            if (strlen($_updateSqlText) == 0) {
                                $_updateSqlText .= $this->propList[$i]->name.' = '.$this->propList[$i]->value;
                            } else {
                                $_updateSqlText .= ', '.$this->propList[$i]->name.' = '.$this->propList[$i]->value;
                            }
                        }
                    }
                }
            }
        }
        $this->_updateSqlText .= $_updateSqlText;
        if (is_numeric($this->keyValue)) {
            $this->_updateSqlText .= ' WHERE 1 = 1 AND '.$this->keyField.' = '.$this->keyValue;
        } else {
            $this->_updateSqlText .= ' WHERE 1 = 1 AND '.$this->keyField.' = \''.$this->keyValue.'\'';
        }
    }

    function setPartInsertSqlText($_json, $_isjson = True, $_is_updated = False){
        $_data = get_object_vars(json_decode($_json));
        $this->_insertSqlText = ' INSERT INTO '.$this->tableName.'(';
        $_insertSqlText = '';
        $i = 0;
        foreach($_data as $_propname => $_propvalue) {
          if ($this->getPropByName($_propname) != null){
            if ($i == 0)
              $_insertSqlText .= $_propname;
            else
              $_insertSqlText .= ', '.$_propname;

            $i ++;
          }
        }
        $this->_insertSqlText .= $_insertSqlText.') VALUES (';
        $_insertSqlText = '';
        $i = 0;
        foreach($_data as $_propname => $_propvalue) {
            if ($this->getPropByName($_propname) != null){
                if ($this->getPropByName($_propname)->checktype('string')){
                    if ($i == 0) {
                        $_insertSqlText .= '\''.$_propvalue.'\'';
                    } else{
                        $_insertSqlText .= ', \''.$_propvalue.'\'';
                    }
                } else {
                    if ($this->getPropByName($_propname)->checktype('json')){
                        if ($i == 0) {
                            $_insertSqlText .= '\''.$_propvalue.'\'';
                        } else{
                            $_insertSqlText .= ', \''.$_propvalue.'\'';
                        }
                    } else {
                        if ($i == 0) {
                            $_insertSqlText .= $_propvalue;
                        } else {
                            $_insertSqlText .= ', '.$_propvalue;}
                    }
                }
                $i++;
            }
        }
        if (!$_is_updated)
          $this->_insertSqlText .= $_insertSqlText.')';
        else
          $this->_insertSqlText .= $_insertSqlText.') RETURNING '.$this->keyField;
    }

    function setPartUpdateSqlText($_json){
        $_data = get_object_vars(json_decode($_json));
        $this->_updateSqlText = ' UPDATE '.$this->tableName.' SET ';
        $i= 0;
        foreach($_data as $_propname => $_propvalue) {
            if ($this->getPropByName($_propname) != null){
                if ($this->getPropByName($_propname)->checktype('string')){
                    if ($i == 0) {
                        $this->_updateSqlText .= $_propname.' = \''.$_propvalue.'\'';
                    } else{
                        $this->_updateSqlText .= ', '.$_propname.' =  \''.$_propvalue.'\'';
                    }
                } else {
                    if ($this->getPropByName($_propname)->checktype('json')){
                        if ($i == 0) {
                            $this->_updateSqlText .= $_propname.' = \''.$_propvalue.'\'';
                        } else{
                            $this->_updateSqlText .= ', '.$_propname.' =  \''.$_propvalue.'\'';
                        }
                    } else {
                        if ($i == 0) {
                            $this->_updateSqlText .= $_propname.' = '.$_propvalue;
                        } else {
                            $this->_updateSqlText .= ', '.$_propname.' = '.$_propvalue;}
                    }
                }
                $i++;
            }
        }

        if (is_numeric($this->keyValue)) {
            $this->_updateSqlText .= ' WHERE 1 = 1 AND '.$this->keyField.' = '.$this->keyValue;
        } else {
            $this->_updateSqlText .= ' WHERE 1 = 1 AND '.$this->keyField.' = \''.$this->keyValue.'\'';
        }
    }

    function setPartData($_json, $_isjson = True, $_is_updated = False){
    	   if ($_isjson){
            $_data = get_object_vars(json_decode($_json));
            foreach($_data as $_propname => $_propvalue) {
                if ($this->getPropByName($_propname) != null)
                    $this->getPropByName($_propname)->setValue($_propvalue);
    	             }
	       }
         if ($this->keyValue == 0) {
           $this->setPartInsertSqlText($_json, $_isjson, $_is_updated);
           if ($_is_updated){
//              var_dump(get_object_vars(json_decode($this->saveToDb($this->_insertSqlText, $_is_updated))[0]));
             $this->keyValue = get_object_vars(json_decode($this->saveToDb($this->_insertSqlText, $_is_updated))[0])[$this->keyField];
             unset($this->propList);
             $this->getDataByKey(1);
           } else $this->saveToDb($this->_insertSqlText, $_is_updated);
         } else {
           $this->setPartUpdateSqlText($_json);
           $this->saveToDb($this->_updateSqlText);
         }
    }

    function setData($_json, $_isjson = True, $_is_updated = False){
    	if ($_isjson){
            $_data = get_object_vars(json_decode($_json));
            for ($i = -1; $i++ < count($this->propList) - 1;){
                switch($this->propList[$i]->type){
                    case 'string': {
                        if (strlen($_data[$this->propList[$i]->name]) == 0){
                            $this->propList[$i]->setValue('');
                        } else {
                            $this->propList[$i]->setValue($_data[$this->propList[$i]->name]);
                        } } break;
                    case 'json': {
                        if (strlen($_data[$this->propList[$i]->name]) == 0){
                            $this->propList[$i]->setValue('');
                        } else {
                            $this->propList[$i]->setValue($_data[$this->propList[$i]->name]);
                        } } break;
                    case 'integer': {
                        if (strlen($_data[$this->propList[$i]->name]) == 0){
                            $this->propList[$i]->setValue(0);
                        } else {
                            $this->propList[$i]->setValue($_data[$this->propList[$i]->name]);
                        }
                    } break;
                    case 'numeric': {
                        if (strlen($_data[$this->propList[$i]->name]) == 0){
                            $this->propList[$i]->setValue('0');
                        } else {
                            $this->propList[$i]->setValue($_data[$this->propList[$i]->name]);
                        }
                     } break;
                    case 'date': {
                        if (strlen($_data[$this->propList[$i]->name]) == 0){
                           $this->propList[$i]->setValue(null);
                        } else {
                            $this->propList[$i]->setValue($_data[$this->propList[$i]->name]);
                        }
                    } break;
                    case 'boolean':{
                        if (strlen($_data[$this->propList[$i]->name]) == 0){
                            $this->propList[$i]->setValue(0);
//                        new logger(strlen($_data[$this->propList[$i]->name]).': '.$this->propList[$i]->name.' -> '.$this->propList[$i]->type.' = '.$_data[$this->propList[$i]->name]);
                        } else {
                            $this->propList[$i]->setValue($_data[$this->propList[$i]->name]);
                        }
                    } break;
                    default: { $this->propList[$i]->setValue($_data[$this->propList[$i]->name]); } break;
                }
    	    }
	}
        if ($this->keyValue == 0) {
            $this->setInsertSqlText($_is_updated);
            if ($_is_updated){
//              var_dump(get_object_vars(json_decode($this->saveToDb($this->_insertSqlText, $_is_updated))[0]));
                $this->keyValue = get_object_vars(json_decode($this->saveToDb($this->_insertSqlText, $_is_updated))[0])[$this->keyField];
                unset($this->propList);
                $this->getDataByKey(1);
            } else $this->saveToDb($this->_insertSqlText, $_is_updated);
        } else {
            $this->setUpdateSqlText();
            $this->saveToDb($this->_updateSqlText);
        }
    }

    function asJSON(){
        return json_encode($this);
    }

    function propListAsJSON(){
        return json_encode($this->propList);
    }

    function dataAsJSON(){
        $_data = [];
        $_data[$this->keyField] = $this->keyValue;
        foreach ($this->propList as $_prop) {
            $_data[$_prop->name] = $_prop->value;
        }
        return json_encode($_data);
    }

    function JSON(){
        return '['.$this->dataAsJSON().']';
    }

    function delData(){
        $this->setDeleteSqlText();
        $this->saveToDb($this->_deleteSqlText);
    }

    function __construct($_tableName, $_keyField, $_keyValue = 0){
        $this->tableName = $_tableName;
        $this->keyField = $_keyField;
        $this->keyValue = $_keyValue;
        $this->keyProp = new miProp($_keyField, $_keyValue);
        switch($this->keyProp->type){
          case 'string':
            if (strlen($_keyValue) == 0) {
              $this->getEmptyRec();
            } else {
              $this->getDataByKey();
            } break;
          case 'numeric':
            if ($_keyValue == 0) {
              $this->getEmptyRec();
            } else {
              $this->getDataByKey();
            } break;
        }
    }

}

?>
