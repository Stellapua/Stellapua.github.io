<?php
session_start();

//session_unset();

if (!isset($_SESSION['user'])) {
    header("Location: http://localhost/webdev/onlineshop/login.php");
}
