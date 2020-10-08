<?php
session_start();

function RemoveSpecialChar($str) { 
  $res = str_replace( array( '\'', '"', 
  ',' , ';', '<', '>', '.', '™' ), ' ', $str); 
  return $res; 
  }

$search_query = $_POST['search'];
$search_query = strtolower($search_query); 
$search_query = trim($search_query);

$text = file_get_contents("http://localhost/frontend/routes/products.html");
preg_match("/<body.*\/body>/s", $text, $html_body);

$text = strip_tags($html_body[0]); // pure text from page
$original_text = $text;
$text = mb_strtolower($text); // lower russian
$text = RemoveSpecialChar($text);
$text = explode(" ",$text); // split by space
// delete excess spaces
for($i=0; $i<count($text); $i++){
  $text[$i] = trim($text[$i]);
}


$pos = array_search($search_query, $text);

$searched_query = array();
if($pos > 6) 
  $searched_query = array_slice($text, $pos - 6);
else 
  $searched_query = array_slice($text, $pos);

$searched_query = implode(" ", $searched_query);
$searched_query = mb_strimwidth($searched_query, 0, 1000, "...", mb_internal_encoding());
$searched_query = str_replace($search_query, "<b>$search_query</b>", $searched_query);
$debug = $searched_query;

$_SESSION['search_content'] =  $pos;
$_SESSION['search_title'] = 'Products';
$_SESSION['debug'] = $debug;

header("Location: ../../frontend/routes/profile.php");