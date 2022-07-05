<?php
include "fonctions.php";
$bdd = getBD();
$data = getDataAll($bdd);

echo time();

$list = [
    ["Name" => "John", "Gender" => "M"],
    ["Name" => "Doe", "Gender" => "M"],
    ["Name" => "Sara", "Gender" => "F"]
];

$csvArray = ["header" => implode(",", array_keys($data[0]))] + array_map(function ($item) {
    return implode(",", $item);
}, $data);

$filename = "backup/backup-" . time() . ".csv";

file_put_contents($filename, implode("\n", $csvArray));
