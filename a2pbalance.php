<?php
require_once "Cecula.php";
$cecula = new Cecula('CCL.BxqLKqVCwHmT-IE.K4JkqE6DDnn3T4tTc4qCQa3M');

$balance = $cecula->getA2PBalance();
print_r($balance);