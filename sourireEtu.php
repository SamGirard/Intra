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
    <link rel="shortcut icon" href="#">
    <link rel="stylesheet" href="css/index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="pageEtu overflow-hidden">

    <?php
            if($_SESSION["connexion"] == true){
                if ($_SERVER["REQUEST_METHOD"] == "GET") {
                    if (isset($_GET['id'])) {
                        $id = $_GET['id'];

                        // Faire la connexion à la base de données
                        $servername = "cours.cegep3r.info";
                        $username = "2172853";
                        $password = "Samu2004";
                        $db = "2172853-girard-samuel";

                        

                        $conn = new mysqli($servername, $username, $password, $db);

                        // Vérifier la connexion
                        if ($conn->connect_error) {
                            die("Connection échouée : " . $conn->connect_error);
                        }

                        $conn->query('SET NAMES utf8');
                        $sql = "SELECT * FROM evenement WHERE id = $id";
                        $result = $conn->query($sql);


                    
                ?>
                        <div class="container smile min-vh-100 d-flex justify-content-center align-items-center p-0">
                            <form id="voteForm" method="post">
                                <input type="hidden" name="voteType" id="voteType">
                                <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
                            </form>

                            <div class="col-md-4 face face1 mx-auto px-0">
                                <button id="btnContent" onclick="clickButton('content')" data-type="content"><img src="img/contentEtu.jpg" height="400" width="400" class="visage"></button>
                            </div>
                            <div class="col-md-4 face mx-auto px-0">
                                <button id="btnMoyen" onclick="clickButton('moyen')" data-type="moyen"><img src="img/moyenEtu.jpg" height="400" width="400" class="visage"></button>
                            </div>
                            <div class="col-md-4 face mx-auto px-0">
                                <button id="btnPasContent" onclick="clickButton('pasContent')" data-type="pasContent"><img src="img/pasContentEtu.jpg" height="400" width="400" class="visage"></button>
                            </div>
                        </div>
                        
        <?php 
            }
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $servername = "cours.cegep3r.info";
            $username = "2172853";
            $password = "2172853";
            $db = "2172853-girard-samuel";

                // Créer la connexion
                $conn = new mysqli($servername, $username, $password, $db);

                // Vérifier la connexion
                if ($conn->connect_error) {
                    die("Connection échouée : " . $conn->connect_error);
                }

                $id = $_POST['id'];
                $voteType = $_POST['voteType'];
                
                $conn->query('SET NAMES utf8');
                $sql = "SELECT * FROM evenement WHERE id = $id";
                $result = $conn->query($sql);

                // Mettre à jour la base de données en fonction du type de vote
                $updateField = "";
                switch ($voteType) {
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

                
                    $sql = "UPDATE evenement SET $updateField = $updateField + 1 WHERE id = ?";
                    $stmt = $conn->prepare($sql);

                    if ($stmt) {
                        $stmt->bind_param("i", $id);
                        if ($stmt->execute()) {
                            header("Location: sourireEtu.php?id=" . $id);
                            exit();
                        } else {
                            echo "Erreur lors de la mise à jour : " . $stmt->error;
                        }
                        $stmt->close();
                    } else {
                        echo "Erreur lors de la préparation de la requête : " . $conn->error;
                    }

            

                // Fermer la connexion
                $conn->close();
            }
        }else {
            header("Location: login.php");
        }
        ?>



        <script src="js/sourireEtu.js"></script>
    </body>
</html>
