<?php
session_start();

if (!isset($_SESSION['USER']))
  header("Location: ../frontend/auth/register.php");

require_once "./connect.php";

$amount = $_POST['amount'];
$promocode = $_POST['promocode'];
$uuid = $_POST['uuid'];
// $product_type = $_POST['product_type'];
try {
  $product_query = $pdo->prepare("SELECT * from products WHERE uuid = ?;");
  $product_query->execute([$uuid]);
  $product = $product_query->fetchAll();
  $is_exist = count($product) > 0;

  if ($is_exist) {
    $price = $product[0]['price'];
    $title = $product[0]['title'];
    $img = $product[0]['img'];
  } else {
    header("Location: ../frontend/routes/products.php");
  }
} catch (PDOException $e) {
  echo "DB ERROR! " . $e->getMessage();
  
}

print_r([$price, $img, $title]);

// $price = $product'price'];

if ($promocode === '222-222-222')
  $price = round($price * 0.8);

$price = $price * $amount;

$product = [
  'promocode' => $promocode,
  'amount' => $amount,
  'type' => 'product',
  'title' => $title,
  'price' => $price,
  'img' => $img
];



if (isset($_SESSION['cart'])) {
  if (!isset($_SESSION['cart'][$uuid]))
    $_SESSION['cart'][$uuid] = $product;
} else {
  $_SESSION['cart'] = [];
  $_SESSION['cart'][$uuid] = $product;
}

header("Location: ../frontend/routes/busket.php");
