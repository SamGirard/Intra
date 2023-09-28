<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Suppression</title>
        <link rel="stylesheet" href="css/index.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    </head>

    <body class="pageSupp">

        <?php
        if($_SESSION["connexion"] == true){
            $erreur = false;

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

                $nomErreur = $passErreur = "";

                //Afficher les donnée
                    $conn->query('SET NAMES utf8');
                    $sql = "SELECT * FROM utilisateur";
                    $result = $conn->query($sql);


                    if ($_SERVER['REQUEST_METHOD'] == "POST" || $erreur == true){

                        $username = $_POST['nUsager'];
                        $password = $_POST['nPass'];

                        if(empty($_POST['nUsager'])){
                            $nomErreur = "Le nom ne peut pas être vide";
                            $erreur = true;
                        }
                        
                        if(empty($_POST['nPass'])){
                            $passErreur = "Le mot de passe ne peut pas être vide";
                            $erreur = true;
                        }

                        $sql = "DELETE FROM utilisateur WHERE nom='$username' AND password= '$password'";

                        if ($conn->query($sql) === TRUE) {
                            header("Location: optionUsager.php");
                            exit();
                        } else {
                            echo "Erreur lors de la suppression : " . $conn->error;
                        }
                    }

                    
            ?>

            <div class="container min-vh-100 d-flex justify-content-center align-items-center">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="suppUserForm">
                    <h1>Supprimer un utilisateur</h1>
                    <input type="text" class="form-control mb-4" name="nUsager" placeholder="Écriver le nom de l'usager à supprimer">
                    <p class="error"><?php echo $nomErreur; ?></p>

                    <input type="password" class="form-control mb-5" name="nPass" placeholder="Écriver le mot passe de l'usager à supprimer">
                    <p class="error"><?php echo $passErreur; ?></p>

                    <div class="d-flex flex-column align-items-center">
                        <button type="submit" class="form-control oui rounded-pill">Oui</button>
                        <a class="mt-5 annule" href="optionUsager.php">Annuler</a>
                    </div>
                </form>
            </div>

        <?php
            }else {
                header("Location: login.php");
            }
        ?>

    </body>
</html>