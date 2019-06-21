<?php

require_once "../init.php";
require_once "../classes/Cart.php";

if (isset($_REQUEST['id']) && (isset($_SESSION['email']))) {
  $cart = new Cart;
  $cart->addToCart($_REQUEST['id'], $_REQUEST['name'], $_REQUEST['quantity'], $_REQUEST['price']);
  $itemsInCart = $cart->getItemsInCart();

  echo (json_encode(array('type' => 'success', 'cartCount' => $itemsInCart)));
} else {
  echo (json_encode(array('type' => 'fail', 'errorMessage' => 'Please login first to access cart functionality.')));
}
exit;
