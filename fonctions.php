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

function getIngredientsByDB($bdd, $nb, $bddName)
{
    $req = $bdd->prepare("select * from " . $bddName . " limit " . $nb);
    $req->execute();
    $data = $req->fetchAll();
    $req->closeCursor();
    return $data;
}
