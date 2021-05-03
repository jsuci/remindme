<?php

if (isset($_SESSION["user_email"])) {
    require_once "connect.inc.php";
    require_once "functions.inc.php";
} else {
    header("location: ./login.php");
    exit();
}
