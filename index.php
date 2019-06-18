<?php
require_once "init.php";
require_once "classes/Product.php";

$products = new Product;

$productDetails = $products->getAllProducts();
echo $twig->render('index.twig', array('heading' => 'Home Page', 'products' => $productDetails));
