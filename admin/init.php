<?php
session_start();
if (isset($_SESSION['isAdmin'])) {
  require_once "../config/config.php";
  require_once "../vendor/autoload.php";
  require_once "../classes/View.php";

  View::initializeTwig("\..\\admin\\views");
  $twig = View::getTwig();
} else {
  die("You cannot access admin panel.");
}
