<?php

$errors = array();
$conn = connectToDatabase($servername, $db, $username, $password);
$password_criteria = ["1 x uppercase letter", "1 x lowercase letter", "1 x number", "1 of the following special characters (&#33, &#64, &#35, &#36, &#37, &#38)."];
$lastInsertId = null;

if (isset($_POST["submit"])) {
    if (isset($_POST["firstname"])) {
        $firstname = filter_var($_POST["firstname"], FILTER_SANITIZE_STRING);
        $firstname = validateInput($firstname, Pattern::NAME);
        if ($firstname == "") {
            array_push($errors, "<p class=\"error\">Firstname must only contain letters, spaces and apostrophes (&#39) and hyphens (&#45).</p>");
        }
    }

    if (isset($_POST["lastname"])) {
        $lastname = filter_var($_POST["lastname"], FILTER_SANITIZE_STRING);
        $lastname = validateInput($lastname, Pattern::NAME);
        if ($lastname == "") {
            array_push($errors, "<p class=\"error\">Lastname must only contain letters, spaces and apostrophes (&#39) and hyphens (&#45).</p>");
        }
    }

    if ($_POST["password_01"] == $_POST["password_02"]) {
        if (isset($_POST["password_01"])) {
            $password_01 = filter_var($_POST["password_01"], FILTER_SANITIZE_STRING);
            $password_01 = validateInput($password_01, Pattern::PASSWORD);
            if ($password_01 == "") {
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
        $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);
        if ($email == "") {
            array_push($errors, "<p class=\"error\">Invalid email format.</p>");
        }
    }

    if (isset($_POST["phone"])) {
        $phone = filter_var($_POST["phone"], FILTER_SANITIZE_STRING);
        $phone = validateInput($phone, Pattern::PHONE);
        if ($phone == "") {
            array_push($errors, "<p class=\"error\">Invalid phone number.</p>");
        }
    }

    if (empty($errors)) {
        $sql = "INSERT INTO Customer (firstname, lastname, password, email, phone) VALUES (?, ?, SHA2(?, 256), ?, ?)";
        $conn->prepare($sql)->execute([$firstname, $lastname, $password_01, $email, $phone]);
        $lastInsertId = $conn->lastInsertId();
    }
}
