<?php 

// i don't know, it just works
function uuid4()
{
  // https://www.php.net/manual/en/function.uniqid.php#94959
  return sprintf(
    '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
    mt_rand(0, 0xffff),
    mt_rand(0, 0xffff),
    mt_rand(0, 0xffff),
    mt_rand(0, 0x0fff) | 0x4000,
    mt_rand(0, 0x3fff) | 0x8000,
    mt_rand(0, 0xffff),
    mt_rand(0, 0xffff),
    mt_rand(0, 0xffff)
  );
}


function log_user_action($action_type, $action_info, $pdo) {
  if(isset($_SESSION['USER'])) {
    $username = $_SESSION['USER']['login'];
    $date = date("Y-m-d H:i:s");
    try {
      $pdo->prepare("INSERT INTO user_log ( `type`, action_time, user_login, info) VALUES ( ?, ?, ?, ?);")->execute([$action_type, $date, $username, $action_info]);
    }
    catch (PDOException $e) {
      echo $e->getMessage();
    }
  }
}