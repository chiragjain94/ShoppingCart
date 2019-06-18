import "bootstrap";

import "../styles/app.scss";

$(document).ready(function() {
  $(".add_to_cart").click(function(event) {
    var $currentCartCount = $("#cart-count").html();
    $currentCartCount++;

    var $id = $(this).attr("product_id");
    var $quantity = $("#quantity").val();
    var $price = $(this).attr("product_price");

    $("#cart-count").html($currentCartCount);
    $("#cart-message").load("page/addToCart.php", {
      id: $id,
      quantity: $quantity,
      price: $price
    });
  });
});
