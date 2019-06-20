<?php

class Cart
{

  public function addToCart($id, $name, $quantity, $price)
  {
    $cart = [
      "id" => $id,
      "name" => $name,
      "quantity" => $quantity,
      "price" => $price
    ];

    $currentCart = [];
    if (isset($_SESSION['cart'])) {
      $currentCart = $_SESSION['cart'];
      array_push($currentCart, $cart);
      $_SESSION['cart'] = $currentCart;
    } else {
      $_SESSION['cart'] = array($cart);
    }
  }

  public function getCartTotal($cartDetails)
  {
    $cartTotal = 0;
    if (isset($cartDetails)) {
      foreach ($cartDetails as $item) {
        $cartTotal += ($item['quantity'] * $item['price']);
      }
    }
    return $cartTotal;
  }

  public function getCartQuantity($cartDetails)
  {
    $cartQuantity = 0;
    if (isset($cartDetails)) {
      foreach ($cartDetails as $item) {
        $cartQuantity += $item['quantity'];
      }
    }
    return $cartQuantity;
  }

  public function getItemsInCart()
  {
    $cartCount = 0;
    if (isset($_SESSION['cart'])) {
      $cart = $_SESSION['cart'];
      $cartCount = count($cart);
    }
    return $cartCount;
  }

  public function deleteItemFromCart($id)
  {
    echo $id;
    echo "main id";
    if (isset($_SESSION['cart'])) {
      $cart = $_SESSION['cart'];

      foreach ($cart as $item) {
        print_r($item);
        foreach ($item as $i) {
          print_r($i);
        }
        // if ($item['id'] == $id) {
        //   $cart = array_diff($cart, array($item['id']));
        // }
      }
    }


    die();
    $_SESSION['cart'] = $cart;
  }
}
