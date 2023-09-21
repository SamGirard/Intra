<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Choix de l'évènement</title>
        <link rel="stylesheet" href="css/index.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    </head>
    
    <body class="pageChoix">

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

                $action = $_POST['action'];

                $conn->close();
            }


            if ($_SERVER['REQUEST_METHOD'] != "POST" || $erreur == true){
                
                ?>

                <div class="container min-vh-100 d-flex justify-content-center align-items-center">


                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class ="choixForm">
                            <a href="index.php"><i class="fa-solid fa-3x fa-arrow-left p-0 m-0"></i></a>
                            <h2>Pour qu'elle évènement voulez-vous partir un sondage?</h2>
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

                                <button class="form-control mt-3 bg-dark text-white" type="submit" name="action">Afficher le sondage</button>
                            </form>

                </div>

                <?php

        } else {
            $id = $_POST['val_id'];
            header("Location: sourire.php?id=" . $id);
            die;
        }
        ?>

        <script src="https://kit.fontawesome.com/2ad1095675.js" crossorigin="anonymous"></script>

    </body>
</html>