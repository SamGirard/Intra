var ctr1 = document.getElementById("ctr1");
var ctr2 = document.getElementById("ctr2");
var ctr3 = document.getElementById("ctr3");

function submitForm(voteType) {
    // Mettez à jour la valeur du champ masqué avec le type de vote
    document.getElementById("voteType").value = voteType;

    var urlParams = new URLSearchParams(window.location.search);
    var id = urlParams.get('id');

    // Placez l'ID dans le champ masqué du formulaire
    document.getElementById("id").value = id;

    // Soumettez le formulaire
    document.getElementById("voteForm").submit();
}

function clickButton(type) {
    $.ajax({
        type: "POST",
        url: "sourireEmp.php",
        data: { voteType: type },
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
