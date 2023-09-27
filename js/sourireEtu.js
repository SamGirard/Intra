var ctr1 = document.getElementById("ctr1");
var ctr2 = document.getElementById("ctr2");
var ctr3 = document.getElementById("ctr3");

function clickButton(type) {
    var urlParams = new URLSearchParams(window.location.search);
    var id = urlParams.get('id');

    $.ajax({
        type: "POST",
        url: "sourireEtu.php",
        data: { voteType: type, id: id }, // Inclure l'ID dans les données envoyées au serveur
        success: function (data) {
            // Gérez ici la réponse du serveur, si nécessaire
            console.log("Vote enregistré pour : " + type);
        },
        error: function () {
            console.error("Erreur lors de l'envoi du vote.");
        }
    });
}


var ctrValueBon = 0;
var ctrValueMoyen = 0;
var ctrValuePasBon = 0;
