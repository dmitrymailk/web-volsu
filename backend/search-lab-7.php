<?php
session_start();

require_once "connect.php";

$results = [];

$search_phrase = $_POST['global-search'];
$poor_food = $_POST['poor-food'];

// items types
$product_type = $_POST['product_type'];
$drinks_type = $_POST['drinks_type'];
$fruits_type = $_POST['fruits_type'];
$vegetables_type = $_POST['vegetables_type'];
$meat_type = $_POST['meat_type'];
$sweets_type = $_POST['sweets_type'];


$poor_limit = 10000000;

if($poor_food)
  $poor_limit = 100;

try {
  
  if($product_type) {
    $products = $pdo->prepare("SELECT * FROM products where title LIKE :title and price <= :poor_limit");
    $products->execute(["title" => "%$search_phrase%", "poor_limit" => $poor_limit]);
    $products = $products->fetchAll();

    unpack_arr($results, $products);
  }
  
  if($drinks_type) {
    $drinks = $pdo->prepare("SELECT * FROM drinks where title LIKE :title and price <= :poor_limit");
    $drinks->execute(["title" => "%$search_phrase%", "poor_limit" => $poor_limit]);
    $drinks = $drinks->fetchAll();

    unpack_arr($results, $drinks);
  }

  if($fruits_type) {
    $fruits = $pdo->prepare("SELECT * FROM fruits where title LIKE :title and price <= :poor_limit");
    $fruits->execute(["title" => "%$search_phrase%", "poor_limit" => $poor_limit]);
    $fruits = $fruits->fetchAll();

    unpack_arr($results, $fruits);
  }

  if($vegetables_type) {
    $vegetables = $pdo->prepare("SELECT * FROM vegetables where title LIKE :title and price <= :poor_limit");
    $vegetables->execute(["title" => "%$search_phrase%", "poor_limit" => $poor_limit]);
    $vegetables = $vegetables->fetchAll();

    unpack_arr($results, $vegetables);
  }

  if($meat_type) {
    $meat = $pdo->prepare("SELECT * FROM meat where title LIKE :title and price <= :poor_limit");
    $meat->execute(["title" => "%$search_phrase%", "poor_limit" => $poor_limit]);
    $meat = $meat->fetchAll();

    unpack_arr($results, $meat);
  }

  if($sweets_type) {
    $sweets = $pdo->prepare("SELECT * FROM sweets where title LIKE :title and price <= :poor_limit");
    $sweets->execute(["title" => "%$search_phrase%", "poor_limit" => $poor_limit]);
    $sweets = $sweets->fetchAll();

    unpack_arr($results, $sweets);
  }
  
} catch (PDOException $e) {
  echo $e->getMessage();
  echo "Something wrong with database";
}


$_SESSION['global-search'] = $results;

header("Location: ../frontend/routes/search-lab-7.php");


function unpack_arr(&$original_array, $from_array) {
  foreach ($from_array as $item) {
    $original_array[] = $item;
  }
}

