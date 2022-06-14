<div class="container">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h2 class="title is-5">Score</h2>
                    <p>Commandes réalisées : 0</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h2 class="">Commande</h2>
                    <ul class="">
                        <li>Salade : <span id="nbSalade">0</span></li>
                        <li>Tomate : <span id="nbTomate">0</span></li>
                        <li>Oignon : <span id="nbOignon">0</span></li>
                        <li>Viande : <span id="nbViande">0</span></li>
                        <li>Fromage : <span id="nbFromage">0</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <p class="title is-4">Vos ingrédients</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">

        <?php
        $listeIngr = ["ingrcards/salade.php", "ingrcards/tomate.php", "ingrcards/fromage.php", "ingrcards/viande.php", "ingrcards/oignon.php", "ingrcards/poivron.php"];
        shuffle($listeIngr);
        ?>

        <?php include $listeIngr[0] ?>
        <?php include $listeIngr[1] ?>
        <?php include $listeIngr[2] ?>
        <?php include $listeIngr[3] ?>
        <?php include $listeIngr[4] ?>
        <?php include $listeIngr[5] ?>

    </div>

</div>