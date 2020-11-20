<?php
session_start();
$redirect = "../frontend/auth/register.php";

if (!isset($_POST['login']))
  header("Location: $redirect");

if (!isset($_POST['password']))
  header("Location: $redirect");

require_once "connect.php";


$login = $_POST['login'];
$password = $_POST['password'];

$user_query = $pdo->prepare("SELECT * FROM users WHERE login = ?");
$user_query->execute([$login]);
$user = $user_query->fetchAll();
$user_exists = count($user);

if (!$user_exists) {


  if (strlen($login) < 3) {
    $_SESSION['register_error_login_short'] = "Too short login";
    header("Location: $redirect");
  } else {

    if (pass_validation($password)) {
      $_SESSION['register_error_pass'] = "Too weak password";
      header("Location: $redirect");
    }

    $password = md5($password);

    if (!isset($_POST['g-recaptcha-response'])) {
      $_SESSION['register_error_login_short'] = "Error with captcha, sorry we can't!";
      header("Location: $redirect");
    }

    $captcha = $_POST['g-recaptcha-response'];

    $secretKey = "6LeaXOYZAAAAAJv_Fwb3YfF0tWLwckmwVJK9_DV5";
    $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($captcha);
    $response = file_get_contents($url);
    $responseKeys = json_decode($response, true);

    if ($responseKeys["success"]) {
      // $is_register = mysqli_query($connect, "INSERT INTO `users` (`login`, `password`) VALUES ('$login', '$password')");
      try {
        $register_query = $pdo->prepare("INSERT INTO `users` (`login`, `password`) VALUES (?, ?)");
        $register_query->execute([$login, $password]);
      } catch (PDOException $e) {
        header("Location: $redirect");
      }
      header("Location: http://localhost/web-volsu/frontend/auth/login.php");
    } else {
      $_SESSION['register_error_login_short'] = "Error with captcha!";
      header("Location: $redirect");
    }
  }
} else {
  $_SESSION['register_error_login_short'] = "User with this credentials already exists!";
  header("Location: $redirect");
}

function pass_validation($pass)
{
  $is_weak = false;

  if (strlen($pass) < 8)
    $is_weak = true;

  if (!preg_match("#[0-9]+#", $pass))
    $is_weak = true;

  if (!preg_match("#[a-zA-Z]+#", $pass))
    $is_weak = true;

  return $is_weak;
}
