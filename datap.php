<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Participant <?php echo $_GET['p']; ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.8.0/dist/chart.min.js"></script>

</head>

<body>

    <?php
    include 'fonctions.php';
    $bdd = getBD();
    $p = $_GET['p'];
    $perf = getPerfP($bdd, $p);
    $rtApp = getRTappP($bdd, $p);
    $rtFac = getRTfacP($bdd, $p);
    $rtFacass = getRTfacassP($bdd, $p);
    $rtDif = getRTdifP($bdd, $p);
    $rtDifass = getRTdifassP($bdd, $p);
    ?>




    <div class="container">
        <div class="row">
            <div class="col text-center mt-4">
                <h1>Votre identifiant : <span class="font-monospace"><?php echo $p ?></span></h1>
            </div>
        </div>


        <div class="row mt-4 justify-content-center">
            <div class="col-md-3">
                <div class="card m-1">
                    <div class="card-header fs-4">
                        Performance
                    </div>
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Étape</th>
                                    <th>Précision</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Entrainement</td>
                                    <td><?php echo $perf[0]["score"] * 100 ?> %</td>
                                </tr>
                                <tr>
                                    <td>Facile</td>
                                    <td><?php echo $perf[3]["score"] * 100 ?> %</td>
                                </tr>
                                <tr>
                                    <td>Facile avec Cobot</td>
                                    <td><?php echo $perf[4]["score"] * 100 ?> %</td>
                                </tr>
                                <tr>
                                    <td>Difficile</td>
                                    <td><?php echo $perf[1]["score"] * 100 ?> %</td>
                                </tr>
                                <tr>
                                    <td>Difficile avec Cobot</td>
                                    <td><?php echo $perf[2]["score"] * 100 ?> %</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-5">
                <div class="card m-1">
                    <div class="card-header fs-4">
                        Temps de réponse (en secondes)
                    </div>
                    <div class="card-body">
                        <canvas height="200px" id="rtChart"></canvas>
                    </div>
                    <div class="card-footer text-muted">
                            Vous pouvez afficher/masquer les courbes en cliquant sur leurs étiquettes au dessus du graphe
                        </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <hr>
                <p>
                    Contact : <a href="mailto:florian.vie@univ-ubs.fr">florian.vie@univ-ubs.fr</a>
                </p>
            </div>
        </div>
    </div>


    <script>
        const labels = [
            <?php
            for ($i = 0; $i < count($rtApp); $i++) {
                echo "'" . $rtApp[$i]['burgerID'] . "',";
            }
            ?>
        ];

        const data = {
            labels: labels,
            datasets: [{
                    label: 'Entrainement',
                    backgroundColor: 'rgb(87, 117, 144)',
                    borderColor: 'rgb(87, 117, 144)',
                    hidden: true,
                    data: [
                        <?php
                        for ($i = 0; $i < count($rtApp); $i++) {
                            echo ($rtApp[$i]['rt'] / 1000) . ",";
                        }
                        ?>
                    ],
                },
                {
                    label: 'Facile',
                    backgroundColor: 'rgb(144, 190, 109)',
                    borderColor: 'rgb(144, 190, 109)',
                    data: [
                        <?php
                        for ($i = 0; $i < count($rtFac); $i++) {
                            echo ($rtFac[$i]['rt'] / 1000) . ",";
                        }
                        ?>
                    ],
                },
                {
                    label: 'Facile Cobot',
                    backgroundColor: 'rgb(67, 170, 139)',
                    borderColor: 'rgb(67, 170, 139)',
                    hidden: true,
                    data: [
                        <?php
                        for ($i = 0; $i < count($rtFacass); $i++) {
                            echo ($rtFacass[$i]['rt'] / 1000) . ",";
                        }
                        ?>
                    ],
                },
                {
                    label: 'Difficile',
                    backgroundColor: 'rgb(248, 150, 30)',
                    borderColor: 'rgb(248, 150, 30)',
                    data: [
                        <?php
                        for ($i = 0; $i < count($rtDif); $i++) {
                            echo ($rtDif[$i]['rt'] / 1000) . ",";
                        }
                        ?>
                    ],
                },
                {
                    label: 'Difficile Cobot',
                    backgroundColor: 'rgb(243, 114, 44)',
                    borderColor: 'rgb(243, 114, 44)',
                    hidden: true,
                    data: [
                        <?php
                        for ($i = 0; $i < count($rtDifass); $i++) {
                            echo ($rtDifass[$i]['rt'] / 1000) . ",";
                        }
                        ?>
                    ],
                },
            ]
        };

        const config = {
            type: 'line',
            data: data,
            options: {}
        };
    </script>

    <script>
        const myChart = new Chart(
            document.getElementById('rtChart'),
            config
        );
    </script>



</body>

</html>