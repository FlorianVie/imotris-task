<!doctype html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pretest Burgers</title>
    <link rel="icon" type="image/png" href="assets/chef.png">

    <script src="jquery-3.6.0.min.js"></script>
    <script src="jspsych/jspsych.js"></script>
    <script src="jspsych/plugin-html-button-response.js"></script>
    <script src="jspsych/plugin-html-keyboard-response.js"></script>
    <script src="jspsych/plugin-preload.js"></script>
    <script src="jspsych/plugin-browser-check.js"></script>
    <script src="jspsych/plugin-instructions.js"></script>




    <link rel="stylesheet" href="jspsych/jspsych.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>


</head>

<script>
    function startTimer(duration, display) {
        var timer = duration - 1,
            minutes, seconds;
        setInterval(function() {
            minutes = parseInt(timer / 60, 10);
            seconds = parseInt(timer % 60, 10);

            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;

            display.text(minutes + ":" + seconds);

            if (--timer < 0) {
                timer = duration;
            }
        }, 1000);
    }
</script>

<body>

    <?php
    include "fonctions.php";
    $bdd = getBD();

    $ingr_app = getIngredientsByDB($bdd, 10, "Pretest_apprentissage");
    ?>

</body>

<script>
    var temps_feedback = 750;
    var temps_burger = 120 * 1000;

    var jsPsych = initJsPsych({
        on_finish: function() {
            jsPsych.data.displayData();
        }
    });

    const sequence = [];

    var preload = {
        type: jsPsychPreload,
        auto_preload: true
    }
    sequence.push(preload);


    var instructionsGenerales = {
        type: jsPsychInstructions,
        data: {
            part: "instructions",
        },
        pages: [
            'Welcome to the experiment. Click next to begin.',
            'This is the second page of instructions.',
            'This is the final page.'
        ],
        button_label_next: "Continuer",
        button_label_previous: "Retour",
        show_clickable_nav: true
    };
    sequence.push(instructionsGenerales);



    var browser = {
        type: jsPsychBrowserCheck
    };
    sequence.push(browser);


    var instructionsApprentissage = {
        type: jsPsychInstructions,
        data: {
            part: "instructions",
        },
        pages: [
            '<h1>Entrainement</h1>',
        ],
        button_label_next: "Continuer",
        button_label_previous: "Retour",
        show_clickable_nav: true
    };
    sequence.push(instructionsApprentissage);

    // ------------
    // ENTRAINEMENT
    // ------------

    <?php
    for ($i = 0; $i < count($ingr_app); $i++) {
    ?>

        var click_trial = {
            type: jsPsychHtmlButtonResponse,
            stimulus: `<?php include 'burgers.php'; ?>`,
            choices: ['Envoyer la commande'],
            prompt: "<p></p>",
            trial_duration: temps_burger,
            data: {
                salade: 0,
                tomate: 0,
                fromage: 0,
                viande: 0,
                oignon: 0,
                poivron: 0,
                part: "burger_apprentissage",
                burgerID: <?php echo $i + 1 ?>
            },
            // Changement de valeur dans Data inialisé au chargement et chargement de la commande
            on_load: function(data) {

                startTimer(temps_burger / 1000, $("#timer"))

                var correct_count = jsPsych.data.get().select('correct').sum();
                var burger_count = jsPsych.data.get().select('burgerID').count();
                console.log(correct_count, "/", burger_count, correct_count / burger_count);
                $("#reussites").text(correct_count);
                $("#ratees").text(burger_count - correct_count);

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
                nbSalade = <?php echo $ingr_app[$i]['Salade'] ?>;
                $("#nbSalade").text(nbSalade);
                jsPsych.data.jsPsych.current_trial.data.salade_nb = nbSalade;

                // Nb Tomate
                nbTomate = <?php echo $ingr_app[$i]['Tomate'] ?>;
                $("#nbTomate").text(nbTomate);
                jsPsych.data.jsPsych.current_trial.data.tomate_nb = nbTomate;

                // Nb Oignon
                nbOignon = <?php echo $ingr_app[$i]['Oignon'] ?>;
                $("#nbOignon").text(nbOignon);
                jsPsych.data.jsPsych.current_trial.data.oignon_nb = nbOignon;

                // Nb Fromage
                nbFromage = <?php echo $ingr_app[$i]['Fromage'] ?>;
                $("#nbFromage").text(nbFromage);
                jsPsych.data.jsPsych.current_trial.data.fromage_nb = nbFromage;

                // Nb Viande
                nbViande = <?php echo $ingr_app[$i]['Viande'] ?>;
                $("#nbViande").text(nbViande);
                jsPsych.data.jsPsych.current_trial.data.viande_nb = nbViande;

                // Nb Poivron
                nbPoivron = <?php echo $ingr_app[$i]['Poivron'] ?>;
                $("#nbPoivron").text(nbPoivron);
                jsPsych.data.jsPsych.current_trial.data.poivron_nb = nbPoivron;


            },
            on_finish: function(data) {
                data.stimulus = "5 ingredients";

                if (data.salade == data.salade_nb && data.tomate == data.tomate_nb && data.fromage == data.fromage_nb && data.viande == data.viande_nb && data.oignon == data.oignon_nb && data.poivron == data.poivron_nb) {
                    data.correct = 1
                } else {
                    data.correct = 0
                }

                console.log("Commande <?php echo $i + 1 ?> : ", data.correct);
            }
        };
        sequence.push(click_trial);

        var feedback = {
            type: jsPsychHtmlKeyboardResponse,
            choices: "",
            trial_duration: temps_feedback,
            stimulus: function() {
                var last_trial_correct = jsPsych.data.get().last(1).values()[0].correct;
                if (last_trial_correct) {
                    return "<img src='assets/correct.png' alt='' width='100px'>";
                } else {
                    return "<img src='assets/incorrect.png' alt='' width='100px'>";
                }
            }
        };
        sequence.push(feedback);

    <?php
    }
    ?>

    jsPsych.run(sequence);
</script>

</html>