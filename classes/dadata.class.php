<?php


class miDaDataConnector{
    private $_uri = '';
    private $_params = '';

    private function getconfigfile(){
        return "../sets/_site";
    }

    private function createurl(){
        return $this->_uri.$this->_params['method'];
    }

    private function sendrequest($_url){
        if (!$curld = curl_init()) {
            exit;
        }
        $headers = array();
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Accept: application/json';
        $headers[] = 'Authorization: Token '.$this->_params['token'];
        curl_setopt($curld, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curld, CURLOPT_URL, $_url);
        curl_setopt($curld, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curld, CURLOPT_POST, 1);
        curl_setopt($curld, CURLOPT_POSTFIELDS, json_encode($this->_params));

        $_output = curl_exec($curld);
        curl_close ($curld);
        return $_output;
    }

    public function __construct($_params, $_conf = "sets/_site"){
        $_params = json_decode($_params, TRUE);
        if (!file_exists($_conf))
            $_conf = $this->getconfigfile();

        $_xml = simplexml_load_file($_conf) or die("Error: Cannot create object");
        $this->_uri = $_xml->dadata[0]->url;
        $this->_params = array_merge($_params, array('token' => $_xml->dadata[0]->token->__toString()));
    }

    public function getokveds($_json_arr){
 //       {
 //           "main": true,
 //           "type": "2014",
 //           "code": "72.19",
 //           "name": "Научные исследования и разработки в области естественных и технических наук прочие"
 //         }
        $_okveds = [];
        foreach($_json_arr as $_okved){
            $_okveds[]['is_main'] = $_okved['main'];
            $_okveds[]['code'] = $_okved['code'];
            $_okveds[]['name'] = $_okved['name'];
            $_okveds[]['type'] = $_okved['type'];
        }
        return $_okveds;
    }

    public function getdata(){
        $_json = json_decode($this->sendrequest($this->createurl()), true);
        $info["companyname"] 		= $_json['suggestions'][0]['value'];
        $info["companyfullname"] 	= $_json['suggestions'][0]['data']['name']['full_with_opf'];
        $info["inn"] 				= $_json['suggestions'][0]['data']['inn'];
        $info["kpp"] 				= $_json['suggestions'][0]['data']['kpp'];
        $info["ogrn"] 				= $_json['suggestions'][0]['data']['ogrn'];
        $info["okpo"] 				= $_json['suggestions'][0]['data']['okpo'];
        $info["startdate"] 			= $_json['suggestions'][0]['data']['state']['registration_date'];
        $info["address"] 			= $_json['suggestions'][0]['data']['address']['value'];
        $info["position"] 			= $_json['suggestions'][0]['data']['management']['post'];
        $info["name"] 				= $_json['suggestions'][0]['data']['management']['name'];
        $info["okved"] 				= $_json['suggestions'][0]['data']['okved'];
        $info["okveds"] 			= $this->getokveds($_json['suggestions'][0]['data']['okveds']);
        return json_encode($info);
    }

    public function getbankdata(){
        $_json = json_decode($this->sendrequest($this->createurl()), true);
        $info["name"] 		= $_json['suggestions'][0]['value'];
        $info["fullname"] 		= $_json['suggestions'][0]['data']['name']['payment'];
        $info["shortname"] 		= $_json['suggestions'][0]['data']['name']['short'];
        $info["bik"]          = $_json['suggestions'][0]['data']['bic'];
        $info["inn"] 				= $_json['suggestions'][0]['data']['inn'];
        $info["kpp"] 				= $_json['suggestions'][0]['data']['kpp'];
        $info["zipcode"] 		= $_json['suggestions'][0]['data']['value'];
        $info["region"] 		= $_json['suggestions'][0]['data']['payment_city'];
        $info["address"] 		= $_json['suggestions'][0]['data']['address']['value'];
        $info["csaccount"] 		= $_json['suggestions'][0]['data']['correspondent_account'];
        $info["swift"] = $_json['suggestions'][0]['data']['swift'];
        $info["registration_number"] = $_json['suggestions'][0]['data']['registration_number'];
        return json_encode($info);
    }
}
