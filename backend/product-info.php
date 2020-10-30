<?php
session_start();

if(!isset($_SESSION['USER']))
  header("Location: ../frontend/auth/register.php");

$amount = $_POST['amount'];
$promocode = $_POST['promocode'];
$uuid = $_POST['uuid'];
$product_type = $_POST['product_type'];

$products = [
  'qwe123' => [
    'img' => '../img/product-info/potato.png',
    'title' => 'Сильно прожаренный картофель'
  ],
  'asd123' => [
    'img' => '../img/product-info/sousages.png',
    'title' => 'Сосиски баварские на гриле'
  ],
  'zxc123' => [
    'img' => '../img/product-info/steak.png',
    'title' => 'Стейк с кровью'
  ],
];
// no php validation, only js

$product = [
  'promocode' => $promocode,
  'amount' => $amount,
  'product_type' => $product_type
];



if(isset($_SESSION['cart'])) {
  if(!isset($_SESSION['cart'][$uuid]))
    $_SESSION['cart'][$uuid] = $product;
}
else {
  $_SESSION['cart'] = [];
  $_SESSION['cart'][$uuid] = $product;
}

header("Location: ../frontend/routes/busket.php");