var ctr1 = document.getElementById("ctr1");
var ctr2 = document.getElementById("ctr2");
var ctr3 = document.getElementById("ctr3");



document.getElementById('btnContent').addEventListener('click', function () {
    ctrValueBon += 1;
    ctr1.innerHTML = ctrValueBon;
    sendVote('content');
});

document.getElementById('btnMoyen').addEventListener('click', function () {
    ctrValueMoyen += 1;
    ctr2.innerHTML = ctrValueMoyen;
    sendVote('moyen');
});

document.getElementById('btnPasContent').addEventListener('click', function () {
    ctrValuePasBon += 1;
    ctr3.innerHTML = ctrValuePasBon;
    sendVote('pasContent');
});

function sendVote(type) {
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'sourireEtu.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // La réponse du serveur, si nécessaire
            console.log(xhr.responseText);
        }
    };

    // Les données à envoyer au serveur
    var data = 'type=' + type;

    xhr.send(data);
}


var ctrValueBon = 0;
var ctrValueMoyen = 0;
var ctrValuePasBon = 0;
