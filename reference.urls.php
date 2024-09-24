<?php

$app->get( '/reference/data/{name}', function ($_name) use ( $app ) {
    $_token = $this->request->getHeader('Authorization');
    $_json = json_encode(
        array(
            "method" => strtolower($_name),
            "token" => $_token,
        )
    );
    echo reference_workflow($_json);
} );
