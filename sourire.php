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

    <body>

    <?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];

    // Faites la mise à jour de la base de données ici en utilisant l'ID reçu

    // Vous pouvez renvoyer une réponse JSON pour indiquer le résultat de la mise à jour
    $response = array();

    // Faire la connexion à la base de données
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $db = "intra smiley"; // Notez que j'ai corrigé le nom de la base de données

    $conn = new mysqli($servername, $username, $password, $db);

    // Vérifier la connexion
    if ($conn->connect_error) {
        $response['success'] = false;
        $response['message'] = "Connection échouée : " . $conn->connect_error;
    } else {
        // Sélectionner la valeur actuelle de contentEtu
        $sql = "SELECT contentEtu FROM evenement WHERE id = $id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $currentContent = $row['contentEtu'];

            // Incrémenter la valeur de contentEtu
            $newContent = $currentContent + 1;

            // Mettre à jour la base de données avec la nouvelle valeur
            $updateSql = "UPDATE evenement SET contentEtu = $newContent WHERE id = $id";
            if ($conn->query($updateSql) === TRUE) {
                $response['success'] = true;
                $response['message'] = "Mise à jour réussie.";
            } else {
                $response['success'] = false;
                $response['message'] = "Erreur lors de la mise à jour : " . $conn->error;
            }
        } else {
            $response['success'] = false;
            $response['message'] = "Événement non trouvé.";
        }

        // Fermer la connexion
        $conn->close();
    }

    // Renvoyer la réponse JSON
    echo json_encode($response);
}
?>




        <div class="container-fluid h-100">
            <div class="row text-center">
                <div class="col-md-3 mx-auto">
                    <button id="btnContent"><img src="img/content.jpg" height="400" width="400"></button>
                </div>
                <div class="col-md-3 mx-auto">
                    <img src="img/bof.jpg" height="400" width="400">
                </div>
                <div class="col-md-3 mx-auto">
                    <img src="img/pas content.jpg" height="400" width="400">
                </div>
            </div>
        </div>


        <script src="js/sourire.js"></script>
    </body>
</html>