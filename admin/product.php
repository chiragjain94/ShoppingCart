<?php
require_once "init.php";
require_once "../classes/Product.php";

if (isset($_POST['delete'])) {
  $id =  $_POST['delete_id'];
  $product = new Product;
  $product->deleteProduct($id);
  $productsDetails = $product->getAllProducts();

  echo $twig->render('index.twig', ['isAdmin' => true, 'products' => $productsDetails]);
  exit;
}

if (isset($_GET['id'])) {
  $id =  $_GET['id'];
  $product = new Product;
  $productDetail = $product->getProduct($id);

  echo $twig->render('product.twig', ['isAdmin' => true, 'product' => $productDetail]);
}
