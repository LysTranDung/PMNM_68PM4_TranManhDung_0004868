<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


require_once "../app/middleware.php";
$middleware = new middleware();
$middleware->checklogin(); 


require_once "../app/core/App.php";
$app = new App();