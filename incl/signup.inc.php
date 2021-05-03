<?php

if (isset($_POST["submit"])) {

    require_once "connect.inc.php";
    require_once "functions.inc.php";

    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirmPass = $_POST["confirm_pass"];

    if (empty_signup($email, $password, $confirmPass) !== false) {
        header("location: ../signup.php?error=empty_field");
        exit();
    }

    if (invalid_email($email) !== false) {
        header("location: ../signup.php?error=invalid_email");
        exit();
    }

    if (invalid_pass($password) !== false) {
        header("location: ../signup.php?error=invalid_pass");
        exit();
    }

    if (pass_not_match($password, $confirmPass) !== false) {
        header("location: ../signup.php?error=pass_not_match");
        exit();
    }


    if (user_exists($conn, $email) !== false) {
        header("location: ../signup.php?error=user_exists");
        exit();
    }


    add_user($conn, $email, $password);
} else {
    header("location: ../signup.php");
    exit();
}
