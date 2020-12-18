<?php

session_start();
require_once "../connect.php";

if (!isset($_SESSION['USER']))
  header("Location: ../auth/register.php");

if ($_SESSION['USER']['role'] !== 'superadmin')
  header("Location: ../auth/register.php");

$admin_errors = [];

$login = $_POST['login'];
$password = md5($_POST['password']);
$role  = $_POST['role'];

if (strlen($login) < 3)
  $admin_errors[] = "Short login";

if (strlen($password) < 3)
  $admin_errors[] = "Short password";

if (!in_array($role, ['user', 'admin']))
  $admin_errors[] = "Incorrect role";

$query = $pdo->prepare("SELECT * FROM users where login=?");
$query->execute([$login]);
$row = $query->rowCount();

if (!$row) {
  if (count($admin_errors) == 0) {
    $is_register = $pdo
      ->prepare("INSERT INTO `users` (`login`, `password`, `role`) VALUES (?, ?, ?)")
      ->execute([$login, $password, $role]);

    if ($is_register)
      $admin_errors[] = "User added";
    else
      $admin_errors[] = "Registration error!";
  }
} else
  $admin_errors[] = 'Login exists';



$_SESSION['admin-errors'] = $admin_errors;
header("Location: ../../frontend/routes/admin-panel.php");
