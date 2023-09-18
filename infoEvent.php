<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Information</title>
            <link rel="stylesheet" href="css/index.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        </head>

        <body>
            <?php

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

                //Afficher les donnée
                    $conn->query('SET NAMES utf8');
                    $sql = "SELECT * FROM evenement WHERE id = $id";
                    $result = $conn->query($sql);

                    $conn->query('SET NAMES utf8');
                    $sql2 = "SELECT * FROM departement";
                    $result2 = $conn->query($sql2);

                    //connection avec la table departement
                    if ($result2->num_rows > 0) {
                        $row2 = $result2->fetch_assoc();
                        $nomDep = $row2['nomDepartement'];
                    }

                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $nom = $row['nom'];
                        $description = $row['description'];
                        $departement = $row['departement'];
                        $contentEtu = $row['contentEtu'];
                        $moyenEtu = $row['moyenEtu'];
                        $pasContentEtu = $row['pasContentEtu'];
                        $contentEmp = $row['contentEmp'];
                        $moyenEmp = $row['moyenEmp'];
                        $pasContentEmp = $row['pasContentEmp'];
                    } else {
                        // Gérer l'erreur si aucun enregistrement correspondant n'est trouvé
                    }

                    $nomErreur = $departementErreur = "";
                    $erreur = false;
                    
                    if ($_SERVER['REQUEST_METHOD'] == "POST"){

                        $nom = trojan($_POST['nom']);
                        $description = trojan($_POST['description']);
                        $departement = trojan($_POST['departement']);
                        $contentEtu = $_POST['contentEtu'];
                        $moyenEtu = $_POST['moyenEtu'];
                        $pasContentEtu = $_POST['pasContentEtu'];
                        $contentEmp = $_POST['contentEmp'];
                        $moyenEmp = $_POST['moyenEmp'];
                        $pasContentEmp = $_POST['pasContentEmp'];

                        $action = $_POST['action'];

                        if(empty($_POST['nom'])){
                            $nomErreur = "Le nom ne peut pas être vide";
                            $erreur = true;
                        }
                        else {
                            $nom = trojan($_POST['nom']);
                        }
                        if(empty($_POST['departement'])){
                            $departementErreur = "Le département ne peut pas être vide";
                            $erreur = true;
                        }
                        
                            
                        $nom = trojan($_POST['nom']);
                        $departement = trojan($_POST['departement']);
    

                        if (!$erreur) {
                            // Mettre à jour la base de données
                            $sql = "UPDATE evenement SET nom = '$nom', description = '$description', departement = '$departement', contentEtu = '$contentEtu', moyenEtu = '$moyenEtu', pasContentEtu = '$pasContentEtu', contentEmp = '$contentEmp', moyenEmp = '$moyenEmp', pasContentEmp = '$pasContentEmp' WHERE id='$id'";
                            
                            if ($conn->query($sql) === TRUE) {
                                echo "Mise à jour réussie.";
                            } else {
                                echo "Erreur lors de la mise à jour : " . $conn->error;
                            }
                        }
                        $conn->close();

                    }
                
                    if ($_SERVER['REQUEST_METHOD'] != "POST" || $erreur == true){
                ?>

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-4 offset-4">
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="mt-5">
                            
                                <label>Nom : </label>
                                <input type="text" class="form-control" value="<?php echo $nom; ?>" name="nom">
                                <p class="error"><?php echo $nomErreur; ?></p>

                                <label class="mt-3">Description : </label>
                                <textarea type="text" class="form-control" value="<?php echo $description; ?>" name="description"><?php echo $description;?></textarea>

                                <label class="mt-3">Département : </label>
                                
                                <Select class="form-control" name="departe">
                                    <option value="rien" class="form-control">Choisissez un département</option>
                                        <?php
                                            $ctr = 0;
                                            while($row2 = $result2->fetch_assoc()){
                                                $selected = ($row2['nomDepartement'] == $departement) ? "selected" : "";
                                        ?>
                                            <option value="<?php echo $row2['nomDepartement'];?>" class="form-control"><?php echo $row2['nomDepartement']?></option>
                                        <?php
                                            $ctr++;
                                            }
                                        ?>
                                    </Select>
                                <p class="error"><?php echo $departementErreur; ?></p>

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

                                <button type="submit" name="action" class="form-control mt-3">Soumettre</button>
                            </form>
                        </div>
                    </div>
                </div>


                <?php
        
            } else {
                header("Location: evenement.php");
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
        </body>
    </html>