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
    $data = getDataP($bdd, $p);
    $dataApp = getDataPApp($bdd, $p);
    $dataFac = getDataPFac($bdd, $p);
    $dataDif = getDataPDif($bdd, $p);
    $dataMean = getDataPMean($bdd, $p);
    ?>

    <script>
        // Temps de réponse

        const labels_rt = [
            <?php
            for ($i = 0; $i < count($dataApp); $i++) {
                echo "'" . $dataApp[$i]['burgerID'] . "',";
            }
            ?>
        ];

        const data_rt = {
            labels: labels_rt,
            datasets: [{
                    label: 'Apprentissage',
                    backgroundColor: 'rgb(209, 175, 148)',
                    borderColor: 'rgb(209, 175, 148)',
                    data: [
                        <?php
                        for ($i = 0; $i < count($dataApp); $i++) {
                            echo "'" . $dataApp[$i]['rt'] . "',";
                        }
                        ?>
                    ],
                },
                {
                    label: 'Facile',
                    backgroundColor: 'rgb(83, 134, 228)',
                    borderColor: 'rgb(83, 134, 228)',
                    data: [
                        <?php
                        for ($i = 0; $i < count($dataFac); $i++) {
                            echo "'" . $dataFac[$i]['rt'] . "',";
                        }
                        ?>
                    ],
                },
                {
                    label: 'Difficile',
                    backgroundColor: 'rgb(238, 46, 49)',
                    borderColor: 'rgb(238, 46, 49)',
                    data: [
                        <?php
                        for ($i = 0; $i < count($dataDif); $i++) {
                            echo "'" . $dataDif[$i]['rt'] . "',";
                        }
                        ?>
                    ],
                }
            ]
        };

        const config_rt = {
            type: 'line',
            data: data_rt,
            options: {
                scales: {
                    y: {
                        suggestedMin: 0,
                    }
                }
            }
        };



        // Performance

        const labels_perf = ["Phases"];

        const data_perf = {
            labels: labels_perf,
            datasets: [{
                    label: 'Apprentissage',
                    backgroundColor: 'rgb(209, 175, 148)',
                    borderColor: 'rgb(209, 175, 148)',
                    data: [<?php echo "'" . $dataMean[0]['score'] . "'," ?>],
                },
                {
                    label: 'Facile',
                    backgroundColor: 'rgb(83, 134, 228)',
                    borderColor: 'rgb(83, 134, 228)',
                    data: [<?php echo "'" . $dataMean[2]['score'] . "'," ?>],
                },
                {
                    label: 'Difficile',
                    backgroundColor: 'rgb(238, 46, 49)',
                    borderColor: 'rgb(238, 46, 49)',
                    data: [<?php echo "'" . $dataMean[1]['score'] . "'," ?>],
                }
            ]
        };

        const config_perf = {
            type: 'bar',
            data: data_perf,
            options: {
                scales: {
                    y: {
                        suggestedMin: 0,
                        suggestedMax: 1
                    }
                }
            }
        };
    </script>


    <div class="container">
        <div class="row">
            <div class="col text-center">
                <h1><?php echo $p ?></h1>
            </div>
        </div>


        <div class="row mt-4">

            <div class="col-md-6">
                <h2>Temps de réponse</h2>
                <canvas id="rtPart"></canvas>
                <script>
                    const rtChart = new Chart(
                        document.getElementById('rtPart'),
                        config_rt
                    );
                </script>

            </div>

            <div class="col-md-6">
                <h2>Performance</h2>
                <canvas id="perfPart"></canvas>
                <script>
                    const perfChart = new Chart(
                        document.getElementById('perfPart'),
                        config_perf
                    );
                </script>
            </div>

        </div>
    </div>

</body>

</html>