<?php

require_once __DIR__.'/vendor/autoload.php';

use Wit\Wit;
$app = new Wit(array(
    'default_access_token' => 'VTNKPHFNIEYJVKPR3QPVXU3XG43PDHYK')
);


//--invoke wit.ai --------------- START
//$response = $app->get('/intents');
//var_dump($response->getDecodedBody());

$data = [
    "name" => "food_request",
    "doc"  => "detect food request",
    "expressions" => [
        ["body" => "testing"],
        ["body" => "I want to fly from london to sfo"],
        ["body" => "need a flight from paris to tokyo"],
    ]
];

$response = $app->post('/intents', $data);
/*
var_dump($response->getDecodedBody());
//$messageStr = $response->getDecodedBody();
//--invoke wit.ai --------------- END
*/
echo "OKkkx22";