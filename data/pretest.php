<?php
include '../fonctions.php';
$bdd = getBD();
$data = getDataPretest($bdd);
#print_r($data);

$dataJ = json_encode($data);
print_r($dataJ);