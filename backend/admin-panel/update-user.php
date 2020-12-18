<?php

session_start();
require_once "../connect.php";

if (!isset($_SESSION['USER']))
  header("Location: ../auth/register.php");

if($_SESSION['USER']['role'] !== 'superadmin')
  header("Location: ../auth/register.php");

$admin_errors = [];

$login = $_POST['login'];
$password = $_POST['password'];
$role  = $_POST['role'];
$user_id = $_POST['id'];


if(strlen($login) < 3)
  $admin_errors[] = "Short login";

if(strlen($password) < 3)
  $admin_errors[] = "Short password";

if(!in_array($role, ['user', 'admin']))
  $admin_errors[] = "Incorrect role";


if(count($admin_errors) == 0) {
  $password = md5($password);
  $user_id = (int)$user_id;
  $pdo
  ->prepare("UPDATE users SET `login`=?, `password`=?, `role`=? WHERE `id`=?")
  ->execute([$login, $password, $role, $user_id]);
  $admin_errors[] = 'Users updated';
}
  
$_SESSION['admin-errors'] = $admin_errors;

header("Location: ../../frontend/routes/admin-panel.php");
