<?php
require_once "Database.php";

class Product
{
  private $database;

  public function __construct()
  {
    $this->database = Database::initializeDatabase();
  }

  public function addProduct($name, $description, $category, $price, $image, $imageText)
  {
    $sql = 'INSERT INTO products(name, description, category, price, image, imagetext) VALUES (?,?,?,?,?,?)';
    $stmt = $this->database->executeSql($sql, [$name, $description, $category, $price, $image, $imageText]);
  }

  public function uploadImage($image)
  {
    $folder = ROOT_URL . '/img/';
    $path = $folder . $image;

    $allowed = array('jpeg', 'png', 'jpg');
    $filename = $_FILES['image']['name'];
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    if (!in_array($ext, $allowed)) {
      echo "Sorry, only JPG, JPEG & PNG  files are allowed.";
      return false;
    } else {
      move_uploaded_file($_FILES['image']['tmp_name'], $path);
      return true;
    }
  }

  public function getAllProducts()
  {
    $sql = 'SELECT * FROM PRODUCTS';
    $stmt = $this->database->executeSql($sql, []);
    $products = $stmt->fetchAll();
    return $products;
  }

  public function getProduct($id)
  {
    $sql = 'SELECT * FROM PRODUCTS WHERE id = ?';
    $stmt = $this->database->executeSql($sql, [$id]);
    $product = $stmt->fetch();
    return $product;
  }

  public function updateProduct($productId, $name, $description, $category, $price, $image, $imageText)
  {
    $sql = 'UPDATE PRODUCTS SET name=?, description=?, category=?, price=?, image=?, imagetext=? WHERE id = ?';
    $stmt = $this->database->executeSql($sql, [$name, $description, $category, $price, $image, $imageText, $productId]);
    $product = $stmt->fetch();
    return $product;
  }

  public function deleteProduct($id)
  {
    $sql = 'DELETE FROM PRODUCTS WHERE id = ?';
    $stmt = $this->database->executeSql($sql, [$id]);
  }
}
