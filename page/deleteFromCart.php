<?php

require_once "../init.php";
require_once "../classes/Cart.php";

if (isset($_REQUEST['id']) && (isset($_SESSION['email']))) {
  $cart = new Cart;
  $cart->deleteItemFromCart($_REQUEST['id']);


  // echo (json_encode(array(
  //   'html' => header("Location: /shoppingCart/api/cart.php"),
  //   'cartCount' => $cartCount
  // )));
  header("Location: /shoppingCart/api/cart.php");
}
