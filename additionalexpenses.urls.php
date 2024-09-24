<?php

$app->get( '/additional/expenses/key/{key}/{date}', function ($_key, $_date) use ( $app ) {
    $_token = $this->request->getHeader('Authorization');
    $_json = json_encode(
        array(
            "method" => 'getAdditionalExpensesByKey',
            "on_date" => $_date,
            "key" => $_key,
            "token" => $_token,
        )
    );
    echo additionalexpenses_workflow($_json);
} );