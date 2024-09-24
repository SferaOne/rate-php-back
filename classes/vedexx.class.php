<?php

//  Vedexx personal cabinet class

/* if (!include("rdbms.class.php")) { include "rdbms.class.php"; }
if (!include("query.class.php")) include "query.class.php";
if (!include("dbwrapper.class.php")) { include "dbwrapper.class.php"; }
if (!include("miRec.php")) { include "miRec.php"; } */

//if (!include("auth.class.php")) { include "auth.class.php"; }
//if (!include("ed22.class.php")) { include "ed22.class.php"; }

class miVedexxCabinet{
    private $_result = '';
//    private $_json = '';

    function getresult(){
        return $this->_result;
    }

    function __construct($_json){
//      $this->_json = $_json;
      $_param = json_decode($_json, TRUE);
	    switch ($_param['method']) {
            case 'getDclRequestList': $this->getDclRequestList($_param); break;
            case 'getDclRequestComments': $this->getDclRequestComments($_param); break;
            case 'getClientRequestComments': $this->getClientRequestComments($_param); break;
            case 'getBookingRequestComments': $this->getBookingRequestComments($_param); break;
            case 'getCustomsRequestComments': $this->getCustomsRequestComments($_param); break;
            case 'getDclRequestHistory': $this->getDclRequestHistory($_param); break;
            case 'getDclRequestCheckList': $this->getDclRequestCheckList($_param); break;
            case 'getDclRequestFilters' : $this->getDclRequestFilters($_param); break;
            case 'getDclRequestFiles':  $this->getDclRequestFiles($_param); break;
            case 'setDclRequestComment':  $this->setDclRequestComment($_param); break;
            case 'setClientRequestComment':  $this->setClientRequestComment($_param); break;
            case 'setClientCustomsRequestComment':  $this->setClientCustomsRequestComment($_param); break;
            case 'setDclRequestState':  $this->setDclRequestState($_param); break;
            case 'auth':  $this->auth($_param); break;
            case 'check':  $this->checkKey($_param); break;
            case 'getReferenceData':  $this->getReferenceData($_param); break;
            case 'getClientReferenceData':  $this->getClientReferenceData($_param); break;
            case 'setDclRequestDclNumbers':  $this->setDclRequestDclNumbers($_param); break;
            case 'uploadFile':  $this->uploadFile($_param); break;
            case 'getRequestData':  $this->getRequestData($_param); break;
            case 'getComment':  $this->getComment($_param); break;
            case 'getClientsComment':  $this->getClientsComment($_param); break;
            case 'getFileInfo':  $this->getFileInfo($_param); break;
            case 'getUserInfo':  $this->getUserInfo($_param); break;
            case 'getHistoryEvent':  $this->getHistoryEvent($_param); break;
            case 'setDclCount':  $this->setDclCount($_param); break;
            case 'getRateList':  $this->getRateList($_param); break;
            case 'setLock':  $this->setLock($_param); break;
            case 'closeLock':  $this->closeLock($_param); break;
            case 'generateLink':  $this->generateLink($_param); break;
            case 'registerByKey':  $this->registerByKey($_param); break;
            case 'getSelfSignedRequestList':  $this->getSelfSignedRequestList($_param); break;
            case 'pushRequestToMe':  $this->pushRequestToMe($_param); break;
            case 'getMenuById':  $this->getMenuById($_param); break;
            case 'getDocBodyById':  $this->getDocBodyById($_param); break;
            case 'setLastRequestComment':  $this->setLastRequestComment($_param); break;
            case 'setCommentVizited':  $this->setCommentVizited($_param); break;
            case 'setMultiCommentVizited':  $this->setMultiCommentVizited($_param); break;
            case 'setClosedDocs':  $this->setClosedDocs($_param); break;
            case 'getNewsByRefName':  $this->getNewsByRefName($_param); break;
            case 'getRateById':  $this->getRateById($_param); break;
			case 'getRateByKey':  $this->getRateByKey($_param); break;
			case 'getDclRequestCost':  $this->getDclRequestCost($_param); break;
            case 'setRateRequestMessage':  $this->setRateRequestMessage($_param); break;
            case 'sendAdvertisingRequest':  $this->sendAdvertisingRequest($_param); break;
            case 'getClientCommission':  $this->getClientCommission($_param); break;
            case 'setClientCommission':  $this->setClientCommission($_param); break;
            case 'getAdditionalExpensesRate':  $this->getAdditionalExpensesRate($_param); break;
            case 'getRequestListData':  $this->getRequestListData($_param); break;
            case 'getRequestDataById':  $this->getRequestDataById($_param); break;
            case 'setNewRequest':  $this->setNewRequest($_param); break;
            case 'getShipScheduleByKey':  $this->getShipScheduleByKey($_param); break;
            case 'getComplexRateList':  $this->getComplexRateList($_param); break;
            case 'getComplexShipSchedule':  $this->getComplexShipSchedule($_param); break;
            case 'getComplexAdditionalExpences':  $this->getComplexAdditionalExpences($_param); break;
            case 'getCompareRateList':  $this->getCompareRateList($_param); break;
            case 'getSiteMenuJson':  $this->getSiteMenuJson($_param); break;
            case 'getArticleBodyJson':  $this->getArticleBodyJson($_param); break;
            case 'getUserData':  $this->getUserData($_param); break;
            case 'getRecomendations':  $this->getRecomendations($_param); break;
            case 'setNewContragent':  $this->setNewContragent($_param); break;
            case 'setPrefRequestData':  $this->setPrefRequestData($_param); break;
            case 'setUserDocumentStatus':  $this->setUserDocumentStatus($_param); break;
            case 'setServiceEvaluation':  $this->setServiceEvaluation($_param); break;
            case 'getDocumentList':  $this->getDocumentList($_param); break;
            case 'getMinRateJson':  $this->getMinRateJson($_param); break;
            case 'setOrderMarks':  $this->setOrderMarks($_param); break;
            case 'getServiceNews':  $this->getServiceNews($_param); break;
            case 'getDocument': $this->getDocument($_param); break;
            case 'getServiceInfo': $this->getServiceInfo($_param); break;
            case 'getNewsBody': $this->getNewsBody($_param); break;
            case 'addContractFile': $this->addContractFile($_param); break;
            case 'getServiceDelayInfo': $this->getServiceDelayInfo($_param); break;
            case 'getStatisticData': $this->getStatisticData($_param); break;
            case 'getRateStatisticByKey': $this->getRateStatisticByKey($_param); break;
            case 'getRateListAlert': $this->getRateListAlert($_param); break;
            case 'getAlternativeRoute': $this->getAlternativeRoute($_param); break;
            case 'setNotifyStatus': $this->setNotifyStatus($_param); break;
            case 'getAutoServiceInfo': $this->getAutoServiceInfo($_param); break;
            case 'getFinDetailsByOrderId': $this->getFinDetailsByOrderId($_param); break;
            case 'getSecurityServiceInfo': $this->getSecurityServiceInfo($_param); break;
            case 'getOurTeam': $this->getOurTeam($_param); break;
            case 'getSettingByName': $this->getSettingByName($_param); break;
            case 'getClientReviewsList': $this->getClientReviewsList($_param); break;
            case 'setCompleteDocRequest': $this->setCompleteDocRequest($_param); break;
            case 'getInshuranceCost': $this->getInshuranceCost($_param); break;
            case 'getTransporterInfoById': $this->getTransporterInfoById($_param); break;
            case 'getTransporterInfoByKey': $this->getTransporterInfoByKey($_param); break;
            case 'setContragentRateInfo': $this->setContragentRateInfo($_param); break;
            case 'setFeedBack': $this->setFeedBack($_param); break;
            case 'getThreeBestRateParams': $this->getThreeBestRateParams($_param); break;
            case 'setActiveThreeBestRateParams': $this->setActiveThreeBestRateParams($_param); break;
            case 'setNewThreeBestRateParams': $this->setNewThreeBestRateParams($_param); break;
            case 'getOrderMarksTemplate': $this->getOrderMarksTemplate($_param); break;
            case 'setOrderMark': $this->setOrderMark($_param); break;
            case 'getCopyOrderAnalogRate': $this->getCopyOrderAnalogRate($_param); break;
            case 'setRateAnalizeRequest': $this->setRateAnalizeRequest($_param); break;
            case 'setFilesToOrder':  $this->setFilesToOrder($_param); break;
            case 'getNotPayedInvoices':  $this->getNotPayedInvoices($_param); break;
            case 'getVedexxFaq': $this->getVedexxFaq(); break;
            case 'getRwRentServiceInfo': $this->getRwRentServiceInfo($_param); break;
            case 'getClientRequestsList': $this->getClientRequestsList($_param); break;
            case 'getAdditionalExpensesRateByOrdId':  $this->getAdditionalExpensesRateByOrdId($_param); break;
            case 'getAutoServiceInfoRegion': $this->getAutoServiceInfoRegion($_param); break;
            case 'getWayBillFileList': $this->getWayBillFileList($_param); break;
            case 'getSearchParamsHistory': $this->getSearchParamsHistory($_param); break;
            case 'setNewAnotherOrder': $this->setNewAnotherOrder($_param); break;
            case 'setUpdateOrderRequest': $this->setUpdateOrderRequest($_param); break;
            case 'addClientRequest': $this->setCompleteDocRequest($_param); break;
            case 'getHotNewsList': $this->getHotNewsList($_param); break;
            case 'getApproximatePrice': $this->getApproximatePrice($_param); break;
            case 'getClientGoodsQuestionnaire': $this->getClientGoodsQuestionnaire($_param); break;
            case 'setClientGoodsQuestionnaire': $this->setClientGoodsQuestionnaire($_param); break;
            case 'getNakInnList': $this->getNakInnList($_param); break;
        }
    }

    function getNakInnList($_param){
        try {
            $_dbw = new dataWrapper('SELECT fruityloops.fn_get_nakinnlist_by_rate_key(\''.$_param['key'].'\','.$_param['client_id'].') AS result', '', true);
            $_dbw->setResultType(emi_res_type::rtARRAY);
            $_data = $_dbw->getData();
            $this->_result = json_encode(
                array(
                    'error' => 0,
                    'message' => $_data[0]['result'],
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

    function getClientGoodsQuestionnaire($_param){
        try {
            $_dbw = new dataWrapper('SELECT id, name, prop_name FROM workflow.prc_checklist_template WHERE template_type = 44342', '', true);
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
                    'message' => 'При обращении к сервису возникли ошибки!s',
                    'emessage' => $e->getMessage()
                )
            );
        }
    }

    function setClientGoodsQuestionnaire($_param){
        try {
            $_dbw = new dataWrapper('SELECT fruityloops.fn_set_client_form(\''.json_encode($_param).'\') AS result', '', true);
            $_dbw->setResultType(emi_res_type::rtARRAY);
            $_data = $_dbw->getData();
            $this->_result = json_encode(
                array(
                    'error' => 0,
                    'message' => $_data[0]['result'],
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

    function getApproximatePrice($_param){
        try {
            $_dbw = new dataWrapper('SELECT rd.fn_check_distance_3(\''.$_param['v_place'].'\', \''.$_param['v_place_to'].'\', '.$_param['v_unit_type'].', '.$_param['v_station_id'].', '.$_param['v_place_to_id'].', '.$_param['v_transporter_id'].') AS result', '', true);
            $_dbw->setResultType(emi_res_type::rtARRAY);
            $_data = $_dbw->getData();
            $this->_result = json_encode(
                array(
                    'error' => 0,
                    'message' => $_data[0]['result'],
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

    function getHotNewsList($_param){
        try {
            $_dbw = new dataWrapper('SELECT * FROM fruityloops.vw_prc_news WHERE is_alert IS TRUE ORDER BY id DESC LIMIT '.$_param['count'], '', true);
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

    function setUpdateOrderRequest($_param){
    try {
        $_dbw = new dataWrapper("SELECT fruityloops.fn_add_update_order_request('".json_encode($_param)."') AS result", '', true);
        $_dbw->setResultType(emi_res_type::rtARRAY);
        $_data = $_dbw->getData();
        $this->_result = json_encode(
            array(
                'error' => 0,
                'message' => $_data[0]['result'],
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

    function setNewAnotherOrder($_param){
        try {
            $_dbw = new dataWrapper("SELECT fruityloops.fn_add_another_request('".json_encode($_param)."') AS result", '', true);
            $_dbw->setResultType(emi_res_type::rtARRAY);
            $_data = $_dbw->getData();
            $this->_result = json_encode(
                array(
                    'error' => 0,
                    'message' => $_data[0]['result'],
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

    function getSearchParamsHistory($_param){
        try {
            if (is_int($_param['service_id'])) {
                $_dbw = new dataWrapper('SELECT fruityloops.fn_get_search_params_history(\''.
                    $_param['token'].'\','.
                    $_param['search_type'].') AS result', '', true);
            } else {
                $_dbw = new dataWrapper('SELECT fruityloops.fn_get_search_params_history(\''.
                    $_param['token'].'\',\''.
                    $_param['search_type'].'\') AS result', '', true);
            }
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

    function getWayBillFileList($_param){
      try {
        $_dbw = new dataWrapper('SELECT * FROM web.vw_waybill_files_for_vehicle', '', true);
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

    function getAutoServiceInfoRegion($_param){
    try {
        $_dbw = new dataWrapper('SELECT rd.fn_check_distance(\''.
            $_param['place_from'].'\', \''.
            $_param['place_to'].'\', \''.
            $_param['place_across'].'\', '.
            $_param['unit_type'].') AS result', '', true);
        $_dbw->setResultType(emi_res_type::rtARRAY);
        $_data = $_dbw->getData();
        $this->_result = json_encode(
            array(
                'error' => 0,
                'message' => $_data[0]['result'],
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

    function getAdditionalExpensesRateByOrdId($_param){
        try {
            $_dbw = new dataWrapper('SELECT fruityloops.fn_get_additional_expenses_rate_by_ordid('.$_param['ord_id'].') AS result', '', true);
            $_dbw->setResultType(emi_res_type::rtARRAY);
            $_data = $_dbw->getData();
            $this->_result = json_encode(
                array(
                    'error' => 0,
                    'message' => $_data[0]['result'],
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

    function getClientRequestsList($_param){
        try {
            $_dbw = new dataWrapper('SELECT * FROM web.vw_prc_clients_request cr WHERE cr.client_id = '.$_param['client_id'], '', true);
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

    function getRwRentServiceInfo($_param){
        try {
            if (is_int($_param['service_id'])){
                $_dbw = new dataWrapper('SELECT fruityloops.fn_get_service_info('.
                    $_param['service_id'].', '.
                    $_param['place_from'].', '.
                    $_param['place_from_ext'].', '.
                    $_param['place_to'].', '.
                    $_param['place_to_ext'].', '.
                    $_param['v_unit_type'].', '.
                    ') AS result', '', true);
            } else {
                $_dbw = new dataWrapper('SELECT fruityloops.fn_get_service_info(\''.$_param['service_id'].'\', '.
                    $_param['place_from'].', '.
                    $_param['place_from_ext'].', '.
                    $_param['place_to'].', '.
                    $_param['place_to_ext'].', '.
                    $_param['v_unit_type'].', '.
                    ') AS result', '', true);
            }
            $_dbw->setResultType(emi_res_type::rtARRAY);
            $_data = $_dbw->getData();
            $this->_result = json_encode(
                array(
                    'error' => 0,
                    'message' => $_data[0]['result'],
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

    function getVedexxFaq(){
        try {
            $_dbw = new dataWrapper('SELECT * FROM fruityloops.vw_prc_vedexx_faq', '', true);
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

    function getNotPayedInvoices($_param){
        try {
            $_dbw = new dataWrapper('SELECT * FROM web.vw_client_not_payed_invoices WHERE 1 = 1', ' AND clnt_id = '.$_param['client_id'].' ORDER BY invoice_date ASC', true);
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

    function setFilesToOrder($_param){
        try {
            $_dbw = new dataWrapper("SELECT  fruityloops.fn_add_order_files('".json_encode($_param)."') AS result", '', true);
            $_dbw->setResultType(emi_res_type::rtARRAY);
            $_data = $_dbw->getData();
            $this->_result = json_encode(
                array(
                    'error' => 0,
                    'message' => $_data[0]['result'],
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

    function setRateAnalizeRequest($_param){
        try {
            $_dbw = new dataWrapper("SELECT fruityloops.fn_add_rate_analize_request('".json_encode($_param)."') AS result", '', true);
            $_dbw->setResultType(emi_res_type::rtARRAY);
            $_data = $_dbw->getData();
            $this->_result = json_encode(
                array(
                    'error' => 0,
                    'message' => $_data[0]['result'],
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

    function getCopyOrderData($_param){
        try {
            $_dbw = new dataWrapper("SELECT fruityloops.fn_get_copy_order_data(".$_param['ord_id'].") AS result", "", true);
            $_dbw->setResultType(emi_res_type::rtARRAY);
            $_data = $_dbw->getData();
            return $_data[0]['result'];
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    function getCopyOrderIdenticalRateKey($_param){
        try {
            $_dbw = new dataWrapper("SELECT key FROM fruityloops.fx_get_renew_rate(".$_param['ord_id'].")", "", true);
            $_dbw->setResultType(emi_res_type::rtARRAY);
            $_data = $_dbw->getData();
            return $_data[0]['key'];
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    function getCopyOrderAnalogRate($_param){
      try {
        $_dbw = new dataWrapper("SELECT fruityloops.fn_get_copy_order_analog_rate(".$_param['ord_id'].") AS result", "", true);
        $_dbw->setResultType(emi_res_type::rtARRAY);
        $_data = $_dbw->getData();
        $_res['rates'] = json_decode($_data[0]['result'], true);
        $_res['identical_rate'] = $this->getCopyOrderIdenticalRateKey($_param);
        $_res['order'] = json_decode($this->getCopyOrderData($_param), true);
        $this->_result = json_encode(
            array(
                'error' => 0,
                'message' => json_encode($_res),
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

    function getBookingRequestComments($_param){
      try {
        $_dbw = new dataWrapper('SELECT * FROM fruityloops.vw_booking_request_comments WHERE 1 = 1', ' AND obj_id = '.$_param['ord_id'], true);
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

    function setOrderMark($_param){
      try {
        $_dbw = new dataWrapper("SELECT fruityloops.fn_set_order_marks('".json_encode($_param)."') AS result", '', true);
        $_dbw->setResultType(emi_res_type::rtARRAY);
        $_data = $_dbw->getData();
        $this->_result = json_encode(
            array(
                'error' => 0,
                'message' => $_data[0]['result'],
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

  function getOrderMarksTemplate($_param){
    try {
        $_dbw = new dataWrapper("SELECT fruityloops.fn_get_order_marks_template(".$_param['ord_id'].") AS result", '', true);
        $_dbw->setResultType(emi_res_type::rtARRAY);
        $_data = $_dbw->getData();
        $this->_result = json_encode(
            array(
                'error' => 0,
                'message' => $_data[0]['result'],
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

    function setNewThreeBestRateParams($_param){
        try {
            $_dbw = new dataWrapper("SELECT fruityloops.fn_add_three_best_rate_params('".json_encode($_param)."') AS result", '', true);
            $_dbw->setResultType(emi_res_type::rtARRAY);
            $_data = $_dbw->getData();
            $this->_result = json_encode(
                array(
                    'error' => 0,
                    'message' => $_data[0]['result'],
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

    function setActiveThreeBestRateParams($_param){
        try {
            $_dbw = new dataWrapper('UPDATE fruityloops.prc_user_rate_auto_notify_params SET is_active = ('.$_param['is_active'].' = 1) WHERE id = '.$_param['id'], '', true);
            $_dbw->getData(1);
            $this->_result = json_encode(
                array(
                    'error' => 0,
                    'message' => 'Настройки успешно сохранены!',
                    'emessage' => ''
                )
            );
        } catch (Exception $e) {
            $this->_result = json_encode(
                array(
                    'error' => 1,
                    'message' => 'При сохранении данных возникли ошибки!',
                    'emessage' => $e->getMessage()
                )
            );
        }
    }

    function getThreeBestRateParams($_param){
        try {
            $_dbw = new dataWrapper('SELECT json_agg(row_to_json(v, true)) AS result FROM (SELECT p.id, COALESCE(p.is_active, false)::integer AS is_active, p.json_data AS data FROM fruityloops.prc_user_rate_auto_notify_params p WHERE p.client_id = '.$_param['client_id'].') v', '', true);
            $_dbw->setResultType(emi_res_type::rtARRAY);
            $_data = $_dbw->getData();
            $this->_result = json_encode(
                array(
                    'error' => 0,
                    'message' => $_data[0]['result'],
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

    function setFeedBack($_param){
        try {
            $_miRec = new miRec('fruityloops.prc_feedback', 'id');
            $_miRec->setPartData(json_encode(
                array(
                    'recipient' => $_param['to'],
                    'bcc' => $_param['bcc'],
                    'cc' => $_param['cc'],
                    'subject' => $_param['subject'],
                    'type' => $_param['type'],
                    'body' => $_param['body']
//                    'atachments' => $_param['obj_id'],
                )
            ));
            $this->_result = json_encode(
                array(
                    'error' => 0,
                    'message' => 'Запрос успешно отправлен!',
                    'emessage' => ''
                )
            );
        } catch (Exception $e) {
            $this->_result = json_encode(
                array(
                    'error' => 1,
                    'message' => 'При сохранении возникли ошибки!',
                    'emessage' => $e->getMessage()
                )
            );
        }
    }

    function setContragentRateInfo($_param){
        try {
            $_dbw = new dataWrapper('SELECT fruityloops.fn_change_contragent_rate_request(\''.json_encode($_param).'\') AS result', '', true);
            $_dbw->setResultType(emi_res_type::rtARRAY);
            $_data = $_dbw->getData();
            $this->_result = json_encode(
                array(
                    'error' => 0,
                    'message' => $_data[0]['result'],
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

    function getTransporterInfoByKey($_param){
        try {
            $_dbw = new dataWrapper('SELECT * FROM fruityloops.prc_transporter_info i WHERE i.logo_name = '.$_param['key'], '', true);
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

    function getTransporterInfoById($_param){
        try {
            $_dbw = new dataWrapper('SELECT * FROM fruityloops.prc_transporter_info i WHERE i.contragent_id = '.$_param['line_id'], '', true);
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

    function getInshuranceCost($_param){
        try {
            $_dbw = new dataWrapper('SELECT rd.fn_get_inshurance_price('.
                $_param['gds_cost'].', '.
                $_param['client_id'].') AS result', '', true);
            $_dbw->setResultType(emi_res_type::rtARRAY);
            $_data = $_dbw->getData();
            $this->_result = json_encode(
                array(
                    'error' => 0,
                    'message' => $_data[0]['result'],
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

    function setCompleteDocRequest($_param){
        try {
            $_dbw = new dataWrapper("SELECT fruityloops.fn_add_complete_doc_request('".json_encode($_param)."') AS result", '', true);
            $_dbw->setResultType(emi_res_type::rtARRAY);
            $_data = $_dbw->getData();
            $this->_result = json_encode(
                array(
                    'error' => 0,
                    'message' => $_data[0]['result'],
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

    function getClientReviewsList($_param){
        try {
            $_dbw = new dataWrapper('SELECT * FROM fruityloops.vw_prc_client_reviews WHERE 1 = 1', '', true);
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

    function getSettingByName($_param){
      try {
        $_val = getSettingByName($_param['setting_name']);
        $this->_result = json_encode(
            array(
                'error' => 0,
                'message' => json_encode(array($_param['setting_name'] => $_val)),
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

    function getOurTeam($_param){
    try {
        $_dbw = new dataWrapper('SELECT * FROM fruityloops.vw_our_team WHERE 1 = 1', '', true);
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

    function getSecurityServiceInfo($_param){
      try {
        $_dbw = new dataWrapper('SELECT rd.fn_get_sec_summa_by_rate_key(\''.$_param['key'].'\', '.$_param['client_id'].') AS result', '', true);
        $_dbw->setResultType(emi_res_type::rtARRAY);
        $_data = $_dbw->getData();
        $this->_result = json_encode(
            array(
                'error' => 0,
                'message' => $_data[0]['result'],
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

    function getFinDetailsByOrderId($_param){
        try {
            $_dbw = new dataWrapper('SELECT fruityloops.fn_get_order_cost('.$_param['ord_id'].') AS result', '', true);
            $_dbw->setResultType(emi_res_type::rtARRAY);
            $_data = $_dbw->getData();
            $this->_result = json_encode(
                array(
                    'error' => 0,
                    'message' => $_data[0]['result'],
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

    function getAutoServiceInfo($_param){
        try {
            $_dbw = new dataWrapper('SELECT rd.fn_get_price_autodelivery('.
                $_param['distance'].', '.
                $_param['unit_type'].', '.
                $_param['weight'].', '.
                $_param['is_vtt'].', '.
                $_param['is_moscow'].') AS result', '', true);
            $_dbw->setResultType(emi_res_type::rtARRAY);
            $_data = $_dbw->getData();
            $this->_result = json_encode(
                array(
                    'error' => 0,
                    'message' => $_data[0]['result'],
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

    function setNotifyStatus($_param){
        try {
            $_dbw = new dataWrapper('SELECT fruityloops.fn_set_notify_status('.$_param['id'].', '.$_param['value'].') AS result', '', true);
            $_dbw->setResultType(emi_res_type::rtARRAY);
            $_data = $_dbw->getData();
            $this->_result = json_encode(
                array(
                    'error' => 0,
                    'message' => $_data[0]['result'],
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

    function getAlternativeRoute($_param){
        try {
          if (!isset($_param['place_to']))
            $_dbw = new dataWrapper('SELECT fruityloops.fn_get_alternative_route('.$_param['place_from'].') AS result', '', true);
          else
            $_dbw = new dataWrapper('SELECT fruityloops.fn_get_alternative_route('.$_param['place_from'].','.$_param['place_to'].','.$_param['type'].') AS result', '', true);
            $_dbw->setResultType(emi_res_type::rtARRAY);
            $_data = $_dbw->getData();
            $this->_result = json_encode(
                array(
                    'error' => 0,
                    'message' => $_data[0]['result'],
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

    function getRateListAlert($_param){
        try {
        if (isset($_param['token'])){
            if (isset($_param['client_id']))
                $_dbw = new dataWrapper('SELECT fruityloops.fn_get_ratelist_alarm_json(\'' .
                    $_param['on_date'] . '\'::date, ' .
                    $_param['place_to'] . ', \'' .
                    $_param['place_from'] . '\', ' .
                    $_param['unit_code'] . ', \'' .
                    $_param['alarm_class'] . '\', ' .
                    $_param['client_id'] . ', 0, \''.
                    $_param['token'].'\') AS result', '', true);
            else
                $_dbw = new dataWrapper('SELECT fruityloops.fn_get_ratelist_alarm_json(\'' .
                    $_param['on_date'] . '\'::date, ' .
                    $_param['place_to'] . ', \'' .
                    $_param['place_from'] . '\', ' .
                    $_param['unit_code'] . ', \'' .
                    $_param['alarm_class'] . '\', -99, 0, \''.
                    $_param['token'].'\') AS result', '', true);
        } else {
            if (isset($_param['client_id']))
                $_dbw = new dataWrapper('SELECT fruityloops.fn_get_ratelist_alarm_json(\'' .
                    $_param['on_date'] . '\'::date, ' .
                    $_param['place_to'] . ', \'' .
                    $_param['place_from'] . '\', ' .
                    $_param['unit_code'] . ', \'' .
                    $_param['alarm_class'] . '\', ' .
                    $_param['client_id'] . ') AS result', '', true);
            else
                $_dbw = new dataWrapper('SELECT fruityloops.fn_get_ratelist_alarm_json(\'' .
                    $_param['on_date'] . '\'::date, ' .
                    $_param['place_to'] . ', \'' .
                    $_param['place_from'] . '\', ' .
                    $_param['unit_code'] . ', \'' .
                    $_param['alarm_class'] . '\') AS result', '', true);
        }
          $_dbw->setResultType(emi_res_type::rtARRAY);
          $_data = $_dbw->getData();
          $this->_result = json_encode(
              array(
                  'error' => 0,
                  'message' => $_data[0]['result'],
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

    function getStatisticData($_param){
        try {
            $_dbw = new dataWrapper('SELECT fruityloops.fn_get_statistic_data() AS result', '', true);
            $_dbw->setResultType(emi_res_type::rtARRAY);
            $_data = $_dbw->getData();
            $this->_result = json_encode(
                array(
                    'error' => 0,
                    'message' => $_data[0]['result'],
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

    function getRateStatisticByKey($_param){
        try {
            $_dbw = new dataWrapper('SELECT fruityloops.fn_get_rate_statistic_by_key(\''.$_param['key'].'\') AS result', '', true);
            $_dbw->setResultType(emi_res_type::rtARRAY);
            $_data = $_dbw->getData();
            $this->_result = json_encode(
                array(
                    'error' => 0,
                    'message' => $_data[0]['result'],
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

    function getServiceDelayInfo($_param){
        try {
            if (is_int($_param['service_id'])){
                $_dbw = new dataWrapper('SELECT fruityloops.fn_get_service_info('.$_param['service_id'].', '.$_param['client_id'].',\''.$_param['rate_key'].'\') AS result', '', true);
            } else {
                $_dbw = new dataWrapper('SELECT fruityloops.fn_get_service_info(\''.$_param['service_id'].'\', '.$_param['client_id'].',\''.$_param['rate_key'].'\') AS result', '', true);
            }
            $_dbw->setResultType(emi_res_type::rtARRAY);
            $_data = $_dbw->getData();
            $this->_result = json_encode(
                array(
                    'error' => 0,
                    'message' => $_data[0]['result'],
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

    function addContractFile($_param){
      try {
        $_dbw = new dataWrapper('SELECT fruityloops.fn_add_contract_file(\''.json_encode($_param).'\') AS result', '', true);
        $_dbw->setResultType(emi_res_type::rtARRAY);
        $_data = $_dbw->getData();
        $this->_result = json_encode(
            array(
                'error' => 0,
                'message' => $_data[0]['result'],
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

    function getNewsBody($_param){
      try {
        $_dbw = new dataWrapper('SELECT * FROM fruityloops.vw_prc_news WHERE id = '.$_param['id'], '', true);
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

    function getServiceInfo($_param){
        try {
            if (is_int($_param['service_id'])){
                $_dbw = new dataWrapper('SELECT fruityloops.fn_get_service_info('.$_param['service_id'].', '.$_param['client_id'].') AS result', '', true);
            } else {
                $_dbw = new dataWrapper('SELECT fruityloops.fn_get_service_info(\''.$_param['service_id'].'\', '.$_param['client_id'].') AS result', '', true);
            }
            $_dbw->setResultType(emi_res_type::rtARRAY);
            $_data = $_dbw->getData();
            $this->_result = json_encode(
                array(
                    'error' => 0,
                    'message' => $_data[0]['result'],
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

    function getDocument($_param){
        try {
            $_dbw = new dataWrapper('SELECT fruityloops.fn_get_client_document('.$_param['id'].', \''.$_param['doc_type'].'\') AS result', '', true);
            $_dbw->setResultType(emi_res_type::rtARRAY);
            $_data = $_dbw->getData();
            $this->_result = json_encode(
                array(
                    'error' => 0,
                    'message' => $_data[0]['result'],
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

    function getServiceNews($_param){
        try{
            $_dbw = new dataWrapper('SELECT * FROM web.vw_prc_news WHERE 1 = 1', '', true);
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

    function setOrderMarks($_param){
        try {
            $_dbw = new dataWrapper('SELECT fruityloops.fn_set_order_marks('.$_param['ord_id'].', '.$_param['mark_value'].') AS result', '', true);
            $_dbw->setResultType(emi_res_type::rtARRAY);
            $_data = $_dbw->getData();
            if ($_data[0]['result'] != 0)
                $this->_result = json_encode(
                    array(
                        'error' => 0,
                        'message' => $_data[0]['result'],
                        'emessage' => ''
                    )
                );
            else
                $this->_result = json_encode(
                    array(
                        'error' => 1,
                        'message' => 'При обращении к сервису возникли ошибки!',
                        'emessage' => 'БД вернула код 0.'
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

    function getMinRateJson($_param){
        try {
            if (isset($_param['client_id']))
                $_dbw = new dataWrapper('SELECT fruityloops.fn_get_min_rate_json(\''.$_param['on_date'].'\'::date, '.$_param['place_to'].', \''.$_param['place_from'].'\', '.$_param['unit_code'].', '.$_param['client_id'].') AS result', '', true);
            else
                $_dbw = new dataWrapper('SELECT fruityloops.fn_get_min_rate_json(\''.$_param['on_date'].'\'::date, '.$_param['place_to'].', \''.$_param['place_from'].'\', '.$_param['unit_code'].') AS result', '', true);
            $_dbw->setResultType(emi_res_type::rtARRAY);
            $_data = $_dbw->getData();
            $this->_result = json_encode(
                array(
                    'error' => 0,
                    'message' => $_data[0]['result'],
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

    function setServiceEvaluation($_param){
        try {
            $_dbw = new dataWrapper('SELECT fruityloops.fn_set_service_evaluation(\''.json_encode($_param).'\') AS result', '', true);
            $_dbw->setResultType(emi_res_type::rtARRAY);
            $_data = $_dbw->getData();
            $this->_result = json_encode(
                array(
                    'error' => 0,
                    'message' => $_data[0]['result'],
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

    function setUserDocumentStatus($_param){
      try {
          $_dbw = new dataWrapper('SELECT fruityloops.fn_update_user_doc_status(\''.
            $_param['token'].'\', '.
            $_param['client_id'].', \''.
            $_param['status_name'].'\', '.
            $_param['value'].') AS result', '', true);
          $_dbw->setResultType(emi_res_type::rtARRAY);
          $_data = $_dbw->getData();
          $this->_result = json_encode(
              array(
                  'error' => 0,
                  'message' => $_data[0]['result'],
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

    function setPrefRequestData($_param){
        try {
            $_dbw = new dataWrapper('SELECT fruityloops.fn_set_pref_request(\''.json_encode($_param).'\') AS result', '', true);
            $_dbw->setResultType(emi_res_type::rtARRAY);
            $_data = $_dbw->getData();
            $this->_result = json_encode(
                array(
                    'error' => 0,
                    'message' => $_data[0]['result'],
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

    function setNewContragent($_param){
      try {
          $_dbw = new dataWrapper('SELECT fruityloops.fn_add_new_contragent(\''.json_encode($_param).'\') AS result', '', true);
          $_dbw->setResultType(emi_res_type::rtARRAY);
          $_data = $_dbw->getData();
          $this->_result = json_encode(
              array(
                  'error' => 0,
                  'message' => $_data[0]['result'],
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

    function getSiteMenuJson($_param){
      try {
          $_dbw = new dataWrapper('SELECT fruityloops.fn_get_site_menu_json() AS result', '', true);
          $_dbw->setResultType(emi_res_type::rtARRAY);
          $_data = $_dbw->getData();
          $this->_result = json_encode(
              array(
                  'error' => 0,
                  'message' => $_data[0]['result'],
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

    function getArticleBodyJson($_param){
      try {
          $_dbw = new dataWrapper('SELECT fruityloops.fn_get_article_body_json('.$_param['id'].') AS result', '', true);
          $_dbw->setResultType(emi_res_type::rtARRAY);
          $_data = $_dbw->getData();
          $this->_result = json_encode(
              array(
                  'error' => 0,
                  'message' => $_data[0]['result'],
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

    function getUserData($_param){
      try {
          $_dbw = new dataWrapper('SELECT fruityloops.fn_get_user_data(\''.$_param['key'].'\') AS result', '', true);
          $_dbw->setResultType(emi_res_type::rtARRAY);
          $_data = $_dbw->getData();
          $this->_result = json_encode(
              array(
                  'error' => 0,
                  'message' => $_data[0]['result'],
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

    function getRecomendations($_param){
      try {
          $_dbw = new dataWrapper('SELECT fruityloops.fn_get_recomendations() AS result', '', true);
          $_dbw->setResultType(emi_res_type::rtARRAY);
          $_data = $_dbw->getData();
          $this->_result = json_encode(
              array(
                  'error' => 0,
                  'message' => $_data[0]['result'],
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

    function setRateRequestMessage($_param){
      try {
          $_dbw = new dataWrapper('SELECT fruityloops.fn_create_rate_requset_messge('.$_param['client_id'].', \''.$_param['key'].'\', \''.$_param['notes'].'\') AS result', '', true);
          $_dbw->setResultType(emi_res_type::rtARRAY);
          $_data = $_dbw->getData();
          $this->_result = json_encode(
              array(
                  'error' => 0,
                  'message' => $_data[0]['result'],
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

    function getComplexAdditionalExpences($_param){
      try {
          $_dbw = new dataWrapper('SELECT fruityloops.fn_get_additional_expenses_rate_complex(\''.$_param['line_ids'].'\', \''.$_param['place_to_ids'].'\', \''.$_param['point_to_ids'].'\', \''.$_param['unit_code'].'\') AS result', '', true);
          $_dbw->setResultType(emi_res_type::rtARRAY);
          $_data = $_dbw->getData();
          $this->_result = json_encode(
              array(
                  'error' => 0,
                  'message' => $_data[0]['result'],
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

    function getComplexShipSchedule($_param){
      try {
          $_dbw = new dataWrapper('SELECT fruityloops.fn_get_ship_schedule_complex(\''.$_param['on_date'].'\'::date, \''.$_param['place_from_ids'].'\', \''.$_param['place_to_ids'].'\', \''.$_param['line_ids'].'\') AS result', '', true);
          $_dbw->setResultType(emi_res_type::rtARRAY);
          $_data = $_dbw->getData();
          $this->_result = json_encode(
              array(
                  'error' => 0,
                  'message' => $_data[0]['result'],
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

    function getComplexRateList($_param){
      try {
      if (isset($_param['token'])){
          if (isset($_param['line_id']))
              $_dbw = new dataWrapper('SELECT fruityloops.fn_getratelist_complex(\'' .
                  $_param['on_date'] . '\'::date, \'' .
                  $_param['place_to'] . '\', \'' .
                  $_param['place_from'] . '\', \'' .
                  $_param['unit_code'] . '\', ' .
                  $_param['client_id'] . ',\'' .
                  $_param['line_id'] . '\', 0, \''.
                  $_param['token'].'\') AS result', '', true);
          else
              $_dbw = new dataWrapper('SELECT fruityloops.fn_getratelist_complex(\'' .
                  $_param['on_date'] . '\'::date, \'' .
                  $_param['place_to'] . '\', \'' .
                  $_param['place_from'] . '\', \'' .
                  $_param['unit_code'] . '\', ' .
                  $_param['client_id'] . ', \'0\', 0,\''.
                  $_param['token'].'\') AS result', '', true);
      } else {
          if (isset($_param['line_id']))
              $_dbw = new dataWrapper('SELECT fruityloops.fn_getratelist_complex(\'' .
                  $_param['on_date'] . '\'::date, \'' .
                  $_param['place_to'] . '\', \'' .
                  $_param['place_from'] . '\', \'' .
                  $_param['unit_code'] . '\', ' .
                  $_param['client_id'] . ',\'' .
                  $_param['line_id'] . '\') AS result', '', true);
          else
              $_dbw = new dataWrapper('SELECT fruityloops.fn_getratelist_complex(\'' .
                  $_param['on_date'] . '\'::date, \'' .
                  $_param['place_to'] . '\', \'' .
                  $_param['place_from'] . '\', \'' .
                  $_param['unit_code'] . '\', ' .
                  $_param['client_id'] . ') AS result', '', true);
      }
          $_dbw->setResultType(emi_res_type::rtARRAY);
          $_data = $_dbw->getData();
          $this->_result = json_encode(
              array(
                  'error' => 0,
                  'message' => $_data[0]['result'],
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

    function getCompareRateList($_param){
      try {
          $_dbw = new dataWrapper('SELECT fruityloops.fn_get_compare_rates(\''.$_param['on_date'].'\'::date,\''.$_param['keys'].'\', '.$_param['client_id'].') AS result', '', true);
          $_dbw->setResultType(emi_res_type::rtARRAY);
          $_data = $_dbw->getData();
          $this->_result = json_encode(
              array(
                  'error' => 0,
                  'message' => $_data[0]['result'],
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

    function setNewRequest($_param){
      try {
        $_miRec = new miRec('fruityloops.prc_queue_request', 'id');
        $_miRec->setPartData(json_encode(
            $_param
        ));
        $this->_result = json_encode(
          array(
            'error' => 0,
            'message' => 'Запрос успешно отправлен!',
            'emessage' => ''
          )
        );
      } catch (Exception $e) {
        $this->_result = json_encode(
          array(
            'error' => 1,
            'message' => 'При сохранении возникли ошибки!',
            'emessage' => $e->getMessage()
          )
        );
      }
    }

    function getRequestListData($_param){
      try {
          $_dbw = new dataWrapper('SELECT json_agg(row_to_json(r, TRUE)) AS result FROM fruityloops.vw_prc_queue_request r WHERE 1 = 1', '', true);
          $_dbw->setResultType(emi_res_type::rtARRAY);
          $_data = $_dbw->getData();
          $this->_result = json_encode(
              array(
                  'error' => 0,
                  'message' => $_data[0]['result'],
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

    function getShipScheduleByKey($_param){
      try {
          $_dbw = new dataWrapper('SELECT fruityloops.fn_get_shipschedulebykey(\''.$_param['key'].'\', \''.$_param['on_date'].'\', '.$_param['unit_type'].') AS result', '', true);
          $_dbw->setResultType(emi_res_type::rtARRAY);
          $_data = $_dbw->getData();
          $this->_result = json_encode(
              array(
                  'error' => 0,
                  'message' => $_data[0]['result'],
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

    function getRequestDataById($_param){
      try {
          $_dbw = new dataWrapper('SELECT row_to_json(r, TRUE) AS result FROM fruityloops.vw_prc_queue_request r WHERE 1 = 1', ' AND id = '.$_param['id'], true);
          $_dbw->setResultType(emi_res_type::rtARRAY);
          $_data = $_dbw->getData();
          $this->_result = json_encode(
              array(
                  'error' => 0,
                  'message' => $_data[0]['result'],
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

    function getClientCommission($_param){
      try {
          $_dbw = new dataWrapper('SELECT * FROM fruityloops.prc_client_commission WHERE 1 = 1', ' AND id = '.$_param['id'], true);
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

    function setClientCommission($_param){
      try {
        $_miRec = new miRec('fruityloops.prc_client_commission', 'id');
        $_miRec->setPartData(json_encode(
            $_param
        ));
        $this->_result = json_encode(
          array(
            'error' => 0,
            'message' => 'Запрос успешно отправлен!',
            'emessage' => ''
          )
        );
      } catch (Exception $e) {
        $this->_result = json_encode(
          array(
            'error' => 1,
            'message' => 'При сохранении возникли ошибки!',
            'emessage' => $e->getMessage()
          )
        );
      }
    }

    function getDclRequestList($_param){
        try {
            $_dbw = new dataWrapper('SELECT * FROM fruityloops.vw_outsorcing_request WHERE 1 = 1', ' AND outsourcing_user_id = '.$_param['user_id'], true);
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

    function getDclRequestComments($_param){
        try {
            $_dbw = new dataWrapper('SELECT * FROM fruityloops.vw_request_comments WHERE 1 = 1', ' AND obj_id = '.$_param['ord_id'], true);
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

    function getlinkedorders($_param){
            $_dbw = new dataWrapper('SELECT logistic.fn_get_ord_ids_by_ord_id('.$_param['ord_id'].') AS result', '', true);
            $_dbw->setResultType(emi_res_type::rtARRAY);
            $_data = $_dbw->getData();
            return $_data[0]['result'];
    }

    function getClientRequestComments($_param){
        try {
          //           $_dbw = new dataWrapper('SELECT * FROM fruityloops.vw_client_request_comments WHERE 1 = 1', ' AND obj_id = ANY(string_to_array(\''.$this->getlinkedorders($_param).'\', \',\')::integer[])', true);
                     $_dbw = new dataWrapper('SELECT * FROM fruityloops.vw_client_request_comments WHERE 1 = 1', ' AND obj_id = '.$_param['ord_id'], true);
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

    function getCustomsRequestComments($_param){
        try {
            $_dbw = new dataWrapper('SELECT * FROM fruityloops.vw_customs_request_comments WHERE 1 = 1', ' AND obj_id = '.$_param['ord_id'], true);
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

    function getDclRequestHistory($_param){
        try {
            $_dbw = new dataWrapper('SELECT * FROM web.vw_monitor_dt_history WHERE 1 = 1', ' AND ord_id = '.$_param['ord_id'], true);
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

    function getview($_type){
        return ($_type == 314)?"workflow.vw_manager_checklist":"workflow.vw_analotik_checklist";
      }

    function getrequestchecklist($_type, $_param){
        $_dbw = new dataWrapper("SELECT * FROM ".$this->getview($_type)." WHERE 1 = 1", ' AND req_id = '.$_param['req_id'].' ', true);
        $_dbw->setResultType(emi_res_type::rtARRAY);
        return $_dbw->getData();
    }

    function getDclRequestCheckList($_param){
        try {
            $_data = array();
            $_data[0]['analitik'] = $this->getrequestchecklist(316, $_param);
            $_data[0]['manager'] = $this->getrequestchecklist(314, $_param);
            $this->_result = json_encode(
                array(
                    'error' => 0,
                    'message' => json_encode($_data),
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

    function getDclRequestFilters($_param){
/*         try {
            $_dbw = new dataWrapper('SELECT * FROM web.prc_client_orders WHERE 1 = 1', ' AND clnt_id = '.$_param['client_id'], true);
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
        }  */
    }

    function getDclRequestFiles($_param){
        try {
            $_dbw = new dataWrapper('SELECT * FROM fruityloops.vw_request_files WHERE 1 = 1', ' AND ord_id = '.$_param['ord_id'], true);
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

    function setRateRequest($_param){
      try {
        $_miRec = new miRec('logistic.prc_rate_request', 'id');
        $_miRec->setPartData(json_encode(
            $_param
        ));
        $this->_result = json_encode(
          array(
            'error' => 0,
            'message' => 'Запрос успешно отправлен!',
            'emessage' => ''
          )
        );
      } catch (Exception $e) {
        $this->_result = json_encode(
          array(
            'error' => 1,
            'message' => 'При сохранении возникли ошибки!',
            'emessage' => $e->getMessage()
          )
        );
      }
    }

    function setDclRequestComment($_param){
      try {
        $_miRec = new miRec('workflow.prc_comment', 'id');
        $_miRec->setPartData(json_encode(
            array(
              'obj_id' => $_param['obj_id'],
              'description' => addslashes($_param['description']),
              'type_id' => 44443,
              'uuser' => $_param['uuser'],
              'to_user_id' => 526,
              'uuser_id' => $_param['uuser_id']
            )
        ));
        $this->_result = json_encode(
          array(
            'error' => 0,
            'message' => 'Комментарий успешно сохранен!',
            'emessage' => ''
          )
        );
      } catch (Exception $e) {
        $this->_result = json_encode(
          array(
            'error' => 1,
            'message' => 'При сохранении комментария возникли ошибки!',
            'emessage' => $e->getMessage()
          )
        );
      }
    }

    function setClientRequestComment($_param){
        try {
            $_miRec = new miRec('workflow.prc_comment', 'id');
            $_miRec->setPartData(json_encode(
                array(
                    'obj_id' => $_param['obj_id'],
                    'description' => addslashes($_param['description']),
                    'type_id' => 99999,
                    'uuser' => $_param['uuser'],
                    'to_user_id' => 999,
                    'uuser_id' => $_param['uuser_id']
                )
            ));
            $this->_result = json_encode(
                array(
                    'error' => 0,
                    'message' => 'Комментарий успешно сохранен!',
                    'emessage' => ''
                )
            );
        } catch (Exception $e) {
            $this->_result = json_encode(
                array(
                    'error' => 1,
                    'message' => 'При сохранении комментария возникли ошибки!',
                    'emessage' => $e->getMessage()
                )
            );
        }
    }

    function setClientCustomsRequestComment($_param){
    try {
        $_miRec = new miRec('workflow.prc_comment', 'id');
        $_miRec->setPartData(json_encode(
            array(
                'obj_id' => $_param['obj_id'],
                'description' => addslashes($_param['description']),
                'type_id' => 44445,
                'uuser' => $_param['uuser'],
                'to_user_id' => 999,
                'uuser_id' => $_param['uuser_id']
            )
        ));
        $this->_result = json_encode(
            array(
                'error' => 0,
                'message' => 'Комментарий успешно сохранен!',
                'emessage' => ''
            )
        );
    } catch (Exception $e) {
        $this->_result = json_encode(
            array(
                'error' => 1,
                'message' => 'При сохранении комментария возникли ошибки!',
                'emessage' => $e->getMessage()
            )
        );
    }
  }

    function setDclRequestConfirm($_param){
        try {
            $_dbw = new dataWrapper('SELECT * FROM web.fn_set_request_confirm(\''.$_param['token'].'\', \''.$_param['notice_name'].'\')', '', true);
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

    function setDclRequestRemedy($_param){
        try {
            $_dbw = new dataWrapper('SELECT * FROM web.fn_set_request_remedy(\''.$_param['token'].'\', \''.$_param['remedy_name'].'\', \''.$_param['remedy_value'].'\')', '', true);
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

    function setDclRequestState($_param){
      try {
          $_dbw = new dataWrapper('SELECT fruityloops.fn_update_request_state('.$_param['req_id'].', \''.$_param['field_name'].'\', \''.$_param['field_value'].'\'::boolean, \''.$_param['token'].'\') AS req_id', '', true);
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

    function setDclRequestDclNumbers($_param){
      try {
          $_dbw = new dataWrapper('SELECT fruityloops.fn_set_request_dcl_nums('.$_param['req_id'].', \''.$_param['dcl_nums'].'\') AS req_id', '', true);
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

    function auth($_param){
      try {
          $_dbw = new dataWrapper('SELECT fruityloops.fn_auth(\''.$_param['user'].'\', '.$_param['key'].', \''.$_param['mixed'].'\', \''.$_param['service'].'\') as data;', '', true);
          $_dbw->setResultType(emi_res_type::rtARRAY);
          $_rows = $_dbw->getData();
          $this->_result = $_rows[0]['data'];
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

    function checkKey($_param){
      try {
        $dbw = new dataWrapper('SELECT web.fn_checkkey(\''.$_param['token'].'\') as result;', '', true);
        $dbw->setResultType(emi_res_type::rtARRAY);
        $_data = $dbw->getData();
        if ($_data[0]['result'] != 1)
        $this->_result = json_encode(
            array(
              'token' => '00000000-0100-0000-0000-000000000403',
              'error' => 1,
              'message' => 'Ключ просрочен!'
            )
        );
        else{
          $this->_result = json_encode(
              array(
                'token' => $_param['token'],
                'error' => 0,
                'message' => ''
              )
          );
        }
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

    function getReferenceData($_param){
      try {
          $_dbw = new dbLookupData($_param['reference_name']);
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

    function getClientReferenceData($_param){
        try {
            $_dbw = new dataWrapper('SELECT fruityloops.fn_get_client_reference(\''.$_param['reference_name'].'\', '.$_param['client_id'].') AS result', '', true);
            $_dbw->setResultType(emi_res_type::rtARRAY);
            $_data = $_dbw->getData();
            $this->_result = json_encode(
                array(
                    'error' => 0,
                    'message' => $_data[0]['result'],
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

    function uploadFile($_param){
      try {
          $_dbw = new dbLookupData($_param['reference_name']);
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

    function getRequestData($_param){
      try {
          $_dbw = new dataWrapper('SELECT row_to_json(r, true) AS result FROM fruityloops.vw_json_request r WHERE 1 = 1', ' AND r.ord_id = '.$_param['ord_id'], true);
          $_dbw->setResultType(emi_res_type::rtARRAY);
          $_data = $_dbw->getData();
          $this->_result = json_encode(
              array(
                  'error' => 0,
                  'message' => $_data[0]['result'],
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

    function getComment($_param){
      try {
          $_dbw = new dataWrapper('SELECT * FROM fruityloops.vw_request_comments r WHERE 1 = 1', ' AND r.id = '.$_param['id'], true);
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

    function getClientsComment($_param){
        try {
            $_dbw = new dataWrapper('SELECT * FROM fruityloops.vw_client_request_comments r WHERE 1 = 1', ' AND r.id = '.$_param['id'], true);
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

    function getFileInfo($_param){
      try {
          $_dbw = new dataWrapper('SELECT * FROM fruityloops.vw_request_files r WHERE 1 = 1', ' AND r.id = '.$_param['id'], true);
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

    function getUserInfo($_param){
      try {
          $_dbw = new dataWrapper('SELECT * FROM fruityloops.vw_outsorcing_users r WHERE 1 = 1', ' AND r.id = '.$_param['id'], true);
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

    function getHistoryEvent($_param){
      try {
          $_dbw = new dataWrapper('SELECT * FROM web.vw_monitor_dt_history r WHERE 1 = 1', ' AND r.id = '.$_param['id'], true);
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

    function setDclCount($_param){
      try {
          $_dbw = new dataWrapper('SELECT fruityloops.fn_set_request_dcl_count('.$_param['req_id'].', '.$_param['dcl_count'].') AS req_id', '', true);
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

    function getRateListOld($_param){
      try {
          $_dbw = new dataWrapper('SELECT * FROM fruityloops.fx_getratelist(\''.$_param['on_date'].'\'::date, '.$_param['port_id'].', '.$_param['place_to'].', '.$_param['place_from'].', '.$_param['unit_code'].')', '', true);
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

    function getRateList($_param){
      try {
      if (isset($_param['token'])){
          if (isset($_param['client_id']))
              $_dbw = new dataWrapper('SELECT fruityloops.fn_get_ratelist_json(\'' .
                  $_param['on_date'] . '\'::date, ' .
                  $_param['place_to'] . ', \'' .
                  $_param['place_from'] . '\', ' .
                  $_param['unit_code'] . ', ' .
                  $_param['client_id'] .', 0, \''.
                  $_param['token'].'\') AS result', '', true);
          else
              $_dbw = new dataWrapper('SELECT fruityloops.fn_get_ratelist_json(\'' .
                  $_param['on_date'] . '\'::date, ' .
                  $_param['place_to'] . ', \'' .
                  $_param['place_from'] . '\', ' .
                  $_param['unit_code']. ', -99, 0, \''.
                  $_param['token'].'\') AS result', '', true);
      } else {
          if (isset($_param['client_id']))
              $_dbw = new dataWrapper('SELECT fruityloops.fn_get_ratelist_json(\'' .
                  $_param['on_date'] . '\'::date, ' .
                  $_param['place_to'] . ', \'' .
                  $_param['place_from'] . '\', ' .
                  $_param['unit_code'] . ', ' .
                  $_param['client_id'] . ') AS result', '', true);
          else
              $_dbw = new dataWrapper('SELECT fruityloops.fn_get_ratelist_json(\'' .
                  $_param['on_date'] . '\'::date, ' .
                  $_param['place_to'] . ', \'' .
                  $_param['place_from'] . '\', ' .
                  $_param['unit_code'] . ') AS result', '', true);
      }
          $_dbw->setResultType(emi_res_type::rtARRAY);
          $_data = $_dbw->getData();
          $this->_result = json_encode(
              array(
                  'error' => 0,
                  'message' => $_data[0]['result'],
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

    function setLock($_param){
      try {
        $_miRec = new miRec('fruityloops.prc_user_lock', 'id');
        $_miRec->setPartData(json_encode(
            array(
              'user_id' => $_param['user_id'],
              'start_date' => "'".$_param['start_date']."'",
              'end_date' => "'".$_param['end_date']."'",
              'lock_type' => $_param['lock_type']
            )
        ));
        $this->_result = json_encode(
          array(
            'error' => 0,
            'message' => 'Не доступность успешно добавлена!',
            'emessage' => ''
          )
        );
      } catch (Exception $e) {
        $this->_result = json_encode(
          array(
            'error' => 1,
            'message' => 'При сохранении данных возникли ошибки!',
            'emessage' => $e->getMessage()
          )
        );
      }
    }

    function closeLock($_param){
      try {
        $_dbw = new dataWrapper('UPDATE fruityloops.prc_user_lock SET lock_status = 1 WHERE 1 = 1 AND user_id = '.$_param['user_id'], '', true);
        $_dbw->getData(1);
        $this->_result = json_encode(
          array(
            'error' => 0,
            'message' => 'Не доступность успешно удалена!',
            'emessage' => ''
          )
        );
      } catch (Exception $e) {
        $this->_result = json_encode(
          array(
            'error' => 1,
            'message' => 'При сохранении данных возникли ошибки!',
            'emessage' => $e->getMessage()
          )
        );
      }
    }

    function generateLink($_param){
      try {
//          $_dbw = new dataWrapper('SELECT fruityloops.fn_genlink(\''.$_param['email'].'\') AS result', '', true);
          if (isset($_param['inn'])){
            $_dbw = new dataWrapper('SELECT fruityloops.fn_genlink(\'' . $_param['email'] . '\', \''.$_param['inn'].'\') AS result', '', true);
          } else {
            $_dbw = new dataWrapper('SELECT fruityloops.fn_genlink(\'' . $_param['email'] . '\') AS result', '', true);
          }
          $_dbw->setResultType(emi_res_type::rtARRAY);
          $_data = $_dbw->getData();
          $this->_result = json_encode(
              array(
                  'error' => 0,
                  'message' => $_data[0]['result'],
                  'emessage' => ''
              )
          );
      } catch (Exception $e) {
        $this->_result = json_encode(
            array(
                'error' => 1,
                'message' => "Зарегистрировать учетную запись не удалось!",
                'emessage' => ''
            )
        );
      }
    }

    function registerByKey($_param){
      try {
          $_dbw = new dataWrapper('SELECT fruityloops.fn_register_by_key(\''.$_param['key'].'\') AS result', '', true);
          $_dbw->setResultType(emi_res_type::rtARRAY);
          $_data = $_dbw->getData();
          $_result = json_decode($_data[0]['result'], true);
          if($_result['error'] != 1){
              $this->_result = json_encode(
                  array(
                      'error' => 0,
                      'message' => $_result['message'],
                      'emessage' => ''
                  )
              );
          } else {
            $this->_result = json_encode(
                array(
                    'error' => 1,
                    'message' => "Зарегистрировать учетную запись не удалось!",
                    'emessage' => ''
                )
            );
          }
      } catch (Exception $e) {
        $this->_result = json_encode(
            array(
                'error' => 1,
                'message' => "Зарегистрировать учетную запись не удалось!",
                'emessage' => ''
            )
        );
      }
    }

    function getSelfSignedRequestList($_param){
      try {
          $_dbw = new dataWrapper('SELECT * FROM fruityloops.vw_selfsigned_request_list r WHERE 1 = 1', '', true);
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

    function pushRequestToMe($_param){
      try {
          $_dbw = new dataWrapper('SELECT fruityloops.fn_push_request_to_me('.$_param['id'].', '.$_param['user_id'].') AS req_id', '', true);
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

    function getMenuById($_param){
      try {
          $_dbw = new dataWrapper('SELECT web.fn_getmenubyid('.$_param['id'].', \''.$_param['service'].'\') AS result', '', true);
          $_dbw->setResultType(emi_res_type::rtARRAY);
          $_data = $_dbw->getData();
          $this->_result = json_encode(
              array(
                  'error' => 0,
                  'message' => $_data[0]['result'],
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

    function getDocBodyById($_param){
      try {
          $_dbw = new dataWrapper('SELECT * FROM fruityloops.vw_docs_body WHERE id = '.$_param['req_id'], '', true);
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

    function setLastRequestComment($_param){
      $this->setDclRequestComment($_param);
      $this->setDclRequestDclNumbers($_param);
    }

    function setCommentVizited($_param){
      try {
          $_dbw = new dataWrapper('UPDATE workflow.prc_comment SET is_vizited = TRUE WHERE id = '.$_param['id'], '', true);
          $_dbw->getData(1);
          $this->_result = json_encode(
            array(
              'error' => 0,
              'message' => 'Комментарий просмотрен!',
              'emessage' => ''
            )
          );
        } catch (Exception $e) {
          $this->_result = json_encode(
            array(
              'error' => 1,
              'message' => 'При сохранении данных возникли ошибки!',
              'emessage' => $e->getMessage()
            )
          );
      }
    }

    function setMultiCommentVizited($_param){
      try {
          $_dbw = new dataWrapper('UPDATE workflow.prc_comment SET is_vizited = TRUE WHERE id IN ('.$_param['ids'].')', '', true);
          $_dbw->getData(1);
          $this->_result = json_encode(
            array(
              'error' => 0,
              'message' => 'Комментарий просмотрен!',
              'emessage' => ''
            )
          );
        } catch (Exception $e) {
          $this->_result = json_encode(
            array(
              'error' => 1,
              'message' => 'При сохранении данных возникли ошибки!',
              'emessage' => $e->getMessage()
            )
          );
      }
    }

    function setClosedDocs($_param){
      try {
          $_dbw = new dataWrapper('SELECT fruityloops.fn_update_request_state('.$_param['req_id'].', \''.$_param['field_name'].'\', \''.$_param['field_value'].'\'::boolean, \''.$_param['token'].'\') AS req_id', '', true);
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

    function getNewsByRefName($_param){
      try {
          $_dbw = new dataWrapper('SELECT * FROM fruityloops.prc_news_data WHERE ref_name = \''.$_param['ref_name'].'\'', '', true);
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

	function getRateById($_param)
	{
		try {
			$_dbw = new dataWrapper('SELECT fruityloops.fn_get_ratebyid_json(\''.$_param['on_date'].'\'::date,'.$_param['id'].') AS result', '', true);
			$_dbw->setResultType(emi_res_type::rtARRAY);
			$_data = $_dbw->getData();
			$this->_result = json_encode(
			array(
			'error' => 0,
			'message' => $_data[0]['result'],
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

	function getRateByKey($_param)
	{
		try {
      if (isset($_param['client_id']))
        $_dbw = new dataWrapper('SELECT fruityloops.fn_get_ratebykey_json(\''.$_param['on_date'].'\'::date,\''.$_param['key'].'\', '.$_param['client_id'].') AS result', '', true);
      else
			   $_dbw = new dataWrapper('SELECT fruityloops.fn_get_ratebykey_json(\''.$_param['on_date'].'\'::date,\''.$_param['key'].'\') AS result', '', true);

			$_dbw->setResultType(emi_res_type::rtARRAY);
			$_data = $_dbw->getData();
			$this->_result = json_encode(
			array(
			'error' => 0,
			'message' => $_data[0]['result'],
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

  function getAdditionalExpensesRate($_param)
  {
    try {
      $_dbw = new dataWrapper('SELECT fruityloops.fn_get_additional_expenses_rate(\''.$_param['key'].'\') AS result', '', true);
      $_dbw->setResultType(emi_res_type::rtARRAY);
      $_data = $_dbw->getData();
      $this->_result = json_encode(
        array(
          'error' => 0,
          'message' => $_data[0]['result'],
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

	function getDclRequestCost($_param)
	{
		try {
			$_dbw = new dataWrapper('SELECT fruityloops.fn_calc_requset_cost('.$_param['goods_count'].','.$_param['cont_num_count'].','.$_param['dcl_count'].') AS cost', '', true);
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

  function sendAdvertisingRequest($_param){
    try {
      $_miRec = new miRec('crm.prc_advertising_request', 'id');
      $_miRec->setPartData(json_encode(
          $_param
      ));
      $this->_result = json_encode(
        array(
          'error' => 0,
          'message' => 'Запрос успешно отправлен!',
          'emessage' => ''
        )
      );
    } catch (Exception $e) {
      $this->_result = json_encode(
        array(
          'error' => 1,
          'message' => 'При сохранении возникли ошибки!',
          'emessage' => $e->getMessage()
        )
      );
    }
  }

  function getDocumentList($_param){
      try {
          $_dbw = new dataWrapper('SELECT * FROM web.vw_client_order_docs p WHERE p.clnt_id = '.$_param['client_id'].' ORDER BY p.invoice_date', '', true);
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
