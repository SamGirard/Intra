<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Création Département</title>
        <link rel="stylesheet" href="css/index.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    </head>

    <body class="pageDepart">
    <?php

        function trojan($data){
            $data = trim($data); //Enleve les caractères invisibles
            $data = addslashes($data); //Mets des backslashs devant les ' et les  "
            $data = htmlspecialchars($data); // Remplace les caractères spéciaux par leurs symboles comme ­< devient &lt;

            return $data;
        }

    if ($_SESSION["connexion"] = true){


        //Faire la connection
        $servername = "localhost";
        $username = "root";
        $password = "2j4Tzg4CxdFwIZBJ";
        $db = "intra smiley";

        //Creer la connection
        $conn = new mysqli($servername, $username, $password, $db);

        //vérifier la connection
        if($conn->connect_error) {
            die("Connection échoué: " . $conn->connect_error);
        }

        //Afficher les donnée pour departemnet
        $conn->query('SET NAMES utf8');
        $sql = "SELECT * FROM tbdepartement";
        $result = $conn->query($sql);

        $nom =  "";
        $nomErreur = "";

        $erreur = false;

        if ($_SERVER['REQUEST_METHOD'] == "POST"){

            if(empty($_POST['nNom'])){
                $nomErreur = "Le nom ne peut pas être vide";
                $erreur = true;
            }
            else {
                $nom = trojan($_POST['nNom']);
            }
            
            $nom = trojan($_POST['nNom']);

            if($erreur != true){
            $sql = "INSERT INTO tbdepartement (nomDepartement)
            VALUES ('$nom')";

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

                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="departForm">
                        <a href="creationEvent.php"><i class="fa-solid fa-3x fa-arrow-left p-0 m-0"></i></a>
                        <h1>Créer un département</h1>

                            <input class="form-control mb-5" type="text" name="nNom" value="<?php echo $nom;?>" placeholder="Nom du nouveau département">
                            <p class="error"><?php echo $nomErreur; ?></p>
                            
                            <button type="submit" class="form-control mt-3 bg-dark text-white rounded-pill">Créer</button>
                        </form>
            </div>

            <?php

            } else {
                header("Location: creationEvent.php");
                die;
            ?>
                

            <?php
            }


        }else {
            header("Location: login.php");
        }
        ?>
        

        <script src="https://kit.fontawesome.com/2ad1095675.js" crossorigin="anonymous"></script>
    </body>
</html>