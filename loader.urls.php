<?php

$app->post( '/loader/rate/validate', function () use ( $app ) {
    $_param = get_object_vars($this->request->getJsonRawBody());
    $_param['token'] = $this->request->getHeader('Authorization');
    $_param['method'] = 'rate.validate';
    $_param['type'] = 142;
    echo loader_workflow(json_encode($_param));
} );

$app->post( '/loader/ship/schedule/validate', function () use ( $app ) {
    $_param = get_object_vars($this->request->getJsonRawBody());
    $_param['token'] = $this->request->getHeader('Authorization');
    $_param['method'] = 'ship.schedule.validate';
    $_param['type'] = 145;
    echo loader_workflow(json_encode($_param));
} );

$app->post( '/loader/additional/expenses/validate', function () use ( $app ) {
    $_param = get_object_vars($this->request->getJsonRawBody());
    $_param['token'] = $this->request->getHeader('Authorization');
    $_param['method'] = 'additional.expenses.validate';
    $_param['type'] = 146;
    echo loader_workflow(json_encode($_param));
} );
