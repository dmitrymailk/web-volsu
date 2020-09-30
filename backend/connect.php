<?php

$connect = mysqli_connect('localhost', 'dimweb', '123', 'test', 3306);
// echo "Hello";
if (!$connect) {
  die("Error database connection");
}
