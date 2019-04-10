<?php
require_once "class/Cecula.php";
$cecula = new Cecula('CCL.BxqLKqVCwHmT-IE.K4JkqE6DDnn3T4tTc4qCQa3M');

$payload = [
    'identity' => '2349090000246'
];

$balanceObj = $cecula->getSyncCloudBalance($payload);
print_r($balanceObj);