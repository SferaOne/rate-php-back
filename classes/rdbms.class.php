<?php
	include "enum.class.php";

class emidb_connection
{
	private $rdbms_type;
	private $user = '';
	private $password = '';
	private $host = '';
	private $port = 1;
	private $charset = 'UTF8';
	private $database = '';
	private $com_object;
    private $res_type;
    public  $db_result;
	public 	$fields;
	
	public function __construct($_dbtype, $_host, $_port, $_database, $_user, $_password, $_charset = 'UTF8')
	{
		$this->rdbms_type = $_dbtype;
		$this->host 	= $_host;
		$this->port 	= $_port;
		$this->database = $_database;
		$this->user		= $_user;
		$this->password	= $_password;
		$this->charset	= $_charset;
		if (emi_rdbms_type::dboMySQL == $this->rdbms_type)
		{
			if ($_host != '') $this->connect();
			if (strtoupper($_charset) != '') $this->do_set_names();
		}
		else if ($_host != '') $this->connect();

	}
	public function connect()
	{
		if (emi_rdbms_type::dboMySQL == $this->rdbms_type)
			$_object = mysqli_connect($this->host, $this->user, $this->password, $this->database, $this->port);

		if (emi_rdbms_type::dboPgSQL == $this->rdbms_type)
			$_object = pg_connect ("host=".$this->host." dbname=".$this->database." user=".$this->user." password=".$this->password);

		if (emi_rdbms_type::dboDB2 == $this->rdbms_type)
			$_object = db2_connect($this->database, $this->user, $this->password);

		if (emi_rdbms_type::dboOracle == $this->rdbms_type)
			$_object = oci_connect($this->user, $this->password, $this->database);

		if (emi_rdbms_type::dboMsSQL == $this->rdbms_type)
			$_object = mssql_connect($this->host, $this->user, $this->password);

		if (emi_rdbms_type::dboSQLite == $this->rdbms_type)
			$_object = sqlite_open($this->database, 0666, $sqliteerror);

//		if (emi_rdbms_type::dbo1CBase == $this->rdbms_type)
			
		$this->com_object = $_object;
		return $_object;
	}
	public function do_set_names()
	{
		mysqli_query($this->com_object, "set names '".$this->charset."'");
	}
	public function close()
	{
	  if (emi_rdbms_type::dboPgSQL == $this->rdbms_type) pg_close($this->com_object);
	  if (emi_rdbms_type::dboMySQL == $this->rdbms_type) mysqli_close($this->com_object);
	  if (emi_rdbms_type::dboOracle == $this->rdbms_type) oci_close($this->com_object);
	  if (emi_rdbms_type::dboDB2 == $this->rdbms_type) db2_close($this->com_object);
//	  if (emi_rdbms_type::dboSQLite == $this->rdbms_type) ($this->com_object);
	  if (emi_rdbms_type::dboMsSQL == $this->rdbms_type) mssql_close($this->com_object);
//	  if (emi_rdbms_type::dbo1CFileBase == $this->rdbms_type) db2_close($this->com_object);
//	  if (emi_rdbms_type::dbo1CServBase == $this->rdbms_type) db2_close($this->com_object);
	}
	public function db_query($_sql)
	{
		if (emi_rdbms_type::dboMySQL == $this->rdbms_type)
		{
                    $result = mysqli_query($this->com_object, $_sql);
                    $this->db_result = mysqli_fetch_all($result, MYSQLI_ASSOC);
        }

		if (emi_rdbms_type::dboPgSQL == $this->rdbms_type)
		{
			try {
					$result = pg_query($this->com_object, $_sql);
                    $this->db_result = pg_fetch_all($result);
			} catch (Exception $e) { exit; }
		}
		if (emi_rdbms_type::dboOracle == $this->rdbms_type)
		{
                    $result = oci_parse($this->com_object, $_sql);
					oci_execute($result);
                    oci_fetch_all($result, $this->db_result, null, null, OCI_FETCHSTATEMENT_BY_ROW);
		}
		if (emi_rdbms_type::dboDB2 == $this->rdbms_type)
		{
                    $_r = db2_prepare($this->com_object, $_sql);
					$result = db2_execute($_r);
                    $this->db_result = db2_fetch_assoc($result);
		}
           return $result;
	}
	public function db_exec($_sql)
	{
		if (emi_rdbms_type::dboMySQL == $this->rdbms_type)
		{
            $result = mysqli_query($this->com_object, $_sql);
	    }
		if (emi_rdbms_type::dboPgSQL == $this->rdbms_type)
		{
            $result = pg_query($this->com_object, $_sql);
		}
		if (emi_rdbms_type::dboOracle == $this->rdbms_type)
		{
            $result = oci_parse($this->com_object, $_sql);
		    oci_execute($result);
		}
		if (emi_rdbms_type::dboDB2 == $this->rdbms_type)
		{
            $_r = db2_prepare($this->com_object, $_sql);
		    $result = db2_execute($_r);
		}
           return $result;
	}	
	public function real_escape_string($_val)
	{
	    if (emi_rdbms_type::dboMySQL == $this->rdbms_type)
			$result = mysqli_real_escape_string($this->com_object, $_val);
	    else
			$result = addslashes($_val);
	    return $result;
	}

    function get_data($res_type)
    {
      if (emi_res_type::rtJSONRW == $res_type)
         $result = json_encode(array('row_count'=>count($this->db_result)
                    ,'data'=>  json_encode($this->db_result)));
		if (emi_res_type::rtJSONEXT == $res_type){
			$result = json_encode(array(
				'fields_count'=>count(array_keys($this->db_result[0]))
			,'fields'=>json_encode(array_keys($this->db_result[0]))
			,'row_count'=>count($this->db_result)
			,'data'=>  json_encode($this->db_result)));
		}
      if (emi_res_type::rtJSON == $res_type)
		  $result = (json_encode($this->db_result));
      if (emi_res_type::rtXML == $res_type)
	  {
		header("Content-type: text/xml");
  		$xml = "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
  		$xml .= "<rows>";
  		$xml .= "<total>".count($this->db_result)."</total>";
		
		$this->fields = array_keys($this->db_result[0]);
				
		$i = 0;
		foreach($this->db_result AS $_row)
		{
			$i++;
		    $xml .= "<row id='".$i."'>";
			for ($j = 0; $j < count($this->fields); $j++)
			{
			    $xml .= "<cell><![CDATA[".$_row[$this->fields[$j]]."]]></cell>";
			}
    		$xml .= "</row>";   
		}
		$xml .= "</rows>";
		
		$result = $xml;
	  }
	  if (emi_res_type::rtAssocXML == $res_type)
	  {
		header("Content-type: text/xml");
  		$xml = "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
  		$xml .= "<rows>";
  		$xml .= "<total>".count($this->db_result)."</total>";
		
		$this->fields = array_keys($this->db_result[0]);
				
		$i = 0;
		foreach($this->db_result AS $_row)
		{
			$i++;
		    $xml .= "<row id='".$i."'>";
			for ($j = 0; $j < count($this->fields); $j++)
			{
			    $xml .= "<".$this->fields[$j].">".$_row[$this->fields[$j]]."</".$this->fields[$j].">";
			}
    		$xml .= "</row>";   
		}
		$xml .= "</rows>";
		
		$result = $xml;
	  }

      if (emi_res_type::rtARRAY == $res_type) $result = $this->db_result;
	  return $result;
	}
}
?>