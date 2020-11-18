<?php
session_start();
require_once "connect.php";

$login = $_POST['login'];
$password = md5($_POST['password']);

$user_query = $pdo->prepare("SELECT * FROM users WHERE login = ? and password = ?");
$user_query->execute([$login, $password]);
$user = $user_query->fetchAll();
$user_exists = count($user);

// print_r($user);
// echo $user[0]['role'];

if ($user_exists) {
  $_SESSION["USER"] = [
    "login" => $login,
    "role" => $user[0]['role']
  ];

  header("Location: ../frontend/routes/profile.php");
} else {
  $_SESSION['login_error'] = "Incorrect user credentials";

  header("Location: ../frontend/auth/login.php");
}
