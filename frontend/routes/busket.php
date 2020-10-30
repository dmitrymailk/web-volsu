<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ДОМ У ЕДЫ</title>
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
      integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z"
      crossorigin="anonymous"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Neucha&display=swap"
      rel="stylesheet"
    />
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
            <a class="nav-link" href="./menu.php">Меню</a>
            <a class="nav-link" href="./products.php">Продукты</a>
            <a class="nav-link" href="./profile.php">Кабинет</a>
            <a class="nav-link basket active" href="./busket.php"
              >Корзина
              <img src="../img/basket.svg" alt="" srcset="" />
              <div class="basket-circle">
                3
              </div>
            </a>
        </div>

        <?php 
          // print_r($_SESSION);

          $products = [
            'qwe123' => [
              'img' => '../img/products/vegetables/1.png',
              'title' => 'Сильно прожаренный картофель',
              'price' => 159
            ],
            'asd123' => [
              'img' => '../img/products/meat/1.png',
              'title' => 'Сосиски баварские на гриле',
              'price' => 399
            ],
            'zxc123' => [
              'img' => '../img/products/meat/3.png',
              'title' => 'Стейк с кровью',
              'price' => 699
            ],
          ];
        ?>

        <!-- <div class="section">
          <div class="section__title">Блюда</div>
          <div class="section__cards">
            <div class="card recommendation-card" >
              <div class="recommendation-card__amount">X2</div>
              <img src="../img/menu/favorites/1.png" class="card-img-top" alt="...">
              <div class="card-body recommendation-card__body">
                <h5 class="card-title recommendation-card__title">Винный соус с курицей и грибами в сковороде</h5>
                <div class="recommendation-card__info">
                  <div class="recommendation-card__stars">
                    <img src="../img/menu/star.svg" alt="">
                    <img src="../img/menu/star.svg" alt="">
                    <img src="../img/menu/star.svg" alt="">
                    <img src="../img/menu/star.svg" alt="">
                  </div>
                  <div class="recommendation-card__price">
                      499 руб.
                  </div>
                </div>
              </div>
            </div>

            <div class="section__next"><img src="../img/next.svg" alt="" srcset=""></div>

          </div>
        </div> -->


        <div class="section">
          <div class="section__title">Продукты</div>
          <div class="section__cards">
            <!-- <div class="card product-card" >
              <div class="product-card__amount">X1</div>
              <img src="../img/products/vegetables/1.png" class="card-img-top" alt="...">
              <div class="card-body product-card__body">
                <h5 class="card-title product-card__title">Сильно прожаренный картофель</h5>
                <div class="product-card__info">
                  <div class="product-card__price">
                    159 руб.
                  </div>
                </div>
              </div>
              </div>

            <div class="card product-card" >
              <div class="product-card__amount">X1</div>
              <img src="../img/products/vegetables/2.png" class="card-img-top" alt="...">
              <div class="card-body product-card__body">
                <h5 class="card-title product-card__title">Яблочный салат с брокколи</h5>
                <div class="product-card__info">
                  <div class="product-card__price">
                    189 руб.
                  </div>
                </div>
              </div>
              </div> -->

              <?php 
                $cart = $_SESSION['cart'];
                foreach(array_keys($_SESSION['cart']) as $uuid) {
                  $price = $products[$uuid]['price'];
                  if($cart[$uuid]['promocode'] === '222-222-222')
                    $price =  round($price* 0.8);

                  $img = $products[$uuid]['img'];
                  $amount = $cart[$uuid]['amount'];
                  $price = $price * $amount;
                  $title = $products[$uuid]['title'];

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

              <div class="section__next"><img src="../img/next.svg" alt="" srcset=""></div>
            </div>
            
        </div>
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
