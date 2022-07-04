<?php

include '../fonctions.php';
$bdd = getBD();
$data = getDataAll($bdd);
#print_r($data);
header('Content-Type: application/json');

$dataJ = json_encode($data);
echo $dataJ;