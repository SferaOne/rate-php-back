<?php

//if (!include("phpQuery.php")) { include_once "phpQuery.php"; }

/*
Дальний Восток (ДВТУ): 107
Приволжье (ПТУ): 104
Северо-Запад (СЗТУ): 100 (исторически сложилось)
Урал (УТУ): 105
Сибирь (СТУ): 106

/api/WH/GetInfoByContainer?token=токен-авторизации&region=код-региона
/api/WH/GetInfoByDocumentNumber?token=токен-авторизации&region=код-региона
/api/WH/GetInfoByTransportIdentifier?token=токен-авторизации&region=код-региона

{
  'Stype': 'LikeMatch'
  'pattern': 'MAEU3460223',
}
methods
  GetInfoByContainer
  GetInfoByDocumentNumber
  GetInfoByTransportIdentifier
  GetDopInfoByContainer

{
  method : 'GetInfoByContainer',
  region : 107,
  pattern : 'MAEU3460223',
  stype : 'LikeMatch'
}

*/

class miEd22Service{
  private $_uri = '';
  private $_params = '';
  private $_dopurl = 'http://wh.ed22.ru/lookup_container_ext.php?query=';

  private function getconfigfile(){
    return "../sets/_site";
  }

  private function sendrequest($_url){
    $_postfields = array(
        'pattern' => $this->_params['pattern'],
        'Stype' => $this->_params['stype'],
    );

    if (!$curld = curl_init()) {
        exit;
    }

    curl_setopt($curld, CURLOPT_POST, true);
    curl_setopt($curld, CURLOPT_POSTFIELDS, http_build_query($_postfields));
    curl_setopt($curld, CURLOPT_URL, $_url);
    curl_setopt($curld, CURLOPT_RETURNTRANSFER, true);

    $_output = curl_exec($curld);
    curl_close ($curld);
    return $_output;
  }

  private function createurl(){
      return $this->_uri.$this->_params['method'].'?token='.$this->_params['token'].'&region='.$this->_params['region'];
  }

  public function __construct($_params, $_conf = "sets/_site"){
    $_params = json_decode($_params, TRUE);
    if ($_params['method'] != 'GetDopInfoByContainer'){
      if (!file_exists($_conf))
        $_conf = $this->getconfigfile();

      $_xml = simplexml_load_file($_conf) or die("Error: Cannot create object");
      $this->_uri = $_xml->ed22[0]->url;
      $this->_params = array_merge($_params, array('token' => $_xml->ed22[0]->token->__toString()));
    } else {
      if (!file_exists($_conf))
        $_conf = $this->getconfigfile();

      $_xml = simplexml_load_file($_conf) or die("Error: Cannot create object");
      $this->_uri = $_xml->ed22[0]->url;
      $_params['method'] = 'GetInfoByContainer';
      $this->_params = array_merge($_params, array('token' => $_xml->ed22[0]->token->__toString()));
    }
  }
//  new logger($_params['method']);
  public function getdata(){
    return $this->sendrequest($this->createurl());
  }

  public function getdopinfo($_contnum){
    $url = "https://wh.ed22.ru/lookup_container_ext.php?query=".$_contnum;

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $headers = array(
       "Cookie: COOK_SESSION=f34c5641-2637-414e-9282-3840193641c6; COOK_USER=Maxim; COOK_USERID=68b3a83e-6607-4f5c-a8f2-e12a96a53eb9",
    );
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    //for debug only!
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

    $resp = curl_exec($curl);
    curl_close($curl);
    return json_encode(array(
      'data' =>$resp
    ));
  }
  public function getdopdata(){
    $url = "https://wh.ed22.ru/lookup_container_ext.php?query=".$this->_params['pattern'];

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $headers = array(
       "Cookie: COOK_SESSION=f34c5641-2637-414e-9282-3840193641c6; COOK_USER=Maxim; COOK_USERID=68b3a83e-6607-4f5c-a8f2-e12a96a53eb9",
    );
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    //for debug only!
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

    $resp = curl_exec($curl);
    curl_close($curl);
    preg_match_all("/\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}/", $resp, $_dopdata, PREG_SET_ORDER, 0);
    return json_encode(array(
      'waybill_statement_date'  => $_dopdata[0][0],
      'reception_from_sea_date' => $_dopdata[1][0],
      'export_application_date' => $_dopdata[2][0],
      'coming_out_date'         => $_dopdata[3][0]
    ));
  }

  public function getproviderinfo(){
//  http://wh.ed22.ru:8774/api/WH/GetProviderInfo?token=8Q4e2jpa3xUWccR&region=107&container=MRKU5204320&provider=VMTP
    $_url = "http://wh.ed22.ru:8774/api/WH/GetProviderInfo?token=".$this->_params['token'].'&region='.$this->_params['region'].'&container='.$this->_params['pattern'].'&provider='.$this->_params['WhInfoProvider'];
//    $_postfields = array(
//        'container' => $this->_params['pattern'],
//        'provider' => 'VMTP',
//    );

    if (!$curld = curl_init()) {
        exit;
    }

//    curl_setopt($curld, CURLOPT_POST, true);
//    curl_setopt($curld, CURLOPT_POSTFIELDS, http_build_query($_postfields));
    curl_setopt($curld, CURLOPT_URL, $_url);
    curl_setopt($curld, CURLOPT_RETURNTRANSFER, true);

    $_output = curl_exec($curld);
    curl_close ($curld);
    return $_output;
  }

  public function getextinfo(){
    $_data = json_decode($this->getdata(), true);
    $_url = "http://wh.ed22.ru:8774/api/WH/GetProviderInfo?token=".$this->_params['token'].'&region='.$this->_params['region'].'&container='.$this->_params['pattern'].'&provider='.$_data[0]["WhInfoProvider"];
    if (!$curld = curl_init()) {
        exit;
    }
    curl_setopt($curld, CURLOPT_URL, $_url);
    curl_setopt($curld, CURLOPT_RETURNTRANSFER, true);

    $_output = curl_exec($curld);
    curl_close ($curld);
    $_arr = json_decode($_output, true);
    return json_encode(array(
      'waybill_statement_date'  => $_arr['BillOfLanding'],
      'reception_from_sea_date' => $_arr['Unload'],
      'export_application_date' => $_arr['OutRequest'],
      'coming_out_date'         => $_arr['Out'],
      'MidcExamIn'              => $_arr['MidcExamIn'],
      'MidcExamOut'             => $_arr['MidcExamOut'],
      'MidcExam'                => $_arr['MidcExam'][0],
      'PhysExamRequest'         => $_arr['PhysExamRequest'],
      'PhysExamIn'              => $_arr['PhysExamIn'],
      'PhysExamOut'             => $_arr['PhysExamOut'],
      'PhysExam'                => $_arr['PhysExam'][0],
      'PhysExamComment'         => $_arr['PhysExamComment'],
      'Weighting'               => $_arr['Weighting'],
      'WeightingComment'        => $_arr['WeightingComment'],
      'BillOfLanding'           => $_arr['BillOfLanding'],
      'Unload'                  => $_arr['Unload'],
      'OutRequest'              => $_arr['OutRequest'],
      'Out'                     => $_arr['Out']
    ));
  }
/*
  public function getdopdata(){
   	$_document = phpQuery::newDocument(file_get_contents($this->_dopurl.$this->_params['pattern']))->text();
    preg_match_all("/\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}/", $_document, $_dopdata, PREG_SET_ORDER, 0);
    return json_encode(array(
      'waybill_statement_date'  => $_dopdata[0][0],
      'reception_from_sea_date' => $_dopdata[1][0],
      'export_application_date' => $_dopdata[2][0],
      'coming_out_date'         => $_dopdata[3][0]
    ));
  }
*/
}

?>
