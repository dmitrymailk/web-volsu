<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  require_once "../connect.php";
  
  if (isset($_POST['uuid'])) {
    $uuid = $_POST['uuid'];

    try {
      $pdo->prepare("DELETE FROM products WHERE uuid=?;")->execute([$uuid]);
    } catch (PDOException $e) {
      header("Location: ../../frontend/routes/product-info.php");
    }

    header("Location: ../../frontend/routes/products.php");
  }
}