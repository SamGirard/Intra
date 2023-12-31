<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en" class="index">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Menu</title>
        <link rel="stylesheet" href="css/index.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    </head>

    <body class="index">

    <?php 
        if($_SESSION['connexion'] == true){
    ?>
        <div class="container-fluid mx-0 navBar px-0 overflow-visible">
            <div class="row">
                <div class="col-md-1">
                    <a href="deconnecter.php"><i class="fa-solid fa-3x fa-right-from-bracket mx-1 mt-2"></i></a>
                </div>
                <div class="col-sm-1 offset-10 mr-auto text-right p-0">
                    <div class="row">
                        <div class="col-md-5 colDePlus"></div>
                        <div class="col-md-7">
                            <a href="optionUsager.php"><i class="fa-solid fa-user-gear mt-2 fa-3x"></i></a>
                        </div>
                    </div>
                </div>
                </div>
                <div class="row align-items-center min-vh-100 choixTrois">
                    <div class="col-md-4 boite-menu px-0 mb-5">
                        <a href="evenement.php" class="event mx-4 d-flex flex-column align-items-center text-center">
                            <h2>Évènement</h2>
                            <p>Afficher, éditer ou supprimer les évènements passés</p>
                        </a>
                    </div>
                    <div class="col-md-4 boite-menu px-0 mb-5">
                        <a href="creationEvent.php" class="creer mx-4 d-flex flex-column align-items-center text-center">
                            <h2>Créer</h2>
                            <p>Créer un nouvel évènement ou un département et l'enregistrer</p>
                        </a>
                    </div>
                    <div class="col-md-4 boite-menu px-0 mb-5">
                        <a href="choixEvenement.php" class="sourire mx-4 d-flex flex-column align-items-center text-center">
                            <h2>Sondage</h2>
                            <p>Commencer un sondage pour un évènement</p>
                        </a>
                    </div>
                </div>
        </div>





        <?php
            } else {
                header("Location: login.php");
            }
    ?>

    
        <script src="https://kit.fontawesome.com/2ad1095675.js" crossorigin="anonymous"></script>
    </body>
</html>