<?php
$listeIngr = ["ingrcards/salade.php", "ingrcards/tomate.php", "ingrcards/fromage.php", "ingrcards/viande.php", "ingrcards/oignon.php", "ingrcards/poivron.php"];
shuffle($listeIngr);
?>

<div class="container">
    <div class="row justify-content-around g-3 mt-1">

        <div class="col-md-2">
            <div class="card">
                <div class="card-header">
                    <h4>Score</h4>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Réussies : <span id="reussites">0</span> </li>
                    <li class="list-group-item">Ratées : <span id="ratees">0</span></li>
                </ul>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4>Commande</h2>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Salade : <span id="nbSalade">0</span></li>
                    <li class="list-group-item">Tomate : <span id="nbTomate">0</span></li>
                    <li class="list-group-item">Oignon : <span id="nbOignon">0</span></li>
                    <li class="list-group-item">Fromage : <span id="nbFromage">0</span></li>
                    <li class="list-group-item">Viande : <span id="nbViande">0</span></li>
                    <li class="list-group-item">Poivron : <span id="nbPoivron">0</span></li>
                </ul>
            </div>
        </div>
    </div>




    <div class="row g-3 my-2">

        <?php include $listeIngr[0] ?>
        <?php include $listeIngr[1] ?>
        <?php include $listeIngr[2] ?>
        <?php include $listeIngr[3] ?>
        <?php include $listeIngr[4] ?>
        <?php include $listeIngr[5] ?>

    </div>


</div>