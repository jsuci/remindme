<?php

require_once "connect.inc.php";
require_once "functions.inc.php";

session_start();

if (!isset($_SESSION["user_id"])) {
    header("location: ./login.php");
    exit();
}

if (isset($_POST["create_note"])) {

    $title = $_POST["title"];
    $message = $_POST["message"];
    $userid = $_SESSION["user_id"];

    if (empty_note($title, $message) !== false) {
        header("location: ../dashboard.php?error=empty_field");
        exit();
    }

    create_note($conn, $title, $message, $userid);
}


if (isset($_GET["delete"])) {

    $post_id = $_GET["delete"];

    if (delete_note($conn, $post_id) !== false) {
        header("location: ../dashboard.php");
    } else {
        header("location: ../dashboard.php?error=delete_post");
    }

    exit();
}


if (isset($_POST["update_note"])) {

    $post_id = $_POST["post_id"];
    $title = $_POST["title"];
    $message = $_POST["message"];

    if (update_note($conn, $post_id, $title, $message) !== false) {
        header("location: ../dashboard.php");
    } else {
        header("location: ../dashboard.php?error=delete_post");
    }

    exit();
}

if (isset($_POST["priority"])) {

    $post_id = $_POST["post_id"];
    $status_message = $_POST["status_message"];

    if (update_priority($conn, $post_id, $status_message) !== false) {
        header("location: ../dashboard.php");
    } else {
        header("location: ../dashboard.php?error=update_priority");
    }

    exit();
}
