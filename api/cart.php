<?php
require_once "../init.php";
require_once "../classes/View.php";
require_once "../classes/Cart.php";

if (isset($_SESSION['cart'])) {
  $cartDetails = $_SESSION['cart'];
  if (count($cartDetails) > 0) {
    $cart = new Cart;
    $cartTotal = $cart->getCartTotal($cartDetails);
    $cartQuantity = $cart->getCartQuantity($cartDetails);


    echo $twig->render('cart.twig', array(
      'cart' => $cartDetails,
      'cartQuantity' => $cartQuantity,
      'cartTotal' => $cartTotal
    ));
    exit;
  }
} ?>
<div class="cart-content-wrapper bg-info row p-o m-0">
  <div class="col-md-12 p-0 m-0">
    <h5 class="cart-data p-3">
      No items Found in cart</h5>
  </div>
</div>