<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IMOTRIS Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.8.0/dist/chart.min.js"></script>

</head>


<body class="">

    <?php
    include "fonctions.php";
    $bdd = getBD();
    ?>

    <div class="container">
        <div class="row mt-4">
            <div class="col text-center">
                <h1>Dashboard</h1>
            </div>
        </div>

        <hr>

        <div class="row justify-content-center">
            <div class="col-md-4 text-center">
                <h2>Pré-test</h2>

                <form action="pretest.php" method="get">

                    <table class="table">
                        <thead>
                            <tr>
                                <th>Phase</th>
                                <th>Nb trials</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Apprentissage</td>
                                <td><input type="number" name="a" class="form-control text-center" value="10" min="1"></td>
                            </tr>
                            <tr>
                                <td>Facile</td>
                                <td><input type="number" name="f" class="form-control text-center" value="10" min="1"></td>
                            </tr>
                            <tr>
                                <td>Difficile</td>
                                <td><input type="number" name="d" class="form-control text-center" value="10" min="1"></td>
                            </tr>
                        </tbody>
                    </table>

                    <button class="btn btn-primary">Pré-test</button>

                </form>

            </div>

            <div class="col-md-4 text-center">
                <h2>Data</h2>
                <?php
                $rt = getDataRT($bdd);

                ?>



            </div>
        </div>

        <hr>

    </div>

</body>

</html>