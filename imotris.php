<!doctype html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Validation questionnaire</title>
    <link rel="icon" type="image/png" href="assets/chef.png">

    <script src="jquery-3.6.0.min.js"></script>
    <script src="jspsych/jspsych.js"></script>
    <script src="jspsych/plugin-html-button-response.js"></script>
    <script src="jspsych/plugin-html-keyboard-response.js"></script>
    <script src="jspsych/plugin-preload.js"></script>
    <script src="jspsych/plugin-browser-check.js"></script>
    <script src="jspsych/plugin-instructions.js"></script>
    <script src="jspsych/plugin-call-function.js"></script>
    <script src="jspsych/plugin-survey-html-form.js"></script>
    <script src="jspsych/plugin-survey-likert.js"></script>




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

    function saveData(id) {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'write_data_task.php'); // change 'write_data.php' to point to php script.
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.onload = function() {
            if (xhr.status == 200) {
                alert("Donn??es transmises, la page va ??tre redirig??e pour afficher vos r??sultats.");
                window.location.href = "datap.php?p=" + id;
                var response = JSON.parse(xhr.responseText);
                console.log(response.success);
            }
        };
        xhr.send(jsPsych.data.get().json());
    }

    function toDatap(id) {
        window.location.href = "datap.php?p=" + id;
    }
</script>

<style>
    .jspsych-btn {
        margin-bottom: 50px;
        font-weight: bold;
    }
</style>

<body>

    <?php
    include "fonctions.php";
    $bdd = getBD();

    if (isset($_GET['a'])) {
        $nbApp = $_GET['a'];
    } else {
        $nbApp = 10;
    }

    if (isset($_GET['f'])) {
        $nbFac = $_GET['f'];
    } else {
        $nbFac = 10;
    }

    if (isset($_GET['d'])) {
        $nbDif = $_GET['d'];
    } else {
        $nbDif = 10;
    }

    if (isset($_GET['fass'])) {
        $nbFacAss = $_GET['fass'];
    } else {
        $nbFacAss = 10;
    }

    if (isset($_GET['dass'])) {
        $nbDifAss = $_GET['dass'];
    } else {
        $nbDifAss = 10;
    }

    $ingr_app = getIngredientsByDB($bdd, $nbApp, "Pretest_apprentissage");
    $ingr_fac = getIngredientsByDB($bdd, $nbFac, "Pretest_facile");
    $ingr_dif = getIngredientsByDB($bdd, $nbDif, "Pretest_difficile");
    $ingr_fass = getIngredientsByDB($bdd, $nbFacAss, "assistance_facile");
    $ingr_fass_correct = getIngredientsByDB($bdd, $nbFacAss, "assistance_facile_correct");
    $ingr_dass = getIngredientsByDB($bdd, $nbDifAss, "assistance_difficile");
    $ingr_dass_correct = getIngredientsByDB($bdd, $nbDifAss, "assistance_difficile_correct");

    $imotris = getIMOTRIS($bdd);
    ?>

</body>

<script>
    var temps_feedback = 750;
    var temps_burger = 25 * 1000;
    var modif_temps = 0.15;
    var modif_temps_f = 0.25;

    var jsPsych = initJsPsych({
        on_finish: function() {
            //jsPsych.data.displayData('csv');
            //console.log(jsPsych.data.get().csv());
            saveData(participant_id);
        }
    });

    var participant_id = jsPsych.randomization.randomID(5);

    jsPsych.data.addProperties({
        participant: participant_id,
    });
    console.log(participant_id);

    const sequence = [];


    var preload = {
        type: jsPsychPreload,
        auto_preload: true
    }
    sequence.push(preload);

    var consent = {
        type: jsPsychSurveyHtmlForm,
        data: {
            part: "consentement",
        },
        preamble: '',
        html: `<?php include 'assets/consent.php'; ?>`,
        button_label: "Continuer",
        show_clickable_nav: true
    };
    sequence.push(consent);


    var instructionsGenerales = {
        type: jsPsychInstructions,
        data: {
            part: "instructions",
        },
        pages: [
            "<div class='container'><div class='row justify-content-center'><div class='col-md-8 text-start lh-sm'>" +
            "<h2 class=''>Identifiant : <strong class='font-monospace'>" + participant_id + "</strong></h2>" +
            "<p>Nous vous remercions grandement pour l???int??r??t que vous portez envers notre ??tude.</p>" +
            "<p>Veuillez <strong>noter et conserver l???identifiant</strong> qui d???affiche en haut de la page. C'est avec celui-ci que vous pourrez faire une demande de restitution et/ou de suppression de vos donn??es.</p>" +
            "<p>L'exp??rience se compose d'un premier questionnaire suivi d'une t??che de recopiage d'informations et se termine par un autre questionnaire.</p>" +
            "<p>Cliquez sur <i>continuer</i> pour poursuivre l'exp??rience vers le premier questionnaire.</p>" +
            "</div></div></div>",
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


    // ------------
    // APTT & ATI
    // ------------

    <?php
    $aptt = getAPTT($bdd);
    $ati = getAIT($bdd);
    ?>


    var likert_scale = [
        "Pas du tout d'accord",
        "Pas d'accord",
        "Ni en d??saccord ni d'accord",
        "D'accord",
        "Tout ?? fait d'accord"
    ];

    var likert_scale_6 = [
        "Pas du tout d'accord",
        "Pas d'accord",
        "Pas tout ?? fait d'accord",
        "Un peu d'accord",
        "D'accord",
        "Tout ?? fait d'accord"
    ];

    var APTT = {
        type: jsPsychSurveyLikert,
        button_label: "Continuer",
        data: {
            part: "APTT",
        },
        questions: [
            <?php
            for ($i = 0; $i < count($aptt); $i++) {
            ?> {
                    prompt: "<?php echo "<strong>" . $aptt[$i]['Item'] . "</strong>" ?>",
                    name: "<?php echo $aptt[$i]['ID'] ?>",
                    labels: likert_scale,
                    required: true
                },
            <?php
            }
            ?>
        ],
        randomize_question_order: false,
        on_finish: function(data) {
            console.log("APTT", data.response);
            data.APTT_1 = data.response.APTT_1;
            data.APTT_2 = data.response.APTT_2;
            data.APTT_3 = data.response.APTT_3;
            data.APTT_4 = data.response.APTT_4;
            data.APTT_5 = data.response.APTT_5;
            data.APTT_6 = data.response.APTT_6;
        },
        preamble: `
        <div class='container'><div class='row justify-content-center'><div class='col-md-8 text-start fs-6 lh-sm'>
        <h3 class='mt-4'>Questionnaire n??1</h3>
        <p>Vous devez lire chaque affirmation du questionnaire et, selon votre degr?? d'accord avec celle-ci, vous devez cocher le choix qui vous convient</p>
        <p>Il est important d'exprimer sinc??rement vos opinions pour la fiabilit?? de l'??tude.</p>
        <hr></div></div></div>
        `
    };
    sequence.push(APTT)


    var ATI = {
        type: jsPsychSurveyLikert,
        button_label: "Continuer",
        data: {
            part: "ATI",
        },
        questions: [
            <?php
            for ($i = 0; $i < count($ati); $i++) {
            ?> {
                    prompt: "<?php echo "<strong>" . $ati[$i]['Item'] . "</strong>" ?>",
                    name: "<?php echo $ati[$i]['ID'] ?>",
                    labels: likert_scale_6,
                    required: true
                },
            <?php
            }
            ?>
        ],
        randomize_question_order: false,
        on_finish: function(data) {
            console.log("ATI", data.response);
            data.ATI_1 = data.response.ATI_1;
            data.ATI_2 = data.response.ATI_2;
            data.ATI_3 = data.response.ATI_3;
            data.ATI_4 = data.response.ATI_4;
            data.ATI_5 = data.response.ATI_5;
            data.ATI_6 = data.response.ATI_6;
            data.ATI_7 = data.response.ATI_7;
            data.ATI_8 = data.response.ATI_8;
            data.ATI_9 = data.response.ATI_9;
        },
        preamble: `
        <div class='container'><div class='row justify-content-center'><div class='col-md-8 text-start fs-6 lh-sm'>
        <h3 class='mt-4'>Questionnaire n??2</h3>
        <p>Vous devez lire chaque affirmation du questionnaire et, selon votre degr?? d'accord avec celle-ci, vous devez cocher le choix qui vous convient</p>
        <p>Il est important d'exprimer sinc??rement vos opinions pour la fiabilit?? de l'??tude.</p>
        <hr></div></div></div>
        `
    };
    sequence.push(ATI)




    var instructionsPretache = {
        type: jsPsychInstructions,
        data: {
            part: "instructions",
        },
        pages: [
            "<div class='container'><div class='row justify-content-center'><div class='col-md-8 text-start lh-sm'>" +
            "<h3 class='mt-4'>Mise en contexte</h3>" +
            "<p>Pour l'exp??rimentation ?? suivre, vous devrez vous mettre dans la peau d???un.e cuisinier.e dont la sp??cialit?? est la pr??paration de burgers. Dans le restaurant o?? vous travaillez, les clients peuvent choisir les ingr??dients qui composent leur burger.</p>" +
            "<p>Durant votre service, vous recevrez les commandes des clients une ?? une. Les commandes sont repr??sent??es par une liste d???ingr??dients que les clients d??sirent. Gr??ce ?? l???interface pr??vue par le site web, vous simulerez la pr??paration de la commande dans un temps limit?? pour chacune d???entre elles.</p>" +
            "<hr><p><u>L'exp??rience se d??roulera en 5 ??tapes</u> :</p>" +
            "<ol>" +
            "<li>??tape d'entrainement pour vous familiariser avec la t??che</li>" +
            "<li>??tape facile</li>" +
            "<li>??tape difficile</li>" +
            "<li>??tape facile avec de l'aide</li>" +
            "<li>??tape difficile avec de l'aide</li>" +
            "</ol>" +
            "<p>Cliquez sur <i>continuer</i> pour poursuivre l'exp??rience.</p>" +
            "</div></div></div>",
        ],
        button_label_next: "Continuer",
        button_label_previous: "Retour",
        show_clickable_nav: true
    };
    sequence.push(instructionsPretache);

    // ------------
    // ENTRAINEMENT
    // ------------

    var instructionsApprentissage = {
        type: jsPsychInstructions,
        data: {
            part: "instructions",
        },
        pages: [
            "<div class='container'><div class='row justify-content-center'><div class='col-md-8 text-start lh-sm'>" +
            "<h2 class='mt-4'>1. Entrainement</h2>" +
            "<p>La t??che qui va suivre consiste ?? composer des burgers en suivant une commande. L???interface avec laquelle vous interagirez ressemblera ?? celle pr??sent??e ci-dessous :</p>" +
            "<img src='assets/capture.png' class='img-fluid'>" +
            "<p>Sur le panneau en haut ?? gauche se trouve la quantit?? et la liste des ingr??dients <strong>n??cessaire ?? la r??alisation de la commande</strong></p>" +
            "<p>Votre objectif sera de r??aliser les commandes de vos clients. Votre t??che consistera ?? faire ajouter ou retirer les ingr??dients n??cessaire ?? la commande en cliquant sur les boutons ?? + ?? et ?? - ?? situ??s en bas de l?????cran.</p>" +
            "<p>Vous disposerez d???un temps limit?? pour r??aliser ces commandes. Le minuteur au centre de l???interface vous indique le temps qu???il vous reste la r??alisation de votre commande. Il sera r??initialis?? ?? chaque commande. Si le timer arrive ?? z??ro, la commande sera compt??e comme une erreur m??me avec le bon nombre d'ingr??dients.</p>" +
            "<p>En haut ?? droite de l???interface vous aurez acc??s ?? votre score li?? ?? la session de pr??paration en cours.</p>" +
            "<p>Une fois que vous consid??rez que votre pr??paration correspond ?? la demande du client vous pourrez cliquer sur ?? Envoyez la commande ??. Cela vous fera ??galement passer ?? la commande suivante.</p>" +
            "<p>Une ic??ne verte indiquera que vous avez correctement r??alis?? la commande, sinon l???ic??ne sera rouge.</p>" +
            "<p><strong>Votre objectif est de r??aliser ces diff??rentes commandes sans vous tromper et le plus rapidement possible.</strong></p>" +
            "<p>Cliquez sur <i>Suivant</i> lorsque vous voulez commencez la phase d???entra??nement</p>" +
            "</div></div></div>",
        ],
        button_label_next: "Suivant",
        button_label_previous: "Retour",
        show_clickable_nav: true
    };
    sequence.push(instructionsApprentissage);


    <?php
    for ($i = 0; $i < count($ingr_app); $i++) {
    ?>

        var burger_app = {
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
            // Changement de valeur dans Data inialis?? au chargement et chargement de la commande
            on_load: function(data) {

                startTimer(temps_burger / 1000, $("#timer"))

                // Compteur score

                var correct_count = jsPsych.data.get().filter({
                    part: "burger_apprentissage"
                }).select('correct').sum();
                var burger_count = jsPsych.data.get().filter({
                    part: "burger_apprentissage"
                }).select('burgerID').count();
                console.log(correct_count, "/", burger_count);
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
                data.stimulus = "6 ingredients";

                if (data.rt != null) {
                    if (data.salade == data.salade_nb && data.tomate == data.tomate_nb && data.fromage == data.fromage_nb && data.viande == data.viande_nb && data.oignon == data.oignon_nb && data.poivron == data.poivron_nb) {
                        data.correct = 1
                    } else {
                        data.correct = 0
                    }
                } else {
                    data.correct = 0
                }

                console.log("Commande apprentissage <?php echo $i + 1 ?> : ", data.correct);

                var tm = jsPsych.data.get().filter({
                    part: "burger_apprentissage"
                }).select('rt').mean();
                data.rt_mean = tm;
                console.log("rt :", data.rt);
                console.log("rt moyen :", tm)
            }
        };
        sequence.push(burger_app);

        var feedback = {
            type: jsPsychHtmlKeyboardResponse,
            choices: "",
            data: {
                part: "feedback"
            },
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

    var recapApprentissage = {
        type: jsPsychInstructions,
        data: {
            part: "recap",
        },
        pages: [
            "<h3 class='mb-4'>Fin de la phase d'apprentissage</h3>" +
            "<p><strong>R??ussites</strong> : <span class='font-monospace' id='reuApp'>0</span></p>" +
            "<p><strong>??checs</strong> : <span class='font-monospace' id='echApp'>0</span></p>" +
            "<p><strong>Temps moyen de r??ponse</strong> : <span class='font-monospace' id='rtApp'>0</span> secondes</p>" +
            "<p><i>Appuyez sur Continuer pour passer ?? la phase suivante</i></p>",
        ],
        button_label_next: "Continuer",
        button_label_previous: "Retour",
        show_clickable_nav: true,
        on_load: function(data) {
            var correct_count = jsPsych.data.get().filter({
                part: "burger_apprentissage"
            }).select('correct').sum();

            var burger_count = jsPsych.data.get().filter({
                part: "burger_apprentissage"
            }).select('burgerID').count();

            var tms = jsPsych.data.get().filter({
                part: "burger_apprentissage"
            }).select('rt').mean() / 1000;

            $("#reuApp").text(correct_count);
            $("#echApp").text(burger_count - correct_count);
            $("#rtApp").text(tms);
        },
    };
    sequence.push(recapApprentissage);


    // ------------
    // FACILE
    // ------------

    var instructionsFacile = {
        type: jsPsychInstructions,
        data: {
            part: "instructions",
        },
        pages: [
            "<div class='container'><div class='row justify-content-center'><div class='col-md-8 text-start lh-sm'>" +
            "<h2 class='mt-4'>2. ??tape facile</h2>" +
            "<p>Dans l'??tape qui suit, vous devrez r??aliser des commandes de la m??me fa??on qu????? l???entra??nement.</p>" +
            "<p>Lors de la phase d???entra??nement nous avons retenu votre temps moyen. Celui-ci sera donc <strong>augment??</strong> pour cette ??tape de pr??paration facile.</p>" +
            "<p>Pour chaque commande vous aurez un temps limit?? pour r??pondre.</p>" +
            "<p>N???oubliez pas, vous devrez r??aliser ces diff??rentes commandes sans vous tromper et le plus rapidement possible</p>" +
            "<p><i>Appuyez sur Continuer pour commencer ?? l'??tape suivante</i></p>" +
            "</div></div></div>",
        ],
        button_label_next: "Continuer",
        button_label_previous: "Retour",
        show_clickable_nav: true,
    };
    sequence.push(instructionsFacile);


    <?php
    for ($i = 0; $i < count($ingr_fac); $i++) {
    ?>

        var burger_facile = {
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
                part: "burger_facile",
                burgerID: <?php echo $i + 1 ?>
            },
            on_start: function(data) {

                var tm = jsPsych.data.get().filter({
                    part: "burger_apprentissage"
                }).select('rt').mean();
                data.rt_mean = tm;
                tms = tm + tm * modif_temps_f;
                //console.log(data.rt, tms);
                jsPsych.current_trial.trial_duration = tms;
            },
            // Changement de valeur dans Data inialis?? au chargement et chargement de la commande
            on_load: function(data) {

                var tms = jsPsych.data.get().filter({
                    part: "burger_apprentissage"
                }).select('rt').mean() / 1000;

                startTimer(tms + tms * modif_temps_f, $("#timer"));

                jsPsych.data.jsPsych.current_trial.data.timeout_burger = tms + tms * modif_temps_f, $("#timer");


                // Compteurs score

                var correct_count = jsPsych.data.get().filter({
                    part: "burger_facile"
                }).select('correct').sum();
                var burger_count = jsPsych.data.get().filter({
                    part: "burger_facile"
                }).select('burgerID').count();
                console.log(correct_count, "/", burger_count);
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
                nbSalade = <?php echo $ingr_fac[$i]['Salade'] ?>;
                $("#nbSalade").text(nbSalade);
                jsPsych.data.jsPsych.current_trial.data.salade_nb = nbSalade;

                // Nb Tomate
                nbTomate = <?php echo $ingr_fac[$i]['Tomate'] ?>;
                $("#nbTomate").text(nbTomate);
                jsPsych.data.jsPsych.current_trial.data.tomate_nb = nbTomate;

                // Nb Oignon
                nbOignon = <?php echo $ingr_fac[$i]['Oignon'] ?>;
                $("#nbOignon").text(nbOignon);
                jsPsych.data.jsPsych.current_trial.data.oignon_nb = nbOignon;

                // Nb Fromage
                nbFromage = <?php echo $ingr_fac[$i]['Fromage'] ?>;
                $("#nbFromage").text(nbFromage);
                jsPsych.data.jsPsych.current_trial.data.fromage_nb = nbFromage;

                // Nb Viande
                nbViande = <?php echo $ingr_fac[$i]['Viande'] ?>;
                $("#nbViande").text(nbViande);
                jsPsych.data.jsPsych.current_trial.data.viande_nb = nbViande;

                // Nb Poivron
                nbPoivron = <?php echo $ingr_fac[$i]['Poivron'] ?>;
                $("#nbPoivron").text(nbPoivron);
                jsPsych.data.jsPsych.current_trial.data.poivron_nb = nbPoivron;


            },
            on_finish: function(data) {
                data.stimulus = "6 ingredients";

                if (data.rt != null) {
                    if (data.salade == data.salade_nb && data.tomate == data.tomate_nb && data.fromage == data.fromage_nb && data.viande == data.viande_nb && data.oignon == data.oignon_nb && data.poivron == data.poivron_nb) {
                        data.correct = 1
                    } else {
                        data.correct = 0
                    }
                } else {
                    data.correct = 0
                }

                console.log("Commande facile <?php echo $i + 1 ?> : ", data.correct);

                var tm = jsPsych.data.get().filter({
                    part: "burger_apprentissage"
                }).select('rt').mean();
                data.rt_mean = tm;
                console.log("rt :", data.rt);
                console.log("Temps moyen :", tm + tm * modif_temps_f)
            }
        };
        sequence.push(burger_facile);

        var feedback = {
            type: jsPsychHtmlKeyboardResponse,
            choices: "",
            data: {
                part: "feedback"
            },
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

    var recapFacile = {
        type: jsPsychInstructions,
        data: {
            part: "recap",
        },
        pages: [
            "<h3 class='mb-4'>Fin de la phase facile</h3>" +
            "<p><strong>R??ussites</strong> : <span class='font-monospace' id='reuApp'>0</span></p>" +
            "<p><strong>??checs</strong> : <span class='font-monospace' id='echApp'>0</span></p>" +
            "<p><strong>Temps moyen de r??ponse</strong> : <span class='font-monospace' id='rtApp'>0</span> secondes</p>" +
            "<p><i>Appuyez sur Continuer pour passer ?? la phase suivante</i></p>",
        ],
        button_label_next: "Continuer",
        button_label_previous: "Retour",
        show_clickable_nav: true,
        on_load: function(data) {
            var correct_count = jsPsych.data.get().filter({
                part: "burger_facile"
            }).select('correct').sum();

            var burger_count = jsPsych.data.get().filter({
                part: "burger_facile"
            }).select('burgerID').count();

            var tms = jsPsych.data.get().filter({
                part: "burger_facile"
            }).select('rt').mean() / 1000;

            $("#reuApp").text(correct_count);
            $("#echApp").text(burger_count - correct_count);
            $("#rtApp").text(tms);
        },
    };
    sequence.push(recapFacile);


    // ------------
    // DIFFICILE
    // ------------

    var instructionsDifficile = {
        type: jsPsychInstructions,
        data: {
            part: "instructions",
        },
        pages: [
            "<div class='container'><div class='row justify-content-center'><div class='col-md-8 text-start lh-sm'>" +
            "<h2  class='mt-4'>3. ??tape difficile</h2>" +
            "<p>Dans l'??tape qui suit, vous devrez r??aliser des commandes de la m??me fa??on que pr??cedemment.</p>" +
            "<p>Lors de la phase d???entra??nement nous avons retenu votre temps moyen. Celui-ci sera donc <strong>r??duit</strong> pour cette ??tape de pr??paration difficile.</p>" +
            "<p>Pour chaque commande vous aurez un temps limit?? pour r??pondre.</p>" +
            "<p>N???oubliez pas, vous devrez r??aliser ces diff??rentes commandes sans vous tromper et le plus rapidement possible</p>" +
            "<p><i>Appuyez sur Continuer pour commencer ?? l'??tape suivante</i></p>" +
            "</div></div></div>",
        ],
        button_label_next: "Continuer",
        button_label_previous: "Retour",
        show_clickable_nav: true,
    };
    sequence.push(instructionsDifficile);


    <?php
    for ($i = 0; $i < count($ingr_dif); $i++) {
    ?>

        var burger_difficile = {
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
                part: "burger_difficile",
                burgerID: <?php echo $i + 1 ?>
            },
            on_start: function(data) {

                var tm = jsPsych.data.get().filter({
                    part: "burger_apprentissage"
                }).select('rt').mean();
                data.rt_mean = tm;
                tms = tm - tm * modif_temps;
                //console.log(data.rt, tms);
                jsPsych.current_trial.trial_duration = tms;
            },
            // Changement de valeur dans Data inialis?? au chargement et chargement de la commande
            on_load: function(data) {

                var tms = jsPsych.data.get().filter({
                    part: "burger_apprentissage"
                }).select('rt').mean() / 1000;

                startTimer(tms - tms * modif_temps, $("#timer"));

                jsPsych.data.jsPsych.current_trial.data.timeout_burger = tms - tms * modif_temps;


                // Compteurs score

                var correct_count = jsPsych.data.get().filter({
                    part: "burger_difficile"
                }).select('correct').sum();
                var burger_count = jsPsych.data.get().filter({
                    part: "burger_difficile"
                }).select('burgerID').count();
                console.log(correct_count, "/", burger_count);
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
                nbSalade = <?php echo $ingr_dif[$i]['Salade'] ?>;
                $("#nbSalade").text(nbSalade);
                jsPsych.data.jsPsych.current_trial.data.salade_nb = nbSalade;

                // Nb Tomate
                nbTomate = <?php echo $ingr_dif[$i]['Tomate'] ?>;
                $("#nbTomate").text(nbTomate);
                jsPsych.data.jsPsych.current_trial.data.tomate_nb = nbTomate;

                // Nb Oignon
                nbOignon = <?php echo $ingr_dif[$i]['Oignon'] ?>;
                $("#nbOignon").text(nbOignon);
                jsPsych.data.jsPsych.current_trial.data.oignon_nb = nbOignon;

                // Nb Fromage
                nbFromage = <?php echo $ingr_dif[$i]['Fromage'] ?>;
                $("#nbFromage").text(nbFromage);
                jsPsych.data.jsPsych.current_trial.data.fromage_nb = nbFromage;

                // Nb Viande
                nbViande = <?php echo $ingr_dif[$i]['Viande'] ?>;
                $("#nbViande").text(nbViande);
                jsPsych.data.jsPsych.current_trial.data.viande_nb = nbViande;

                // Nb Poivron
                nbPoivron = <?php echo $ingr_dif[$i]['Poivron'] ?>;
                $("#nbPoivron").text(nbPoivron);
                jsPsych.data.jsPsych.current_trial.data.poivron_nb = nbPoivron;


            },
            on_finish: function(data) {
                data.stimulus = "6 ingredients";

                if (data.rt != null) {
                    if (data.salade == data.salade_nb && data.tomate == data.tomate_nb && data.fromage == data.fromage_nb && data.viande == data.viande_nb && data.oignon == data.oignon_nb && data.poivron == data.poivron_nb) {
                        data.correct = 1
                    } else {
                        data.correct = 0
                    }
                } else {
                    data.correct = 0
                }

                console.log("Commande difficile <?php echo $i + 1 ?> : ", data.correct);

                var tm = jsPsych.data.get().filter({
                    part: "burger_apprentissage"
                }).select('rt').mean();
                data.rt_mean = tm;
                console.log("rt :", data.rt);
                console.log("Temps moyen :", tm - tm * modif_temps)
            }
        };
        sequence.push(burger_difficile);

        var feedback = {
            type: jsPsychHtmlKeyboardResponse,
            choices: "",
            data: {
                part: "feedback"
            },
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

    var recapDifficile = {
        type: jsPsychInstructions,
        data: {
            part: "recap",
        },
        pages: [
            "<h3 class='mb-4'>Fin de la phase difficile</h3>" +
            "<p><strong>R??ussites</strong> : <span class='font-monospace' id='reuApp'>0</span></p>" +
            "<p><strong>??checs</strong> : <span class='font-monospace' id='echApp'>0</span></p>" +
            "<p><strong>Temps moyen de r??ponse</strong> : <span class='font-monospace' id='rtApp'>0</span> secondes</p>" +
            "<p><i>Appuyez sur Continuer pour passer ?? la phase suivante</i></p>",
        ],
        button_label_next: "Continuer",
        button_label_previous: "Retour",
        show_clickable_nav: true,
        on_load: function(data) {
            var correct_count = jsPsych.data.get().filter({
                part: "burger_difficile"
            }).select('correct').sum();

            var burger_count = jsPsych.data.get().filter({
                part: "burger_difficile"
            }).select('burgerID').count();

            var tms = jsPsych.data.get().filter({
                part: "burger_difficile"
            }).select('rt').mean() / 1000;

            $("#reuApp").text(correct_count);
            $("#echApp").text(burger_count - correct_count);
            $("#rtApp").text(tms);
        },
    };
    sequence.push(recapDifficile);



    // ------------
    // FACILE ASSISTANCE
    // ------------

    var instructionsFacileAssistance = {
        type: jsPsychInstructions,
        data: {
            part: "instructions",
        },
        pages: [
            "<div class='container'><div class='row justify-content-center'><div class='col-md-8 text-start lh-sm'>" +
            "<h2 class='mt-4'>4. ??tape facile avec de l'aide</h2>" +
            "<p>Durant cette ??tape, vous devrez r??aliser des commandes de la m??me fa??on que pr??cedemment.</p>" +
            "<p>Lors de la phase d???entra??nement nous avons retenu votre temps moyen. Celui-ci sera donc <strong>augment??</strong> pour cette ??tape de pr??paration facile.</p>" +
            "<p>Pour chaque commande vous aurez un temps limit?? pour r??pondre.</p>" +
            "<p>Cette fois-ci, <strong>un robot pr??parateur de commandes d??nomm?? Cobot vous assistera en pr??-remplissant les ingr??dients</strong> de la commande.</p>" +
            "<p>N???oubliez pas, vous devrez r??aliser ces diff??rentes commandes sans vous tromper et le plus rapidement possible</p>" +
            "<p><i>Appuyez sur Continuer pour commencer ?? l'??tape suivante</i></p>" +
            "</div></div></div>",
        ],
        button_label_next: "Continuer",
        button_label_previous: "Retour",
        show_clickable_nav: true,
    };
    sequence.push(instructionsFacileAssistance);


    <?php
    for ($i = 0; $i < count($ingr_fass); $i++) {
    ?>

        var burger_facile_ass = {
            type: jsPsychHtmlButtonResponse,
            stimulus: `<?php include 'burgers.php'; ?>`,
            choices: ['Envoyer la commande'],
            prompt: "<p></p>",
            trial_duration: temps_burger,
            data: {
                salade: <?php echo $ingr_fass[$i]['Salade'] ?>,
                tomate: <?php echo $ingr_fass[$i]['Tomate'] ?>,
                fromage: <?php echo $ingr_fass[$i]['Fromage'] ?>,
                viande: <?php echo $ingr_fass[$i]['Viande'] ?>,
                oignon: <?php echo $ingr_fass[$i]['Oignon'] ?>,
                poivron: <?php echo $ingr_fass[$i]['Poivron'] ?>,
                part: "burger_facile_assistance",
                burgerID: <?php echo $i + 1 ?>
            },
            on_start: function(data) {

                var tm = jsPsych.data.get().filter({
                    part: "burger_apprentissage"
                }).select('rt').mean();
                data.rt_mean = tm;
                tms = tm + tm * modif_temps_f;
                //console.log(data.rt, tms);
                jsPsych.current_trial.trial_duration = tms;
            },
            // Changement de valeur dans Data inialis?? au chargement et chargement de la commande
            on_load: function(data) {

                var tms = jsPsych.data.get().filter({
                    part: "burger_apprentissage"
                }).select('rt').mean() / 1000;

                startTimer(tms + tms * modif_temps_f, $("#timer"));

                jsPsych.data.jsPsych.current_trial.data.timeout_burger = tms + tms * modif_temps_f, $("#timer");


                // Compteurs score

                var correct_count = jsPsych.data.get().filter({
                    part: "burger_facile_assistance"
                }).select('correct').sum();
                var burger_count = jsPsych.data.get().filter({
                    part: "burger_facile_assistance"
                }).select('burgerID').count();
                console.log(correct_count, "/", burger_count);
                $("#reussites").text(correct_count);
                $("#ratees").text(burger_count - correct_count);

                // Compteur Salade

                $('#saladeC').text("<?php echo $ingr_fass[$i]['Salade'] ?>");
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

                $('#fromageC').text("<?php echo $ingr_fass[$i]['Fromage'] ?>");
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

                $('#oignonC').text("<?php echo $ingr_fass[$i]['Oignon'] ?>");
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

                $('#tomateC').text("<?php echo $ingr_fass[$i]['Tomate'] ?>");
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

                $('#viandeC').text("<?php echo $ingr_fass[$i]['Viande'] ?>");
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

                $('#poivronC').text("<?php echo $ingr_fass[$i]['Poivron'] ?>");
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
                nbSalade = <?php echo $ingr_fass_correct[$i]['Salade'] ?>;
                $("#nbSalade").text(nbSalade);
                jsPsych.data.jsPsych.current_trial.data.salade_nb = nbSalade;

                // Nb Tomate
                nbTomate = <?php echo $ingr_fass_correct[$i]['Tomate'] ?>;
                $("#nbTomate").text(nbTomate);
                jsPsych.data.jsPsych.current_trial.data.tomate_nb = nbTomate;

                // Nb Oignon
                nbOignon = <?php echo $ingr_fass_correct[$i]['Oignon'] ?>;
                $("#nbOignon").text(nbOignon);
                jsPsych.data.jsPsych.current_trial.data.oignon_nb = nbOignon;

                // Nb Fromage
                nbFromage = <?php echo $ingr_fass_correct[$i]['Fromage'] ?>;
                $("#nbFromage").text(nbFromage);
                jsPsych.data.jsPsych.current_trial.data.fromage_nb = nbFromage;

                // Nb Viande
                nbViande = <?php echo $ingr_fass_correct[$i]['Viande'] ?>;
                $("#nbViande").text(nbViande);
                jsPsych.data.jsPsych.current_trial.data.viande_nb = nbViande;

                // Nb Poivron
                nbPoivron = <?php echo $ingr_fass_correct[$i]['Poivron'] ?>;
                $("#nbPoivron").text(nbPoivron);
                jsPsych.data.jsPsych.current_trial.data.poivron_nb = nbPoivron;


            },
            on_finish: function(data) {
                data.stimulus = "5 ingredients";

                if (data.rt != null) {
                    if (data.salade == data.salade_nb && data.tomate == data.tomate_nb && data.fromage == data.fromage_nb && data.viande == data.viande_nb && data.oignon == data.oignon_nb && data.poivron == data.poivron_nb) {
                        data.correct = 1
                    } else {
                        data.correct = 0
                    }
                } else {
                    data.correct = 0
                }

                console.log("Commande facile <?php echo $i + 1 ?> : ", data.correct);

                var tm = jsPsych.data.get().filter({
                    part: "burger_apprentissage"
                }).select('rt').mean();
                data.rt_mean = tm;
                console.log("rt :", data.rt);
                console.log("Temps moyen :", tm + tm * modif_temps_f)
            }
        };
        sequence.push(burger_facile_ass);

        var feedback = {
            type: jsPsychHtmlKeyboardResponse,
            choices: "",
            data: {
                part: "feedback"
            },
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

    var recapFacileAssistance = {
        type: jsPsychInstructions,
        data: {
            part: "recap",
        },
        pages: [
            "<h3 class='mb-4'>Fin de la phase facile avec assistance</h3>" +
            "<p><strong>R??ussites</strong> : <span class='font-monospace' id='reuApp'>0</span></p>" +
            "<p><strong>??checs</strong> : <span class='font-monospace' id='echApp'>0</span></p>" +
            "<p><strong>Temps moyen de r??ponse</strong> : <span class='font-monospace' id='rtApp'>0</span> secondes</p>" +
            "<p><i>Appuyez sur Continuer pour passer ?? la phase suivante</i></p>",
        ],
        button_label_next: "Continuer",
        button_label_previous: "Retour",
        show_clickable_nav: true,
        on_load: function(data) {
            var correct_count = jsPsych.data.get().filter({
                part: "burger_facile_assistance"
            }).select('correct').sum();

            var burger_count = jsPsych.data.get().filter({
                part: "burger_facile_assistance"
            }).select('burgerID').count();

            var tms = jsPsych.data.get().filter({
                part: "burger_facile_assistance"
            }).select('rt').mean() / 1000;

            $("#reuApp").text(correct_count);
            $("#echApp").text(burger_count - correct_count);
            $("#rtApp").text(tms);
        },
    };
    sequence.push(recapFacileAssistance);


    // ------------
    // DIFFICILE ASSISTANCE
    // ------------

    var instructionsDifficileAssistance = {
        type: jsPsychInstructions,
        data: {
            part: "instructions",
        },
        pages: [
            "<div class='container'><div class='row justify-content-center'><div class='col-md-8 text-start lh-sm'>" +
            "<h2 class='mt-4'>5. ??tape difficile avec de l'aide</h2>" +
            "<p>Durant cette ??tape, vous devrez r??aliser des commandes de la m??me fa??on que pr??cedemment.</p>" +
            "<p>Lors de la phase d???entra??nement nous avons retenu votre temps moyen. Celui-ci sera donc <strong>r??duit</strong> pour cette ??tape de pr??paration difficile.</p>" +
            "<p>Pour chaque commande vous aurez un temps limit?? pour r??pondre.</p>" +
            "<p>Cette fois-ci, <strong>un robot pr??parateur de commandes d??nomm?? Cobot vous assistera en pr??-remplissant les ingr??dients</strong> de la commande.</p>" +
            "<p>N???oubliez pas, vous devrez r??aliser ces diff??rentes commandes sans vous tromper et le plus rapidement possible</p>" +
            "<p><i>Appuyez sur Continuer pour commencer ?? l'??tape suivante</i></p>" +
            "</div></div></div>",
        ],
        button_label_next: "Continuer",
        button_label_previous: "Retour",
        show_clickable_nav: true,
    };
    sequence.push(instructionsDifficileAssistance);


    <?php
    for ($i = 0; $i < count($ingr_dass); $i++) {
    ?>

        var burger_difficile_assistance = {
            type: jsPsychHtmlButtonResponse,
            stimulus: `<?php include 'burgers.php'; ?>`,
            choices: ['Envoyer la commande'],
            prompt: "<p></p>",
            trial_duration: temps_burger,
            data: {
                salade: <?php echo $ingr_dass[$i]['Salade'] ?>,
                tomate: <?php echo $ingr_dass[$i]['Tomate'] ?>,
                fromage: <?php echo $ingr_dass[$i]['Fromage'] ?>,
                viande: <?php echo $ingr_dass[$i]['Viande'] ?>,
                oignon: <?php echo $ingr_dass[$i]['Oignon'] ?>,
                poivron: <?php echo $ingr_dass[$i]['Poivron'] ?>,
                part: "burger_difficile_assistance",
                burgerID: <?php echo $i + 1 ?>
            },
            on_start: function(data) {

                var tm = jsPsych.data.get().filter({
                    part: "burger_apprentissage"
                }).select('rt').mean();
                data.rt_mean = tm;
                tms = tm - tm * modif_temps;
                //console.log(data.rt, tms);
                jsPsych.current_trial.trial_duration = tms;
            },
            // Changement de valeur dans Data inialis?? au chargement et chargement de la commande
            on_load: function(data) {

                var tms = jsPsych.data.get().filter({
                    part: "burger_apprentissage"
                }).select('rt').mean() / 1000;

                startTimer(tms - tms * modif_temps, $("#timer"));

                jsPsych.data.jsPsych.current_trial.data.timeout_burger = tms - tms * modif_temps;


                // Compteurs score

                var correct_count = jsPsych.data.get().filter({
                    part: "burger_difficile_assistance"
                }).select('correct').sum();
                var burger_count = jsPsych.data.get().filter({
                    part: "burger_difficile_assistance"
                }).select('burgerID').count();
                console.log(correct_count, "/", burger_count);
                $("#reussites").text(correct_count);
                $("#ratees").text(burger_count - correct_count);

                // Compteur Salade

                $('#saladeC').text("<?php echo $ingr_dass[$i]['Salade'] ?>");
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

                $('#fromageC').text("<?php echo $ingr_dass[$i]['Fromage'] ?>");
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

                $('#oignonC').text("<?php echo $ingr_dass[$i]['Oignon'] ?>");
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

                $('#tomateC').text("<?php echo $ingr_dass[$i]['Tomate'] ?>");
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

                $('#viandeC').text("<?php echo $ingr_dass[$i]['Viande'] ?>");
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

                $('#poivronC').text("<?php echo $ingr_dass[$i]['Poivron'] ?>");
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
                nbSalade = <?php echo $ingr_dass_correct[$i]['Salade'] ?>;
                $("#nbSalade").text(nbSalade);
                jsPsych.data.jsPsych.current_trial.data.salade_nb = nbSalade;

                // Nb Tomate
                nbTomate = <?php echo $ingr_dass_correct[$i]['Tomate'] ?>;
                $("#nbTomate").text(nbTomate);
                jsPsych.data.jsPsych.current_trial.data.tomate_nb = nbTomate;

                // Nb Oignon
                nbOignon = <?php echo $ingr_dass_correct[$i]['Oignon'] ?>;
                $("#nbOignon").text(nbOignon);
                jsPsych.data.jsPsych.current_trial.data.oignon_nb = nbOignon;

                // Nb Fromage
                nbFromage = <?php echo $ingr_dass_correct[$i]['Fromage'] ?>;
                $("#nbFromage").text(nbFromage);
                jsPsych.data.jsPsych.current_trial.data.fromage_nb = nbFromage;

                // Nb Viande
                nbViande = <?php echo $ingr_dass_correct[$i]['Viande'] ?>;
                $("#nbViande").text(nbViande);
                jsPsych.data.jsPsych.current_trial.data.viande_nb = nbViande;

                // Nb Poivron
                nbPoivron = <?php echo $ingr_dass_correct[$i]['Poivron'] ?>;
                $("#nbPoivron").text(nbPoivron);
                jsPsych.data.jsPsych.current_trial.data.poivron_nb = nbPoivron;


            },
            on_finish: function(data) {
                data.stimulus = "5 ingredients";

                if (data.rt != null) {
                    if (data.salade == data.salade_nb && data.tomate == data.tomate_nb && data.fromage == data.fromage_nb && data.viande == data.viande_nb && data.oignon == data.oignon_nb && data.poivron == data.poivron_nb) {
                        data.correct = 1
                    } else {
                        data.correct = 0
                    }
                } else {
                    data.correct = 0
                }

                console.log("Commande difficile <?php echo $i + 1 ?> : ", data.correct);

                var tm = jsPsych.data.get().filter({
                    part: "burger_apprentissage"
                }).select('rt').mean();
                data.rt_mean = tm;
                console.log("rt :", data.rt);
                console.log("Temps moyen :", tm - tm * modif_temps)
            }
        };
        sequence.push(burger_difficile_assistance);

        var feedback = {
            type: jsPsychHtmlKeyboardResponse,
            choices: "",
            data: {
                part: "feedback"
            },
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

    var recapDifficileAssistance = {
        type: jsPsychInstructions,
        data: {
            part: "recap",
        },
        pages: [
            "<h3 class='mb-4'>Fin de la phase difficile avec assistance</h3>" +
            "<p><strong>R??ussites</strong> : <span class='font-monospace' id='reuApp'>0</span></p>" +
            "<p><strong>??checs</strong> : <span class='font-monospace' id='echApp'>0</span></p>" +
            "<p><strong>Temps moyen de r??ponse</strong> : <span class='font-monospace' id='rtApp'>0</span> secondes</p>" +
            "<p><i>Appuyez sur Continuer pour continuer vers le dernier questionnaire</i></p>",
        ],
        button_label_next: "Continuer",
        button_label_previous: "Retour",
        show_clickable_nav: true,
        on_load: function(data) {
            var correct_count = jsPsych.data.get().filter({
                part: "burger_difficile_assistance"
            }).select('correct').sum();

            var burger_count = jsPsych.data.get().filter({
                part: "burger_difficile_assistance"
            }).select('burgerID').count();

            var tms = jsPsych.data.get().filter({
                part: "burger_difficile_assistance"
            }).select('rt').mean() / 1000;

            $("#reuApp").text(correct_count);
            $("#echApp").text(burger_count - correct_count);
            $("#rtApp").text(tms);
        },
    };
    sequence.push(recapDifficileAssistance);


    // ------------
    // IMOTRIS
    // ------------

    <?php
    $imotris = getIMOTRIS($bdd);
    ?>


    var likert_scale_imotris = [
        "Pas du tout d'accord",
        "Pas d'accord",
        "Ni en d??saccord ni d'accord",
        "D'accord",
        "Tout ?? fait d'accord"
    ];

    var IMOTRIS = {
        type: jsPsychSurveyHtmlForm,
        button_label: "Continuer",
        data: {
            part: "IMOTRIS",
        },
        html: `<?php include 'assets/imotris_questionnaire.php' ?>`,
        randomize_question_order: false,
        on_finish: function(data) {
            console.log("IMOTRIS", data.response);
            data.IMOT_1 = data.response.IMOT_1;
            data.IMOT_2 = data.response.IMOT_2;
            data.IMOT_3 = data.response.IMOT_3;
            data.IMOT_4 = data.response.IMOT_4;
            data.RIS_1 = data.response.RIS_1;
            data.RIS_2 = data.response.RIS_2;
            data.RIS_3 = data.response.RIS_3;
            data.RIS_4 = data.response.RIS_4;
            data.RIS_5 = data.response.RIS_5;
            data.RIS_6 = data.response.RIS_6;

            data.IMOT_1_comp = data.response.IMOT_1_comp;
            data.IMOT_2_comp = data.response.IMOT_2_comp;
            data.IMOT_3_comp = data.response.IMOT_3_comp;
            data.IMOT_4_comp = data.response.IMOT_4_comp;
            data.RIS_1_comp = data.response.RIS_1_comp;
            data.RIS_2_comp = data.response.RIS_2_comp;
            data.RIS_3_comp = data.response.RIS_3_comp;
            data.RIS_4_comp = data.response.RIS_4_comp;
            data.RIS_5_comp = data.response.RIS_5_comp;
            data.RIS_6_comp = data.response.RIS_6_comp;

            data.commentaire = data.response.commentaire;
        },
        preamble: `
        <div class='container'><div class='row justify-content-center'><div class='col-md-8 text-start fs-6 lh-sm'>
        <h3 class='mt-4'>Questionnaire n??3</h3>
        <p>Le questionnaire ci-dessous porte sur votre <strong>exp??rience pass??e pr??c??demment avec le robot pr??parateur de burgers nomm?? Cobot</strong>.</p>
        <p>Vous devez lire chaque affirmation du questionnaire et, selon votre degr?? d'accord avec celle-ci, vous devez cocher le choix qui vous convient.</p>
        <p>?? chaque affirmation est associ??e un curseur dans lequel vous devez r??gler votre degr?? de compr??hension.</p>
        <p>Il est important d'exprimer sinc??rement vos opinions pour la fiabilit?? de l'??tude.</p>
        </div></div></div>
        `
    };
    sequence.push(IMOTRIS);



    var ending = {
        type: jsPsychSurveyHtmlForm,
        data: {
            part: "fin",
        },
        preamble: '',
        html: `<?php include 'assets/ending.php'; ?>`,
        button_label: "Envoyer les donn??es ?? l'exp??rimentateur",
        on_finish: function(data) {
            data.mail = data.response.mail;
            data.age = data.response.age;
            data.genre = data.response.genre;
            data.date_acquisition = <?php echo time() ?>;
        },
        show_clickable_nav: true
    };
    sequence.push(ending);




    jsPsych.run(sequence);
</script>

</html>