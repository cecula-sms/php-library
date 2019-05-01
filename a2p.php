<?php
require_once "class/Cecula.php";
$cecula = new Cecula('CCL.BxqLKqVCwHmT-IE.K4JkqE6DDnn3T4tTc4qCQa3M');

$payload = [
    'origin' => 'LAB',
    'message' => 'Testing the power of many',
    'recipients' => [
        '2348183172770',
        '2348183172771'
    ]
];

$response = $cecula->sendA2PSMS($payload);
print_r($response);