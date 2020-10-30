<?php
session_start();

if (!isset($_SESSION['USER']))
  header("Location: ../frontend/auth/profile.php");

if (!isset($_SESSION['cart']))
  header("Location: ../frontend/routes/products.php");

if (count($_SESSION['cart']) == 0)
  header("Location: ../frontend/routes/products.php");

require_once './connect.php';

$order_uuid = 'f80d82c8-312a-459d-927d-cff09e47c2d0';//uuid4();
$username = $_SESSION['USER']['login'];
$date = date("Y-m-d");

// mysqli_query($connect, "INSERT INTO `user_orders` (
//   `user`,
//   `date`,
//   `uuid`
// ) VALUES
// (
//   '$username',
//   '$date',
//   '$order_uuid'
// );
// ");

$cart = $_SESSION['cart'];

foreach(array_keys($cart) as $product_id) {
  
}

// unset($_SESSION['cart']);

function uuid4() {
  // https://www.php.net/manual/en/function.uniqid.php#94959
  return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
  // 32 bits for "time_low"
  mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),

  // 16 bits for "time_mid"
  mt_rand( 0, 0xffff ),

  // 16 bits for "time_hi_and_version",
  // four most significant bits holds version number 4
  mt_rand( 0, 0x0fff ) | 0x4000,

  // 16 bits, 8 bits for "clk_seq_hi_res",
  // 8 bits for "clk_seq_low",
  // two most significant bits holds zero and one for variant DCE1.1
  mt_rand( 0, 0x3fff ) | 0x8000,

  // 48 bits for "node"
  mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
);
}