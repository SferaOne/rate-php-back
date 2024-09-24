<?php

ini_set('display_errors','On');
error_reporting(E_ALL);

include "classes/workflow.class.php";

use Phalcon\DI\FactoryDefault,
    Phalcon\Mvc\Micro,
    Phalcon\Http\Response,
    Phalcon\Http\Request;

$di = new FactoryDefault();
$di["response"] = function () {
    return new Response();
};
$di["request"] = function () {
    return new Request();
};

$request = new Phalcon\Http\Request();

$app = new Micro();
$app->setDI( $di );

$app->get('/preflight', function() use ($app) {
  $app->response->setHeader("Access-Control-Allow-Origin", '*')
    ->setHeader("Access-Control-Allow-Methods", 'GET,PUT,POST,DELETE,OPTIONS')
    ->setHeader("Access-Control-Allow-Headers", 'Origin, X-Requested-With, Content-Range, Content-Disposition, Content-Type, Authorization, X-Auth-Token, access-control-allow-credentials, access-control-allow-origin')
    ->setHeader("Access-Control-Allow-Credentials", true)
    ->setStatusCode(200, "OK")
    ->sendHeaders();
});

$app->options('/{catch:(.*)}', function () use ( $app ) {
  $app->response->setHeader("Access-Control-Allow-Origin", '*')
      ->setHeader("Access-Control-Allow-Methods", 'GET,PUT,POST,DELETE,OPTIONS')
      ->setHeader("Access-Control-Allow-Headers", 'Origin, X-Requested-With, Content-Range, Content-Disposition, Content-Type, Authorization, X-Auth-Token, access-control-allow-credentials, access-control-allow-origin')
      ->setHeader("Access-Control-Allow-Credentials", true)
      ->setStatusCode(200, "OK")
      ->sendHeaders();
  }
);

$app->post( '/log', function () use ( $app ) {
    new logger(json_encode($app->request->getJsonRawBody()));
} );

if (!include("extended.urls.php")) include "extended.urls.php";
if (!include("rate.urls.php")) include "rate.urls.php";
if (!include("auth.urls.php")) include "auth.urls.php";
if (!include("reference.urls.php")) include "reference.urls.php";
if (!include("schedule.urls.php")) include "schedule.urls.php";
if (!include("additionalexpenses.urls.php")) include "additionalexpenses.urls.php";
if (!include("loader.urls.php")) include "loader.urls.php";

$app->notFound(
    function () use ( $app ) {
      $app->response->setStatusCode( 404, "Not Found" )->sendHeaders();
      echo 'Erzus REST API';
    }
);
try {
    $app->handle($_SERVER["REQUEST_URI"]);
} catch (\Exception $e) {
    echo $e->getMessage();
}

