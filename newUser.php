<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ajouter un utilisateur</title>
        <link rel="stylesheet" href="css/index.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    </head>

    <body class="pageUser">
        <?php

            function trojan($data){
                $data = trim($data); //Enleve les caractères invisibles
                $data = addslashes($data); //Mets des backslashs devant les ' et les  "
                $data = htmlspecialchars($data); // Remplace les caractères spéciaux par leurs symboles comme ­< devient &lt;

                return $data;
            }

            if($_SESSION["connexion"] = true){

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
        
                //Afficher les donnée pour departemnet
                $conn->query('SET NAMES utf8');
                $sql = "SELECT * FROM utilisateur";
                $result = $conn->query($sql);
            
            
                $username = $mdp = $confMdp = $mdpHash = $confMdpHash =  "";
                $usernameErreur = $mdpErreur = $confMdpErreur = "";
                $erreur = false;

                if ($_SERVER['REQUEST_METHOD'] == "POST"){

                    if(empty($_POST['nUsername'])){
                        $usernameErreur = "Le nom ne peut pas être vide";
                        $erreur = true;
                    }
                    else {
                        $username = trojan($_POST['nUsername']);
                    }
                    if(empty($_POST['nMdp'])){
                        $mdpErreur = "Le mot de passe ne peut pas être vide";
                        $erreur = true;
                    }
                    else {
                        $mdpHash = md5($mdp);
                    }
                    if(empty($_POST['nConfMdp'])){
                        $confMdpErreur = "Veuillez réecrire le mot de passe";
                        $erreur = true;
                    }
                    else if($_POST['nConfMdp'] != $_POST['nMdp']){
                        $confMdpErreur = "Veuillez réecrire le même mot de passe";
                        $erreur = true;
                    } else {
                        $confMdpHash = md5($confMdp);
                    }
                    
                    
        
                    $username = trojan($_POST['nUsername']);
                    $mdp = trojan($_POST['nMdp']);
                    $confMdp = trojan($_POST['nConfMdp']);
                    
        
                    if($erreur != true){
                    $sql = "INSERT INTO utilisateur (nom, password)
                    VALUES ('$username', '$mdpHash')";


        
                        if (mysqli_query($conn, $sql)) {
                            echo "Enregistrement réussi";
                        } else {
                            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                        }
            
                        mysqli_close($conn);
                    }
                }
        
        
                if ($_SERVER['REQUEST_METHOD'] != "POST" || $erreur == true){
            ?>

            <div class="container min-vh-100 d-flex justify-content-center align-items-center">

                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="userForm">
                            <a href="index.php"><i class="fa-solid fa-3x fa-arrow-left p-0 m-0 mb-3"></i></a>
                            <h1>Créer un utilisateur</h1>
                            <input type="text" placeholder="Créer un nom d'utilisateur" class="form-control mt-4" name="nUsername" value=<?php echo $username?>>
                            <p class="error mt-1"><?php echo $usernameErreur; ?></p>

                            <input type="password" placeholder="Créer un mot de passe" name="nMdp" class="form-control mt-4">
                            <p class="error mt-1"><?php echo $mdpErreur; ?></p>

                            <input type="password" placeholder="Confirmer le mot de passe" name="nConfMdp" class="form-control mt-4">
                            <p class="error mt-1"><?php echo $confMdpErreur; ?></p>

                            <button type="submit" class="form-control mt-4 bg-dark text-white rounded-pill">Créer</button>
                        </form>

            </div>



            <?php
                } else {
                    header("Location: index.php");
                    die;
            
                }

            }else {
                header("Location: login.php");
            }
    
    
            ?>

        <script src="https://kit.fontawesome.com/2ad1095675.js" crossorigin="anonymous"></script>
    </body>
</html>