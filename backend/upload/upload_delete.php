<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  require_once "../connect.php";
  
  if (isset($_POST['uuid']) && isset($_POST['type'])) {
    $uuid = $_POST['uuid'];
    $type = $_POST['type'];
    $query_str = "DELETE FROM $type WHERE uuid=?;";
    
    unlink('../uploads/'. $uuid . ".png");
    try {
      $pdo->prepare($query_str)->execute([$uuid]);
    } catch (PDOException $e) {
      header("Location: ../../frontend/routes/product-info.php");
    }

    header("Location: ../../frontend/routes/products.php");
  }
}