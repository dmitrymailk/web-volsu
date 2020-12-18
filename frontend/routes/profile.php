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
          <?php require_once '../components/admin-panel.php' ?>
      </div>
     
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
            
            try {
              $user_history_query = $pdo->prepare("SELECT * FROM user_orders WHERE user = ?;");
              $user_history_query->execute([$login]);
              $user_history = $user_history_query->fetchAll();
            } catch (PDOException $e) {
              // echo $e->getMessage();
              echo "Something wrong with database";
            }

            ;
            if (count($user_history) > 0) {
              foreach ($user_history as $purchase) {
                $uuid = $purchase['order_uuid'];
                $purchase_query = $pdo->prepare("SELECT * FROM user_orders_products WHERE order_uuid = ?");
                $purchase_query->execute([$uuid]);
                $purchase_products = $purchase_query->fetchAll();

                // print_r($purchase_products);

                $date = $purchase['date'];
                echo "
                  <div class='history-card'>
                  <div class='history-card__date'>$date</div>
                  <div class='history-card__items'>
                  ";


                $total = 0;
                foreach ($purchase_products as $item) {
                  $total += $item['price'];
                  $amount = $item['amount'];
                  $title = $item['title'];
                  $price = $item['price'];
                  $img = $item['img'];

                  // show one item
                  echo ("
                        <div class='history-card__item'>
                          <div class='history-card__img'>
                            <img src='$img'>
                          </div>
                          <div class='history-card__card-name'>$title</div>
                          <div class='history-card__amount'>X$amount</div>
                          <div class='history-card__price'>$price руб.</div>
                          </div>
                        ");
                }
                echo "</div>";
                // total items
                echo "
                    <div class='history-card__result'>
                      <div class='history-card__total'>Итого: $total руб.</div>
                      <button class='history-card__repeat'>Повторить</button>
                    </div></div>
                    ";
              }
            }
            else {
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