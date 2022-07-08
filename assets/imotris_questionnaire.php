<style id="jspsych-survey-likert-css">
    .jspsych-survey-likert-statement {
        display: block;
        font-size: 16px;
        padding-top: 40px;
        margin-bottom: 10px;
    }

    .jspsych-survey-likert-opts {
        list-style: none;
        width: 100%;
        margin: auto;
        padding: 0 0 35px;
        display: block;
        font-size: 14px;
        line-height: 1.1em;
    }

    .jspsych-survey-likert-opt-label {
        line-height: 1.1em;
        color: #444;
    }

    .jspsych-survey-likert-opts:before {
        content: '';
        position: relative;
        top: 11px;
        /*left:9.5%;*/
        display: block;
        background-color: #efefef;
        height: 4px;
        width: 100%;
    }

    .jspsych-survey-likert-opts:last-of-type {
        border-bottom: 0;
    }

    .jspsych-survey-likert-opts li {
        display: inline-block;
        /*width:19%;*/
        text-align: center;
        vertical-align: top;
    }

    .jspsych-survey-likert-opts li input[type=radio] {
        display: block;
        position: relative;
        top: 0;
        left: 50%;
        margin-left: -6px;
    }
</style>

<div id="jspsych-survey-likert-form">
    <hr>
    <label class="jspsych-survey-likert-statement"><strong>Si cela ne tenait qu'à moi, je ne laisserais pas ce Cobot avoir d'influence sur les aspects importants de la préparation de commandes</strong></label>
    <ul class="jspsych-survey-likert-opts" data-name="IMOT_1" data-radio-group="Q0">
        <li style="width:20%"><label class="jspsych-survey-likert-opt-label"><input type="radio" name="IMOT_1" value="0" required="">Pas du tout d'accord</label></li>
        <li style="width:20%"><label class="jspsych-survey-likert-opt-label"><input type="radio" name="IMOT_1" value="1" required="">Pas d'accord</label></li>
        <li style="width:20%"><label class="jspsych-survey-likert-opt-label"><input type="radio" name="IMOT_1" value="2" required="">Ni en désaccord ni d'accord</label></li>
        <li style="width:20%"><label class="jspsych-survey-likert-opt-label"><input type="radio" name="IMOT_1" value="3" required="">D'accord</label></li>
        <li style="width:15%"><label class="jspsych-survey-likert-opt-label"><input type="radio" name="IMOT_1" value="4" required="">Tout à fait d'accord</label></li>
    </ul>

    <div class="container border rounded bg-light">
        <label for="customRange1" class="form-label" style="font-size: 16px;"><strong>Comment trouvez-vous cette affirmation ?</strong></label>
        <div class="row align-items-center">
            <div class="col text-center" style="font-size: 15px;">Pas du tout claire</div>
            <div class="col-6"><input type="range" class="form-range" id="customRange1" min=0 max=1 step=0.01></div>
            <div class="col text-center" style="font-size: 15px;">Tout à fait claire</div>
        </div>
    </div>

    <hr>

    <label class="jspsych-survey-likert-statement"><strong>Je serais à l'aise de laisser à ce Cobot l'entière responsabilité de la préparation de commandes</strong></label>
    <ul class="jspsych-survey-likert-opts" data-name="IMOT_2" data-radio-group="Q1">
        <li style="width:20%"><label class="jspsych-survey-likert-opt-label"><input type="radio" name="IMOT_2" value="0" required="">Pas du tout d'accord</label></li>
        <li style="width:20%"><label class="jspsych-survey-likert-opt-label"><input type="radio" name="IMOT_2" value="1" required="">Pas d'accord</label></li>
        <li style="width:20%"><label class="jspsych-survey-likert-opt-label"><input type="radio" name="IMOT_2" value="2" required="">Ni en désaccord ni d'accord</label></li>
        <li style="width:20%"><label class="jspsych-survey-likert-opt-label"><input type="radio" name="IMOT_2" value="3" required="">D'accord</label></li>
        <li style="width:15%"><label class="jspsych-survey-likert-opt-label"><input type="radio" name="IMOT_2" value="4" required="">Tout à fait d'accord</label></li>
    </ul>

    <label class="jspsych-survey-likert-statement"><strong>J'aimerais vraiment disposer d'un bon moyen pour surveiller les décisions de ce Cobot</strong></label>
    <ul class="jspsych-survey-likert-opts" data-name="IMOT_3" data-radio-group="Q2">
        <li style="width:20%"><label class="jspsych-survey-likert-opt-label"><input type="radio" name="IMOT_3" value="0" required="">Pas du tout d'accord</label></li>
        <li style="width:20%"><label class="jspsych-survey-likert-opt-label"><input type="radio" name="IMOT_3" value="1" required="">Pas d'accord</label></li>
        <li style="width:20%"><label class="jspsych-survey-likert-opt-label"><input type="radio" name="IMOT_3" value="2" required="">Ni en désaccord ni d'accord</label></li>
        <li style="width:20%"><label class="jspsych-survey-likert-opt-label"><input type="radio" name="IMOT_3" value="3" required="">D'accord</label></li>
        <li style="width:15%"><label class="jspsych-survey-likert-opt-label"><input type="radio" name="IMOT_3" value="4" required="">Tout à fait d'accord</label></li>
    </ul>

    <label class="jspsych-survey-likert-statement"><strong>Je serais à l'aise de laisser ce Cobot mettre en oeuvre ses décisions, même si je ne peux pas la surveiller</strong></label>
    <ul class="jspsych-survey-likert-opts" data-name="IMOT_4" data-radio-group="Q3">
        <li style="width:20%"><label class="jspsych-survey-likert-opt-label"><input type="radio" name="IMOT_4" value="0" required="">Pas du tout d'accord</label></li>
        <li style="width:20%"><label class="jspsych-survey-likert-opt-label"><input type="radio" name="IMOT_4" value="1" required="">Pas d'accord</label></li>
        <li style="width:20%"><label class="jspsych-survey-likert-opt-label"><input type="radio" name="IMOT_4" value="2" required="">Ni en désaccord ni d'accord</label></li>
        <li style="width:20%"><label class="jspsych-survey-likert-opt-label"><input type="radio" name="IMOT_4" value="3" required="">D'accord</label></li>
        <li style="width:15%"><label class="jspsych-survey-likert-opt-label"><input type="radio" name="IMOT_4" value="4" required="">Tout à fait d'accord</label></li>
    </ul>

    <label class="jspsych-survey-likert-statement"><strong>Je pourrais compter sur ce Cobot sans hésitation</strong></label>
    <ul class="jspsych-survey-likert-opts" data-name="RIS_1" data-radio-group="Q4">
        <li style="width:20%"><label class="jspsych-survey-likert-opt-label"><input type="radio" name="RIS_1" value="0" required="">Pas du tout d'accord</label></li>
        <li style="width:20%"><label class="jspsych-survey-likert-opt-label"><input type="radio" name="RIS_1" value="1" required="">Pas d'accord</label></li>
        <li style="width:20%"><label class="jspsych-survey-likert-opt-label"><input type="radio" name="RIS_1" value="2" required="">Ni en désaccord ni d'accord</label></li>
        <li style="width:20%"><label class="jspsych-survey-likert-opt-label"><input type="radio" name="RIS_1" value="3" required="">D'accord</label></li>
        <li style="width:15%"><label class="jspsych-survey-likert-opt-label"><input type="radio" name="RIS_1" value="4" required="">Tout à fait d'accord</label></li>
    </ul>

    <label class="jspsych-survey-likert-statement"><strong>Je pense qu'utiliser ce Cobot conduira à des résultats positifs</strong></label>
    <ul class="jspsych-survey-likert-opts" data-name="RIS_2" data-radio-group="Q5">
        <li style="width:20%"><label class="jspsych-survey-likert-opt-label"><input type="radio" name="RIS_2" value="0" required="">Pas du tout d'accord</label></li>
        <li style="width:20%"><label class="jspsych-survey-likert-opt-label"><input type="radio" name="RIS_2" value="1" required="">Pas d'accord</label></li>
        <li style="width:20%"><label class="jspsych-survey-likert-opt-label"><input type="radio" name="RIS_2" value="2" required="">Ni en désaccord ni d'accord</label></li>
        <li style="width:20%"><label class="jspsych-survey-likert-opt-label"><input type="radio" name="RIS_2" value="3" required="">D'accord</label></li>
        <li style="width:15%"><label class="jspsych-survey-likert-opt-label"><input type="radio" name="RIS_2" value="4" required="">Tout à fait d'accord</label></li>
    </ul>

    <label class="jspsych-survey-likert-statement"><strong>Je me sentirais à l'aise pour compter sur ce Cobot dans le futur</strong></label>
    <ul class="jspsych-survey-likert-opts" data-name="RIS_3" data-radio-group="Q6">
        <li style="width:20%"><label class="jspsych-survey-likert-opt-label"><input type="radio" name="RIS_3" value="0" required="">Pas du tout d'accord</label></li>
        <li style="width:20%"><label class="jspsych-survey-likert-opt-label"><input type="radio" name="RIS_3" value="1" required="">Pas d'accord</label></li>
        <li style="width:20%"><label class="jspsych-survey-likert-opt-label"><input type="radio" name="RIS_3" value="2" required="">Ni en désaccord ni d'accord</label></li>
        <li style="width:20%"><label class="jspsych-survey-likert-opt-label"><input type="radio" name="RIS_3" value="3" required="">D'accord</label></li>
        <li style="width:15%"><label class="jspsych-survey-likert-opt-label"><input type="radio" name="RIS_3" value="4" required="">Tout à fait d'accord</label></li>
    </ul>

    <label class="jspsych-survey-likert-statement"><strong>Lorsque la préparation de commandes était difficile, je sentais que je pouvais dépendre de ce Cobot</strong></label>
    <ul class="jspsych-survey-likert-opts" data-name="RIS_4" data-radio-group="Q7">
        <li style="width:20%"><label class="jspsych-survey-likert-opt-label"><input type="radio" name="RIS_4" value="0" required="">Pas du tout d'accord</label></li>
        <li style="width:20%"><label class="jspsych-survey-likert-opt-label"><input type="radio" name="RIS_4" value="1" required="">Pas d'accord</label></li>
        <li style="width:20%"><label class="jspsych-survey-likert-opt-label"><input type="radio" name="RIS_4" value="2" required="">Ni en désaccord ni d'accord</label></li>
        <li style="width:20%"><label class="jspsych-survey-likert-opt-label"><input type="radio" name="RIS_4" value="3" required="">D'accord</label></li>
        <li style="width:15%"><label class="jspsych-survey-likert-opt-label"><input type="radio" name="RIS_4" value="4" required="">Tout à fait d'accord</label></li>
    </ul>

    <label class="jspsych-survey-likert-statement"><strong>Si je faisais face à une préparation de commandes très difficile dans le futur, je voudrais avoir ce Cobot avec moi</strong></label>
    <ul class="jspsych-survey-likert-opts" data-name="RIS_5" data-radio-group="Q8">
        <li style="width:20%"><label class="jspsych-survey-likert-opt-label"><input type="radio" name="RIS_5" value="0" required="">Pas du tout d'accord</label></li>
        <li style="width:20%"><label class="jspsych-survey-likert-opt-label"><input type="radio" name="RIS_5" value="1" required="">Pas d'accord</label></li>
        <li style="width:20%"><label class="jspsych-survey-likert-opt-label"><input type="radio" name="RIS_5" value="2" required="">Ni en désaccord ni d'accord</label></li>
        <li style="width:20%"><label class="jspsych-survey-likert-opt-label"><input type="radio" name="RIS_5" value="3" required="">D'accord</label></li>
        <li style="width:15%"><label class="jspsych-survey-likert-opt-label"><input type="radio" name="RIS_5" value="4" required="">Tout à fait d'accord</label></li>
    </ul>

    <label class="jspsych-survey-likert-statement"><strong>Je serais à l'aise de laisser ce Cobot prendre toute les décisions</strong></label>
    <ul class="jspsych-survey-likert-opts" data-name="RIS_6" data-radio-group="Q9">
        <li style="width:20%"><label class="jspsych-survey-likert-opt-label"><input type="radio" name="RIS_6" value="0" required="">Pas du tout d'accord</label></li>
        <li style="width:20%"><label class="jspsych-survey-likert-opt-label"><input type="radio" name="RIS_6" value="1" required="">Pas d'accord</label></li>
        <li style="width:20%"><label class="jspsych-survey-likert-opt-label"><input type="radio" name="RIS_6" value="2" required="">Ni en désaccord ni d'accord</label></li>
        <li style="width:20%"><label class="jspsych-survey-likert-opt-label"><input type="radio" name="RIS_6" value="3" required="">D'accord</label></li>
        <li style="width:15%"><label class="jspsych-survey-likert-opt-label"><input type="radio" name="RIS_6" value="4" required="">Tout à fait d'accord</label></li>
</div>