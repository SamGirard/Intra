<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creation d'Évènement</title>
    <link rel="stylesheet" href="css/index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>

    <?php

    $_SESSION["connexion"] = true;
    echo "Connexion réussi" . $_SESSION["connexion"];


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
        echo "Connection Réussi!";


        $nom = $description = $departement = "";
        $nomErreur = $descriptionErreur = $departementErreur = "";
        $content = $moyen = $pasContent = 0;

        $erreur = false;

        if ($_SERVER['REQUEST_METHOD'] == "POST"){

            if(empty($_POST['nNom'])){
                $nomErreur = "Le nom ne peut pas être vide";
                $erreur = true;
            }
            else {
                $nom = trojan($_POST['nNom']);
            }
            if(empty($_POST['nDescription'])){
                $descriptionErreur = "La description ne peut pas être vide";
                $erreur = true;
            }
            else {
                $description = trojan($_POST['nDescription']);
            }
            if(empty($_POST['nDepartement'])){
                $departementErreur = "Le département ne peut pas être vide";
                $erreur = true;
            }
            else {
                $departement = trojan($_POST['type']);
            }
            

            $nom = trojan($_POST['nNom']);
            $description = trojan($_POST['nDescription']);
            $departement = trojan($_POST['nDepartement']);

            if($erreur != true){
            $sql = "INSERT INTO evenement (nom, description, departement, content, moyen, pasContent)
            VALUES ('$nom', '$description', '$departement', 0, 0, 0)";

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
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-md-4 offset-4 p-0">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="mt-5">
                    <a href="index.php"><i class="fa-solid fa-3x fa-arrow-left p-0 m-0 mb-3"></i></a>
                    <h1>Créer un évènement</h1>
                        <input type="text" class="form-control mb-2" placeholder="Nom de l'évènement" name="nNom" value="<?php echo $nom;?>">
                        <p class="error"><?php echo $nomErreur; ?></p>

                        <div class="row">
                            <div class="col-md-10">
                                <input type="text" class="form-control mb-2" placeholder="Départment associé" name="nDepartement" value="<?php echo $departement;?>">
                                <p class="error"><?php echo $departementErreur; ?></p>
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="form-control mb-2" value="<?php echo $departement;?>"><i class="fa-solid fa-plus"></i></button>
                            </div>
                        </div>
                        

                        <textarea type="textarea" class="form-control mb-2" placeholder="Description" name="nDescription" value="<?php echo $description;?>"></textarea>
                        <p class="error"><?php echo $descriptionErreur; ?></p>

                        <button type="submit" class="form-control mb-2 mt-5">Ajouter</button>
                    </form>
                </div>
            </div>
        </div>

        <?php

        } else {
            header("Location: index.php");
            die;
        ?>
            

        <?php
        }

            function trojan($data){
                $data = trim($data); //Enleve les caractères invisibles
                $data = addslashes($data); //Mets des backslashs devant les ' et les  "
                $data = htmlspecialchars($data); // Remplace les caractères spéciaux par leurs symboles comme ­< devient &lt;
            
                return $data;
            }


        ?>

        <script src="https://kit.fontawesome.com/2ad1095675.js" crossorigin="anonymous"></script>
    </body>
</html>