<?php
session_start();
$is_admin = $_SESSION['USER']['role'] === 'admin';

require_once "../../backend/connect.php";
require_once "../../backend/utils.php";

log_user_action("visit page", "visit lab-7-page page", $pdo);
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
</head>

<body>
  <div class="app">
    <div class="app__left">
      <div class="app__nav">
        <nav class="nav">
          <a class="nav-link active" href="./search-lab-7.php">Поиск</a>
          <a class="nav-link" href="./menu.php">Меню</a>
          <a class="nav-link" href="./products.php">Продукты</a>
          <a class="nav-link" href="./profile.php">Кабинет</a>
          <a class="nav-link basket " href="./busket.php">
            Корзина
            <img src="../img/basket.svg" alt="" srcset="" />
            <div class="basket-circle">
              3
            </div>
          </a>
      </div>

      <div class="global-search">
        <form class='global-search__input' action='../../backend/search-lab-7.php' method='POST'>
          <input type='text' placeholder='Поиск по сайту' name='global-search' class='global-search__input-field'>
          <button type='submit'>
            <img src='../img/components/search/search-button.svg'>
          </button>
          <div class="parameters">
            <div class="parameters__item">
              <input type="checkbox" id="poor-food" name="poor-food" value="1">
              <label for="poor-food">Дешевая еда</label>
            </div>
            <div class="parameters__item">
              <input type="checkbox" id="scales" name="product_type" value="1" checked>
              <label for="scales">Блюда</label>
            </div>
            <div class="parameters__item">
              <input type="checkbox" id="scales" name="drinks_type" value="1" checked>
              <label for="scales">Напитки</label>
            </div>
            <div class="parameters__item">
              <input type="checkbox" id="scales" name="fruits_type" value="1" checked>
              <label for="scales">Фрукты</label>
            </div>
            <div class="parameters__item">
              <input type="checkbox" id="scales" name="vegetables_type" value="1" checked>
              <label for="scales">Овощи</label>
            </div>
            <div class="parameters__item">
              <input type="checkbox" id="scales" name="meat_type" value="1" checked>
              <label for="scales">Мясо</label>
            </div>
            <div class="parameters__item">
              <input type="checkbox" id="scales" name="sweets_type" value="1" checked>
              <label for="scales">Сладости</label>
            </div>
          </div>
        </form>

        <div class="global-search__results">
          <?php
          $results = $_SESSION['global-search'];

         
          foreach ($results as $result) {
            
            $img_path = $result['img'];
            $price = $result['price'];
            $title = $result['title'];
            $uuid = $result['uuid'];
            $type = $result['type'];

            echo "
              <a class='card product-card mt-10' href='./product-info.php?uuid=$uuid&type=$type'>
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

          unset($_SESSION['global-search']);

          ?>
        </div>
      </div>


    </div>



    <div class="app__right">
      <div class="app__right-img">
        <img src="../img/back.png" alt="" srcset="">
      </div>
      <a class="app__right-name" href="../index.html">
        ДОМ У МЯСА™
      </a>

    </div>
  </div>
</body>
<style>
  .global-search__results {
    display:  grid;
    grid-template-rows: 1fr 1fr 1fr;
    grid-template-columns: 1fr 1fr 1fr;
    /* gap: 10px; */
    row-gap: 20px;
  }

  .mt-10 {
    margin-top: 10;
  }

  .parameters {
    display: flex;
  }

  .parameters__item {
    margin: 10px;
  }

  .global-search__input-field {
    width: 400px;
    height: 40px;
    border-radius: 4px;
    border: 2px solid #ccc;
    outline: none !important;
  }

  .global-search__input >  button {
    height: 40px;
    width: 40px;
    border-radius: 4px;
    border: 2px solid #ccc;
    background: #fff;
  }


</style>

</html>