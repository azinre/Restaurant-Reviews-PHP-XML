$(document).ready(function () {
  $("#FormValidation").on("submit", function (e) {
    e.preventDefault();
    // get values
    var Street = $("input[name='Street']").val();
    var City = $("input[name='City']").val();
    var Province = $("input[name='Province']").val();
    var Postal = $("input[name='Postal']").val();
    var Summary = $("textarea[name='Sumary']").val();

    // clean the classes
    var elementsToClear = ["Street", "City", "Province", "Postal", "Sumary"];
    for (var i = 0; i < elementsToClear.length; i++) {
      var elementId = elementsToClear[i];
      $("#" + elementId)
        .parent()
        .removeClass("has-success has-error has-feedback");
      $("#" + elementId)
        .siblings(".glyphicon")
        .remove();
    }
    if (Street.trim() === "") {
      $("#Street").parent().addClass("has-error has-feedback");
      $("#Street").after(
        '<span class="glyphicon glyphicon-remove form-control-feedback"></span>'
      );
    } else {
      $("#Street").parent().addClass("has-success has-feedback");
      $("#Street").after(
        '<span class="glyphicon glyphicon-ok form-control-feedback"></span>'
      );
    }

    if (City.trim() === "") {
      $("#City").parent().addClass("has-error has-feedback");
      $("#City").after(
        '<span class="glyphicon glyphicon-remove form-control-feedback"></span>'
      );
    } else {
      $("#City").parent().addClass("has-success has-feedback");
      $("#City").after(
        '<span class="glyphicon glyphicon-ok form-control-feedback"></span>'
      );
    }

    if (Province.trim() === "") {
      $("#Province").parent().addClass("has-error has-feedback");
      $("#Province").after(
        '<span class="glyphicon glyphicon-remove form-control-feedback"></span>'
      );
    } else {
      $("#Province").parent().addClass("has-success has-feedback");
      $("#Province").after(
        '<span class="glyphicon glyphicon-ok form-control-feedback"></span>'
      );
    }

    if (Postal.trim() === "") {
      $("#Postal").parent().addClass("has-error has-feedback");
      $("#Postal").after(
        '<span class="glyphicon glyphicon-remove form-control-feedback"></span>'
      );
    } else {
      $("#Postal").parent().addClass("has-success has-feedback");
      $("#Postal").after(
        '<span class="glyphicon glyphicon-ok form-control-feedback"></span>'
      );
    }

    if (Summary.trim() === "") {
      $("#Sumary").parent().addClass("has-error has-feedback");
      $("#Sumary").after(
        '<span class="glyphicon glyphicon-remove form-control-feedback"></span>'
      );
    } else {
      $("#Sumary").parent().addClass("has-success has-feedback");
      $("#Sumary").after(
        '<span class="glyphicon glyphicon-ok form-control-feedback"></span>'
      );
    }

    if (
      Street.trim() !== "" &&
      City.trim() !== "" &&
      Province.trim() !== "" &&
      Postal.trim() !== "" &&
      Summary.trim() !== ""
    ) {
      this.submit();
    }
  });
});
