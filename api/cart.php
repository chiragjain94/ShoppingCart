<?php
require_once "../init.php";
require_once "../classes/View.php";
require_once "../classes/Cart.php";

if (isset($_SESSION['cart'])) {
  $cartDetails = $_SESSION['cart'];
  $cart = new Cart;
  $cartTotal = $cart->getCartTotal($cartDetails);
  $cartQuantity = $cart->getCartQuantity($cartDetails);


  echo $twig->render('cart.twig', array(
    'cart' => $cartDetails,
    'cartQuantity' => $cartQuantity,
    'cartTotal' => $cartTotal
  ));
} else echo "No items found in cart";
