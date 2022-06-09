<!doctype html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Test immotris</title>

    <script src="jquery-3.6.0.min.js"></script>
    <script src="jspsych/jspsych.js"></script>
    <script src="jspsych/plugin-free-sort.js"></script>

    <link rel="stylesheet" href="jspsych/jspsych.css">

</head>

<body>

</body>

<script>
    var jsPsych = initJsPsych({
        on_finish: function() {
            jsPsych.data.displayData();
        }
    });

    const sequence = [];

    var sort_trial = {
        type: jsPsychFreeSort,
        stimuli: ["ingr/fromage.png", "ingr/salade.png", "ingr/tomate.png", "ingr/viande.png", "ingr/viande.png"],
        stim_width: 80,
        stim_height: 60,
        sort_area_width: 400,
        sort_area_height: 400,
        column_spread_factor: 1,
        sort_area_shape: "square",
        on_start: function() {
            //$("#jspsych-free-sort-done-btn").css("visibility", "visible");
        },
        prompt: "<p>Click and drag the images below to sort them so that similar items are close together.</p>"
    };

    sequence.push(sort_trial);

    jsPsych.run(sequence);
</script>

</html>