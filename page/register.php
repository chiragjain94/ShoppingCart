<?php
require_once "../init.php";
require_once "../classes/User.php";

$message = "";
$messageCss = "";
$ret = [];

if (isset($_POST["submit"])) {
  $name = htmlspecialchars($_POST['name']);
  $email = htmlspecialchars($_POST['email']);
  $password = htmlspecialchars($_POST['password']);
  $password2 = htmlspecialchars($_POST['password2']);

  if ((filter_var($email, FILTER_VALIDATE_EMAIL))) {
    $user = new User;

    if (!$user->CheckIfEmailIdExists($email)) {
      if ($password == $password2) {
        $passwordEncrypt = md5($email . $password);
        $user->register($name, $email, $passwordEncrypt);
        $response = array ('success' => true, 'message'=> "User Added" );
        // $message = "User Added";
        // $messageCss = "d-block alert-success";
        $name = $email = $password = $password2 = "";
      } else {
        $response = array ('success' => false, 'message'=> "Passowrd doesn't match" );
        // $message = "Password doesn't match";
        // $messageCss = "d-block alert-danger";
      }
    } else {
      $response = array ('success' => false, 'message'=> "User already exists" );

      // $message = "User already exists";
      // $messageCss = "d-block alert-danger";
    }
  } else {
    $response = array ('success' => false, 'message'=> "Email id is not correct" );
    
    // $message = "Email id is not correct";
    // $messageCss = "d-block alert-danger";
  }

  $ret = array(
    'name' => $name,
    'email' => $email,
    'password' => $password,
    'password2' => $password2,
    'response' => $response
    // 'message' => $message,
    // 'messageCss' => $messageCss
  );
}
echo $twig->render('register.twig', $ret);
