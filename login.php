<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="css/index.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    </head>

    <body>

    <?php

        $mdp = $usager = "";
        $mdpErreur = $usagerErreur = "";
        $erreur = false;

        $erreurLogin = "";

        if ($_SERVER['REQUEST_METHOD'] == "POST"){
    
            $password = $_POST['mdp'];
            $usager = $_POST['usager'];

            $password = md5($password, false);
            //echo $password;

            //vérifier que l'usager est dans la BD
            $servername = "localhost";
            $usernameDB = "root";
            $passwordDB = "root";
            $dbname = "intra smiley";

            $conn = new mysqli($servername, $usernameDB, $passwordDB, $dbname);

            if($conn->connect_error){
                die("Connection erreur : " . $conn->connect_error);
            }

            $sql = "SELECT * FROM utilisateur WHERE user = '$usager' AND password ='$password'";
            //echo $sql;

            $result = $conn->query($sql);

            if($result->num_rows > 0){
                $row = $result->fetch_assoc();
                echo "<h1>Connecter</h1>";
                $_SESSION["connexion"] = true;
            }
            else {
                $erreur = true;
                $erreurLogin = "Un des champs est invalide";
            }
            $conn->close();


            if(empty($_POST['mdp'])){
                $mdpErreur = "Mauvais mot de passe";
                $erreur = true;
            }
            else {
                $mdp = trojan($_POST['mdp']);
            }

            if(empty($_POST['usager'])){
                $usagerErreur = "Mauvais usager";
                $erreur = true;
            }
            else {
                $usager = trojan($_POST['usager']);
            }

            $usager = trojan($_POST['usager']);
            $mdp = trojan($_POST['mdp']);


            $action = $_POST['action'];
        }


        if ($_SERVER['REQUEST_METHOD'] != "POST" || $erreur == true){

        ?>


        <div class="container-fluid">
            <div class="row">
                <div class = "col-md-6 offset-3 text-center">
                    <h1>Se connecter</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 offset-3">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" class="mt-5">
                        <input type="text" class="form-control mb-2" placeholder="Nom d'usager" name="usager" value="">
                        <p class="error"><?php echo $usagerErreur; ?></p>

                        <input type="password" class="form-control mb-2" placeholder="Mot de passe" name="mdp" value="">
                        <p class="error"><?php echo $mdpErreur; ?></p>


                        <p class="error"><?php echo $erreurLogin?></p>
                        <button type="submit" class="form-control mb-1 mt-5" name="action" value="connecter">Se connecter</button>
                    </form>
                </div>
            
            </div>
        </div>

        <?php


    } else {
            header("Location: index.php");
        ?>


        <?php
        }

            function trojan($data){
                $data = trim($data); //Enleve les caractères invisibles
                $data = addslashes($data); //Mets des backslashs devant les ' et les  "
                $data = htmlspecialchars($data); // Remplace les caractères spéciaux par leurs symboles comme ­< devient &lt;
            
                return $data;
            }


        ?>

    
        <script src="https://kit.fontawesome.com/2ad1095675.js" crossorigin="anonymous"></script>
    </body>
</html>