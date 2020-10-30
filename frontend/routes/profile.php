<?php
session_start();
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

  <link rel="stylesheet" href="../style/menu.css">
  <link rel="stylesheet" href="../style/busket.css">
  <link rel="stylesheet" href="../style/profile.css">
  
</head>

<body>
  <div class="app">
    <div class="app__left">
      <div class="app__nav">
        <nav class="nav">
          <a class="nav-link" href="./menu.php">Меню</a>
          <a class="nav-link" href="./products.php">Продукты</a>
          <a class="nav-link active" href="./profile.php">Кабинет</a>
          <a class="nav-link basket" href="./busket.php">Корзина
            <img src="../img/basket.svg" alt="" srcset="" />
            <div class="basket-circle">
              3
            </div>
          </a>
      </div>
      <!-- КАКАЯ ЖЕ ТУТ НАЧИНАЕТСЯ МЕШАНИНА ЭТО ПРОСТО НЕПРИЕМЛИМО... -->
      <?php if (!$_SESSION["USER"]) :  ?>
        <div class="section">
          <h2>Уже есть аккаунт? <a href="../auth/login.php">Войти в аккаунт </a></h2>
          <h2>Первый раз на сайте? <a href="../auth/register.php">Зарегистрировать аккаунт </a></h2>
          
        </div>
      <?php else : ?>
        <a href="../../backend/logout.php">Выйти из аккаунта </a>
        
        <div class="section">
          <div class="section__title"><span>История заказов </div>
          <div class="section__history-cards">
            <?php
            require_once "../../backend/connect.php";
            $login = $_SESSION["USER"]['login'];
            $user_history = mysqli_query($connect, "SELECT * FROM `users_info` WHERE `user_login` = '$login'");

            if (mysqli_num_rows($user_history) > 0) {
              $history_data = mysqli_fetch_assoc($user_history);
              $history_data = json_decode($history_data['user_data'], true);

              foreach ($history_data as $shop_history) {
                $date = $shop_history['date'];
                echo "
              <div class='history-card'>
              <div class='history-card__date'>$date</div>
              <div class='history-card__items'>
              ";

                $total = 0;
                foreach ($shop_history['data'] as $item) {
                  $total += $item[3];
                  // show one item
                  echo ("
                  <div class='history-card__item'>
                    <div class='history-card__img'>
                      <img src='$item[0]'>
                    </div>
                    <div class='history-card__card-name'>$item[1]</div>
                    <div class='history-card__amount'>X$item[2]</div>
                    <div class='history-card__price'>$item[3] руб.</div>
                  </div>
                  ");
                }
                // total items
                echo "
              <div class='history-card__result'>
                <div class='history-card__total'>Итого: $total руб.</div>
                <button class='history-card__repeat'>Повторить</button>
              </div>
              </div>
              ";
              }
              echo "</div></div>";
            } else {
              echo "<h4> История заказов пуста...</h4>";
            }
            ?>
          </div>
        </div>
      <?php endif; ?>
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




  </div>
</body>

</html>