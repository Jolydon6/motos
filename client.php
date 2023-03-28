<?php
require_once('config.php');

$agent = $bdd->prepare("SELECT * FROM client ");

$agent->execute();

$total = $bdd->query("SELECT count(*) as total FROM client")->fetch()['total'];




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .b-example-divider {
            height: 3rem;
            background-color: rgba(0, 0, 0, .1);
            border: solid rgba(0, 0, 0, .15);
            border-width: 1px 0;
            box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
        }

        .b-example-vr {
            flex-shrink: 0;
            width: 1.5rem;
            height: 100vh;
        }

        .bi {
            vertical-align: -.125em;
            fill: currentColor;
        }

        .nav-scroller {
            position: relative;
            z-index: 2;
            height: 2.75rem;
            overflow-y: hidden;
        }

        .nav-scroller .nav {
            display: flex;
            flex-wrap: nowrap;
            padding-bottom: 1rem;
            margin-top: -1px;
            overflow-x: auto;
            text-align: center;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
        }
    </style>


    <!-- Custom styles for this template -->

</head>

<body>

    <?php require_once('./layouts/header.php') ?>

    <div class="container-fluid">
        <div class="row">
            <?php require_once('./layouts/sidebar.php') ?>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Clients</h1>
                </div>

                <div>
                </div>
                <div class="d-flex justify-content-between">
                    <h2>Profils clients</h2>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">Ajouter un client</button>
                </div>
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">AJouter un client</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">





                                <form method="POST">

                                    <?php

                                    if (isset($_POST['ajouter'])) {
                                        $nom_agent = [
                                            'nom_agent' => htmlspecialchars($_POST['nom_agent']),
                                        ];

                                        $requete = $bdd->prepare("INSERT INTO  agent (nom_agent) VALUES (:nom_agent)");


                                        try {
                                            $insertion = $requete->execute($nom_agent);

                                            if ($insertion) {
                                                echo "<div class='col-md-12'>
            <div class='alert alert-success'>
            Ajout réussi!!
            </div >
            </div >";
                                            }
                                        } catch (PDOException $e) {
                                            if ($e->getCode() == 23000) {
                                                echo "<div class='col-md-12'>
            <div class='alert alert-danger'>
           Agent non ajouté!!
            </div >
            </div >";
                                            }
                                        }
                                    }









                                    ?>


                                    <div class="mb-3">
                                        <label for="recipient-name" class="col-form-label">Nom & prénom</label>
                                        <input type="text" class="form-control" name="nom_agent" id="recipient-name" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="recipient-name" class="col-form-label">Téléphone</label>
                                        <input type="text" class="form-control" name="nom_agent" id="recipient-name" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="recipient-name" class="col-form-label"> Adresse</label>
                                        <input type="text" class="form-control" name="nom_agent" id="recipient-name" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="recipient-name" class="col-form-label"> Type de client</label>
                                        <select name="" id="">
                                            <option value="">...</option>
                                            <option value="Solveur">Solveur</option>
                                            <option value="Debiteur">Débiteur</option>
                                        </select>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                        <input type="submit" value="Ajouter" name="ajouter" class="btn btn-dark">
                                    </div>
                                </form>




                            </div>

                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nom & Prénoms</th>
                                <th scope="col">Téléphone</th>
                                <th scope="col">Adresse</th>
                                <th scope="col">Type de client</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($mes_agent = $agent->fetch()) :    ?>
                                <tr>
                                    <td><?= $mes_agent['num_agent']    ?></td>
                                    <td><?= $mes_agent['nom_agent']    ?></td>
                                    <td><i class="bi bi-arrow-up-left-square"></i> &nbsp;&nbsp;&nbsp; <a href="supprimer.php? id=<?= $mes_agent['num_agent']   ?>"> <i class="bi bi-archive"></i></a> </td>
                                </tr>
                            <?php endwhile   ?>
                            <div>

                            </div>
                        </tbody>
                    </table>

                </div>
            </main>
        </div>
    </div>





    <script>
        src = "js/bootstrap.bundle.min.js"
    </script>
    <script src="sweetalert2.all.min.js"></script>
</body>

</html>