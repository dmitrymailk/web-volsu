<?php

if (isset($_SESSION['USER'])) {
  $admin = $_SESSION['USER']['role'] === 'superadmin';
  if($admin) {
    $render_string = "<a class='nav-link' href='./admin-panel.php'>Админка</a>";
    echo $render_string;
  }
}

?>