$(function(){
  $.ajax({
      type: "GET",
      url: "php/RestaurantReviews.php?action=searchNames",
      dataType: "json"
  }).done(res => {
      console.log("Received data for searchNames:", res);
      res.forEach(ele => {
          $('#drpRestaurant').append($('<option>', {
              value: ele.id,
              text: ele.name
          }));
      });
  }).fail(function(jqXHR, textStatus, errorThrown){
      console.error("Error: ", textStatus, errorThrown);
  });

  $('#drpRestaurant').change(() => {
      var selectedId = $("#drpRestaurant option:selected").val();
      console.log("Selected Restaurant ID:", selectedId);
      reChange(selectedId);
  });
  $('#btnSave').click(() => {
      updateRestaurant();
  });
});

function reChange(id){
  if (id == "-1"){
      $("#txtStreetAddress").val("");
      $("#txtCity").val("");
      $("#txtProvinceState").val("");
      $("#txtPostalZipCode").val("");
      $("#txtSummary").val("");
      $("#drpRating").empty();
      for (let index = 1; index <= 5; index++){
          $('#drpRating').append($('<option>', {
              value: index,
              text: index
          }));
      }
      return;   
  }
  $.ajax({
      type: "GET",
      url: "php/RestaurantReviews.php?action=searchRestaurant&id=" + id,
      dataType: "json"
  }).done(res => {
      console.log("Received data for restaurant details:", res);
      $("#txtStreetAddress").val(res.Address.StreetAddress || "");
      $("#txtCity").val(res.Address.City || "");
      $("#txtProvinceState").val(res.Address.ProvinceState || "");
      $("#txtPostalZipCode").val(res.Address.PostalZipCode || "");
      $("#txtSummary").val(res.Summary || "");
      $("#drpRating").empty();
      for (let index = res.RatingMin; index <= res.RatingMax; index++) {
          $('#drpRating').append($('<option>', {
              value: index,
              text: index,
              selected: index == res.Rating
          }));
      }
  }).fail(function(jqXHR, textStatus, errorThrown){
      console.error("Error: ", textStatus, errorThrown);
  });
}

function updateRestaurant(){
  let data = {
      id: $("#drpRestaurant option:selected").val(),
      action: "updateRestaurant",
      StreetAddress: $("#txtStreetAddress").val(),
      City: $("#txtCity").val(),
      ProvinceState: $("#txtProvinceState").val(),
      PostalZipCode: $("#txtPostalZipCode").val(),
      Summary: $("#txtSummary").val(),
      Rating: $("#drpRating option:selected").val()
  };
  $.ajax({
      type: "POST",
      url: "php/RestaurantReviews.php",
      dataType: "json",
      data: data
  }).done(res => {
      console.log("Restaurant Update Response:", res);
      $("#lblConfirmation").text(res.message);
  }).fail(function(jqXHR, textStatus, errorThrown){
      $("#lblConfirmation").text("Restaurant Update Failed");
      console.error("Error: ", textStatus, errorThrown);
  });
}
