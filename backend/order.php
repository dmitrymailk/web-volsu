<?php
session_start();

if (!isset($_SESSION['USER']))
  header("Location: ../frontend/auth/profile.php");

if (!isset($_SESSION['cart']))
  header("Location: ../frontend/routes/products.php");

if (count($_SESSION['cart']) == 0)
  header("Location: ../frontend/routes/products.php");

require_once './connect.php';

$order_uuid = uuid4();
$username = $_SESSION['USER']['login'];
$date = date("Y-m-d");

// add to user_orders table
try {
  $pdo->prepare("INSERT INTO user_orders ( user, `date`, uuid) VALUES ( ?, ?, ?);")->execute([$username, $date, $order_uuid]);
} catch (PDOException $e) {
  header("Location: ../frontend/routes/busket.php");
}

$cart = $_SESSION['cart'];

$query_start = "INSERT INTO user_orders_products ( uuid, img, title, amount, price, `type`) VALUES ";
$array_data = [];

foreach (array_keys($cart) as $product_id) {
  $title = $cart[$product_id]['title'];
  $amount = $cart[$product_id]['amount'];
  $price = $cart[$product_id]['price'];
  $type = $cart[$product_id]['type'];
  $img = $cart[$product_id]['img'];

  array_push($array_data, $order_uuid);
  array_push($array_data, $img); 
  array_push($array_data, $title);
  array_push($array_data, $amount);
  array_push($array_data, $price);
  array_push($array_data, $type);

  $query_start = $query_start . " ( ?, ?, ?, ?, ?, ?),";
}
$query_start[-1] = ";";

// add to user_orders_products table
try {
  $add_products = $pdo->prepare($query_start);
  $add_products->execute($array_data);
  unset($_SESSION['cart']);

  header("Location: ../frontend/routes/profile.php");
} catch (PDOException $e) {
  echo $e->getMessage();
}

// i don't know, it just works
function uuid4()
{
  // https://www.php.net/manual/en/function.uniqid.php#94959
  return sprintf(
    '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
    mt_rand(0, 0xffff),
    mt_rand(0, 0xffff),
    mt_rand(0, 0xffff),
    mt_rand(0, 0x0fff) | 0x4000,
    mt_rand(0, 0x3fff) | 0x8000,
    mt_rand(0, 0xffff),
    mt_rand(0, 0xffff),
    mt_rand(0, 0xffff)
  );
}
