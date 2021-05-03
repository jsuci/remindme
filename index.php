<?php include "header.php" ?>

<?php

if (isset($_SESSION["user_email"])) {
    header("location: dashboard.php");
    exit();
} else {
    header("Location: login.php");
    exit();
}
