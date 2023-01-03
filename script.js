$(document).ready(function() {
    $("#successMajSujet").hide();
});

function ready() {
    $("#successMajSujet").hide();
}

//ajax pour enregistrer "je prie pour toi"
$(".validerpriere").click(function() {

    var id = $(this).attr("id").split("-")
    var sujet = $(`#idSujet-${id[1]}`).val()

    if ($(`#validerpriere-${id[1]}`).attr("class") == "validerpriere btn btn-outline-warning") {

        $.ajax({
            type: "POST",
            url: "fonc/accueiltr.php",
            data: {
                idSujet: sujet
            },
            success: function(response) {
                console.log("Ajax d ajout de priere SUCCESS")
                    //document.getElementsByClassName('validerpriere').disabled = true
            }
        });
    }



    $(this).removeClass()
    $(this).addClass("btn btn-outline-success");
    $(this).html("Je prie pour toi");
    //$(`#validerpriere-${id[1]}`).prop("disabled", true);
})



//ajax mise a jour du compte
$("#validerinfo").click(function() {

    var majObj = {
        nom: $("#nom").val(),
        prenom: $("#prenom").val(),
        mail: $("#mail").val(),
        telephone: $("#telephone").val()
    }
    $.ajax({
        type: "post",
        url: "majcompte.php",
        data: majObj,
        success: function(response) {
            $("#majok").html("Mise à jour réalisé avec succès!").addClass("text-center")
        }
    });

})

//mot de passe valide 
$("#validermdp").click(function() {

    if ($("#pass2").val() != $("#pass1").val() || $("#pass2").val() == null || $("#pass1").val() == null) {
        $("#different").html('Attention les mots de passes ne sont pas identiquies')
            //console.log($("#pass2").val() + " " + $("#pass1").val())
        return false
    } else {
        console.log("valeur vraie " + $(this))
        return true
    }
});

//ajax mise a jour des sujets
$("#majsujet").click(function() {

    var id = $("#idSujet").val()
    var sujet = $("#textSujet").val()

    var datav = {
        id: id,
        sujet: sujet
    }

    $.ajax({
        type: "post",
        url: "fonctionsapp/majsujet.php",
        data: datav,
        success: function(response) {
            $("#successMajSujet").html(`<div class="alert alert-success text-center inh" role="alert">
            Mise à jour réalisé avec succès !
        </div>`);
        }
    });
    $("#successMajSujet").show()

})