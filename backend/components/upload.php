<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  require_once "../connect.php";
  require_once "../utils.php";

  // print_r($_FILES);
  $obj_name = 'image';

  if (isset($_FILES[$obj_name])) {
    $errors = [];

    $path = '/var/www/html/web-volsu/backend/uploads/';
    $extensions = ['jpg', 'jpeg', 'png', 'gif'];

    $all_files = count($_FILES[$obj_name]['tmp_name']);


    $file_name = $_FILES[$obj_name]['name'];
    $file_tmp = $_FILES[$obj_name]['tmp_name'];
    $file_type = $_FILES[$obj_name]['type'];
    $file_size = $_FILES[$obj_name]['size'];

    $file_ext = strtolower(end(explode('.', $file_name)));

    // print_r($file_ext . '  ' . $file_name);

    
    if (!in_array($file_ext, $extensions)) {
      $errors[] = 'Extension not allowed: ' . $file_name . ' ' . $file_type;
    }
    
    if ($file_size > 2097152) {
      $errors[] = 'File size exceeds limit: ' . $file_name . ' ' . $file_type;
    }
    
    if (empty($errors)) {
      $uuid = uuid4();
      $file = $path . $uuid . ".$file_ext";
      move_uploaded_file($file_tmp,  $file);
      $root_url = "http://localhost/web-volsu/backend/uploads/";
      $relative_path = $root_url . $uuid . ".$file_ext";

      $title = $_POST['title'];
      $price = $_POST['price'];


      // add to products table
      try {
        $pdo->prepare("INSERT INTO products ( uuid, title, img, price) VALUES ( ?, ?, ?, ?);")->execute([$uuid, $title, $relative_path, $price]);
      } catch (PDOException $e) {
        header("Location: ../../frontend/routes/product-info.php");
      }
      
      header("Location: ../../frontend/routes/products.php");

    }
  }
}
