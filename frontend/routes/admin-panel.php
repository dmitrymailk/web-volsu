<?php
session_start();

if (!isset($_SESSION['USER']))
  header("Location: ../auth/register.php");
if($_SESSION['USER']['role'] !== 'superadmin')
  header("Location: ../auth/register.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>ДОМ У ЕДЫ</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous" />
  <link href="https://fonts.googleapis.com/css2?family=Neucha&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="../style/normalize.css">
  <link rel="stylesheet" href="../style/index.css" />
  <link rel="stylesheet" href="../style/products.css">
  <link rel="stylesheet" href="../style/menu.css">
  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
  <div class="app">
    <div class="app__left">
      <div class="app__nav">
        <nav class="nav">
          <a class="nav-link" href="./menu.php">Меню</a>
          <a class="nav-link" href="./products.php">Продукты</a>
          <a class="nav-link" href="./profile.php">Кабинет</a>
          <a class="nav-link basket" href="./busket.php">Корзина
            <img src="../img/basket.svg" alt="" srcset="" />
            <div class="basket-circle">
              3
            </div>
          </a>
          <?php require_once '../components/admin-panel.php' ?>
      </div>

      <?php
        $errors = $_SESSION['admin-errors'];
        foreach($errors as $error) {
          echo "
          <div class='alert alert-warning' role='alert'>
            $error
          </div>
          ";
        }
        unset($_SESSION['admin-errors']);
      ?>

      <table class="table mt-4">
        <thead>
          <tr>
            <th scope="col">id</th>
            <th scope="col">login</th>
            <th scope="col">password</th>
            <th scope="col">role</th>
            <th scope="col">actions</th>
          </tr>
        </thead>
        <tbody>
        <?php

          require_once "../../backend/connect.php";
          $users = $pdo->query("SELECT * FROM users where `role` != 'superadmin'; ")->fetchAll();
          function return_user_row($id, $login, $password, $role) {
            return "
            <tr>
              <form method='post' action='../../backend/admin-panel/update-user.php'>
              <td>
                <input type='hidden' name='id' value='$id'>
                $id
              </td>
              <td>
                <input type='text' value='$login' name='login' class='form-control'>
              </td>
              <td>
                <input type='text' value='$password' name='password' class='form-control'>
              </td>
              <td>
                <input type='text' value='$role' name='role' class='form-control'>
              </td>
              <td>
                <button type='submit' class='btn btn-success mr-4'>Update user</button>
              </td>
              </form>
              <td>
                <form method='post' action='../../backend/admin-panel/delete-user.php'>
                  <input type='hidden' value='$login' name='login'>
                  <button type='submit' class='btn btn-danger'>Delete user</button>
                </form>
              </td>
            </tr>
            ";
          }

          foreach($users as $user) {
            $id = $user['id'];
            $login = $user['login'];
            $password = $user['password'];
            $role = $user['role'];

            echo return_user_row($id, $login, $password, $role);

          }

        ?>
        <tr>
          <form action="../../backend/admin-panel/create-user.php" method="post">
          <td></td>
          <td><input type='text' value='' name='login' class="form-control"></td>
          <td><input type='text' value='' name='password' class="form-control"></td>
          <td>
            <select name="role" class="form-control">
              <option value="user">user</option>
              <option value="admin">admin</option>
            </select>
          </td>
          <td><button type="submit" class="btn btn-primary">Create New User</button></td>
          </form>
        </tr>
        </tbody>
      </table>

    </div>



    <div class="app__right">
      <div class="app__right-img">
        <img src="../img/back.png" alt="" srcset="">
      </div>
      <a class="app__right-name" href="../index.html">
        ДОМ У ЕДЫ™
      </a>
      <?php include "../components/search.php"; ?>
    </div>
  </div>
</body>

</html>