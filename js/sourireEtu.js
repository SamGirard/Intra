// Dans sourire.js

// Fonction pour gérer le clic sur le bouton Content
function clickContent() {
    // Augmentez le compteur
    ctrValueBon++;
    // Mettez à jour l'affichage
    document.getElementById('ctr1').textContent = 'Content: ' + ctrValueBon;
    // Envoyez la valeur du compteur à la base de données
    updateDatabase('content', ctrValueBon);
}

// Fonction pour gérer le clic sur le bouton Moyen
function clickMoyen() {
    // Augmentez le compteur
    ctrValueMoyen++;
    // Mettez à jour l'affichage
    document.getElementById('ctr2').textContent = 'Moyen: ' + ctrValueMoyen;
    // Envoyez la valeur du compteur à la base de données
    updateDatabase('moyen', ctrValueMoyen);
}

// Fonction pour gérer le clic sur le bouton Pas Content
function clickPasContent() {
    // Augmentez le compteur
    ctrValuePasBon++;
    // Mettez à jour l'affichage
    document.getElementById('ctr3').textContent = 'Pas Content: ' + ctrValuePasBon;
    // Envoyez la valeur du compteur à la base de données
    updateDatabase('pasContent', ctrValuePasBon);
}

// Fonction pour envoyer la valeur du compteur à la base de données
function updateDatabase(type, value) {
    // Créez une instance XMLHttpRequest
    var xhr = new XMLHttpRequest();
    // Définissez la méthode et l'URL pour la requête
    xhr.open('POST', 'sourireEtu.php', true);
    // Configurez l'en-tête de la requête
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    // Définissez la fonction de rappel pour la réponse
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Réponse de la requête
            console.log(xhr.responseText);
        }
    };
    // Créez les données à envoyer
    var data = 'type=' + type + '&value=' + value;
    // Envoyez la requête
    xhr.send(data);
}

var ctrValueBon = 0;
var ctrValueMoyen = 0;
var ctrValuePasBon = 0;
