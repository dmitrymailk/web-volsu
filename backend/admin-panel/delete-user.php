<?php
session_start();
require_once "../connect.php";

if (!isset($_SESSION['USER']))
  header("Location: ../auth/register.php");

if($_SESSION['USER']['role'] !== 'superadmin')
  header("Location: ../auth/register.php");


$user_login = $_POST['login'];



try {
  $pdo->prepare("DELETE FROM users WHERE login=?;")->execute([$user_login]);
  header("Location: ../../frontend/routes/admin-panel.php");

} catch (PDOException $e) {
  echo "DB ERROR! " . $e->getMessage();
}