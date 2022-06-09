<div class="container mb-5">
    <div class="columns is-centered">
        <div class="column is-8">
            <div class="card">
                <div class="card-content">
                    <div class="content">
                        Commande
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="columns is-centered mt-5 mb-4">
        <div class="col has-text-centered">
            <h1 class="title">Vos ingrédients</h1>
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