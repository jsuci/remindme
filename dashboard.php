<?php
include "header.php";
include_once "incl/functions.inc.php";
include_once "incl/connect.inc.php";

if (!isset($_SESSION["user_id"])) {
    header("location: ./login.php");
    exit();
}

?>

<nav>
    <div id="menuToggle">
        <input type="checkbox" />

        <span></span>
        <span></span>
        <span></span>

        <ul id="menu">
            <a href="dashboard.php">
                <li>Home</li>
            </a>
            <a href="incl/logout.inc.php">
                <li>Logout</li>
            </a>
        </ul>
    </div>
</nav>

<main>
    <form action="incl/dashboard.inc.php" method="post">
        <div class="new_note">
            <div class="group">
                <label for="title" class="label">Title*</label>
                <input type="text" class="input" name="title">
            </div>

            <div class="group">
                <label for="message" class="label">Message*</label>
                <textarea name="message"></textarea>
            </div>

            <div class="group">
                <button class="button" type="submit" name="create_note">Add Note</button>
            </div>


            <div class="validation">
                <?php
                if (isset($_GET["error"])) {
                    if ($_GET["error"] === "empty_field") {
                        echo "<p class='invalid'>Please fill in all the required fields.</p>";
                    }

                    if ($_GET["error"] === "stmt_failed") {
                        echo "<p class='invalid'>Something went wrong. Please try again.</a></p>";
                    }

                    if ($_GET["error"] === "none") {
                        echo "<p class='success'>Successfully created a new note.</p>";
                    }

                    if ($_GET["error"] === "delete_post") {
                        echo "<p class='invalid'>Error deleting note.</p>";
                    }
                }
                ?>
            </div>
        </div>
    </form>

    <div class="ncontainer">
        <div class="notes">
            <?php
            $userid = $_SESSION["user_id"];
            $entries = read_note($conn, $userid);

            if ($entries) {
                foreach ($entries as $entry) {
                    echo '<div class="entry" id=e' . $entry["post_id"] . '><div class="text"><div class="title">' . $entry["title"] . '</div><div class="date-pub">' . $entry["date_start"] . '</div><div class="message"><p>' . $entry["message"] . '</p></div></div><div class="controls"><a href="incl/dashboard.inc.php?delete=' . $entry["post_id"] . '"><div class="icons" id="bin"></div></a><a href="javascript:void(0);" onclick="saveNote(' . $entry["post_id"] . ')"><div class="icons" id="save"></div></a><a href="javascript:void(0);" onclick="editNote(' . $entry["post_id"] . ')"><div class="icons" id="pen"></div></a></div></div>';
                }
            } else {
                echo '<div class="validation"><p class="invalid">No notes show.</a></p></div>';
            }

            ?>



        </div>
    </div>
</main>

<?php include "footer.php" ?>