<?php
require_once "init.php";
require_once "../classes/Product.php";

if (isset($_POST["submit"])) {
  $productId = htmlspecialchars($_POST['id']);
  $name = htmlspecialchars($_POST['name']);
  $description = htmlspecialchars($_POST['description']);
  $category = htmlspecialchars($_POST['category']);
  $price = htmlspecialchars($_POST['price']);
  $image = $_FILES['image']['name'];
  $imageText = htmlspecialchars($_POST['imageText']);

  $product = new Product;
  if ($product->uploadImage($image)) {
    $product->updateProduct($productId, $name, $description, $category, $price, $image, $imageText);
  } else exit("Incorrect product details");

  $productDetail = $product->getProduct($productId);
  echo $twig->render('product.twig', ['isAdmin' => true, 'product' => $productDetail]);
  exit();
}

if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $product = new Product;
  $productDetail = $product->getProduct($id);
  echo $twig->render('editProduct.twig', array('isAdmin' => true, 'product' => $productDetail));
  exit();
}
