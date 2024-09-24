<?php

$app->get( '/ship/schedule/key/{key}/{date}', function ($_key, $_date) use ( $app ) {
    $_token = $this->request->getHeader('Authorization');
    $_json = json_encode(
        array(
            "method" => 'getShipScheduleByKey',
            "on_date" => $_date,
            "key" => $_key,
            "token" => $_token,
        )
    );
    echo shipschedule_workflow($_json);
} );