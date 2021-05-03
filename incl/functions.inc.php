<?php

function empty_signup($email, $password, $confirmPass)
{
    if (empty($email) || empty($password) || empty($confirmPass)) {
        return true;
    }

    return false;
}

function invalid_email($email)
{
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    }

    return false;
}


function invalid_pass($password)
{
    if (strlen($password) < 8) {
        return true;
    }

    return false;
}



function pass_not_match($password, $confirmPass)
{
    if ($password !== $confirmPass) {
        return true;
    }

    return false;
}


function user_exists($conn, $email)
{
    $sql = "SELECT * FROM users WHERE email = ?;";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=stmt_failed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);

    mysqli_stmt_close($stmt);

    if ($row) {
        return $row;
    } else {
        return false;
    }
}


function add_user($conn, $email, $password)
{
    $sql = "INSERT INTO users VALUES (NULL, ?, ?);";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=stmt_failed");
        exit();
    }

    $hashPass = password_hash($password, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "ss", $email, $hashPass);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    /* redirect to login */
    header("location: ../signup.php?error=none");
    exit();
}


function empty_login($email, $password)
{

    if (empty($email) || empty($password)) {
        return true;
    }

    return false;
}


function login_user($conn, $email, $password)
{
    $userExists = user_exists($conn, $email);

    if ($userExists === false) {
        header("location: ../login.php?error=invalid_login");
        exit();
    }

    $passHashed = $userExists["password"];
    $checkPass = password_verify($password, $passHashed);

    if ($checkPass === false) {
        header("location: ../login.php?error=invalid_password");
        exit();
    } else {
        session_start();
        $_SESSION["user_id"] = $userExists["user_id"];
        $_SESSION["user_email"] = $userExists["email"];

        /* redirect to dashboard */
        header("location: ../dashboard.php");
        exit();
    }
}
