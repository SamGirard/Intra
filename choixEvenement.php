<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Choix de l'évènement</title>
        <link rel="stylesheet" href="css/index.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    </head>
    
    <body>

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


            $choix = "";
            $choixErreur = "";
            $erreur = false;

            if ($_SERVER['REQUEST_METHOD'] == "POST"){

                $choix = $_POST['val_id'];

                if($choix == "rien"){
                    $choixErreur = "Choisissez un évènement";
                    $erreur = true;
                }
                else {
                    $id = $_POST['id'];
                }
            }


            if ($_SERVER['REQUEST_METHOD'] != "POST" || $erreur == true){
                
                ?>

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6 offset-3">
                            <h2 class="text-center">Pour qu'elle évènement voulez-vous partir un sondage?</h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 offset-3">
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                <Select class="form-control" name="val_id">
                                <option value="rien" class="form-control">...</option>
                                    <?php
                                        $ctr = 0;
                                        while($row = $result->fetch_assoc()){
                                    ?>
                                        <option value="<?php echo $row['id']; ?>" class="form-control"><?php echo $row['nom']?></option>
                                    <?php
                                        $ctr++;
                                        }
                                    ?>
                                </Select>
                                
                                <p type="text" class="error mt-1"><?php echo $choixErreur ?></p>

                                <button class="form-control mt-3" type="submit">Afficher le sondage</button>
                            </form>
                        </div>
                    </div>
                </div>

                <?php

        } else {
            header("Location: sourire.php?id=" . $id);
            die;
        }
        ?>

    </body>
</html>