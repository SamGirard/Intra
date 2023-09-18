let ctr1 = 0;
let ctr2 = 0;
let ctr3 = 0;
let ctrVal1 = document.getElementById("ctr1");
let ctrVal2 = document.getElementById("ctr2");
let ctrVal3 = document.getElementById("ctr3");

// Fonction générique pour incrémenter le compteur et envoyer au serveur
function incrementCounter(counterName, counterElement) {
    counterName++;
    counterElement.innerHTML = counterName;

    // Envoi de la valeur au serveur PHP via une requête AJAX
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "sourire.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Réponse du serveur (peut contenir un message de confirmation)
            console.log(xhr.responseText);
        }
    };
    xhr.send(counterName + "=" + counterName);
}

function clickContent() {
    incrementCounter(ctr1, ctrVal1);
}

function clickMoyen() {
    incrementCounter(ctr2, ctrVal2);
}

function clickPasContent() {
    incrementCounter(ctr3, ctrVal3);
}
