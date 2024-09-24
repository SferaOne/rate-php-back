<?php

$app->get( '/auth/getclientidbytoken', function () use ( $app ) {
    $_json = json_encode(
        array(
            "method" => 'getClientByToken',
            "token" => $this->request->getHeader('Authorization'),
        )
    );
    echo auth_workflow($_json);
});

$app->get('/auth/getclientinfo', function()  use ( $app ) {
    $_json = json_encode(
        array(
            "method" => "getClientByToken",
            "token" => $this->request->getHeader('Authorization'),
        )
    );
    echo auth_workflow($_json);
});

$app->post( '/auth/login', function () use ( $app ) {
    $_param = get_object_vars($this->request->getJsonRawBody());
    $_param['token'] = $this->request->getHeader('Authorization');
    $_param['method'] = 'auth';
    echo auth_workflow(json_encode($_param));
} );

$app->get( '/auth/check/{token}', function ($_token) use ( $app ) {
    $_param = get_object_vars($this->request->getJsonRawBody());
    $_param['token'] = $_token;
    $_param['method'] = 'check';
    echo auth_workflow(json_encode($_param));
} );
