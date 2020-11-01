<?php
session_start();

if (!isset($_SESSION['USER']))
  header("Location: ../frontend/auth/register.php");

$amount = $_POST['amount'];
$promocode = $_POST['promocode'];
$uuid = $_POST['uuid'];
// $product_type = $_POST['product_type'];

$products = [
  'qwe123' => [
    'img' => '../img/products/vegetables/1.png',
    'title' => 'Сильно прожаренный картофель',
    'price' => 159,
    'type' => 'product'
  ],
  'asd123' => [
    'img' => '../img/products/meat/1.png',
    'title' => 'Сосиски баварские на гриле',
    'price' => 399,
    'type' => 'product'
  ],
  'zxc123' => [
    'img' => '../img/products/meat/3.png',
    'title' => 'Стейк с кровью',
    'price' => 699,
    'type' => 'product'
  ],
];
// no php validation, only js

$price = $products[$uuid]['price'];

if ($promocode === '222-222-222')
  $price = round($price * 0.8);

$price = $price * $amount;

$product = [
  'promocode' => $promocode,
  'amount' => $amount,
  'type' => $products[$uuid]['type'],
  'title' => $products[$uuid]['title'],
  'price' => $price,
  'img' => $products[$uuid]['img']
];



if (isset($_SESSION['cart'])) {
  if (!isset($_SESSION['cart'][$uuid]))
    $_SESSION['cart'][$uuid] = $product;
} else {
  $_SESSION['cart'] = [];
  $_SESSION['cart'][$uuid] = $product;
}

header("Location: ../frontend/routes/busket.php");
