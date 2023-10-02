<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="css/index.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    </head>

    <body class="pageChoixEdit">

    <?php


        function trojan($data){
            $data = trim($data); //Enleve les caractères invisibles
            $data = addslashes($data); //Mets des backslashs devant les ' et les  "
            $data = htmlspecialchars($data); // Remplace les caractères spéciaux par leurs symboles comme ­< devient &lt;
            return $data;
        }

        if ($_SESSION["connexion"] == true) {
            // Faire la connection
            $servername = "cours.cegep3r.info";
            $username = "root";
            $password = "2j4Tzg4CxdFwIZBJ";
            $db = "intra smiley";

            // Créer la connection
            $conn = new mysqli($servername, $username, $password, $db);

            // Vérifier la connection
            if ($conn->connect_error) {
                die("Connection échouée : " . $conn->connect_error);
            }

            // Afficher les données pour l'usager
            $conn->query('SET NAMES utf8');
            $sql = "SELECT * FROM utilisateur";
            $result = $conn->query($sql);

            $choixErreur = "";
            $erreur = false;

            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                $choix = trojan($_POST['userChoix']);

                    header("Location: editUser.php?id=" . $choix);
                    exit(); 
            }
        ?>



            <div class="container min-vh-100 d-flex justify-content-center align-items-center">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="formChoixEdit">
                    <a href="optionUsager.php"><i class="fa-solid fa-3x fa-arrow-left p-0 m-0 mb-3"></i></a>
                    <h1>Choisissez l'utilisateur</h1>
                    <select class="form-control" name="userChoix">
                        <?php
                        while ($row = $result->fetch_assoc()) {
                            echo '<option value="' . $row['id'] . '" class="form-control">' . $row['nom'] . '</option>';
                        }
                        ?>
                    </select>
                    <button type="submit" class="form-control mt-4 bg-dark text-white rounded-pill">Commencer la modification</button>
                </form>
            </div>


        <?php
    } else {
        header("Location: login.php");
    }
    ?>
        <script src="https://kit.fontawesome.com/2ad1095675.js" crossorigin="anonymous"></script>
    </body>
</html>