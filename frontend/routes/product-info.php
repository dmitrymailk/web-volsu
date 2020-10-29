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
  <link rel="stylesheet" href="../style/product-info.css">
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

      <?php
      $uuid = $_GET['uuid'];
      $products = [
        'qwe123' => [
          'img' => '../img/product-info/potato.png',
          'title' => 'Сильно прожаренный картофель'
        ],
        'asd123' => [
          'img' => '../img/product-info/sousages.png',
          'title' => 'Сосиски баварские на гриле'
        ],
        'zxc123' => [
          'img' => '../img/product-info/steak.png',
          'title' => 'Стейк с кровью'
        ],
      ];

      $is_exist = isset($products[$uuid]);
      ?>



      <?php if ($is_exist) : ?>
        <div class="product-info">
          <div class="product-info__title">Информация о продукте</div>

          <div class="product-info__group">
            <div class="product-info__img">
              <img src="<?php echo $products[$uuid]['img']; ?>">
            </div>

            <form class="product-info__controls" action="../../backend/product-info.php" method="POST">
              <div class="product-info__amount">
                <div class="product-info__amount-title">Количество:</div>
                <span>X</span>
                <input class="product-info__amount-input" id="amount" name="amount">
              </div>

              <div class="product-info__promocode">
                <div class="product-info__promocode-title">Промокод:</div>
                <input class="product-info__promocode-code" id="promocode" name="promocode">
              </div>

              <button class="product-info__cart" type="submit" id="submit" disabled>
                Добавить в корзину
              </button>

          </div>
        </div>

        <div class="product-info__name">
          <?php echo $products[$uuid]['title']; ?>
        </div>
        </form>
      <?php else : ?>
        <h1>This product doesn't exist</h1>
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
<script>
  window.onload = () => {
    const $ = (selector) => document.querySelector(selector);
    let amount = $('#amount');
    let promocode = $("#promocode")

    let state = {
      amount: false,
      promocode: false
    }

    amount.addEventListener("input", (e) => {
      
      let elem = e.srcElement
      const isNum = isNumber(elem.value)
      let elemClassIncorrect = `${amount.classList[0]}_incorrect`
      
      if (!isNum && !amount.classList.contains(elemClassIncorrect)) {
        amount.classList.add(elemClassIncorrect)
        setState('amount', false)
      } else if(isNum) {
        if (amount.classList.contains(elemClassIncorrect)) {
          amount.classList.remove(elemClassIncorrect)
        }

        const correctRange = +elem.value > 0 && +elem.value < 10;

        if (correctRange) {
          setState('amount', true);
        } else {
          amount.classList.add(elemClassIncorrect)
          setState('amount', false)
        }

      }


      checkState()
    })

    promocode.addEventListener('input', e => {
      let elem = e.srcElement;
      const isMatch = correctMatch(elem.value);
      
      let elemClassIncorrect = `${promocode.classList[0]}_incorrect`
      
      if (!isMatch && !promocode.classList.contains(elemClassIncorrect)) {
        promocode.classList.add(elemClassIncorrect)
        setState('promocode', false)
      } else if (isMatch){
        if (promocode.classList.contains(elemClassIncorrect)) {
          promocode.classList.remove(elemClassIncorrect)
        }
        setState('promocode', true);
      }
      checkState()
    })

    function checkState() {
      let allCorrect = true;
      let states = Object.keys(state);
      // console.log(states)
      states.forEach(elem => {
        // console.log(elem, state[elem])
        allCorrect = allCorrect && state[elem]
      })
      // console.log(allCorrect)
      disableButton(allCorrect)
    }



    function isNumber(value) {
      return !isNaN(value) && typeof(+value) === 'number';
    }

    function disableButton(condition) {
      $('#submit').disabled = !condition
    }

    function setState(_state, payload) {
      state[_state] = payload
    }

    function correctMatch(value) {
      const pattern = /^[a-z0-9]{3}-[a-z0-9]{3}-[a-z0-9]{3}$/;
      return pattern.test(value)
    }

  }
</script>

</html>