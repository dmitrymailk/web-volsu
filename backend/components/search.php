<?php
session_start();


function clear_query($query)
{
  $query = strtolower($query);
  $query = trim($query);
  return $query;
}

require_once "../connect.php";
$search_query = clear_query($_POST['search']);
if(strlen($search_query)>0){

  $results = [];
  $products = [];
  try {
    $products_query = $pdo->prepare("SELECT * FROM `products` WHERE (title LIKE ? OR price LIKE ?)");
    $products_query->execute(["%$search_query%", "%$search_query%"]);
    $products = $products_query->fetchAll();
  } catch(PDOException $e) {
    echo $e->getMessage();
  }
  // print_r($_POST['search']);
  
  foreach($products as $product) {
    $result = [];
    $result['content'] = "Price ". $product['price'];
    $result['link'] = "http://localhost/web-volsu/frontend/routes/product-info.php?uuid=" . $product['uuid'];
    $result['title'] = $product['title'];
  
    $results[] = $result;
  }
  
  // print_r($results);
  
  $_SESSION['search_results'] = $results;
  
}
$return_link = $_SERVER['HTTP_REFERER'];

header("Location: $return_link");


