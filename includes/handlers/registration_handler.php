<?php

$password_criteria = ["1 x uppercase letter", "1 x lowercase letter", "1 x number", "1 of the following special characters (&#33, &#64, &#35, &#36, &#37, &#38)."];

$errors = array();
$conn = connectToDatabase($servername, $db, $username, $password);
$lastInsertId = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["firstname"])) {
        $firstname = filter_var(trim($_POST["firstname"]), FILTER_SANITIZE_STRING);
        $firstname = validateInput($firstname, Pattern::NAME);
        if (strlen($firstname) == 0) {
            array_push($errors, "<p class=\"error\">Firstname must only contain letters, spaces and apostrophes (&#39) and hyphens (&#45).</p>");
        }
    }

    if (isset($_POST["lastname"])) {
        $lastname = filter_var(trim($_POST["lastname"]), FILTER_SANITIZE_STRING);
        $lastname = validateInput($lastname, Pattern::NAME);
        if (strlen($lastname) == 0) {
            array_push($errors, "<p class=\"error\">Lastname must only contain letters, spaces and apostrophes (&#39) and hyphens (&#45).</p>");
        }
    }

    if ($_POST["password_01"] == $_POST["password_02"]) {
        if (isset($_POST["password_01"])) {
            $password_01 = filter_var(trim($_POST["password_01"]), FILTER_SANITIZE_STRING);
            $password_01 = validateInput($password_01, Pattern::PASSWORD);
            if (strlen($password_01) == 0) {
                $error_message = "<p class=\"error\">Password must contain at least <ul>";
                foreach ($password_criteria as $criteria) {
                    $error_message .= "<li>$criteria</li>";
                }
                $error_message .= "</ul></p>";
                array_push($errors, $error_message);
            }
        }
    } else {
        array_push($errors, "<p class=\"error\">Passwords do not match.</p>");
    }

    if (isset($_POST["email"])) {
        $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);
        if (strlen($email) == 0) {
            array_push($errors, "<p class=\"error\">Invalid email format.</p>");
        }
    }

    if (isset($_POST["phone"])) {
        $phone = filter_var(trim($_POST["phone"]), FILTER_SANITIZE_STRING);
        $phone = validateInput($phone, Pattern::PHONE);
        if (strlen($phone) == 0) {
            array_push($errors, "<p class=\"error\">Invalid phone number.</p>");
        }
    }

    if (empty($errors)) {
        try {
            $sql = "INSERT INTO Customer (Firstname, Lastname, Password, Email, Phone) VALUES (?, ?, SHA2(?, 256), ?, ?)";
            $conn->prepare($sql)->execute([$firstname, $lastname, $password_01, $email, $phone]);
            $lastInsertId = $conn->lastInsertId();
        } catch (PDOException $e) {
            array_push($errors, "<p class=\"error\">" . $e->getMessage() . "</p>");
        }
    }
}
