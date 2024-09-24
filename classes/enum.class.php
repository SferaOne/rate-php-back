<?php

abstract class enum {
    private $current_val;
    
    final public function __construct( $type ) {
        $class_name = get_class( $this );
        
        $type = strtoupper( $type );
        if ( constant( "{$class_name}::{$type}" )  === NULL ) {
            throw new enum_exception( 'Свойства '.$type.' в перечислении '.$class_name.' не найдено.' ); 
        }
        
        $this->current_val = constant( "{$class_name}::{$type}" );
    }
    
    final public function __toString() {
        return $this->current_val;
    }
}
class enum_exception extends Exception {}
class emi_res_type extends enum 
{
    const rtJSON 		= 0;
    const rtXML 		= 1;
    const rtARRAY 		= 2;
	const rtAssocXML	= 3;
  	const rtJSONRW 		= 4;
    const rtJSONEXT     = 5;
}
class emi_rdbms_type extends enum 
{
    const dboMySQL 		= 0;
    const dboPgSQL 		= 1;
    const dboMsSQL 		= 2;
	const dboOracle		= 3;
	const dboSQLite		= 4;
	const dbo1CFileBase	= 5;
	const dbo1CServBase = 6;
	const dboDB2		= 7;
}

class emiRecCrType extends enum{
    const rcNew = 1;
    const rcExt = 0;
    const rcCpy = 2;
    const rcBin = 3;
    const rcBst = 4;
}


?>