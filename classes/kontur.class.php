<?php

//if (!include("phpQuery.php")) { include_once "phpQuery.php"; }

class miKonturConnector {
//    private $_key = '3208d29d15c507395db770d0e65f3711e40374df';
//    private $_key = 'DEMO05f7b861d94d895a138a58226b15f6ba5eed';
    private $_key = '6fc86e48d71496c093a604673be8a6d325067130';
    private $_uri = 'https://focus-api.kontur.ru/api3/';
    private $_result = '';

    function getUrl($_url_params){
        return $this->_uri.$_url_params;
    }

    function dateDiff($_startDate, $_endDate){
        $_interval = date_diff($_startDate, $_endDate);
        return $_interval->format('%Y') * 12  + $_interval->format('%m');
    }

    function getresult(){
        return $this->_result;
    }

    function getDataFromService($_url){
        try {
            $_data = phpQuery::newDocument(file_get_contents($_url));
            return $_data->text();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    function __construct($_json){
        $_param = json_decode($_json, TRUE);
        switch ($_param['method']) {
            case 'getCompanyInfo':  $this->getCompanyInfo($_param); break;
            case 'getCompanyExtendedInfo':  $this->getCompanyExtendedInfo($_param); break;
            case 'getCompanyAnalytics':  $this->getCompanyAnalytics($_param); break;
            case 'getCompanyInfoHistory':  $this->getCompanyInfoHistory($_param); break;
            case 'getCompanyContacts':  $this->getCompanyContacts($_param); break;
            case 'getCompanySites':  $this->getCompanySites($_param); break;
            case 'getCompanyBuhInfo':  $this->getCompanyBuhInfo($_param); break;
            case 'getCompanyLicsInfo':  $this->getCompanyLicsInfo($_param); break;
            case 'getCompanyAutoFinAnalytics':  $this->getCompanyAutoFinAnalytics($_param); break;
            case 'getCompanyBankAccounts':  $this->getCompanyBankAccounts($_param); break;
            case 'getCompanyBankGuarantees':  $this->getCompanyBankGuarantees($_param); break;
            case 'getCompanyTaxes':  $this->getCompanyTaxes($_param); break;
            case 'getCompanyAffiliates':  $this->getCompanyAffiliates($_param); break;
            case 'getCompanyEnforcementProceedings':  $this->getCompanyEnforcementProceedings($_param); break;
            case 'getBrefReport':  $this->getBrefReport($_param); break;
            case 'getBrefReportAsPdf':  $this->getBrefReportAsPdf($_param); break;
            case 'getCompanyBlockedBankAccounts':  $this->getCompanyBlockedBankAccounts($_param); break;
            case 'getCompanyGovPurchasesOfParticipant':  $this->getCompanyGovPurchasesOfParticipant($_param); break;
            case 'getCompanyGovPurchasesOfCustomer':  $this->getCompanyGovPurchasesOfCustomer($_param); break;
            case 'getCompanyInspections':  $this->getCompanyInspections($_param); break;
            case 'getCompanyBeneficialOwners':  $this->getCompanyBeneficialOwners($_param); break;
            case 'getCompanyCertDocs':  $this->getCompanyCertDocs($_param); break;
            case 'getCompanyLicensedActivities':  $this->getCompanyLicensedActivities($_param); break;
            case 'getCompanyPetitionersOfArbitration':  $this->getCompanyPetitionersOfArbitration($_param); break;
            case 'getCompanyBankruptcy':  $this->getCompanyBankruptcy($_param); break;
            case 'getCompanyForeignRepresentatives':  $this->getCompanyForeignRepresentatives($_param); break;
            case 'getEgrulOrEgrip':  $this->getEgrulOrEgrip($_param); break;
            case 'getWorkBan':  $this->getWorkBan($_param); break;
            case 'getWorkWarnings':  $this->getWorkWarnings($_param); break;
            case 'getAllParams': $this->getAllParams($_param); break;
            case 'getCompanyLisingContracts': $this->getCompanyLisingContracts($_param); break;
        }
    }

    function getCompanyInfo($_param){
        return $this->getDataFromService($this->getUrl('req?inn='.$_param['inn'].'&key='.$this->_key));
    }

    function getCompanyLisingContracts($_param){
        return $this->getDataFromService($this->getUrl('lessee?inn='.$_param['inn'].'&key='.$this->_key));
    }

    function getCompanyExtendedInfo($_param){
        return $this->getDataFromService($this->getUrl('egrDetails?inn='.$_param['inn'].'&key='.$this->_key));
    }

    function getCompanyAnalytics($_param){
        return $this->getDataFromService($this->getUrl('analytics?inn='.$_param['inn'].'&key='.$this->_key));
    }

    function getCompanyInfoHistory($_param){
        return $this->getDataFromService($this->getUrl('foundersHistory?inn='.$_param['inn'].'&key='.$this->_key));
    }

    function getCompanyContacts($_param){
        return $this->getDataFromService($this->getUrl('contacts?inn='.$_param['inn'].'&key='.$this->_key));
    }

    function getCompanySites($_param){
        return $this->getDataFromService($this->getUrl('sites?inn='.$_param['inn'].'&key='.$this->_key));
    }

    function getCompanyBuhInfo($_param){
        return $this->getDataFromService($this->getUrl('buh?inn='.$_param['inn'].'&key='.$this->_key));
    }

    function getCompanyLicsInfo($_param){
        return $this->getDataFromService($this->getUrl('licences?inn='.$_param['inn'].'&key='.$this->_key));
    }

    function getCompanyAutoFinAnalytics($_param){
        return $this->getDataFromService($this->getUrl('finanValues?inn='.$_param['inn'].'&key='.$this->_key));
    }

    function getCompanyBankAccounts($_param){
        return $this->getDataFromService($this->getUrl('bankAccounts?inn='.$_param['inn'].'&key='.$this->_key));
    }

    function getCompanyBankGuarantees($_param){
        return $this->getDataFromService($this->getUrl('bankGuarantees?inn='.$_param['inn'].'&key='.$this->_key));
    }

    function getCompanyTaxes($_param){
        return $this->getDataFromService($this->getUrl('taxes?inn='.$_param['inn'].'&key='.$this->_key));
    }

    private function getCompanyAffiliatesBase($_param){

    }

    function getCompanyAffiliates($_param){

    }

    function getCompanyEnforcementProceedings($_param){
        return $this->getDataFromService($this->getUrl('fssp?inn='.$_param['inn'].'&key='.$this->_key));
    }

    function getCompanyBlockedBankAccounts($_param){
        return $this->getDataFromService($this->getUrl('fnsBlockedBankAccounts?inn='.$_param['inn'].'&key='.$this->_key));
    }

    function getCompanyBankruptcy($_param){
        return $this->getDataFromService($this->getUrl('companyBankruptcy?inn='.$_param['inn'].'&key='.$this->_key));
    }

    function getCompanyGovPurchasesOfParticipant($_param){
        return $this->getDataFromService($this->getUrl('govPurchasesOfParticipant?inn='.$_param['inn'].'&key='.$this->_key));
        //  1.	govPurchasesOfCustomer – госзакупки Заказчика
        //  2.	govPurchasesOfParticipant – госзакупки Участника
    }

    function getCompanyGovPurchasesOfCustomer($_param){
        return $this->getDataFromService($this->getUrl('govPurchasesOfCustomer?inn='.$_param['inn'].'&key='.$this->_key));
        //  1.	govPurchasesOfCustomer – гипосзакупки Заказчика
        //  2.	govPurchasesOfParticipant – госзакупки Участника
    }

    function getCompanyInspections($_param){
        return $this->getDataFromService($this->getUrl('inspections?inn='.$_param['inn'].'&key='.$this->_key));
    }

    function getCompanyBeneficialOwners($_param){
        return $this->getDataFromService($this->getUrl('beneficialOwners?inn='.$_param['inn'].'&key='.$this->_key));
    }

    function getCompanyCertDocs($_param){
        return $this->getDataFromService($this->getUrl('fsa?inn='.$_param['inn'].'&key='.$this->_key));
    }

    function getCompanyLicensedActivities($_param){
        return $this->getDataFromService($this->getUrl('licensedActivities?inn='.$_param['inn'].'&key='.$this->_key));
    }

    function getCompanyForeignRepresentatives($_param){
        return $this->getDataFromService($this->getUrl('foreignRepresentatives?inn='.$_param['inn'].'&key='.$this->_key));
    }

    function getCompanyPetitionersOfArbitration($_param){
        return $this->getDataFromService($this->getUrl('petitionersOfArbitration?inn='.$_param['inn'].'&key='.$this->_key));
    }

    private function getBrefReportLink($_param){
        try {
            $_data = phpQuery::newDocument(file_get_contents($this->getUrl('briefReport?inn='.$_param['inn'].'&key='.$this->_key)));
            return json_decode($_data->text(), true)[0]['briefReport']['href'];
        } catch (Exception $e) {
            return '';
        }
    }

    function getBrefReport($_param){
        try {
            $_uri = str_replace('&l', '&', $this->getBrefReportLink($_param));
//            echo $_uri.'<br>';
            $parts = parse_url($_uri);
            parse_str($parts['query'], $_getParam);
            $options = array(
                'http'=>array(
                    'method'=>"GET",
                    'header'=>"Accept-language: ru-RU,ru;q=0.9,en-US;q=0.8,en;q=0.7\r\n" .
                        "User-Agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.5005.141 Whale/3.15.136.29 Safari/537.36\r\n".
                        "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9\r\n".
                        "Cookie: token=".$_getParam['token']."\r\n"
                )
            );

            $context = stream_context_create($options);
//            echo file_get_contents($_uri, false, $context);
            $_data = phpQuery::newDocument(file_get_contents($_uri, false, $context));
            $this->_result = json_encode(
                array(
                    'error' => 0,
                    'message' => $_data->text(),
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

    function getBrefReportAsPdf($_param){

    }

    function getEgrulOrEgrip($_param){
//        return $this->getDataFromService($this->getUrl('excerpt?inn='.$_param['inn'].'&key='.$this->_key));
//  pdf
        /*        try {
                    $_data = phpQuery::newDocument(file_get_contents($this->getUrl('excerpt?inn='.$_param['inn'].'&key='.$this->_key)));
                    $this->_result = json_encode(
                        array(
                            'error' => 0,
                            'message' => $_data->text(),
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
        */
    }

    function checkHistoryChanges($_ul, $_param){
        $_cnt = 0;
        $_date = new DateTime();
        if (isset($_ul['history'][$_param])){
            foreach ($_ul['history'][$_param] as $_row) {
                $_eventDate = DateTime::createFromFormat('Y-m-d', $_row['date']);
                if ($_eventDate > $_date->modify("-12 months")){
                    if ($_eventDate < $_date) {
                        $_cnt++;
                    }
                }
            }
            return ($_cnt > 2);
        } else
            return false;
    }

    function getAllParams($_param){
        $_info = json_decode($this->getCompanyInfo($_param), true);
        $_analytics = json_decode($this->getCompanyAnalytics($_param), true);
        $_extendedInfo = json_decode($this->getCompanyExtendedInfo($_param), true);
        $_lics = []; // $this->getCompanyLicsInfo($_param);
        $_lising = []; // $this->getCompanyLisingContracts($_param);
        $_finan = $this->getCompanyAutoFinAnalytics($_param);
        $_data = Array();
        $_data[0] = $_param;
        $_data[0]['info'] = $_info;
        $_data[0]['analytics'] = $_analytics;
        $_data[0]['additional'] = $_extendedInfo;
        $_data[0]['alerts'] = $this->getAlerts($_analytics[0]['analytics'], $_info[0]['UL']);
        $_data[0]['warnings'] = $this->getWarnings($_analytics[0]['analytics'], $_info[0]['UL'], $_extendedInfo[0]);
        $_data[0]['success'] = $this->getSuccess($_analytics[0]['analytics'], $_info[0]['UL'], $_extendedInfo[0], $_lics, $_lising, $_finan[0]);
        $_data[0]['rate'] = $this->calcRate($_data[0]['alerts'], $_data[0]['warnings'], $_data[0]['success']);
        $_data[0]['alerts_stats'] = $this->getStats($_data[0]['alerts'], 1);
        $_data[0]['warnings_stats'] = $this->getStats($_data[0]['warnings'], 2);
        $_data[0]['success_stats'] = $this->getStats($_data[0]['success'], 3);
        $this->_result = json_encode(
            array(
                'error' => 0,
                'message' => json_encode($_data),
                'emessage' => ''
            )
        );
    }

    function getStats($_params, $_type){
        $_data = [];
        if ($_type == 1){
            foreach (array_keys($_params) as $_param){
                switch ($_param){
                    case 'mark_1': $_data[$_param] = 'Организация ликвидирована или ликвидируется'; break;
                    case 'mark_2': $_data[$_param] = 'Блокировка банковского счета организации'; break;
                    case 'mark_3': $_data[$_param] = 'Намерение подать иск о банкротстве'; break;
                    case 'mark_4': $_data[$_param] = 'Недостоверность сведений об адресе'; break;
                    case 'mark_5': $_data[$_param] = 'Недостоверные сведения о руководителе или учредителе'; break;
                    case 'mark_6': $_data[$_param] = 'Обнаружены арбитражные дела о банкротстве в качестве ответчика'; break;
                    case 'mark_7': $_data[$_param] = 'Обнаружены признаки завершенной процедуры банкротства'; break;
                    case 'mark_8': $_data[$_param] = 'Обнаружены сообщения о текущей процедуре банкротства (стадия)'; break;
                    case 'mark_9': $_data[$_param] = 'Подано заявление на ликвидацию'; break;
                    case 'mark_10_1': $_data[$_param] = 'Руководитель организации является банкротом'; break;
                    case 'mark_10_2': $_data[$_param] = 'Учредитель организации является банкротом'; break;
                    case 'mark_11': $_data[$_param] = 'Руководство в реестре дисквалифицированных лиц'; break;
//                    case 'mark_12': $_data[$_param] = 'Более половины связанных организаций имеют признаки банкротства.'; break;
                    case 'mark_13_3': $_data[$_param] = 'Организация зарегистрирована менее 3 месяцев'; break;
                    case 'mark_13_6': $_data[$_param] = 'Организация зарегистрирована менее 6 месяцев'; break;
                    case 'mark_13_12': $_data[$_param] = 'Организация зарегистрирована менее 12 месяцев'; break;
                    case 'mark_14': $_data[$_param] = 'Задолженность по уплате налогов свыше 1000 рублей'; break;
                };
            }
        }
        if ($_type == 2){
            foreach (array_keys($_params) as $_param){
                switch ($_param){
                    case 'mark_1': $_data[$_param] = 'Деятельность предприятия убыточна'; break;
                    case 'mark_2': $_data[$_param] = 'Исполнительные производства по заработной плате'; break;
                    case 'mark_3': $_data[$_param] = 'Организация в реестре недобросовестных поставщиков'; break;
                    case 'mark_4': $_data[$_param] = 'Руководитель или учредитель найден в Особых реестрах ФНС'; break;
                    case 'mark_5': $_data[$_param] = 'Организация не предоставляет налоговую отчетность больше года'; break;
                    case 'mark_6': $_data[$_param] = 'Значительная сумма арбитражных дел в качестве ответчика (более 3 млн. руб.)'; break;
                    case 'mark_7': $_data[$_param] = 'Значительная сумма исполнительных производств (более 3 млн.)'; break;
                    case 'mark_8': $_data[$_param] = 'Исполнительные производства (взыскания заложенного имущества, кредитные платежи или наложение ареста)'; break;
                    case 'mark_9': $_data[$_param] = 'Смена руководителя чаще 1 раза за последние 12 мес'; break;
                    case 'mark_10': $_data[$_param] = 'Смена учредителей чаще 1 раза за последние 12 мес'; break;
                    case 'mark_11': $_data[$_param] = 'Смена юридического адреса чаще 1 раза за последние 12 мес'; break;
                    case 'mark_12': $_data[$_param] = 'Более половины связанных организаций имеют признаки банкротства.'; break;
                    case 'mark_13': $_data[$_param] = 'Обнаружены арбитражные дела о банкротстве в качестве ответчика'; break;
                };
            }
        }
        if ($_type == 3){
            foreach (array_keys($_params) as $_param){
                switch ($_param){
                    case 'mark_1': $_data[$_param] = 'Наличие филиалов и представительств'; break;
                    case 'mark_2': $_data[$_param] = 'Организация зарегистрирована более 3 лет назад'; break;
                    case 'mark_3': $_data[$_param] = 'Наличие государственных контрактов'; break;
                    case 'mark_4': $_data[$_param] = 'Наличие действующих лицензий надзорных органов'; break;
                    case 'mark_5': $_data[$_param] = 'Наличие товарных знаков'; break;
                    case 'mark_6': $_data[$_param] = 'Уставный капитал более 100000 руб'; break;
                    case 'mark_7': $_data[$_param] = 'Общее число работников более 10'; break;
                    case 'mark_8': $_data[$_param] = 'Средняя ЗП в компании выше МРОТ на 30% и более'; break;
                    case 'mark_9': $_data[$_param] = 'Действующие договоры лизинга'; break;
                    case 'mark_10': $_data[$_param] = 'Статистическая оценка отчетности за последние 4 года'; break;
//                    case 'mark_10': $_data[$_param] = 'У компании есть основные средства на сумму более 5 млн. руб'; break;
                };
            }
        }
        return $_data;
    }

    function calcRate($_alerts, $_warnings, $_success){
      if (isset($_alerts['mark_15'])){
          return 4;
      }
      if (isset($_alerts['mark_16'])){
          return 4;
      }
      if (isset($_alerts['mark_17'])){
          return 4;
      }
        if (isset($_alerts['mark_13_12']))
            return 4;
        else {
            if (count($_alerts) > 0)
                return 1;
            else
                return 5 - count($_warnings) + count($_success);
        }
    }

    function getAlerts($_analitics, $_ul){
        $_data = [];
        $_bankrupting = 0; $_dissolving = 0; $_dissolved = 0;
        if (isset($_ul['status']['bankrupting'])) {
            if ($_ul['status']['bankrupting']) $_bankrupting = 1; else $_bankrupting = 0;
        }
        if (isset($_ul['status']['dissolving'])){
            if ($_ul['status']['dissolving']) $_dissolving = 1; else $_dissolving = 0;
        }
        if (isset($_ul['status']['dissolved'])) {
            if ($_ul['status']['dissolved']) $_dissolved = 1; else $_dissolved = 0;
        }
        if ((($_bankrupting + $_dissolving + $_dissolved) > 0))
            $_data['mark_1'] = (($_bankrupting + $_dissolving + $_dissolved) > 0);
        if (isset($_analitics['m7010']))
            if ($_analitics['m7010'])
                $_data['mark_2'] = $_analitics['m7010'];
        if (isset($_analitics['m7015']))
            if ($_analitics['m7015'])
                $_data['mark_3'] = $_analitics['m7015'];
        if (isset($_analitics['m5006']))
            if ($_analitics['m5006'])
                $_data['mark_4'] = $_analitics['m5006'];
        if (isset($_analitics['m5007']))
            if ($_analitics['m5007'])
                $_data['mark_5'] = $_analitics['m5007'];
//        if (isset($_analitics['q7026']))
//            if ($_analitics['q7026'] > 0)
//                $_data['mark_6'] = ($_analitics['q7026'] > 0);
        if (isset($_analitics['m7016']))
            if ($_analitics['m7016'])
                $_data['mark_7'] = $_analitics['m7016'];
        if (isset($_analitics['e7014']))
            if ($_analitics['e7014'])
                $_data['mark_8'] = $_analitics['e7014'];
        if (isset($_analitics['m7037']))
            if ($_analitics['m7037'])
                $_data['mark_9'] = $_analitics['m7037'];
        if (isset($_analitics['m7022']))
            if ($_analitics['m7022'])
                $_data['mark_10_1'] = $_analitics['m7022'];
        if (isset($_analitics['m7026']))
            if ($_analitics['m7026'])
                $_data['mark_10_2'] = $_analitics['m7026'];
        if (isset($_analitics['m5008']))
            if ($_analitics['m5008'])
                $_data['mark_11'] = $_analitics['m5008'];
        if (isset($_analitics['q7005']))
            if ($_analitics['q7005'] > 4)
                $_data['mark_12'] = ($_analitics['q7005'] > 4);
        if (isset($_analitics['m7002']))
            if ($_analitics['m7002'])
                $_data['mark_13_3'] = $_analitics['m7002'];
        if (isset($_analitics['m7003']))
            if ($_analitics['m7003'])
                $_data['mark_13_6'] = $_analitics['m7003'];
        if (isset($_analitics['m7004']))
            if ($_analitics['m7004'])
                $_data['mark_13_12'] = $_analitics['m7004'];
        if (isset($_analitics['m5004']))
            if ($_analitics['m5004'])
                $_data['mark_14'] = $_analitics['m5004'];

        return $_data;
    }

    function getWarnings($_analitics, $_ul, $_extendedInfo){
        $_data = [];
        $_m5008 = 0; $_q7018 = 0; $_q7019 = 0;
        $_m1004 = 0; $_m1005 = 0; $_m1006 = 0;
        if (isset($_analitics['s6008']))
            if ($_analitics['s6008'] < 0)
                $_data['mark_1'] = ($_analitics['s6008'] < 0);
        if (isset($_analitics['m1003']))
            if ($_analitics['m1003'])
                $_data['mark_2'] = $_analitics['m1003'];
        if (isset($_analitics['m4001']))
            if ($_analitics['m4001'])
                $_data['mark_3'] = $_analitics['m4001'];

        if (isset($_analitics['m5008'])) {
            if ($_analitics['m5008']) $_m5008 = 1; else $_m5008 = 0;
        }
        if (isset($_analitics['q7018'])) {
            if ($_analitics['q7018'] > 1) $_q7018 = 1; else $_q7018 = 0;
        }
        if (isset($_analitics['q7019'])) {
            if ($_analitics['q7019'] > 1) $_q7019 = 1; else $_q7019 = 0;
        }
//  , но "Нахождение в особых реестрах" мы не учитываем в расчете. -- Mazeev M.Y 2023-09-08
//        if (($_m5008 + $_q7018 + $_q7019) > 0)
//           $_data['mark_4'] = (($_m5008 + $_q7018 + $_q7019) > 0) ;
        if (isset($_analitics['m5005']))
            if ($_analitics['m5005'])
                $_data['mark_5'] = $_analitics['m5005'];
                //   -- Mazeev M.Y 2023-09-08
                //  s6004 < 100 млн и s2002 > 5 млн => -1
                //  500 млн > s6004 > 100 млн и s2002 > 20 млн => -1
                //  s6004 > 500 млн и s2002 > 50 млн => -1
                //  иначе 0
                        if (isset($_analitics['s2001']))
                            if ($_analitics['s2001'] > 3000000) {
                                if (($_analitics['s6004'] <= 100000000) && ($_analitics['s2002'] >= 5000000))
                                    $_data['mark_6'] = true;
                                else if (($_analitics['s6004'] >= 100000000) && ($_analitics['s6004'] <= 500000000) && ($_analitics['s2002'] >= 20000000))
                                    $_data['mark_6'] = true;
                                else if (($_analitics['s6004'] >= 500000000) && ($_analitics['s2002'] >= 50000000))
                                    $_data['mark_6'] = true;
                            }

                //                $_data['mark_6'] = ($_analitics['s2001'] > 3000000);
        if (isset($_analitics['s1001']))
            if ($_analitics['s1001'] > 3000000)
                $_data['mark_7'] = ($_analitics['s1001'] > 3000000);

        if (isset($_analitics['m1006'])) {
            if ($_analitics['m1006']) $_m1006 = 1; else $_m1006 = 0;
        }
        if (isset($_analitics['m1005'])) {
            if ($_analitics['m1005']) $_m1005 = 1; else $_m1005 = 0;
        }
        if (isset($_analitics['m1004'])) {
            if ($_analitics['m1004']) $_m1004 = 1; else $_m1004 = 0;
        }
        if (($_m1004 + $_m1005 + $_m1006) > 0)
            $_data['mark_8'] = (($_m1004 + $_m1005 + $_m1006) > 0);
        $_heads = $this->checkHistoryChanges($_ul, 'heads');
        if ($_heads)
            $_data['mark_9'] = $_heads;
        $_founders = $this->checkHistoryChanges($_extendedInfo, 'foundersFL');
        if ($_founders)
            $_data['mark_10'] = $_founders;
        $_legaladdresses = $this->checkHistoryChanges($_ul,'legalAddresses');
        if ($_legaladdresses)
            $_data['mark_11'] = $_legaladdresses;
        if (isset($_analitics['q7005']))
            if ($_analitics['q7005'] > 4)
                $_data['mark_12'] = ($_analitics['q7005'] > 4);

            //        "e7014": {"description": "Юр. признаки. Текущая стадия банкротства по решению суда от d7014
            // (вычисляется на основе сообщений о банкротстве)", "type": "string", "enum":
            // [
            //      "Наблюдение",
            //      "Финансовое оздоровление",
            //      "Внешнее управление",
            //      "Конкурсное производство",
            //      "Конкурсное производство завершено",
            //      "Реструктуризация долгов",
            //      "Реструктуризация долгов завершена",
            //      "Реализация имущества",
            //      "Реализация имущества завершена",
            //      "Отказано в признании должника банкротом",
            //      "Производство по делу прекращено",
            //      "Не удалось определить стадию"
            //  ]}
                    if (isset($_analitics['q7026']))
                        if ($_analitics['q7026'] > 0)
                            if (isset($_analitics['e7014']))
                                if ($this->checke7014($_analitics['e7014']) != 0)
                                    $_data['mark_13'] = ($_analitics['q7026'] > 0);

        return $_data;
    }

    function checke7014($_e7014){
      switch($_e7014){
          case 'Производство по делу прекращено':
          case 'Не удалось определить стадию': return 0;
          default: return 1;
      }
    }

    function getSuccess($_analitics, $_ul, $_extendedInfo, $_lics, $_lising, $_finan){
        $_data = [];

        $_q4002 = 0; $_q4004 = 0; $_q7022 = -1;
        if (isset($_ul['branches']))    //  array count ?
            if (count($_ul['branches']) > 1)
                $_data['mark_1'] = true;
        if (isset($_ul['registrationDate'])) {
            $_registrationDate = DateTime::createFromFormat('Y-m-d', $_ul['registrationDate']);
            if ($_registrationDate->format('Y')<= (date("Y") - 3))
                $_data['mark_2'] = true;
        }
//        $_data['mark_2'] = $_ul['date'];
        if (isset($_analitics['q4002'])) {
            if ($_analitics['q4002'] > 0) $_q4002 = 1; else $_q4002 = 0;
        }
        if (isset($_analitics['q4004'])) {
            if ($_analitics['q4004'] > 0) $_q4004 = 1; else $_q4004 = 0;
        }
        if (($_q4002 + $_q4004) > 0)
            $_data['mark_3'] = (($_q4002 + $_q4004) > 0);
//`Наличие действующих лицензий надзорных органов (+1).
        if (isset($_lics['licenses']))    //  array count
            if (count($_lics['licenses']) > 0)
                $_data['mark_4'] = true;
        if (isset($_analitics['q9001']))
            if (($_analitics['q9001']) > 0)
                $_data['mark_5'] = (($_analitics['q9001']) > 0);
        if (isset($_extendedInfo['UL']['statedCapital']))
            if ($_extendedInfo['UL']['statedCapital']['sum'] > 100000)
                $_data['mark_6'] = ($_extendedInfo['UL']['statedCapital']['sum'] > 100000);
        if (isset($_analitics['q7022']))
            if (($_analitics['q7022']) > 10)
                $_data['mark_7'] = (($_analitics['q7022']) > 10);
//`Средняя ЗП в компании выше МРОТ на 30% и более (+1). Метод не доступен, показатель отсутсвует
//        $_data['mark_8'] = true;
//`Действующие договоры лизинга (+1).
        if (isset($_lising['contracts']))    //  array count
            if (count($_lising['contracts']) > 0)
            $_data['mark_9'] = true;
//`У компании есть основные средства на сумму более 5 млн. руб. (+1) Данные из баланса за прошедший период. Метод не доступен
//  Взята оценка по фин показателям.
        if (isset($_finan['finanValues'])) {
            if (count($_finan['finanValues']) > 0) {
                if ($_finan['finanValues'][0]['statisticalScore'] > 40)
                $_data['mark_10'] = true;
            }
        }

//        q7022 - Среднесписочная численность работников за календарный год, предшествующий году размещения таких сведений.
//        if (isset($_analitics['q7022']))
//            $_q7022 = $_analitics['q7022'];
        return $_data;
    }

    function getWorkBan($_param){
        $_info = json_decode($this->getCompanyInfo($_param), true);
//        $_blockedaccounts = json_decode($this->getCompanyBlockedBankAccounts($_param), true);
        $_analytics = json_decode($this->getCompanyAnalytics($_param), true);
//        if ($this->_key != '3208d29d15c507395db770d0e65f3711e40374df')
//            $_contacts = json_decode($this->getCompanyContacts($_param), true);
//        else
//            $_contacts = [];
//        $_sites = json_decode($this->getCompanySites($_param), true);
        $_data = Array();
        $_data[0] = $_param;
        $_data[0]['info'] = $_info;
        $_data[0]['analytics'] = $_analytics;
//        $_data[0]['contacts'] = $_contacts;
//        $_data[0]['sites'] = $_sites;
//        $_data[0]['bankruptcy'] = json_decode($this->getCompanyBankruptcy($_param), true);
//        $_data[0]['blockedaccounts'] = $_blockedaccounts;
//        $_data[0]['beneficialandowners'] = json_decode($this->getCompanyBeneficialOwners($_param), true);
        $_data[0]['additional'] = json_decode($this->getCompanyExtendedInfo($_param), true);
//        $_data[0]['analytics'] = $_analytics;
//        $_data[0]['fssp'] = json_decode($this->getCompanyEnforcementProceedings($_param), true);
        if (isset($_info[0]['UL']['status']['dissolved']))
            $_data[0]['mark_1'] = $_info[0]['UL']['status']['dissolved'];
        if (isset($_analytics[0]['analytics']['m7010']))
            $_data[0]['mark_2'] = $_analytics[0]['analytics']['m7010'];
        if (isset($_analytics[0]['analytics']['m7015']))
            $_data[0]['mark_3'] = $_analytics[0]['analytics']['m7015'];
        if (isset($_analytics[0]['analytics']['m5006']))
            $_data[0]['mark_4'] = $_analytics[0]['analytics']['m5006'];
        if (isset($_analytics[0]['analytics']['m5007']))
            $_data[0]['mark_5'] = $_analytics[0]['analytics']['m5007'];
        if (isset($_analytics[0]['analytics']['q7026']))
            $_data[0]['mark_6'] = ($_analytics[0]['analytics']['q7026'] > 0);
        if (isset($_analytics[0]['analytics']['m7016']))
            $_data[0]['mark_7'] = $_analytics[0]['analytics']['m7016'];
        if (isset($_analytics[0]['analytics']['e7014']))
            $_data[0]['mark_8'] = $_analytics[0]['analytics']['e7014'];
        if (isset($_analytics[0]['analytics']['m7037']))
            $_data[0]['mark_9'] = $_analytics[0]['analytics']['m7037'];
        if (isset($_analytics[0]['analytics']['m7022']))
            $_data[0]['mark_10_1'] = $_analytics[0]['analytics']['m7022'];
        if (isset($_analytics[0]['analytics']['m7026']))
            $_data[0]['mark_10_2'] = $_analytics[0]['analytics']['m7026'];
        if (isset($_analytics[0]['analytics']['m5008']))
            $_data[0]['mark_11'] = $_analytics[0]['analytics']['m5008'];
        if (isset($_analytics[0]['analytics']['q7005']))
            $_data[0]['mark_12'] = ($_analytics[0]['analytics']['q7005'] > 4);
        if (isset($_analytics[0]['analytics']['m7002']))
            $_data[0]['mark_13_3'] = $_analytics[0]['analytics']['m7002'];
        if (isset($_analytics[0]['analytics']['m7003']))
            $_data[0]['mark_13_6'] = $_analytics[0]['analytics']['m7003'];
        if (isset($_analytics[0]['analytics']['m7004']))
            $_data[0]['mark_13_12'] = $_analytics[0]['analytics']['m7004'];

        $this->_result = json_encode(
            array(
                'error' => 0,
                'message' => json_encode($_data),
                'emessage' => ''
            )
        );
    }

    function getWorkWarnings($_param){
        $_info = json_decode($this->getCompanyInfo($_param), true);
//        $_blockedaccounts = json_decode($this->getCompanyBlockedBankAccounts($_param), true);
        $_analytics = json_decode($this->getCompanyAnalytics($_param), true);
//        if ($this->_key != '3208d29d15c507395db770d0e65f3711e40374df')
//            $_contacts = json_decode($this->getCompanyContacts($_param), true);
//        else
//            $_contacts = [];
//        $_sites = json_decode($this->getCompanySites($_param), true);
        $_data = Array();
        $_data[0] = $_param;
        $_data[0]['info'] = $_info;
//        $_data[0]['contacts'] = $_contacts;
//        $_data[0]['sites'] = $_sites;
        $_data[0]['additional'] = json_decode($this->getCompanyExtendedInfo($_param), true);
        if (isset($_analytics[0]['analytics']['s6008']))
            $_data[0]['mark_1'] = ($_analytics[0]['analytics']['s6008'] < 0);
        if (isset($_analytics[0]['analytics']['m1003']))
            $_data[0]['mark_2'] = $_analytics[0]['analytics']['m1003'];
        if (isset($_analytics[0]['analytics']['m4001']))
            $_data[0]['mark_3'] = $_analytics[0]['analytics']['m4001'];
        if (isset($_analytics[0]['analytics']['m5008'])){
            if($_analytics[0]['analytics']['m5008']) $_m5008 = 1; else $_m5008 = 0;
            if($_analytics[0]['analytics']['q7018'] > 1) $_q7018 = 1; else $_q7018 = 0;
            if($_analytics[0]['analytics']['q7019'] > 1) $_q7019 = 1; else $_q7019 = 0;
            $_data[0]['mark_4'] = (($_m5008 * $_q7018 * $_q7019) > 0) ;
        }

//        $_data[0]['mark_5'] = [''];
//        $_data[0]['mark_6'] = [''];
//        $_data[0]['mark_7'] = [''];
//        $_data[0]['mark_8'] = [''];
//        $_data[0]['mark_9'] = [''];
//        $_data[0]['mark_10'] = [''];
//        $_data[0]['mark_11'] = [''];
        if (isset($_analytics[0]['analytics']['m5004']))
            $_data[0]['mark_12'] = $_analytics[0]['analytics']['m5004'];
        if (isset($_analytics[0]['analytics']['s2001']))
            $_data[0]['mark_13'] = ($_analytics[0]['analytics']['s2001'] > 0);
        if (isset($_analytics[0]['analytics']['s1001']))
            $_data[0]['mark_14'] = ($_analytics[0]['analytics']['s1001'] > 0 );
        if (isset($_analytics[0]['analytics']['s2003'])) {
            //  Реализация:
            //  Сумма за 3 последних года - сумма за посл 12 месяцев
            //  полученное делим на 2, среднее за предыдущие 2 года
            //  сравниваем сумму за посл 12 мес и среднее за 2 года
            //  если больше, то стоит проверить.
            $_s2003 = $_analytics[0]['analytics']['s2003'];
            $_s2004 = $_analytics[0]['analytics']['s2004'];
            $_avg = ($_s2004 - $_s2003) / 2;
            $_data[0]['mark_15'] = ($_s2003 > ($_avg * 2)); //    Базовые условия берем 3 года/3, если 12 мес > чем среднее * 2
        }
        if (isset($_analytics[0]['analytics']['s2001'])) {
            $_s2001 = $_analytics[0]['analytics']['s2001'];
            $_s2002 = $_analytics[0]['analytics']['s2002'];
            $_avg = ($_s2002 - $_s2001) / 2;
            $_data[0]['mark_16'] = ($_s2001 > ($_avg * 2));   //    берем 3 года/3, если 12 мес > чем среднее * 2
        }

//          "s2001": {"description": "Арбитраж. Дела в качестве ответчика. Оценка исковой суммы за 12 последних месяцев (в рублях)", "type":"number"},
//			"s2002": {"description": "Арбитраж. Дела в качестве ответчика. Оценка исковой суммы за 3 последних года (в рублях)", "type":"number"},
//			"s2003": {"description": "Арбитраж. Дела в качестве истца. Оценка исковой суммы за 12 последних месяцев (в рублях)", "type":"number"},
//			"s2004": {"description": "Арбитраж. Дела в качестве истца. Оценка исковой суммы за 3 последних года (в рублях)", "type":"number"},

        if (isset($_analytics[0]['analytics']['m1006']))
            $_data[0]['mark_17'] = $_analytics[0]['analytics']['m1006'];
        if (isset($_analytics[0]['analytics']['m1005']))
            $_data[0]['mark_18'] = $_analytics[0]['analytics']['m1005'];
        if (isset($_analytics[0]['analytics']['s1007']))
            $_data[0]['mark_19'] = $_analytics[0]['analytics']['s1007'];
        if (isset($_analytics[0]['analytics']['m1004']))
            $_data[0]['mark_20'] = $_analytics[0]['analytics']['m1004'];
        if (isset($_analytics[0]['analytics']['s1008']))
            $_data[0]['mark_21'] = $_analytics[0]['analytics']['s1008'];
//        $_data[0]['mark_22'] = [''];
        if (isset($_analytics[0]['analytics']['m5005']))
            $_data[0]['mark_23'] = $_analytics[0]['analytics']['m5005'];
//        $_data[0]['mark_24'] = [''];
//        $_data[0]['mark_25'] = [''];
//        $_data[0]['mark_26'] = [''];
        $this->_result = json_encode(
            array(
                'error' => 0,
                'message' => json_encode($_data),
                'emessage' => ''
            )
        );
    }
}
