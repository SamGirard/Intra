<?php
    session_start();
?>

<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Modifier</title>
            <link rel="stylesheet" href="css/index.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        </head>

        <body class="pageModif">

            <?php

        function trojan($data){
            $data = trim($data); //Enleve les caractères invisibles
            $data = addslashes($data); //Mets des backslashs devant les ' et les  "
            $data = htmlspecialchars($data); // Remplace les caractères spéciaux par leurs symboles comme ­< devient &lt;

            return $data;
        }
            if($_SESSION["connexion"] == true){
                $erreur = false;

                if($_SERVER["REQUEST_METHOD"] == "GET") {
                if(isset($_GET['id'])) {
                    $id = $_GET['id'];


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


                    //Afficher les donnée des evenement
                        $conn->query('SET NAMES utf8');
                        $sql = "SELECT * FROM evenement WHERE id = $id";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            $nom = $row['nomEvent'];
                            $description = $row['description'];
                            $lieu = $row['lieu'];
                            $date = $row['date'];
                            $departement = $row['departement'];
                            //$contentEtu = $row['contentEtu'];
                            //$moyenEtu = $row['moyenEtu'];
                            //$pasContentEtu = $row['pasContentEtu'];
                            //$contentEmp = $row['contentEmp'];
                            //$moyenEmp = $row['moyenEmp'];
                            //$pasContentEmp = $row['pasContentEmp'];
                        } else {
                            echo "pas de donnée";
                        }

                        //afficher les donner de tbdepartement
                        $conn->query('SET NAMES utf8');
                        $sql2 = "SELECT * FROM tbdepartement";
                        $result2 = $conn->query($sql2);


                        $departement = "";
                        $nomErreur = $lieuErreur = $dateErreur = $choixErreur = "";
                ?>

                            <div class="container min-vh-100 d-flex justify-content-center align-items-center">
            
                                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="modifForm">
                                            <a href="evenement.php"><i class="fa-solid fa-3x fa-arrow-left p-0 m-0"></i></a>
                                            <h1>Modifier l'évènement</h1>
            
                                            <input type="hidden" name="id" value="<?php echo $id; ?>">
            
                                            <label>Nom : </label>
                                            <input type="text" class="form-control" value="<?php echo $nom; ?>" name="nom">
                                            <p class="error"><?php echo $nomErreur; ?></p>
            
                                            <label class="mt-3">Description : </label>
                                            <textarea type="text" class="form-control" value="<?php echo $description; ?>" name="description"><?php echo $description;?></textarea>
            
                                            <label>Lieu : </label>
                                            <input type="text" class="form-control" value="<?php echo $lieu; ?>" name="lieu">
                                            <p class="error"><?php echo $lieuErreur; ?></p>
            
                                            <label>Date : </label>
                                            <input type="date" class="form-control" value="<?php echo $date; ?>" name="date">
                                            <p class="error"><?php echo $dateErreur; ?></p>
            
                                            <label class="mt-3">Département : </label>
                                            
                                            <Select class="form-control" name="departe">
                                                <?php
                                                        $ctr = 0;
                                                        while($row2 = $result2->fetch_assoc()){
                                                    ?>
                                                        <option value="<?php echo $row2['nomDepartement'];?>" class="form-control"><?php echo $row2['nomDepartement'];?></option>
                                                    <?php
                                                        $ctr++;
                                                        }
                                                    ?>
                                                </Select>
                                            <p class="error"><?php echo $choixErreur; ?></p>
    <!--
                                            <label class="mt-3">Nombre d'avis satisfait (Étudiant) : </label>
                                            <input type="number" class="form-control" value="<?php echo $contentEtu; ?>" name="contentEtu">
            
                                            <label class="mt-3">Nombre d'avis moyennement satisfait (Étudiant) : </label>
                                            <input type="number" class="form-control" value="<?php echo $moyenEtu; ?>" name="moyenEtu">
            
                                            <label class="mt-3">Nombre d'avis pas satisfait (Étudiant) : </label>
                                            <input type="number" class="form-control" value="<?php echo $pasContentEtu; ?>" name="pasContentEtu">
            
                                            <label class="mt-3">Nombre d'avis satisfait (Employeur) : </label>
                                            <input type="number" class="form-control" value="<?php echo $contentEmp; ?>" name="contentEmp">
            
                                            <label class="mt-3">Nombre d'avis moyennement satisfait (Employeur) : </label>
                                            <input type="number" class="form-control" value="<?php echo $moyenEmp; ?>" name="moyenEmp">
            
                                            <label class="mt-3">Nombre d'avis pas satisfait (Employeur) : </label>
                                            <input type="number" class="form-control" value="<?php echo $pasContentEmp; ?>" name="pasContentEmp">
    --> 
                                            <button type="submit" name="action" class="form-control mt-3 bg-dark text-white">Modifier</button>
                                        
                                        </form>
            
                            </div>
            
            
                                
                            <?php
                }
            }

                        if($_SERVER["REQUEST_METHOD"] == "POST" || $erreur == true){
                    
                        
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

                            $id = $_POST['id'];

                            //Afficher les donnée des evenement
                                $conn->query('SET NAMES utf8');
                                $sql = "SELECT * FROM evenement WHERE id = $id";
                                $result = $conn->query($sql);

                                $sql_Nom = $_POST["nom"];
                                $sql_Description = $_POST["description"];
                                $sql_Lieu = $_POST["lieu"];
                                $sql_Date = $_POST["date"];

                                //afficher les donner de tbdepartement
                                $conn->query('SET NAMES utf8');
                                $sql2 = "SELECT * FROM tbdepartement";
                                $result2 = $conn->query($sql2);

                                $sql2_Departement = $_POST["nomDepartement"];
                    

                            if(empty($_POST['nom'])){
                                $nomErreur = "Le nom ne peut pas être vide";
                                $erreur = true;
                            }
                            else {
                                $nom = trojan($_POST['nom']);
                            }
                            
                            if(empty($_POST['lieu'])){
                                $lieuErreur = "Le lieu ne peut pas être vide";
                                $erreur = true;
                            }
                            else {
                                $lieu = trojan($_POST['lieu']);
                            }

                            $choix = $_POST['departe'];

                            if ($choix == "rien") {
                                $choixErreur = "Choisissez un département";
                                $erreur = true;
                            } else {
                                $departement = $choix;
                            }

                            $nom = trojan($_POST['nom']);
                            $description = trojan($_POST['description']);
                            $lieu = trojan($_POST['lieu']);
                            $date = trojan($_POST['date']);

                            $nomDepartement = $_POST['departe'];
                            $date = $_POST['date'];
                            //$contentEtu = $_POST['contentEtu'];
                            //$moyenEtu = $_POST['moyenEtu'];
                            //$pasContentEtu = $_POST['pasContentEtu'];
                            //$contentEmp = $_POST['contentEmp'];
                            //$moyenEmp = $_POST['moyenEmp'];
                            //pasContentEmp = $_POST['pasContentEmp'];
        

                            // Mettre à jour la base de données
                            $sql = "UPDATE evenement SET nomEvent = '$sql_Nom', description = '$sql_Description', departement = '$departement', lieu = '$sql_Lieu', date = '$sql_Date' WHERE id = $id";

                            echo $sql;
                            if ($conn->query($sql) === TRUE) {
                                echo "Mise à jour réussie.";
                            } else {
                                echo "Erreur lors de la mise à jour: " . $conn->error;
                            }
                            

                            $conn->close();

                            header("Location: evenement.php");

                        }

                    ?>
                    
            <?php
            }else {
                header("Location: login.php");
            }
        ?>

            <script src="https://kit.fontawesome.com/2ad1095675.js" crossorigin="anonymous"></script>
        </body>
    </html>