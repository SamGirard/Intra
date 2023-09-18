<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Vote Sourire</title>
        <link rel="stylesheet" href="css/index.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    </head>

    <body>

    <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
            $id = $_POST['id'];
            
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

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $nom = $row['nom'];
                    echo "<h1>$nom</h1>";
                } else {
                    echo "Aucun élément trouvé avec cet ID.";
                }

            }else {
                echo "ID non spécifié dans la requête.";
            }
?>

        <div class="container-fluid h-100">
            <div class="row text-center">
                <div class="col-md-3 mx-auto">
                    <button id="btnContent"><img src="img/content.jpg" height="400" width="400"></button>
                </div>
                <div class="col-md-3 mx-auto">
                    <img src="img/bof.jpg" height="400" width="400">
                </div>
                <div class="col-md-3 mx-auto">
                    <img src="img/pas content.jpg" height="400" width="400">
                </div>
            </div>
        </div>
        <h1><?php echo $nom;?></h1>

        <script src="js/sourire.js"></script>
    </body>
</html>