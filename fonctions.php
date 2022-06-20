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

function getDataRT($bdd)
{
    $req = $bdd->prepare("select participant, part, burgerID, rt from data_test where part = 'burger_apprentissage' or part = 'burger_facile' or part = 'burger_difficile'");
    $req->execute();
    $data = $req->fetchAll();
    $req->closeCursor();
    return $data;
}
