<?php
require_once "../init.php";
require_once "../classes/Product.php";

if (isset($_GET['id'])) {
  $id =  $_GET['id'];
  $product = new Product;
  $productDetail = $product->getProduct($id);

  echo $twig->render('product.twig', ['product' => $productDetail]);
}
