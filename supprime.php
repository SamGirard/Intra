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

    <body>

        <?php
            $id = $_GET['id'];

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

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-10 offset-1 text-center mt-5">
                    <h1>Confirmer la suppression ?</h1>
                    <?php
                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            echo "<p>Nom de l'événement : " . $row['nom'] . "</p>";
                        }
                    ?>
                </div>
            </div>
            <form method="POST">
                <div class="row">  
                <div class="col-md-2 offset-4">
                    <button type="submit" class="form-control">Oui</button>
                </div>
                <div class="col-md-2">
                    <a href="evenement.php"><button class="form-control">Annuler</button></a>
                </div>
            </form>
            </div>
        </div>
    </body>
</html>