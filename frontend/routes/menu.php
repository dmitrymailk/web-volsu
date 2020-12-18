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
    <link rel="stylesheet" href="../style/menu.css">
  </head>
  <body>
    <div class="app">
      <div class="app__left">
        <div class="app__nav">
          <nav class="nav">
            <a class="nav-link active" href="menu.php">Меню</a>
            <a class="nav-link " href="products.php">Продукты</a>
            <a class="nav-link" href="profile.php">Кабинет</a>
            <a class="nav-link basket " href="busket.php"
              >Корзина
              <img src="../img/basket.svg" alt="" srcset="" />
              <div class="basket-circle">
                3
              </div>
            </a>
            <?php require_once '../components/admin-panel.php' ?>
        </div>

        <div class="section">
          <div class="section__title">Часто заказывают</div>
          <div class="section__cards">
            <div class="card recommendation-card" >
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

            <div class="card recommendation-card" >
              <img src="../img/menu/favorites/2.png" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title recommendation-card__title">Легкие сувлаки с курицей</h5>
                <div class="recommendation-card__info">
                  <div class="recommendation-card__stars">
                    <img src="../img/menu/star.svg" alt="">
                    <img src="../img/menu/star.svg" alt="">
                    <img src="../img/menu/star.svg" alt="">
                  </div>
                  <div class="recommendation-card__price">
                    299 руб.
                  </div>
                </div>
              </div>
            </div>

          </div>
          <div class="section__next"><img src="../img/next.svg" alt="" srcset=""></div>
        </div>

        <div class="section">
          <div class="section__title">Категории</div>
          <div class="section__cards">
            <div class="card category-card category-card_meat" >
              <img src="../img/menu/icons/1.svg" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title category-card__title">Мясо</h5>
              </div>
            </div>

            <div class="card category-card category-card_drink" >
              <img src="../img/menu/icons/2.svg" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title category-card__title">Напитки</h5>
              </div>
            </div>

            <div class="card category-card category-card_vegetables" >
              <img src="../img/menu/icons/3.svg" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title category-card__title">Овощи</h5>
              </div>
            </div>

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
