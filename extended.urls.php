<?php

$app->get( '/getcompanybyinn/{inn}', function ($key) use ( $app ) {
    echo getcompanybyinn($key);
} );

$app->get( '/getbankbybik/{bik}', function ($key) use ( $app ) {
    echo getbankbybik($key);
} );

// Post request to file Archive

$app->post('/ed22', function() use ( $app ) {
    echo ed22_workflow(json_encode($app->request->getJsonRawBody()));
} );

$app->post('/alta', function() use ( $app ) {
    echo alta_workflow(json_encode($app->request->getJsonRawBody()));
} );

$app->post( '/autodispetcher', function () use ( $app ) {
    echo autodispetcher_workflow(json_encode($app->request->getJsonRawBody()));
} );

$app->post( '/distanceapi', function () use ( $app ) {
    echo distance_api_workflow(json_encode($app->request->getJsonRawBody()));
} );

$app->post( '/kontur', function () use ( $app ) {
    echo kontur_workflow(json_encode($app->request->getJsonRawBody()));
} );

$app->post( '/translate', function () use ( $app ) {
    echo yad_workflow(json_encode($app->request->getJsonRawBody()));
} );
/*
$app->get( '/getesnginfobygng/{key}', function ($key) use ( $app ) {
    $_json = json_encode(
        array(
            "gng_code" => $key
        ));
    echo vagoneacs_workflow($_json);
} );
*/
$app->get( '/checkdb', function () use ( $app ) {
    $_json = json_encode(
        array(
            "method" => 'checkDB',
        )
    );
    echo erzus_workflow($_json);
} );
