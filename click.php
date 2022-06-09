<!doctype html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Click Test</title>

    <script src="jquery-3.6.0.min.js"></script>
    <script src="jspsych/jspsych.js"></script>
    <script src="jspsych/plugin-html-button-response.js"></script>

    <link rel="stylesheet" href="css/bulma.css">
    <link rel="stylesheet" href="jspsych/jspsych.css">

</head>

<script>
    function addIngr(ingr) {
        var c = $('#' + ingr).text();
        $('#' + ingr).text(parseInt(c) + 1);
    }

    function remIngr(ingr) {
        var c = $('#' + ingr).text();
        $('#' + ingr).text(parseInt(c) - 1);
    }
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
        prompt: "<p></p>"
    };

    sequence.push(click_trial);

    jsPsych.run(sequence);
</script>

</html>