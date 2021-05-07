<?php include "header.php" ?>

<main>
    <form action="incl/login.inc.php" method="post">
        <div class="login">
            <div class="group">
                <img src=img/remindme-logo.png alt="form-logo" />
            </div>

            <div class="group">
                <label for="email" class="label">Email</label>
                <input type="text" id="email" class="input" autocomplete="on" name="email">
            </div>

            <div class="group">
                <label for="pass" class="label">Password</label>
                <input type="password" id="pass" class="input   " name="password">
            </div>

            <div class="show">
                <input type="checkbox" onclick="showPass()" class="c-box">
                Show Password
            </div>

            <div class="validation">
                <?php
                if (isset($_GET["error"])) {
                    if ($_GET["error"] === "empty_field") {
                        echo "<p class='invalid'>Please fill in all the required fields.</p>";
                    }

                    if ($_GET["error"] === "invalid_login") {
                        echo "<p class='invalid'>Invalid credentials. <a href='signup.php'>Click here to sign up.</a></p>";
                    }

                    if ($_GET["error"] === "invalid_password") {
                        echo "<p class='invalid'>Password incorrect.</p>";
                    }
                }
                ?>
            </div>

            <div class="group">
                <button class="button" type="submit" name="submit">Sign In</button>
            </div>

            <div class="sep"></div>

            <div class="reg">
                <p>Not yet registered? <a href=signup.php>Create an account</a></p>
            </div>
        </div>
    </form>
</main>

<?php include "footer.php" ?>