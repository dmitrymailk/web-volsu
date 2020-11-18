<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Дом у Еды</title>
  <link rel="stylesheet" href="../style/normalize.css" />
  <!-- <link rel="stylesheet" href="../style/index.css" /> -->
  <link rel="stylesheet" href="../style/auth.css" />
  <link href="https://fonts.googleapis.com/css2?family=Neucha&display=swap" rel="stylesheet" />
</head>

<body>
  <div class="auth">
    <div class="auth__title">Вход в аккаунт</div>
    <form class="auth__form" action="../../backend/login.php" method="POST">
      <div class="auth__desc">Логин</div>
      <input class="auth__input" name="login" />
      <div class="auth__desc">Пароль</div>
      <input class="auth__input" type="password" name="password" />
      <button class="auth__submit">Отправить</button>
    </form>
    <h3>Первый раз на сайте? <a href="./register.php">Зарегистрировать аккаунт </a></h3>
    <h3>
      <?php
      echo $_SESSION['login_error'];
      unset($_SESSION['login_error']);
      ?>
    </h3>

  </div>
</body>

</html>