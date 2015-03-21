<?php

require_once('config.php');
require_once('functions.php');

session_start();

$pdo = connectDb();

$_SESSION = array();

unset($_SESSION['USER']);
unset($_SESSION['app_number']);


session_destroy();

unset($pdo);

header('Location:'.SITE_URL.'index.php');
