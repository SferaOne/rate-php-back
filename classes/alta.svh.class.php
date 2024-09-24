<?php

class miAltaApiService{
  private $_uri = 'https://www.alta.ru/svh-gruz/search/api/v1/?n_k=';
  private $_user = 'sa33344';
  private $_pass = '32JQS8CR';

  private function getSecretKey($_cont_num){
    return md5($_cont_num."::::".$this->_user.":".md5($this->_pass));
  }

  private function sendrequest($_url){
    if (!$curld = curl_init()) {
      exit;
    }
    curl_setopt($curld, CURLOPT_URL, $_url);
    curl_setopt($curld, CURLOPT_RETURNTRANSFER, true);
    return curl_exec($curld);
  }

  function __construct(){ }

  private function createurl($_cont_num){
      return $this->_uri.$_cont_num.'&n_trans=&n_trans_doc=&n_dt=&login='.$this->_user.'&secret='.$this->getSecretKey($_cont_num);
  }

  function getdata($_json){
    $_params = json_decode($_json, TRUE);
    $_jres = json_decode($this->sendrequest($this->createurl($_params['pattern'])), TRUE)['content'];
    $_res = $_jres[count($_jres) - 1];
    $_messages = array();
    $_i = 0;
    foreach($_res['dtDataList'] as $_msg){
        $_messages[$_i] = array(
          'msg_type' => $_msg['messageType'],
          'msg_docnumber' => $_msg['dtRegNumber'],
          'reg_doctype' => $_msg['documentName'],
          'reg_doc_number' => $_msg['number'],
          'msg_status_type' => $_msg['documentKind'],
          'msg_status' => '',
          'place_count' => $_msg['totalPackageNumber'],
          'goods_weight' => $_msg['weight'][0],
        );
        $_i++;
    }
    preg_match("/№\d+/m", $_res['internalNumber'], $_pSvhdocnum);
    preg_match("/\d{2}\.\d{2}\.\d{4}/m", $_res['internalNumber'], $_pSvhdocdate);
    preg_match("/№\D+\d+/m", $_res['transportNumbers'][0], $_pWayBilldocnum);
    preg_match("/\d{2}\.\d{2}\.\d{4}/m", $_res['transportNumbers'][0], $_pWayBilldocdate);
    return json_encode(array(
      'DO1' => array(
        'docnumber' => str_replace('№', '', $_pSvhdocnum[0]),
        'docdate' => $_pSvhdocdate[0],
      ),
      'WHInfo' => array(
        'name' => $_res['warehouseOwner']['organizationName'],
        'ogrn' => $_res['warehouseOwner']['ogrn'],
        'inn' => $_res['warehouseOwner']['inn'],
        'kpp' => $_res['warehouseOwner']['kpp'],
        'address' => $_res['warehouseOwner']['addressLine'],
        'certkind' => $_res['warehouseOwner']['certificateKind'],
        'certnum' => $_res['warehouseOwner']['certificateNumber'],
        'certdate' => $_res['warehouseOwner']['certificateDate'],
      ),
      'WHDocument' => array(
        'docnumber' => $_res['regNumber'],
        'docdate' => $_res['acceptDate'],
      ),
      'TransportDocument' => array(
        'docnumber' => str_replace('№', '', $_pWayBilldocnum[0]),
        'docdate' => $_pWayBilldocdate[0],
      ),
      'Transport' => array(
        'name' => $_res['transportIdentifiers'][0],
      ),
      'GoodsInfo' => array(
        'places' => $_res['totalPackageNumber'],
        'weigth' => $_res['weight'],
      ),
      'Containers' => $_res['containerNumbers'],
      'Messages' => $_messages,
    ));
  }

}