<?php

$config = parse_ini_file("../config.ini");
require_once("../includes/components/header.php");
require_once("../includes/utility/utils.php");
require_once("../includes/handlers/database_handler.php");
require_once("../includes/classes/abstract/Pattern.php");
require_once("../includes/handlers/request_handler.php");
?>

<section>
    <h1>ShipOnline System Request Page</h1>
    <?php
    if (!isset($_SESSION["CustomerID"])) {
        header("Location: ./login.php");
    } else {
        echo "<p class=\"success\">You are logged in with customer number " . $_SESSION["CustomerID"] . ". <a href=\"./logout.php\">Logout?</a></p>";
        require("../includes/components/request_form.php");

        if (!empty($errors)) {
            foreach ($errors as $error) {
                echo $error;
            }
        }

        if ($lastInsertId !== null) {
            echo "<p class=\"success\">$lastInsertId</p>";
        }
    }
    ?>
</section>

<?php
require_once("../includes/components/footer.php");
?>