<?php
session_start();
if (!isset($_SESSION['USER']))
  header("Location: ../auth/register.php");
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
      require_once "../../backend/connect.php";

      $uuid = $_GET['uuid'];

      $is_exist = false;
      $is_admin = $_SESSION['USER']['role'] === 'admin';
      try {
        $product_query = $pdo->prepare("SELECT * from products WHERE uuid = ?;");
        $product_query->execute([$uuid]);
        $product = $product_query->fetchAll();
        $is_exist = count($product) > 0;

        if ($is_exist) {
          $price = $product[0]['price'];
          $title = $product[0]['title'];
          $img = $product[0]['img'];
        }
      } catch (PDOException $e) {
        echo "DB ERROR! " . $e->getMessage();
      }

      ?>



      <?php if ($is_exist && !$is_admin) : ?>
        <div class="product-info">
          <div class="product-info__title">Информация о продукте</div>

          <div class="product-info__group">
            <div class="product-info__img">
              <img src="<?php echo $img; ?>">
            </div>

            <form class="product-info__controls" action="../../backend/product-info.php" method="POST">
              <input type="hidden" name="uuid" value="<?php echo $uuid; ?>">
              <!-- <input type="hidden" name="type" value="<php echo $products[$uuid]['type']; ?>"> -->
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
      <?php elseif ($is_admin && $is_exist) : ?>
        <h1>Update</h1>
        <form class="product-info" action="../../backend/upload/upload_put.php?uuid=<?php echo $uuid; ?>" method="POST" enctype="multipart/form-data">
          <div class="product-info__title">Информация о продукте</div>
          <input type="hidden" name="uuid" value="<?php echo $uuid; ?>">

          <div class="product-info__group">
            <div class="product-info__img">
              <img class="product-info__img-fix" src="<?php echo $img ?>" id="imagePreview">
              <div class="product-info__add">
                <input class="product-info__img-add" type="file" name="image" id="image" multiple />
                <img src="../img/add.svg">
              </div>
            </div>

            <div class="product-info__controls">
              <div class="product-info__promocode">
                <div class="product-info__promocode-title">Стоимость:</div>
                <input class="product-info__promocode-code" id="price" name="price" value="<?php echo $price; ?>">
              </div>

              <button class="product-info__cart" type="submit" id="submit" disabled>
                Обновить элемент
              </button>
            </div>
          </div>

          <div class="product-info__name">
            <input class="product-info__name-title" type="text" placeholder="Введите название продукта" name='title' id='title' value="<?php echo $title; ?>">
          </div>
        </form>
        <form action="../../backend/upload/upload_delete.php" method="post">
          <input type="text" type="hidden" name="uuid" value="<?php echo $uuid; ?>" hidden>
          <button class="product-info__cart" type="submit">
            Удалить элемент
          </button>
        </form>

      <?php elseif ($is_admin && !$is_exist) : ?>
        <h1>Add new</h1>
        <form class="product-info" action="../../backend/upload/upload.php" method="POST" enctype="multipart/form-data">
          <div class="product-info__title">Информация о продукте</div>

          <div class="product-info__group">
            <div class="product-info__img">
              <img class="product-info__img-fix" src="" id="imagePreview">
              <div class="product-info__add">
                <input class="product-info__img-add" type="file" name="image" id="image" multiple />
                <img src="../img/add.svg">
              </div>
            </div>

            <div class="product-info__controls">
              <div class="product-info__promocode">
                <div class="product-info__promocode-title">Стоимость:</div>
                <input class="product-info__promocode-code" id="price" name="price">
              </div>

              <button class="product-info__cart" type="submit" id="submit" disabled>
                Добавить в каталог
              </button>

            </div>
          </div>

          <div class="product-info__name">
            <input class="product-info__name-title" type="text" placeholder="Введите название продукта" name='title' id='title'>
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
<?php if ($is_exist && !$is_admin) : ?>
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
        } else if (isNum) {
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
        } else if (isMatch) {
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
<?php elseif ($is_admin && $is_exist) : ?>
  <script>
    window.onload = () => {
      const $ = (selector) => document.querySelector(selector);
      let amount = $("#price")
      let image = $("#image")
      let title = $("#title")
      let imageBorder = $(".product-info__img")
      let imagePreview = $("#imagePreview");

      const maxPrice = 10000;

      let state = {
        amount: true,
        image: true,
        title: true
      }

      image.addEventListener("change", e => {
        let elem = e.srcElement;
        let hasFiles = elem.files.length > 0;

        let elemClassIncorrect = `${imageBorder.classList[0]}_incorrect`;
        let elemClassCorrect = `${imageBorder.classList[0]}_correct`;

        if (hasFiles) {
          imageBorder.classList.add(elemClassCorrect);

          if (imageBorder.classList.contains(elemClassIncorrect))
            imageBorder.classList.remove(elemClassIncorrect)

          var loadImage = new FileReader();
          loadImage.addEventListener('load', () => {
            imagePreview.src = loadImage.result;
          });
          loadImage.readAsDataURL(elem.files[0]);
          setState('image', true);
        } else {
          imageBorder.classList.add(elemClassIncorrect);

          if (imageBorder.classList.contains(elemClassCorrect))
            imageBorder.classList.remove(elemClassCorrect)
          setState('image', false);
        }
        checkState()
      });

      title.addEventListener('input', e => {
        let elem = e.srcElement;
        const minLenStr = 5;
        let elemClassIncorrect = `${title.classList[0]}_incorrect`;
        let strLen = elem.value.length > minLenStr;

        if (!strLen && !title.classList.contains(elemClassIncorrect)) {
          title.classList.add(elemClassIncorrect)
          setState('title', false)
        } else if (strLen) {
          if (title.classList.contains(elemClassIncorrect)) {
            title.classList.remove(elemClassIncorrect)
          }
          setState('title', true);
        }

        checkState();
      });

      amount.addEventListener("input", (e) => {

        let elem = e.srcElement;
        const isNum = isNumber(elem.value)
        let elemClassIncorrect = `${amount.classList[0]}_incorrect`

        if (!isNum && !amount.classList.contains(elemClassIncorrect)) {
          amount.classList.add(elemClassIncorrect)
          setState('amount', false)
        } else if (isNum) {
          if (amount.classList.contains(elemClassIncorrect)) {
            amount.classList.remove(elemClassIncorrect)
          }

          const correctRange = +elem.value > 0 && +elem.value < maxPrice;

          if (correctRange) {
            setState('amount', true);
          } else {
            amount.classList.add(elemClassIncorrect)
            setState('amount', false)
          }

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
    }
  </script>
<!-- php elseif ($is_admin) : ?>
  <script>
    window.onload = () => {
      const $ = (selector) => document.querySelector(selector);
      let amount = $("#price");
      let image = $("#image");
      let title = $("#title");
      let imageBorder = $(".product-info__img");
      let imagePreview = $("#imagePreview");

      const maxPrice = 10000;

      let state = {
        amount: false,
        image: false,
        title: false
      }

      image.addEventListener("change", e => {
        let elem = e.srcElement;
        let hasFiles = elem.files.length > 0;

        let elemClassIncorrect = `${imageBorder.classList[0]}_incorrect`;
        let elemClassCorrect = `${imageBorder.classList[0]}_correct`;

        if (hasFiles) {
          imageBorder.classList.add(elemClassCorrect);

          if (imageBorder.classList.contains(elemClassIncorrect))
            imageBorder.classList.remove(elemClassIncorrect)

          var loadImage = new FileReader();
          loadImage.addEventListener('load', () => {
            imagePreview.src = loadImage.result;
          });
          loadImage.readAsDataURL(elem.files[0]);
          setState('image', true);
        } else {
          imageBorder.classList.add(elemClassIncorrect);

          if (imageBorder.classList.contains(elemClassCorrect))
            imageBorder.classList.remove(elemClassCorrect)
          setState('image', false);
        }
        checkState()
      });

      title.addEventListener('input', e => {
        let elem = e.srcElement;
        const minLenStr = 5;
        let elemClassIncorrect = `${title.classList[0]}_incorrect`;
        let strLen = elem.value.length > minLenStr;

        if (!strLen && !title.classList.contains(elemClassIncorrect)) {
          title.classList.add(elemClassIncorrect)
          setState('title', false)
        } else if (strLen) {
          if (title.classList.contains(elemClassIncorrect)) {
            title.classList.remove(elemClassIncorrect)
          }
          setState('title', true);
        }

        checkState();
      });

      amount.addEventListener("input", (e) => {

        let elem = e.srcElement;
        const isNum = isNumber(elem.value)
        let elemClassIncorrect = `${amount.classList[0]}_incorrect`

        if (!isNum && !amount.classList.contains(elemClassIncorrect)) {
          amount.classList.add(elemClassIncorrect)
          setState('amount', false)
        } else if (isNum) {
          if (amount.classList.contains(elemClassIncorrect)) {
            amount.classList.remove(elemClassIncorrect)
          }

          const correctRange = +elem.value > 0 && +elem.value < maxPrice;

          if (correctRange) {
            setState('amount', true);
          } else {
            amount.classList.add(elemClassIncorrect)
            setState('amount', false)
          }

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



    }
  </script> -->
<?php endif; ?>

</html>