<?php
require_once "../init.php";
require_once "../classes/Product.php";

$product = new Product;
$products = $product->fetchAllProducts();

echo $twig->render('../admin/views/addProducts.twig', []);
