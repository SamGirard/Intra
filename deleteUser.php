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
if ($_SESSION["connexion"] == true) {
    // Déclaration des variables d'erreur
    $nomErreur = $passErreur = "";
    $erreur = false;

                //Faire la connection
                $servername = "cours.cegep3r.info";
                $username = "2172853";
                $password = "2172853";
                $db = "2172853-girard-samuel";

                //Creer la connection
                $conn = new mysqli($servername, $username, $password, $db);

                //vérifier la connection
                if($conn->connect_error) {
                    die("Connection échoué: " . $conn->connect_error);
                }

                //Afficher les donnée
                    $conn->query('SET NAMES utf8');
                    $sql = "SELECT * FROM utilisateur";
                    $result = $conn->query($sql);


                    if ($_SERVER['REQUEST_METHOD'] == "POST") {
                        // Récupération des données du formulaire
                        $username = $_POST['nUsager'];
                        $password = md5($_POST['nPass']);
                
                        // Vérification des champs vides
                        if (empty($username)) {
                            $nomErreur = "Le nom ne peut pas être vide";
                            $erreur = true;
                        }
                
                        if ($password === md5('')) { 
                            $passErreur = "Le mot de passe ne peut pas être vide";
                            $erreur = true;
                        }
                
                        // Si aucune erreur n'est détectée, effectuer la suppression
                        if (!$erreur) {
                            $sql = "DELETE FROM utilisateur WHERE nom=? AND password=?";
                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param("ss", $username, $password);
                
                            if ($stmt->execute()) {
                                header("Location: optionUsager.php");
                                exit();
                            } else {
                                echo "Erreur lors de la suppression : " . $stmt->error;
                            }
                        }
                    }
                    ?>
                
                    <div class="container min-vh-100 d-flex justify-content-center align-items-center">
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="suppUserForm">
                            <a href="optionUsager.php"><i class="fa-solid fa-3x fa-arrow-left p-0 m-0 mb-3"></i></a>
                            <h1>Supprimer un utilisateur</h1>
                            <input type="text" class="form-control mb-2" name="nUsager" placeholder="Écriver le nom de l'usager à supprimer">
                            <p class="error mb-4"><?php echo $nomErreur; ?></p>
                
                            <input type="password" class="form-control mb-2" name="nPass" placeholder="Écriver le mot passe de l'usager à supprimer">
                            <p class="error mb-5"><?php echo $passErreur; ?></p>
                
                            <div class="d-flex flex-column align-items-center">
                                <button type="submit" class="form-control oui rounded-pill">Supprimer</button>
                                <a class="mt-5 annule" href="optionUsager.php">Annuler</a>
                            </div>
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