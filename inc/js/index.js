import "bootstrap";

import "../styles/app.scss";

$(document).ready(function() {
  var $navbar = $("#navbarNav");
  //Function called when we add an item to cart and the cart badge is updated.
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

  //Function called when cart details are viewed.
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

  //Function to slide up the dropdown when clicked somewhere else on screen.
  $(document).on("click", function(event) {
    event.preventDefault();
    var $trigger = $("#cart-content-wrapper");
    if ($trigger !== event.target && !$trigger.has(event.target).length) {
      $(".cart-data").slideUp("fast");
    }
  });

  //Function to delete an item from cart.
  $navbar.on("click", ".delete-item", function(event) {
    event.preventDefault();
    var $id = $(this).attr("product_id");

    $.ajax({
      type: "POST",
      url: "page/deleteFromCart.php",
      data: {
        id: $id
      },
      success: function(response) {
        $("#cart-content-wrapper").html(response);

        var $cartCount = $("#cart-count").html();
        $cartCount--;
        if ($cartCount == 0) {
          $("#cart-count").html("");
        } else $("#cart-count").html($cartCount);
      }
    });
  });

  //Function to limit cart quantity between 1 & 5
  $navbar.on("input", ".product-quantity", function(event) {
    var currentQuantity = $(this).val();
    // console.log(productTotal);

    if (currentQuantity < 6 && currentQuantity > 0) {
      $(".cart-error").text("");
      $(".cart-error").removeClass("alert alert-danger");

      var unitPrice = $(this).attr("product_price");
      var mainDiv = $(this)
        .parent()
        .parent();

      $(mainDiv)
        .find(".product-price")
        .html(currentQuantity * unitPrice);

      var productTotal = 0;

      $(".product-price").each(function() {
        // console.log($(this).text());
        productTotal += parseInt($(this).text());
      });
      console.log(productTotal);
      $(mainDiv)
        .parent()
        .find(".product-total")
        .html(productTotal);
    } else {
      $(".cart-error").addClass("alert alert-danger");
      $(".cart-error").text("**Quantity must be between 1 and 5");
    }
  });
});
