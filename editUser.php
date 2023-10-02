<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Modifier un utilisateur</title>
        <link rel="stylesheet" href="css/index.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    </head>

    <body class="pageUser">
        <?php


            if ($_SESSION["connexion"] == true) {

                $erreur = false;
            
                if ($_SERVER["REQUEST_METHOD"] == "GET") {
                    if (isset($_GET['id'])) {
                        $id = $_GET['id'];
            
                        //Faire la connection
                        $servername = "cours.cegep3r.info";
            $username = "2172853";
            $password = "2172853";
            $db = "intra smiley";
            
                        //Creer la connection
                        $conn = new mysqli($servername, $username, $password, $db);
            
                        //vérifier la connection
                        if ($conn->connect_error) {
                            die("Connection échoué: " . $conn->connect_error);
                        }
            
                        //Afficher les donnée pour departemnet
                        $conn->query('SET NAMES utf8');
                        $sql = "SELECT * FROM utilisateur WHERE id = $id";
                        $result = $conn->query($sql);
            
                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            $nom = $row['nom'];
                        } else {
                            echo "pas de donnée";
                        }

                $usernameBd = $passwordBd = "";
                $usernameErreur = $mdpErreur = $confMdpErreur = "";
                $nom = $motDePasse = $mdp = $confMdp = "";
            ?>

            <div class="container min-vh-100 d-flex justify-content-center align-items-center">

                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="userForm">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">

                            <a href="choixUserEdit.php"><i class="fa-solid fa-3x fa-arrow-left p-0 m-0 mb-3"></i></a>
                            <h1>Modifier un utilisateur</h1>

                            <input type="text" placeholder="Modifier le nom d'utilisateur (facultatif)" class="form-control mt-4" name="nUsername" value=<?php echo $nom?>>
                            <p class="error mt-1"><?php echo $usernameErreur; ?></p>

                            <input type="password" placeholder="Modifier le mot de passe (facultatif)" name="nMdp" class="form-control mt-4">
                            <p class="error mt-1"><?php echo $mdpErreur; ?></p>

                            <input type="password" placeholder="Modifier le mot de passe (facultatif)" name="nConfMdp" class="form-control mt-4">
                            <p class="error mt-1"><?php echo $confMdpErreur; ?></p>

                            <button type="submit" name="action" class="form-control mt-4 bg-dark text-white rounded-pill">Modifier</button>
                        </form>

            </div>
            
            <?php
                
            }
        }
                

                if ($_SERVER['REQUEST_METHOD'] == "POST" || $erreur == true) {

                    $servername = "cours.cegep3r.info";
                    $username = "2172853";
                    $password = "2172853";
                    $db = "intra smiley";
            
                    //Creer la connection
                    $conn = new mysqli($servername, $username, $password, $db);
            
                    //vérifier la connection
                    if ($conn->connect_error) {
                        die("Connection échoué: " . $conn->connect_error);
                    }
            
                    $id = $_POST['id'];

                    //Afficher les donnée pour departemnet
                    $conn->query('SET NAMES utf8');
                    $sql = "SELECT * FROM utilisateur WHERE id = $id";
                    $result = $conn->query($sql);
            
                    if (empty($_POST['nUsername'])) {
                        $usernameErreur = "Veuillez entrer un nom d'utilisateur";
                        $erreur = true;
                    } else {
                        $usernameBd = trojan($_POST['nUsername']);
                    }
            
                    if (empty($_POST['nMdp'])) {
                        $mdpErreur = "Veuillez entrer un mot de passe";
                        $erreur = true;
                    } else {
                        $mdp = trojan($_POST['nMdp']);
                    }
            
                    if ($_POST['nConfMdp'] != $_POST['nMdp']) {
                        $confMdpErreur = "Veuillez réécrire le même mot de passe";
                        $erreur = true;
                    } else {
                        $confMdpHash = trojan($_POST['nConfMdp']);
                    }
            
                    // Mettez à jour la base de données uniquement si aucune erreur n'est survenue

                        $sql = "UPDATE utilisateur SET nom = '$usernameBd', password = MD5('$mdp') WHERE id = $id";
            
                        echo $sql;
                        if ($conn->query($sql) === TRUE) {
                            echo "Mise à jour réussie.";
                        } else {
                            echo "Erreur lors de la mise à jour: " . $conn->error;
                        }
            
                        $conn->close();
            
                        header("Location: optionUsager.php");

                }
                
        
            } else {
                header("Location: login.php");
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