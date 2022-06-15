<!doctype html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Click Imotris</title>

    <script src="jquery-3.6.0.min.js"></script>
    <script src="jspsych/jspsych.js"></script>
    <script src="jspsych/plugin-html-button-response.js"></script>


    <link rel="stylesheet" href="jspsych/jspsych.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>


</head>

<script>
    /*     function addIngr(ingr) {
        var c = $('#' + ingr).text();
        $('#' + ingr).text(parseInt(c) + 1);
    }

    function remIngr(ingr) {
        var c = $('#' + ingr).text();
        $('#' + ingr).text(parseInt(c) - 1);
    }

    function getIngr(ingr) {
        return $('#' + ingr).text();
    } */
</script>

<body>

    <?php
    include "fonctions.php";
    $bdd = getBD(); 
    $ingr = getIngredients($bdd, 3);
    ?>

</body>

<script>
    var jsPsych = initJsPsych({
        on_finish: function() {
            jsPsych.data.displayData();
        }
    });

    const sequence = [];

    <?php
    for ($i = 0; $i < count($ingr); $i++) {
    ?>

        var click_trial = {
            type: jsPsychHtmlButtonResponse,
            stimulus: `<?php include 'burgers.php'; ?>`,
            choices: ['Suivant'],
            prompt: "<p></p>",
            trial_duration: 10000,
            data: {
                salade: 0,
                tomate: 0,
                fromage: 0,
                viande: 0,
                oignon: 0,
                poivron: 0,
            },
            // Changement de valeur dans Data inialisé au chargement et chargement de la commande
            on_load: function(data) {

                // Compteur Salade

                $("#saladePlus").click(function(data) {
                    var c = $('#saladeC').text();
                    $('#saladeC').text(parseInt(c) + 1);
                    jsPsych.data.jsPsych.current_trial.data.salade = parseInt(c) + 1;
                });
                $("#saladeMoins").click(function() {
                    var c = $('#saladeC').text();
                    $('#saladeC').text(parseInt(c) - 1);
                    jsPsych.data.jsPsych.current_trial.data.salade = parseInt(c) - 1;
                });

                // Compteur Fromage

                $("#fromageMoins").click(function() {
                    var c = $('#fromageC').text();
                    $('#fromageC').text(parseInt(c) - 1);
                    jsPsych.data.jsPsych.current_trial.data.fromage = parseInt(c) - 1;
                });
                $("#fromagePlus").click(function() {
                    var c = $('#fromageC').text();
                    $('#fromageC').text(parseInt(c) + 1);
                    jsPsych.data.jsPsych.current_trial.data.fromage = parseInt(c) + 1;
                });

                // Compteur Oignon

                $("#oignonMoins").click(function() {
                    var c = $('#oignonC').text();
                    $('#oignonC').text(parseInt(c) - 1);
                    jsPsych.data.jsPsych.current_trial.data.oignon = parseInt(c) - 1;
                });
                $("#oignonPlus").click(function() {
                    var c = $('#oignonC').text();
                    $('#oignonC').text(parseInt(c) + 1);
                    jsPsych.data.jsPsych.current_trial.data.oignon = parseInt(c) + 1;
                });

                // Compteur Tomate

                $("#tomateMoins").click(function() {
                    var c = $('#tomateC').text();
                    $('#tomateC').text(parseInt(c) - 1);
                    jsPsych.data.jsPsych.current_trial.data.tomate = parseInt(c) - 1;
                });
                $("#tomatePlus").click(function() {
                    var c = $('#tomateC').text();
                    $('#tomateC').text(parseInt(c) + 1);
                    jsPsych.data.jsPsych.current_trial.data.tomate = parseInt(c) + 1;
                });

                // Compteur Viande

                $("#viandeMoins").click(function() {
                    var c = $('#viandeC').text();
                    $('#viandeC').text(parseInt(c) - 1);
                    jsPsych.data.jsPsych.current_trial.data.viande = parseInt(c) - 1;
                });
                $("#viandePlus").click(function() {
                    var c = $('#viandeC').text();
                    $('#viandeC').text(parseInt(c) + 1);
                    jsPsych.data.jsPsych.current_trial.data.viande = parseInt(c) + 1;
                });

                // Compteur Poivron

                $("#poivronMoins").click(function() {
                    var c = $('#poivronC').text();
                    $('#poivronC').text(parseInt(c) - 1);
                    jsPsych.data.jsPsych.current_trial.data.poivron = parseInt(c) - 1;
                });
                $("#poivronPlus").click(function() {
                    var c = $('#poivronC').text();
                    $('#poivronC').text(parseInt(c) + 1);
                    jsPsych.data.jsPsych.current_trial.data.poivron = parseInt(c) + 1;
                });


                // Nb Salade
                nbSalade = <?php echo $ingr[$i]['Salade'] ?>;
                $("#nbSalade").text(nbSalade);
                jsPsych.data.jsPsych.current_trial.data.salade_nb = nbSalade;

                // Nb Tomate
                nbTomate = <?php echo $ingr[$i]['Tomate'] ?>;
                $("#nbTomate").text(nbTomate);
                jsPsych.data.jsPsych.current_trial.data.tomate_nb = nbTomate;

                // Nb Oignon
                nbOignon = <?php echo $ingr[$i]['Oignon'] ?>;
                $("#nbOignon").text(nbOignon);
                jsPsych.data.jsPsych.current_trial.data.oignon_nb = nbOignon;

                // Nb Fromage
                nbFromage = <?php echo $ingr[$i]['Fromage'] ?>;
                $("#nbFromage").text(nbFromage);
                jsPsych.data.jsPsych.current_trial.data.fromage_nb = nbFromage;

                // Nb Viande
                nbViande = <?php echo $ingr[$i]['Viande'] ?>;
                $("#nbViande").text(nbViande);
                jsPsych.data.jsPsych.current_trial.data.viande_nb = nbViande;

                // Nb Poivron
                nbPoivron = <?php echo $ingr[$i]['Poivron'] ?>;
                $("#nbPoivron").text(nbPoivron);
                jsPsych.data.jsPsych.current_trial.data.poivron_nb = nbPoivron;


            },
            on_finish: function(data) {
                data.stimulus = "5 ingredients";
                
                if (data.salade == data.salade_nb) {
                    data.correct = 1
                } else {
                    data.correct = 0
                }
            }
        };

        sequence.push(click_trial);

    <?php
    }
    ?>

    jsPsych.run(sequence);
</script>

</html>