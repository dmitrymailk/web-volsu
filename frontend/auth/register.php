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
  <link rel="stylesheet" href="../style/auth.css" />
  <link href="https://fonts.googleapis.com/css2?family=Neucha&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous" />
  <script src="https://www.google.com/recaptcha/api.js"></script>
</head>

<body>
  <div class="auth">
    <div class="auth__title">Регистрация</div>
    <form class="auth__form" action="../../backend/register.php" method="POST">
      <div class="auth__desc">Логин</div>
      <input class="auth__input" name="login" />
      <div class="auth__desc">Пароль</div>
      <input class="auth__input" type="password" name="password" />
      <div class="g-recaptcha" data-sitekey="6LeaXOYZAAAAAGty7iCVzsWXtTb-8DqgOgYIAlcx" name='captha'></div>
      <button class="auth__submit">Отправить</button>
    </form>
    <h3>Уже есть аккаунт? <a href="./login.php">Войти в аккаунт </a></h3>
    <h4>
      <?php
      echo $_SESSION['register_error_login_short'];
      unset($_SESSION['register_error_login_short']);
      ?>
    </h4>
    <h4>
      <?php
      echo $_SESSION['register_error_pass'];
      unset($_SESSION['register_error_pass']);
      ?>
    </h4>
    <h4>
      <?php
      echo $_SESSION['register_error'];
      unset($_SESSION['register_error']);
      ?>
    </h4>
  </div>
</body>



</html>