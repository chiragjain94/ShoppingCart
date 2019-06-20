import "bootstrap";

import "../styles/app.scss";

$(document).ready(function() {
  $(".add_to_cart").click(function(event) {
    event.preventDefault();
    var $id = $(this).attr("product_id");
    var $price = $(this).attr("product_price");
    var $name = $(this).attr("product_name");
    var $quantity = $("#quantity" + $id).val();

    $.ajax({
      type: "POST",
      url: "page/addToCart.php",
      data: {
        id: $id,
        name: $name,
        quantity: $quantity,
        price: $price
      },
      success: function(response) {
        response = JSON.parse(response);
        if (response && response.type == "success") {
          $("#cart-count").html(response.cartCount);
          alert("Item added to the cart successfully.");
        } else {
          alert(response.errorMessage);
        }
      },
      error: function(data) {
        //Only handles network related errors, like 404
      }
    });
  });

  $("#cart-details").click(function(event) {
    event.preventDefault();
    var url = $(this).attr("href");
    $.ajax({
      type: "POST",
      url: url,
      success: function(response) {
        $("#cart-content-wrapper").html(response);
        $("#cart-content-wrapper").slideDown("slow");
      }
    });
  });

  $(document).on("click", function(event) {
    event.preventDefault();
    var $trigger = $("#cart-content-wrapper");
    if ($trigger !== event.target && !$trigger.has(event.target).length) {
      $(".cart-data").slideUp("fast");
    }
  });

  $(document).on("click", ".delete-item", function(event) {
    event.preventDefault();
    var $id = $(this).attr("product_id");

    $.ajax({
      type: "POST",
      url: "page/deleteFromCart.php",
      data: {
        id: $id
      }
    });
  });
});
