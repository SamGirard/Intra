<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Se connecter</title>
        <link rel="stylesheet" href="css/index.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    </head>

    <body class="login">

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
            $servername = "cours.cegep3r.info";
            $usernameDB = "2172853";
            $passwordDB = "2172853";
            $db = "2172853-girard-samuel";

            $conn = new mysqli($servername, $usernameDB, $passwordDB, $db);

            if($conn->connect_error){
                die("Connection erreur : " . $conn->connect_error);
            }

            $sql = "SELECT * FROM utilisateur WHERE nom = '$usager' AND password ='$password'";


            $result = $conn->query($sql);


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

            $usager = trojan($_POST['usager']);
            $mdp = trojan($_POST['mdp']);


            $action = $_POST['action'];
        }


        if ($_SERVER['REQUEST_METHOD'] != "POST" || $erreur == true){

        ?>


        <div class="container min-vh-100 d-flex justify-content-center align-items-center">
            
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" class="loginForm">
                    <h1>Se connecter</h1>
                        <input type="text" class="form-control mb-4" placeholder="Nom d'usager" name="usager">
                        <p class="error"><?php echo $usagerErreur; ?></p>

                        <input type="password" class="form-control mb-5" placeholder="Mot de passe" name="mdp">
                        <p class="error"><?php echo $mdpErreur; ?></p>


                        <p class="error"><?php echo $erreurLogin?></p>
                        <button type="submit" class="form-control mb-1 mt-5 bg-dark text-white rounded-pill" name="action" value="connecter">Se connecter</button>
                    </form>
        </div>

        <?php


    } else {
            header("Location: index.php");
            $_SESSION['connexion'] = true;
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