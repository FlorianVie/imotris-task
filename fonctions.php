<?php
include "bdd.php";

function getIngredients($bdd, $nb)
{
    $req = $bdd->prepare("select * from ingredients limit " . $nb);
    $req->execute();
    $data = $req->fetchAll();
    $req->closeCursor();
    return $data;
}
