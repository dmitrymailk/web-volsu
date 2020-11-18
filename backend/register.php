<?php
session_start();
require_once "connect.php";

$login = $_POST['login'];
$password = md5($_POST['password']);

if (strlen($login) < 3) {
  $_SESSION['register_error_login_short'] = "Too short login";
  header("Location: ../auth/register.php");
} else {

  $is_register = mysqli_query($connect, "INSERT INTO `users` (`login`, `password`) VALUES ('$login', '$password')");
  if ($is_register) {
    $_SESSION['register_success'] = "You successfully signed up!";
    header("Location: ../frontend/routes/profile.php");
  } else {
    $_SESSION['register_error'] = "Registration error!";
    header("Location: ../frontend/auth/register.php");
  }
}
