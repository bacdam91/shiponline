<?php

$config = parse_ini_file("../config.ini");
require_once("../includes/components/header.php");
require_once("../includes/utility/utils.php");
require_once("../includes/handlers/database_handler.php");
require_once("../includes/classes/abstract/Pattern.php");
require_once("../includes/handlers/login_handler.php");

?>

<section>
    <h1>ShipOnline System Login Page</h1>
    <?php
    if (!isset($_SESSION["CustomerID"])) {
        include_once("../includes/components/login_form.php");
        if (!empty($errors)) {
            foreach ($errors as $error) {
                echo $error;
            }
        }
    } else {
        header("Location: ./request.php");
    }
    ?>
</section>

<?php
require_once("../includes/components/footer.php");
?>