<?php

$config = parse_ini_file("../config.ini");
require_once("../includes/components/header.php");
require_once("../includes/utility/utils.php");
require_once("../includes/handlers/database_handler.php");
require_once("../includes/classes/abstract/Pattern.php");
require_once("../includes/handlers/registration_handler.php");
?>

<section>
    <h1>ShipOnline System Register Page</h1>
    <?php

    if (!isset($_SESSION["CustomerID"])) {
        include_once("../includes/components/registration_form.php");
        if (!empty($errors)) {
            foreach ($errors as $error) {
                echo $error;
            }
        }
        if ($lastInsertId !== null) {
            echo "<p class=\"success\">Dear $firstname, you are successfully registered into ShipOnline, and your customer number is $lastInsertId, which will be used to get into the system.</p>";
        }
    } else {
        header("Location: ./request.php");
    }

    ?>
</section>

<?php
require_once("../includes/components/footer.php");
?>