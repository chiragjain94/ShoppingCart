<?php
require_once "../init.php";
require_once "../classes/Cart.php";

// echo $_POST['id'];
// echo $_REQUEST['quantity'];
// echo $_SESSION['email'];
if (isset($_REQUEST['id']) && (isset($_SESSION['email']))) {
  // $id =  $_REQUEST['id'];
  $cart = new Cart;
  $cart->addToCart($_REQUEST['id'], $_REQUEST['quantity'], $_REQUEST['price']);
  echo "<script type='text/javascript'>alert('Item added to the cart successfully.');</script>";
  exit;
}
echo "<script type='text/javascript'>alert('Cart functionality is not supported. Login with your account first.');</script>";
