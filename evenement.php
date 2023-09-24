<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Gestion des Évènement</title>
        <link rel="stylesheet" href="css/index.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    </head>

    <body class="pageEvent">

    <?php

        //Faire la connection
        $servername = "localhost";
        $username = "root";
        $password = "root";
        $db = "intra smiley";

        //Creer la connection
        $conn = new mysqli($servername, $username, $password, $db);

        //vérifier la connection
        if($conn->connect_error) {
            die("Connection échoué: " . $conn->connect_error);
        }

        //Afficher les donnée
            $conn->query('SET NAMES utf8');
            $sql = "SELECT * FROM evenement";
            $result = $conn->query($sql);

            if (isset($_GET['id'])) {
                $id = $_GET['id'];
            }
        ?>


        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2">
                    <a href="index.php"><i class="fa-solid fa-3x fa-arrow-left p-0 mt-2"></i></a>
                </div>
            </div>
            
            <div class="row">
                <?php
                    $ctr = 0;
                    while($row = $result->fetch_assoc()){
                        if ($ctr % 2 == 0 && $ctr != 0) {
                            echo '</div><div class="row">';
                        }
                ?>
                    <div class="col-md-5 boite mx-auto my-5">
                        <div class="row">
                            <div class="col-md-10">
                                <h2 class="mt-3 titre"><?php echo $row['nom'];?></h1>
                            </div>
                            <div class="col-md-1">
                            <a href="infoEvent.php?id=<?php echo $row['id'];?>"><i class="mt-3 fa-solid fa-square-pen fa-4x" style="color: #292929"></i></a>
                            </div>
                            <div class="col-md-1 px-2">
                                <a href="supprime.php?id=<?php echo $row['id'];?>"><i class="mt-3 fa-solid fa-square-xmark fa-4x" style="color: #ff4242;"></i></a>
                            </div>
                        </div>
                        
                        <p class="desc"><?php echo $row['description']?></p>
                        <h3 class="my-4">Département : <?php echo $row['departement']?></h3>
                        <h4 class="my-4">Lieu : <?php echo $row['lieu']?></h4>
                        <h4 class="my-4">Date : <?php echo $row['date']?></h4>
                        <div class="row text-center">
                            <div class="col-md-4">
                                <h5><?php echo $row['contentEtu']?><i class="fa-solid fa-face-smile mx-2"></i></h5>
                            </div>
                            <div class="col-md-4">
                                <h5><?php echo $row['moyenEtu']?><i class="fa-solid fa-face-meh mx-2"></i></h5>
                            </div>
                            <div class="col-md-4">
                                <h5><?php echo $row['pasContentEtu']?><i class="fa-solid fa-face-frown mx-2"></i></h5>
                            </div>
                        </div>
                        <div class="row text-center mt-3 rowEmployeur">
                            <div class="col-md-4">
                                <h5><?php echo $row['contentEmp']?><i class="fa-regular fa-face-smile mx-2"></i></h5>
                            </div>
                            <div class="col-md-4">
                                <h5><?php echo $row['moyenEmp']?><i class="fa-regular fa-face-meh mx-2"></i></h5>
                            </div>
                            <div class="col-md-4">
                                <h5><?php echo $row['pasContentEmp']?><i class="fa-regular fa-face-frown mx-2"></i></h5>
                            </div>
                        </div>
                    </div>
                <?php
                    $ctr++;
                    }
                ?>
            </div>
        </div>



        <script src="https://kit.fontawesome.com/2ad1095675.js" crossorigin="anonymous"></script>
    </body>
</html>