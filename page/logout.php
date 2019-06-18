<?php
require_once "../init.php";

unset($_SESSION["email"]);
unset($_SESSION["isAdmin"]);
unset($_SESSION["cart"]);

header("location:/shoppingcart");
