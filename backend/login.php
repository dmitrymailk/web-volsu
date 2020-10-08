<?php
session_start();
require_once "connect.php";

$login = $_POST['login'];
$password = md5($_POST['password']);

$user_exists = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM `users` WHERE `login` = '$login' and `password` = '$password'")) == 1;


if ($user_exists) {
  $_SESSION["USER"] = [
    "login" => $login
  ];

  // $_SESSION["user_data"] = [
  //   [
  //     "date" => "29-09-2020",
  //     "data" => [
  //       ["../img/profile/1.png", "Винный соус с курицей и грибами в сковороде", 2, 840],
  //       ["../img/profile/2.png", "Сильно прожаренный картофель", 1, 159],
  //       ["../img/profile/3.png", "Яблочный салат с брокколи", 1, 1890]
  //     ]
  //   ],
  //   [
  //     "date" => "22-09-2020",
  //     "data" => [
  //       ["../img/profile/1.png", "Винный соус с курицей и грибами в сковороде", 2, 840],
  //       ["../img/profile/3.png", "Яблочный салат с брокколи", 1, 189]
  //     ]
  //   ]
  // ];
  header("Location: ../frontend/routes/profile.php");
} else {
  $_SESSION['login_error'] = "Incorrect user credentials";

  header("Location: ../frontend/auth/login.php");
}
