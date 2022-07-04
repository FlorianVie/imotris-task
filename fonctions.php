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

function getIngredientsAssCorrect($bdd, $nb)
{
    $req = $bdd->prepare("select * from assistance_correct limit " . $nb);
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

function getDataP($bdd, $p)
{
    $req = $bdd->prepare("select participant, part, burgerID, correct, rt, rt_mean, timeout_burger, (salade + tomate + fromage + viande + oignon + poivron) as NbIngr
                            from data_test
                            where (part = 'burger_apprentissage' or part = 'burger_facile' or part = 'burger_difficile') and participant = '" . $p . "'");
    $req->execute();
    $data = $req->fetchAll();
    $req->closeCursor();
    return $data;
}

function getDataPApp($bdd, $p)
{
    $req = $bdd->prepare("select participant, part, burgerID, correct, rt, rt_mean, timeout_burger, (salade + tomate + fromage + viande + oignon + poivron) as NbIngr
                            from data_test
                            where part = 'burger_apprentissage' and participant = '" . $p . "'");
    $req->execute();
    $data = $req->fetchAll();
    $req->closeCursor();
    return $data;
}

function getDataPFac($bdd, $p)
{
    $req = $bdd->prepare("select participant, part, burgerID, correct, rt, rt_mean, timeout_burger, (salade + tomate + fromage + viande + oignon + poivron) as NbIngr
                            from data_test
                            where part = 'burger_facile' and participant = '" . $p . "'");
    $req->execute();
    $data = $req->fetchAll();
    $req->closeCursor();
    return $data;
}

function getDataPDif($bdd, $p)
{
    $req = $bdd->prepare("select participant, part, burgerID, correct, rt, rt_mean, timeout_burger, (salade + tomate + fromage + viande + oignon + poivron) as NbIngr
                            from data_test
                            where part = 'burger_difficile' and participant = '" . $p . "'");
    $req->execute();
    $data = $req->fetchAll();
    $req->closeCursor();
    return $data;
}

function getDataPMean($bdd, $p)
{
    $req = $bdd->prepare("select participant, part, avg(correct) as score, std(correct) as std
                            from data_test
                            where (part = 'burger_apprentissage' or part = 'burger_facile' or part = 'burger_difficile') and participant = '" . $p . "'
                            group by participant, part;");
    $req->execute();
    $data = $req->fetchAll();
    $req->closeCursor();
    return $data;
}

function getParticipants($bdd)
{
    $req = $bdd->prepare("select participant from data_test group by participant");
    $req->execute();
    $data = $req->fetchAll();
    $req->closeCursor();
    return $data;
}

function getDataPretest($bdd)
{
    $req = $bdd->prepare("select * from data_test");
    $req->execute();
    $data = $req->fetchAll();
    $req->closeCursor();
    return $data;
}

function getAPTT($bdd)
{
    $req = $bdd->prepare("select * from Questionnaire_APTT");
    $req->execute();
    $data = $req->fetchAll();
    $req->closeCursor();
    return $data;
}

function getAIT($bdd)
{
    $req = $bdd->prepare("select * from Questionnaire_ATI");
    $req->execute();
    $data = $req->fetchAll();
    $req->closeCursor();
    return $data;
}

function getIMOTRIS($bdd)
{
    $req = $bdd->prepare("select * from Questionnaire_IMOTRIS");
    $req->execute();
    $data = $req->fetchAll();
    $req->closeCursor();
    return $data;
}