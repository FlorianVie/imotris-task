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

function getDataAll($bdd)
{
    $req = $bdd->prepare("SELECT participant, part, correct, rt, rt_mean, success, timeout, failed_images, failed_audio, failed_video, trial_type, trial_index, time_elapsed, internal_node_id, response, view_history, width, height, webaudio, browser, browser_version, mobile, os, fullscreen, vsync_rate, webcam, microphone, question_order, APTT_1, APTT_2, APTT_3, APTT_4, APTT_5, APTT_6, ATI_1, ATI_2, ATI_3, ATI_4, ATI_5, ATI_6, ATI_7, ATI_8, ATI_9, stimulus, salade, tomate, fromage, viande, oignon, poivron, burgerID, salade_nb, tomate_nb, oignon_nb, fromage_nb, viande_nb, poivron_nb, timeout_burger, IMOT_1, IMOT_2, IMOT_3, IMOT_4, RIS_1, RIS_2, RIS_3, RIS_4, RIS_5, RIS_6 FROM Data");
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