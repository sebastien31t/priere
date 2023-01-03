"use strict";

$(".validerpriere").click(function () {
  var id = $(this).attr("id").split("-");
  var sujet = $("#idSujet-".concat(id[1])).val();
  console.log("#idSujet-".concat(id[1]));
  $(this).removeClass();
  $(this).addClass("btn btn-outline-success");
  $(this).html("Je prie pour toi");
  $.ajax({
    type: "POST",
    url: "http://localhost/priere/fonc/accueiltr.php",
    data: {
      idSujet: sujet
    },
    success: function success(response) {
      console.log("Ajax d ajout de priere SUCCESS");
    }
  });
});