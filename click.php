<!doctype html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=1024, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Click Imotris</title>

    <script src="jquery-3.6.0.min.js"></script>
    <script src="jspsych/jspsych.js"></script>
    <script src="jspsych/plugin-html-button-response.js"></script>

    
    <link rel="stylesheet" href="jspsych/jspsych.css">
    <link rel="stylesheet" href="css/bulma.css">

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

</body>

<script>
    var jsPsych = initJsPsych({
        on_finish: function() {
            jsPsych.data.displayData();
        }
    });

    const sequence = [];

    var click_trial = {
        type: jsPsychHtmlButtonResponse,
        stimulus: `<?php include 'burgers.php'; ?>`,
        choices: ['Suivant'],
        prompt: "<p></p>",
        data: {
            salade: 0,
            tomate: 0,
            fromage: 0,
            viande: 0,
            oignon: 0
        },
        // Changement de valeur dans Data inialisé au chargement
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


        },
        on_finish: function(data) {
            data.stimulus = "5 ingredients"
        }

    };

    sequence.push(click_trial);

    jsPsych.run(sequence);
</script>

</html>