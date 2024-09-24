<?php

//	error_reporting(0);
	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization, X-Auth-Token, access-control-allow-credentials, access-control-allow-origin');
	header('Access-Control-Allow-Methods: HEAD, POST, GET, PUT, DELETE, OPTIONS');
	header('Access-Control-Allow-Credentials: true');

	if (!include("rdbms.class.php")) include "rdbms.class.php";
	if (!include("dbwrapper.class.php")) include "dbwrapper.class.php";
    if (!include("service.class.php")) include "service.class.php";
	if (!include("ed22.class.php")) { include "ed22.class.php"; }
	if (!include("alta.svh.class.php")) { include "alta.svh.class.php"; }
	if (!include("dadata.class.php")) include "dadata.class.php";
	if (!include("rate.class.php")) { include "rate.class.php"; }
    if (!include("schedule.class.php")) { include "schedule.class.php"; }
    if (!include("additionalexpenses.class.php")) { include "additionalexpenses.class.php"; }
	if (!include("auth.class.php")) { include "auth.class.php"; }
    if (!include("reference.class.php")) { include "reference.class.php"; }
    if (!include("loader.class.php")) { include "loader.class.php"; }
	if (!include("autodispetcher.class.php")) { include "autodispetcher.class.php"; }
	if (!include("kontur.class.php")) { include "kontur.class.php"; }
	if (!include("distance.api.class.php")) { include "distance.api.class.php"; }

//	if (!include("vagon.eacs.class.php")) { include "vagon.eacs.class.php"; }

//	if (!include("miRec.php")) { include "miRec.php"; }

    function getbankbybik($_bik){
		$_dd = new miDaDataConnector(
			json_encode(
				array(
					'method' => 'findById/bank',
					'query' => $_bik
				)
			)
		);
		return $_dd->getbankdata();
    }

    function getcompanybyinn($_inn){
			$_dd = new miDaDataConnector(
    			json_encode(
        			array(
            			'method' => 'findById/party',
            			'query' => $_inn
        			)
    			)
			);
			return $_dd->getdata();
    }


	function ed22_workflow($_json){
		$_param = json_decode($_json, TRUE);
		switch($_param['method']){
			case 'GetDopInfoByContainer': {
				$_ed22 = new miEd22Service($_json);
				return $_ed22->getextinfo();
			}
			case 'GetNewDopInfoByContainer': {
				$_ed22 = new miEd22Service($_json);
				return $_ed22->getdopinfo($_param['pattern']);
			}
			case 'GetProviderInfo': {
				$_ed22 = new miEd22Service($_json);
				return $_ed22->getproviderinfo();
			}
			case 'GetAltaInfo': {
				$_ed22 = new miAltaApiService();
				return $_ed22->getdata($_json);
			}
			case 'getPortByContNum': {
				$_cabinet = new miNewCabinet($_json);
				return $_cabinet->getresult();
			}
			default: {
				$_ed22 = new miEd22Service($_json);
				return $_ed22->getdata();
			}
		}
	}

	function alta_workflow($_json){
		$_alta = new miAltaApiService();
		return $_alta->getdata($_json);
	}

//		POST for new personal cabinet

	function rate_workflow($_json) : string {
		$_app = new miRateApiService($_json);
		return $_app->getResult();
	}

    function additionalexpenses_workflow($_json){
        $_app = new miAdditionalExpensesApiService($_json);
        echo $_app->getResult();
    }

    function shipschedule_workflow($_json){
        $_app = new miShipScheduleApiService($_json);
        echo $_app->getResult();
    }

	function auth_workflow($_json) : string {
		$_app = new miAuthConnector($_json);
        return $_app->getResult();
	}

    function reference_workflow($_json) : string {
        $_app = new miReferenceConnector($_json);
        return $_app->getResult();
    }

	function autodispetcher_workflow($_json) : string {
		$_app = new miAutodispetcherConnector($_json);
		return $_app->getresult();
	}

	function kontur_workflow($_json) : string {
		$_app = new miKonturConnector($_json);
		return $_app->getresult();
	}

	function distance_api_workflow($_json){
		$_app = new miDistanceApiService();
		echo $_app->getDataByJson($_json);
	}

    function loader_workflow($_json){
        $_app = new miLoaderController($_json);
        echo $_app->getResult();
    }
/*
	function vagoneacs_workflow($_json){
		$_app = new miVagonEacs($_json);
		echo $_app->getresult();
	}
*/

