<?php
include '../fonctions.php';
$bdd = getBD();
$data = getDataPretest($bdd);
#print_r($data);
header('Content-Type: application/json');

$dataJ = json_encode($data);
print_r($dataJ);