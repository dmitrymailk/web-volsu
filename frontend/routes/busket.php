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
  <link rel="stylesheet" href="../style/products.css">
  <link rel="stylesheet" href="../style/menu.css">
  <link rel="stylesheet" href="../style/busket.css">
</head>

<body>
  <div class="app">
    <div class="app__left">
      <div class="app__nav">
        <nav class="nav">
          <a class="nav-link" href="./search-lab-7.php">Поиск</a>
          <a class="nav-link" href="./menu.php">Меню</a>
          <a class="nav-link" href="./products.php">Продукты</a>
          <a class="nav-link" href="./profile.php">Кабинет</a>
          <a class="nav-link basket active" href="./busket.php">Корзина
            <img src="../img/basket.svg" alt="" srcset="" />
            <div class="basket-circle">
              3
            </div>
          </a>
      </div>

      <div class="section">
        <div class="section__title">Продукты</div>
        <div class="section__cards">
          <?php
          $cart = $_SESSION['cart'];
          foreach (array_keys($_SESSION['cart']) as $uuid) {
            $price = $cart[$uuid]['price'];

            $img = $cart[$uuid]['img'];
            $amount = $cart[$uuid]['amount'];
            $title = $cart[$uuid]['title'];

            echo "
                  <div class='card product-card' >
                    <div class='product-card__amount'>X$amount</div>
                    <img src='$img' class='card-img-top' />
                    <div class='card-body product-card__body'>
                      <h5 class='card-title product-card__title'>$title</h5>
                      <div class='product-card__info'>
                        <div class='product-card__price'>
                          $price руб.
                        </div>
                      </div>
                    </div>
                    </div>
                  ";
          }
          ?>
          <?php if (count($cart) > 0) :  ?>
            <div class="section__next"><img src="../img/next.svg" alt="" srcset=""></div>
          <?php endif; ?>
        </div>

      </div>
      <?php
      if (count($cart) > 0) {
      }
      ?>
      <?php if (count($cart) > 0) :  ?>
        <a class="basket__order" href="../../backend/order.php">
          Сделать заказ
        </a>
      <?php else :  ?>
        <h3>Empty </h3>
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
</body>

</html>