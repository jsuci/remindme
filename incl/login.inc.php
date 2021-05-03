<?php

if (isset($_POST["submit"])) {
    require_once "connect.inc.php";
    require_once "functions.inc.php";

    $email = $_POST["email"];
    $password = $_POST["password"];

    if (empty_login($email, $password) !== false) {
        header("location: ../login.php?error=empty_field");
        exit();
    }

    login_user($conn, $email, $password);
} else {
    header("location: ../login.php");
    exit();
}
