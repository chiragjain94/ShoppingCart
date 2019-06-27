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
      $response = array('success' => false,'key'=>"value",'message' => "User not found");
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
    }
  } else {
    $response = array('success' => false, 'message' => "Enter valid email id");
  };

  $ret = array (
    'email' => $email,
    'password' => $password,
    'response' =>$response,
  );
}
echo $twig->render('login.twig', $ret);
