<?php

$app->get( '/rate/list/{date}/{from}/{to}/{unit}', function ($_date, $_from, $_to, $_unit) use ( $app ) {
    $_token = $this->request->getHeader('Authorization');
    $_json = json_encode(
        array(
            "method" => 'getRateList',
            "on_date" => $_date,
            "place_from" => $_from,
            "place_to" => $_to,
            "unit_code" => $_unit,
            "client_id" => miRateApiService::getClientIdByToken($_token),
            "token" => $_token,
        )
    );
    echo rate_workflow($_json);
} );

$app->get( '/rate/key/{key}/{date}', function ($_key, $_date) use ( $app ) {
    $_token = $this->request->getHeader('Authorization');
    $_json = json_encode(
        array(
            "method" => 'getRateByKey',
            "on_date" => $_date,
            "key" => $_key,
            "client_id" => miRateApiService::getClientIdByToken($_token),
            "token" => $_token,
        )
    );
    echo rate_workflow($_json);
} );

$app->post( '/rate', function () use ( $app ) {
    $_param = get_object_vars($this->request->getJsonRawBody());
    $_param['token'] = $this->request->getHeader('Authorization');
    $_param['reqType'] = 'POST';
    echo rate_workflow(json_encode($_param));
} );
