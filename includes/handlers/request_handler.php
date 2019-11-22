<?php

$errors = array();
$conn = connectToDatabase($servername, $db, $username, $password);
$lastInsertId = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    print_r($_POST);
    if (isset($_POST["item-description"])) {
        $itemDescription = filter_var(trim($_POST["item-description"]), FILTER_SANITIZE_STRING);
        $itemDescription = validateInput($itemDescription, Pattern::ITEM_DESCRIPTION);
        if (strlen($itemDescription) == 0) {
            array_push($errors, "<p class=\"error\">Item description cannot be blank and must contain on numbers, letters, commas, hyphens, periods, and exclamation marks.</p>");
        }
    }
}
