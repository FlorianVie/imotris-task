<?php
function getBD()
{
    $serveur = 'localhost';
    $login = 'root';
    $mot_de_passe = 'root';
    $base_de_donnees = 'stage';

    $pdo = new PDO('mysql:host=' . $serveur . ';dbname=' . $base_de_donnees, $login, $mot_de_passe);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    $pdo->exec("SET CHARACTER SET utf8");
    return $pdo;
}