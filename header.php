<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <title>
        <?php
        if ($_SERVER["REQUEST_URI"] === "/remindme/signup.php") {
            echo "RemindMe | Register";
        } elseif ($_SERVER["REQUEST_URI"] === "/remindme/login.php") {
            echo "RemindMe | Login";
        } else {
            echo "RemindMe | Student Reminder App";
        }
        ?>
    </title>
</head>

<body>