<?php
echo("
<style>
@import '../style/components/search.css' all;
</style>
<div class='search' style='@import '../style/components/search.css' all;'>
  <form class='search__input' action='../../backend/components/search.php' method='POST'>
    <input type='text' placeholder='Поиск по сайту' name='search' class='search__input-field'>
    <button type='submit'>
      <img src='../img/components/search/search-button.svg'>
    </button>
  </form>
  <div class='search__results'>
    ");
    if (isset($_SESSION['search_results'])) {

      foreach ($_SESSION['search_results'] as $result) {
        $link = $result['link'];
        $title = $result['title'];
        $content = $result['content'];
        echo ("
              <a class='search-card' target='_blank' href='$link'>
                <div class='search-card__title'>$title</div>
                <p class='search-card__body'>$content</p>
              </a>
              ");
      }
    }
    
    echo(" 
  </div>
</div>
");
unset($_SESSION['search_results']);
?>

