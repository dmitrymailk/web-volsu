<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  require_once "../connect.php";
  require_once "../utils.php";

  if (isset($_POST['uuid'])) {

    $uuid = $_POST['uuid'];
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

        $file = $path . $uuid . ".$file_ext";
        // unlink('../uploads/'. $uuid . ".$file_ext");
        move_uploaded_file($file_tmp,  $file);
        $root_url = "http://localhost/web-volsu/backend/uploads/";
        $relative_path = $root_url . $uuid . ".$file_ext";

        if (!isset($_POST['title']))
          header("Location: ../../frontend/routes/product-info.php");

        if (!isset($_POST['price']))
          header("Location: ../../frontend/routes/product-info.php");

        $title = $_POST['title'];
        $price = $_POST['price'];

        // UPDATE table_name
        // SET column1=value, column2=value2,...
        // WHERE some_column=some_value
        // add to products table
        try {
          $pdo->prepare("UPDATE products SET img=?, title=?, price=? WHERE uuid=?;")->execute([$relative_path, $title, $price, $uuid]);
        } catch (PDOException $e) {
          header("Location: ../../frontend/routes/product-info.php");
        }

        header("Location: ../../frontend/routes/products.php");
      }
    }
  }
}
