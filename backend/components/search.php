<?php
session_start();


function clear_query($query)
{
  $query = strtolower($query);
  $query = trim($query);
  return $query;
}

// function searchOnPage($link, $query, $page_name)
// {
//   $text = file_get_contents($link);
//   $text = preg_replace('/(<(style)\b[^>]*>).*?(<\/\2>)/is', "$1$3", $text);
//   preg_match("/<body.*\/body>/s", $text, $html_body);

//   $text = strip_tags($html_body[0]); // pure text from page
//   $text = mb_strtolower(preg_replace('/\s+/', ' ', $text));

//   $pos = strpos($text, $query);

//   if ($pos === false) {
//     return false; // query doesn't exist
//   }

//   $searched_query = "";

//   if ($pos > 16)
//     $searched_query = substr($text, ($pos - 16));
//   else
//     $searched_query = substr($text, $pos);

//   // $searched_query = implode(" ", $searched_query);
//   $searched_query = mb_strimwidth($searched_query, 1, 120, "...", mb_internal_encoding());
//   $searched_query = str_replace($query, "<b>$query</b>", $searched_query);

//   $result['content'] = $searched_query;
//   $result['link'] = $link;
//   $result['title'] = $page_name;
//   return $result;
// }

require_once "../connect.php";
$search_query = clear_query($_POST['search']);
if(strlen($search_query)>0){

  $results = [];
  $products = [];
  try {
    $products_query = $pdo->prepare("SELECT * FROM `products` WHERE title LIKE ?");
    $products_query->execute(["%$search_query%"]);
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


