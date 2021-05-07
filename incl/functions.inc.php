<?php

// login, logout, signup functions
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

        /* redirect to dashboard */
        header("location: ../dashboard.php");
        exit();
    }
}


// dashboard functions
function empty_note($title, $message)
{

    if (empty($title) || empty($message)) {
        return true;
    }

    return false;
}


function create_note($conn, $title, $message, $userid)
{
    $sql = "INSERT INTO posts VALUES (NULL, ?, ?, ?, NULL, NULL, 'active');";

    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../dashboard.php?error=stmt_failed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "sss", $userid, $title, $message);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    /* redirect to login */
    header("location: ../dashboard.php?error=none");
    exit();
}

function read_note($conn, $userid)
{
    $sql = "SELECT * FROM posts WHERE user_id = ? AND post_status = 'active' ORDER BY post_id DESC;";

    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        return false;
    }

    mysqli_stmt_bind_param($stmt, "s", $userid);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    $result_count = mysqli_num_rows($result);

    $entries = array();

    if ($result_count > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $entries[] = $row;
        }
    }

    mysqli_stmt_close($stmt);

    return $entries;
}


function delete_note($conn, $post_id)
{
    $sql = "UPDATE posts SET post_status = 'deleted' WHERE post_id = ?;";

    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        return false;
    }

    mysqli_stmt_bind_param($stmt, "s", $post_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    return true;
}


function update_note($conn, $post_id, $title, $message)
{
    $sql = "UPDATE posts SET title = ?, message  = ? WHERE post_id = ?;";

    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        return false;
    }

    mysqli_stmt_bind_param($stmt, "sss", $title, $message, $post_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    return true;
}
