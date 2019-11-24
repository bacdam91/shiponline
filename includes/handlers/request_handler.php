<?php

$errors = array();
$conn = connectToDatabase($servername, $db, $username, $password);
$lastInsertId = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["item-description"])) {
        $itemDescription = filter_var(trim($_POST["item-description"]), FILTER_SANITIZE_STRING);
        $itemDescription = validateInput($itemDescription, Pattern::ITEM_DESCRIPTION);
        if (strlen($itemDescription) == 0) {
            array_push($errors, "<p class=\"error\">Item description can only contain on numbers, letters, commas, hyphens, periods, and exclamation marks, and must be between 3 and 50 characters long.</p>");
        }
    }

    if (isset($_POST["weight"])) {
        $weight = filter_var(trim($_POST["weight"]), FILTER_SANITIZE_NUMBER_INT);
        $weight = filter_var($weight, FILTER_VALIDATE_INT, array(
            "options" => array(
                "min_range" => 2,
                "max_range" => 20
            )
        ));
        if (strlen($weight) == 0) {
            array_push($errors, "<p class=\"error\">The weight has to be between 2kg and 20kg</p>");
        }
    }

    if (isset($_POST["pu-address"])) {
        $puAddress = filter_var(trim($_POST["pu-address"]), FILTER_SANITIZE_STRING);
        $puAddress = validateInput($puAddress, Pattern::ADDRESS);
        if (strlen($puAddress) == 0) {
            array_push($errors, "<p class=\"error\">Address can only contain numbers, letters, spaces, hyphens, commas, apostrophes, and must be between 5 and 50 characters long.</p>");
        }
    }

    if (isset($_POST["pu-suburb"])) {
        $puSuburb = filter_var(trim($_POST["pu-suburb"]), FILTER_SANITIZE_STRING);
        $puSuburb = validateInput($puSuburb, Pattern::SUBURB);
        if (strlen($puSuburb) == 0) {
            array_push($errors, "<p class=\"error\">Suburb can only contain letters and spaces, and must be between 3 and 50 characters long.</p>");
        }
    }

    if (isset($_POST["pu-state"])) {
        $puState = filter_var(trim($_POST["pu-state"]), FILTER_SANITIZE_STRING);
        $puState = validateInput($puState, Pattern::STATE);
        if (strlen($puState) == 0) {
            array_push($errors, "<p class=\"error\">Please select from the list of states.</p>");
        }
    }

    if (isset($_POST["date"]) && isset($_POST["month"]) && isset($_POST["year"])) {
        $month = filter_var(trim($_POST["month"]), FILTER_SANITIZE_NUMBER_INT);
        $date = filter_var(trim($_POST["date"]), FILTER_SANITIZE_NUMBER_INT);
        $year = filter_var(trim($_POST["year"]), FILTER_SANITIZE_NUMBER_INT);
        if (!checkdate($month, $date, $year)) {
            array_push($errors, "<p class=\"error\">Invalid date selection.</p>");
        }
    }

    if (isset($_POST["hour"]) && isset($_POST["minute"])) {
        $hour = $_POST["hour"];
        $minute = $_POST["minute"];
        if ($hour < 0 || $hour > 23 || $minute < 0 || $minute > 55) {
            array_push($errors, "<p class=\"error\">Invalid time selection.</p>");
        }

        if (($hour < 7 && $minute < 30) || ($hour > 20 && $minute > 30)) {
            array_push($errors, "<p class=\"error\">Preferred time must be between 07:30 and 20:30.</p>");
        }
    }

    if (isset($year) && isset($month) && isset($date) && isset($hour) && isset($minute)) {
        $now = new DateTime();
        $preferredDateTime = $year . "-" . $month . "-" . $date . " " . $hour . ":" . $minute . ":00";
        $preferredDate = new DateTime($preferredDateTime);
        $interval = $now->diff($preferredDate);
        if ($interval->format("%d") < 1) {
            array_push($errors, "<p class=\"error\">Preferred pick up time must be 24 hours after the request time.</p>");
        }
    }

    if (isset($_POST["recipient"])) {
        $recipient = filter_var(trim($_POST["recipient"]), FILTER_SANITIZE_STRING);
        $recipient = validateInput($recipient, Pattern::NAME);
        if (strlen($recipient) == 0) {
            array_push($errors, "<p class=\"error\">Recipient's name can only contain lettesr, hyphens and apostrophes, and must be between 3 and 50 characters long.</p>");
        }
    }

    if (isset($_POST["del-address"])) {
        $delAddress = filter_var(trim($_POST["del-address"]), FILTER_SANITIZE_STRING);
        $delAddress = validateInput($delAddress, Pattern::ADDRESS);
        if (strlen($delAddress) == 0) {
            array_push($errors, "<p class=\"error\">Address can only contain numbers, letters, spaces, hyphens, commas, apostrophes, and must be between 5 and 50 characters long.</p>");
        }
    }

    if (isset($_POST["del-suburb"])) {
        $delSuburb = filter_var(trim($_POST["del-suburb"]), FILTER_SANITIZE_STRING);
        $delSuburb = validateInput($delSuburb, Pattern::SUBURB);
        if (strlen($delSuburb) == 0) {
            array_push($errors, "<p class=\"error\">Suburb can only contain letters and spaces, and must be between 3 and 50 characters long.</p>");
        }
    }

    if (isset($_POST["del-state"])) {
        $delState = filter_var(trim($_POST["del-state"]), FILTER_SANITIZE_STRING);
        $delState = validateInput($delState, Pattern::STATE);
        if (strlen($delState) == 0) {
            array_push($errors, "<p class=\"error\">Please select from the list of states.</p>");
        }
    }

    if (empty($errors)) {
        try {
            $sql = "INSERT INTO Request (ItemDescription, Weight, PreferredPickUpDate, PickUpAddress, PickUpSuburb, PickUpStateCode, DeliveryAddress, DeliverySuburb, DeliveryStateCode, Recipient, CustomerID) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
            $conn->prepare($sql)->execute([$itemDescription, $weight, $preferredDateTime, $puAddress, $puSuburb, $puState, $delAddress, $delSuburb, $delState, $recipient, $_SESSION["CustomerID"]]);
            $lastInsertId = $conn->lastInsertId();
        } catch (PDOException $e) {
            array_push($errors, "<p class=\"error\">" . $e->getMessage() . "</p>");
        }
    }
}
