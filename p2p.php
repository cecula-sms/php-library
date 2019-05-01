<?php
require_once "Cecula.php";
$cecula = new Cecula('CCL.BxqLKqVCwHmT-IE.K4JkqE6DDnn3T4tTc4qCQa3M');

$payload = [
    'origin' => '2348182796568',
    'message' => 'Testing the power of many',
    'recipients' => [
        '2348183172770',
        '2348183172771'
    ]
];
$response = $cecula->sendP2PSMS($payload);
print_r($response);

// stdClass Object
// (
//     [status] => sent
//     [code] => 1801
//     [messageID] => 2588
//     [sentTo] => Array
//         (
//             [0] => stdClass Object
//                 (
//                     [recipient] => 2348183172770
//                     [id] => 6000
//                 )

//             [1] => stdClass Object
//                 (
//                     [recipient] => 2348183172771
//                     [id] => 6001
//                 )

//         )

//     [declined] => Array
//         (
//         )

// )