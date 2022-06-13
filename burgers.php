<div class="container mb-5">
    <div class="columns is-centered">
    <div class="column is-4">
            <div class="card">
                <div class="card-content">
                    <div class="content">
                        <h2 class="title is-5">Score</h2>
                        <p>Commandes réalisées : 0</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="column is-8">
            <div class="card">
                <div class="card-content">
                    <div class="content">
                    <h2 class="title is-5">Commande</h2>
                    <p>Salade : 0</p>
                    <p>Tomate : 0</p>
                    <p>Oignon : 0</p>
                    <p>Viande : 0</p>
                    <p>Fromage : 0</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="columns is-centered mt-5 mb-4">
        <div class="col has-text-centered">
        <div class="card">
                <div class="card-content">
                    <div class="content">
                    <p class="title is-4">Vos ingrédients</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="columns is-centered">

        <?php
        $listeIngr = ["ingrcards/salade.php", "ingrcards/tomate.php", "ingrcards/fromage.php", "ingrcards/viande.php", "ingrcards/oignon.php"];
        shuffle($listeIngr);
        ?>

        <?php include $listeIngr[0] ?>
        <?php include $listeIngr[1] ?>
        <?php include $listeIngr[2] ?>
        <?php include $listeIngr[3] ?>
        <?php include $listeIngr[4] ?>

    </div>

</div>