<?php
require_once "../init.php";

unset($_SESSION["email"]);
unset($_SESSION["isAdmin"]);

header("location:/shoppingcart");
