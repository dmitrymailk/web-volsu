<?php
session_start();

$amount = $_POST['amount'];
$promocode = $_POST['promocode'];

echo ("$amount, $promocode");