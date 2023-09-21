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
<body class="pageCreer">

    <?php

    $_SESSION["connexion"] = true;
    


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

        //Afficher les donnée pour departemnet
        $conn->query('SET NAMES utf8');
        $sql = "SELECT * FROM tbdepartement";
        $result = $conn->query($sql);

       


        $nom = $description = $departement = $lieu = $date = "";
        $nomErreur = $descriptionErreur = $departementErreur = $LieuErreur = $dateErreur = "";
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
            if(empty($_POST['nLieu'])){
                $LieuErreur = "Le lieu ne peut pas être vide";
                $erreur = true;
            }
            else {
                $lieu = trojan($_POST['nLieu']);
            }
            if(empty($_POST['nDate'])){
                $dateErreur = "Le date ne peut pas être vide";
                $erreur = true;
            }
            else {
                $date = trojan($_POST['nDate']);
            }

            $choix = $_POST['departe'];

            if ($choix == "rien") {
                $choixErreur = "Choisissez un département";
                $erreur = true;
            } else {
                $departement = $choix;
            }
            

            $nom = trojan($_POST['nNom']);
            $description = trojan($_POST['nDescription']);
            $lieu = trojan($_POST['nLieu']);
            $date = trojan($_POST['nDate']);

            if($erreur != true){
            $sql = "INSERT INTO evenement (nom, description, departement, lieu, date, contentEtu, moyenEtu, pasContentEtu, contentEmp, moyenEmp, pasContentEmp)
            VALUES ('$nom', '$description', '$departement', '$lieu', '$date', 0, 0, 0, 0, 0, 0)";

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
        <div class="container d-flex justify-content-center align-items-center">
            
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="creerForme">
                    <a href="index.php"><i class="fa-solid fa-3x fa-arrow-left p-0 m-0 mb-3"></i></a>
                    <h1>Créer un évènement</h1>
                        <input type="text" class="form-control mb-2" placeholder="Nom de l'évènement" name="nNom" value="<?php echo $nom;?>">
                        <p class="error"><?php echo $nomErreur; ?></p>

                        <div class="row">
                            <div class="col-md-10">
                                <Select class="form-control" name="departe">
                                    <option value="rien" class="form-control">Choisissez un département</option>
                                        <?php
                                            $ctr = 0;
                                            while($row = $result->fetch_assoc()){
                                        ?>
                                            <option value="<?php echo $row['nomDepartement'];?>" class="form-control"><?php echo $row['nomDepartement']?></option>
                                        <?php
                                            $ctr++;
                                            }
                                        ?>
                                </Select>
                            </div>
                            <div class="col-md-2">
                                <a href="creationDepart.php">
                                    <button type="button" class="form-control mb-2 plus" value="<?php echo $departement;?>"><i class="fa-solid fa-plus"></i></button>
                                </a>
                            </div>
                        </div>

                        <input type="text" class="form-control mb-2" placeholder="Lieu" name="nLieu" value="<?php echo $lieu;?>">
                        <p class="error"><?php echo $LieuErreur; ?></p>

                        <input type="date" class="form-control mb-2" placeholder="Date" name="nDate" value="<?php echo $date;?>">
                        <p class="error"><?php echo $dateErreur; ?></p>

                        <textarea type="textarea" class="form-control mb-2" placeholder="Description" name="nDescription" value="<?php echo $description;?>"></textarea>
                        <p class="error"><?php echo $descriptionErreur; ?></p>

                        <button type="submit" class="form-control mb-2 mt-5 bg-dark text-white">Ajouter</button>
                    </form>
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