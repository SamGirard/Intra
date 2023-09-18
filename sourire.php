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
        $id = $_GET['id'];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // Récupérer les valeurs des compteurs depuis la requête AJAX
            $ctrValueBon = intval($_POST['counter1']);
            $ctrValueMoyen = intval($_POST['counter2']);
            $ctrValuePasBon = intval($_POST['counter3']);

            // Faire la connexion à la base de données
            $servername = "localhost";
            $username = "root";
            $password = "root";
            $db = "intra smiley";

            $conn = new mysqli($servername, $username, $password, $db);

            // Vérifier la connexion
            if ($conn->connect_error) {
                die("Connection échouée : " . $conn->connect_error);
            }

            // Mettre à jour les valeurs dans la base de données
            $sql = "UPDATE evenement SET contentEtu = '$ctrValueBon', moyenEtu = '$ctrValueMoyen', pasContentEtu = '$ctrValuePasBon' WHERE id = $id";

            if ($conn->query($sql) === TRUE) {
                echo "Mise à jour réussie.";
            } else {
                echo "Erreur lors de la mise à jour : " . $conn->error;
            }

            // Fermer la connexion
            $conn->close();
        }
    ?>

    <div class="container-fluid h-100">
        <div class="row text-center">
            <div class="col-md-3 mx-auto">
                <button id="btnContent" onclick="clickContent()"><img src="img/content.jpg" height="400" width="400"></button>
            </div>
            <div class="col-md-3 mx-auto">
                <button onclick="clickMoyen()"><img src="img/bof.jpg" height="400" width="400"></button>
            </div>
            <div class="col-md-3 mx-auto">
                <button onclick="clickPasContent()"><img src="img/pas content.jpg" height="400" width="400"></button>
            </div>
        </div>
    </div>
    <h1><?php echo $id;?></h1>
    <h2 id="ctr1">0</h2>
    <h2 id="ctr2">0</h2>
    <h2 id="ctr3">0</h2>

    <script src="js/sourire.js"></script>
    </body>
</html>
