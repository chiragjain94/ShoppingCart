<?php
require_once "../init.php";
require_once "../classes/User.php";

$ret = [];

if (isset($_POST["submit"])) {
  $email = htmlspecialchars($_POST['email']);
  $password = htmlspecialchars($_POST['password']);
  $user = new User;

  if ((filter_var($email, FILTER_VALIDATE_EMAIL))) {
    $passwordEncrypt = md5($email . $password);
    $userEmail = $user->login($email, $passwordEncrypt);

    if (!$userEmail) {
      $message = "User not found";
      $messageCss = "d-block alert-danger";
    } else {
      $_SESSION['email'] = $userEmail;
      $twig = View::getTwig();
      $userDetails = $user->getUser();
      $isLoggedIn = true;

      if ($user->isAdmin()) {
        $isAdmin = true;
        $twig->addGlobal("isAdmin", $isAdmin);
        $_SESSION['isAdmin'] = $isAdmin;
        header("Location: /shoppingCart/admin/");
        exit;
      }

      $_SESSION['isAdmin'] = false;
      $twig->addGlobal("isLoggedIn", $isLoggedIn);
      $twig->addGlobal("userDetails", $userDetails);
      header("Location: /shoppingCart/");
      exit;
      // echo $twig->render('index.twig', array('heading' => 'Home Page'));
    }
  } else {
    $message = "Enter valid email id";
    $messageCss = "d-block alert-danger";
  };

  $ret = array(
    'email' => $email,
    'password' => $password,
    'message' => $message,
    'messageCss' => $messageCss
  );
}
echo $twig->render('login.twig', $ret);
