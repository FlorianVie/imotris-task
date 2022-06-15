<?php
$listeIngr = ["ingrcards/salade.php", "ingrcards/tomate.php", "ingrcards/fromage.php", "ingrcards/viande.php", "ingrcards/oignon.php", "ingrcards/poivron.php"];
shuffle($listeIngr);
?>

<div class="container">
    <div class="row justify-content-around g-3 mt-1">

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5>Score</h5>
                </div>
                <table class="table table-sm table-borderless table-hover">
                    <thead>
                        <tr>
                            <th>Ratées</th>
                            <th>Réussies</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><span id="ratees">0</span></td>
                            <td><span id="reussites">0</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-md-3">
            <h3 class="mt-3 font-monospace">
                <span id="timer">..:..</span>
            </h3>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5>Commande</h5>
                </div>
                <table class="table table-sm table-borderless table-hover">
                    <thead>
                        <tr>
                            <th>Ingrédients</th>
                            <th>Quantités</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Salade</td>
                            <td><span id="nbSalade">0</span></td>
                        </tr>
                        <tr>
                            <td>Tomate</td>
                            <td><span id="nbTomate">0</span></td>
                        </tr>
                        <tr>
                            <td>Oignon</td>
                            <td><span id="nbOignon">0</span></td>
                        </tr>
                        <tr>
                            <td>Fromage</td>
                            <td><span id="nbFromage">0</span></td>
                        </tr>
                        <tr>
                            <td>Viande</td>
                            <td><span id="nbViande">0</span></td>
                        </tr>
                        <tr>
                            <td>Poivron</td>
                            <td><span id="nbPoivron">0</span></td>
                        </tr>
                    </tbody>
                </table>
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