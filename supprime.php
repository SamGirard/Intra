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
                $id = $_GET['id'];

                //Faire la connection
                $servername = "cours.cegep3r.info";
            $username = "2172853";
            $password = "2172853";
            $db = "intra smiley";

                //Creer la connection
                $conn = new mysqli($servername, $username, $password, $db);

                //vérifier la connection
                if($conn->connect_error) {
                    die("Connection échoué: " . $conn->connect_error);
                }

                //Afficher les donnée
                    $conn->query('SET NAMES utf8');
                    $sql = "SELECT * FROM evenement WHERE id = $id";
                    $result = $conn->query($sql);

                    if ($_SERVER['REQUEST_METHOD'] == "POST"){

                        $sql = "DELETE FROM evenement WHERE id=$id";

                        if ($conn->query($sql) === TRUE) {
                            header("Location: evenement.php");
                            exit();
                        } else {
                            echo "Erreur lors de la suppression : " . $conn->error;
                        }
                    }
                    
            ?>

            <div class="container min-vh-100 d-flex justify-content-center align-items-center">
                <form method="POST" class="suppForm">
                    <h1>Confirmer la suppression ?</h1>
                    <?php
                            if ($result->num_rows > 0) {
                                $row = $result->fetch_assoc();
                                echo "<p>Nom de l'événement : " . $row['nomEvent'] . "</p>";
                            }
                        ?>
                    <div class="d-flex flex-column align-items-center">
                        <button type="submit" class="form-control oui rounded-pill">Oui</button>
                        <a class="mt-5 annule" href="evenement.php">Annuler</a>
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