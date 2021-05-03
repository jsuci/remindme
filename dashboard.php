<?php include "header.php" ?>
<?php include "incl/dashboard.inc.php" ?>

<main>
    <?php echo "Hello, " . $_SESSION["user_email"]; ?>
    <a href="incl/logout.inc.php">Logout</a>
</main>

<?php include "footer.php" ?>