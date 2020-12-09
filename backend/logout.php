<?php
session_start();
require_once "connect.php";
require_once "utils.php";
log_user_action("logout", "loooogout", $pdo);
$_SESSION = array();
session_destroy();
header("Location: ../frontend/routes/profile.php");
