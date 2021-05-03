<?php include "header.php" ?>

<main>
    <form action="incl/signup.inc.php" method="POST">
        <div class="login">

            <div class="group">
                <img src=img/remindme-logo.png alt="form-logo" />
            </div>

            <div class="group">
                <label for="email" class="label">Email</label>
                <input type="email" id="email" class="input" autocomplete="on" name="email">
            </div>

            <div class="group">
                <label for="pass" class="label">Password</label>
                <input type="password" id="pass" class="input" name="password">
            </div>

            <div class="group">
                <label for="pass" class="label">Confirm Password</label>
                <input type="password" id="confirm_pass" class="input" name="confirm_pass">
            </div>

            <div class="show">
                <input type="checkbox" onclick="showPass()" class="c-box">Show Password
            </div>

            <div class="invalid">
                <?php
                if (isset($_GET["error"])) {
                    if ($_GET["error"] === "empty_field") {
                        echo "<p>Please fill in all the required fields.</p>";
                    } else if ($_GET["error"] === "invalid_email") {
                        echo "<p>Please enter a valid email address.</p>";
                    } else if ($_GET["error"] === "invalid_pass") {
                        echo "<p>Password length must be at least 8 characters long.</p>";
                    } else if ($_GET["error"] === "pass_not_match") {
                        echo "<p>Password do not match.</p>";
                    } else if ($_GET["error"] === "user_exists") {
                        echo "<p>Email address already taken.</p>";
                    } else {
                        echo '<p style="color:green;">Registration successful. <a href="login.php">Click here to login</a>';
                    }
                }
                ?>
            </div>

            <div class="group">
                <button class="button" type="submit" name="submit">Sign Up</button>
            </div>

            <div class="sep"></div>

            <div class="reg">
                <p>Already have an account? <a href='login.php'>Sign in</a></p>
            </div>

        </div>
    </form>
</main>

<?php include "footer.php" ?>