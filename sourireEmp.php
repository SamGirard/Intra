<?php
    session_start();
?>

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

    <body class="pageEmp">

    <?php
        $id = $_GET['id'];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $type = $_POST['type'];
            $value = intval($_POST['value']);

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
            $updateField = "";
            switch ($type) {
                case "content":
                    $updateField = "contentEtu";
                    break;
                case "moyen":
                    $updateField = "moyenEtu";
                    break;
                case "pasContent":
                    $updateField = "pasContentEtu";
                    break;
            }

    if (!empty($updateField)) {
        $sql = "UPDATE `evenement` SET `contentEtu`='".$updateField."',`moyenEtu`='".$updateField."',`pasContentEtu`='".$updateField."',`contentEmp`='".$updateField."',`moyenEmp`='".$updateField."',`pasContentEmp`='".$updateField."' WHERE `id`";

        if ($conn->query($sql) === TRUE) {
            echo "Mise à jour réussie.";
        } else {
            echo "Erreur lors de la mise à jour : " . $conn->error;
        }
    }

            // Fermer la connexion
            $conn->close();
        }
    ?>


    <div class="container emp min-vh-100 d-flex justify-content-center align-items-center p-0">
       
            <div class="col-md-4 face mx-auto px-0">
                <button id="btnContent" onclick="clickContent()"><img src="img/contentEmp.jpg" height="400" width="400"></button>
            </div>
            <div class="col-md-4 face mx-auto px-0">
                <button id="btnMoyen" onclick="clickMoyen()"><img src="img/moyenEmp.jpg" height="400" width="400"></button>
            </div>
            <div class="col-md-4 face mx-auto px-0">
                <button id="btnPasContent" onclick="clickPasContent()"><img src="img/pasContentEmp.jpg" height="400" width="400"></button>

        </div>
    </div>
    <h1><?php echo $id;?></h1>
    <h2 id="ctr1"></h2>
    <h2 id="ctr2"></h2>
    <h2 id="ctr3"></h2>

    <script src="js/sourireEmp.js"></script>
    </body>
</html>
