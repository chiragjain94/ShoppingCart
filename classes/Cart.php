<?php

class Cart
{

  public function addToCart($id, $quantity, $price)
  {
    $cart = ["item" => [
      "id" => $id,
      "quantity" => $quantity,
      "price" => $price
    ]];
    $currentCart = [];
    if (isset($_SESSION['cart'])) {
      $currentCart = $_SESSION['cart'];
      array_push($currentCart, $cart);
      $_SESSION['cart'] = $currentCart;
      echo "first ";
    } else {
      echo "second ";
      $_SESSION['cart'] = $cart;
    }
    var_dump($_SESSION['cart']);
  }
}
