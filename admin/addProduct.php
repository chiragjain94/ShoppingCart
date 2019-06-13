<?php
require_once "init.php";
require_once "../classes/Product.php";

$ret = [];
if (isset($_POST["submit"])) {
  $name = htmlspecialchars($_POST['name']);
  $description = htmlspecialchars($_POST['description']);
  $category = htmlspecialchars($_POST['category']);
  $price = htmlspecialchars($_POST['price']);
  $image = $_FILES['image']['name'];
  $imageText = htmlspecialchars($_POST['imageText']);

  $product = new Product;
  if ($product->uploadImage($image)) {
    $product->addProduct($name, $description, $category, $price, $image, $imageText);
  } else echo "Image not Correct";
}

echo $twig->render('addProduct.twig', array('isAdmin' => true));
