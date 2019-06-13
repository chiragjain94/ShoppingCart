<?php
require_once "init.php";
require_once "../classes/Product.php";

$products = new Product;
$productsDetails = $products->getAllProducts();

echo $twig->render('index.twig', ['isAdmin' => true, 'products' => $productsDetails]);
