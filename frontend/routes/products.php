<?php
session_start();
$is_admin = $_SESSION['USER']['role'] === 'admin';
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
  </head>
  <body>
    <div class="app">
      <div class="app__left">
        <div class="app__nav">
          <nav class="nav">
            <a class="nav-link" href="./menu.php">Меню</a>
            <a class="nav-link active" href="./products.php">Продукты</a>
            <a class="nav-link" href="./profile.php">Кабинет</a>
            <a class="nav-link basket " href="./busket.php">
              Корзина
              <img src="../img/basket.svg" alt="" srcset="" />
              <div class="basket-circle">
                3
              </div>
            </a>
        </div>

        <div class="section">
          <div class="section__title">Мясные изделия
            <?php if ($is_admin) : ?>
                <a href="./product-info.php" class="section__add">
                  <img src="../img/add.svg" >
                </a>
            <?php endif; ?>
          </div>
          <div class="section__cards">

          <?php
            require_once "../../backend/connect.php";
            try {
              $products = $pdo->query("SELECT * FROM products")->fetchAll();
              
              // print_r($products);
            } catch (PDOException $e) {
              // echo $e->getMessage();
              echo "Something wrong with database";
            }
            foreach($products as $product) {
              $img_path = $product['img'];
              $price = $product['price'];
              $title = $product['title'];
              $uuid = $product['uuid'];
              // echo $uuid;
              echo "
              <a class='card product-card' href='./product-info.php?uuid=$uuid'>
                <img src='$img_path' class='card-img-top'>
                <div class='card-body product-card__body'>
                  <h5 class='card-title product-card__title'>$title</h5>
                  <div class='product-card__info'>
                    <div class='product-card__price'>
                      $price руб.
                    </div>
                  </div>
                </div>
              </a>
              ";
            }
          ?>

            <!-- <a class="card product-card" href="./product-info.php?uuid=asd123">
              <img src="../img/products/meat/1.png" class="card-img-top" alt="...">
              <div class="card-body product-card__body">
                <h5 class="card-title product-card__title">Сосиски баварские на гриле</h5>
                <div class="product-card__info">
                  <div class="product-card__price">
                      399 руб.
                  </div>
                </div>
              </div>
            </a>

            <div class="card product-card" >
              <img src="../img/products/meat/2.png" class="card-img-top" alt="...">
              <div class="card-body product-card__body">
                <h5 class="card-title product-card__title">Курица гриль</h5>
                <div class="product-card__info">
                  <div class="product-card__price">
                    299 руб.
                  </div>
                </div>
              </div>
              </div>

            <a class="card product-card" href="./product-info.php?uuid=zxc123">
              <img src="../img/products/meat/3.png" class="card-img-top" alt="...">
              <div class="card-body product-card__body">
                <h5 class="card-title product-card__title">Стейк с кровью</h5>
                <div class="product-card__info">
                  <div class="product-card__price">
                    699 руб.
                  </div>
                </div>
              </div>
            </a>

            <div class="card product-card" >
              <img src="../img/products/meat/4.png" class="card-img-top" alt="...">
              <div class="card-body product-card__body">
                <h5 class="card-title product-card__title">Котлеты домашние</h5>
                <div class="product-card__info">
                  <div class="product-card__price">
                    199 руб.
                  </div>
                </div>
              </div>
            </div> -->

            <div class="section__next"><img src="../img/next.svg" alt="" srcset=""></div>
            
            </div>
        
          </div>
        <!-- <div class="section">
          <div class="section__title">Овощи</div>
          <div class="section__cards">
            <a class="card product-card" href="./product-info.php?uuid=qwe123">
              <img src="../img/products/vegetables/1.png" class="card-img-top" alt="...">
              <div class="card-body product-card__body">
                <h5 class="card-title product-card__title">Сильно прожаренный картофель</h5>
                <div class="product-card__info">
                  <div class="product-card__price">
                    159 руб.
                  </div>
                </div>
              </div>
</a>

            <div class="card product-card" >
              <img src="../img/products/vegetables/2.png" class="card-img-top" alt="...">
              <div class="card-body product-card__body">
                <h5 class="card-title product-card__title">Яблочный салат с брокколи</h5>
                <div class="product-card__info">
                  <div class="product-card__price">
                    189 руб.
                  </div>
                </div>
              </div>
              </div>

            <div class="card product-card" >
              <img src="../img/products/vegetables/3.png" class="card-img-top" alt="...">
              <div class="card-body product-card__body">
                <h5 class="card-title product-card__title">Летний салат из томатов черри</h5>
                <div class="product-card__info">
                  <div class="product-card__price">
                    199 руб.
                  </div>
                </div>
              </div>
              </div>

            <div class="card product-card" >
              <img src="../img/products/vegetables/4.png" class="card-img-top" alt="...">
              <div class="card-body product-card__body">
                <h5 class="card-title product-card__title">Свежий салат</h5>
                <div class="product-card__info">
                  <div class="product-card__price">
                    59 руб.
                  </div>
                </div>
              </div>
            </div>
            
            <div class="section__next"><img src="../img/next.svg" alt="" srcset=""></div>
            </div>
        </div> -->

        </div>

        
      
      <div class="app__right">
        <div class="app__right-img">
          <img src="../img/back.png" alt="" srcset="">
        </div>
        <a class="app__right-name" href="../index.html">
          ДОМ У МЯСА™
        </a>
        <?php include "../components/search.php"; ?>
      </div>
    </div>
  </body>
</html>
