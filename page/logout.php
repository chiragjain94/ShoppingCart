<?php
require_once "../init.php";

unset($_SESSION["email"]);
header("location:/shoppingcart");
