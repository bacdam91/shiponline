<?php

$errors = array();
$conn = connectToDatabase($servername, $db, $username, $password);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["customerNumber"])) {
        $customerNumber = filter_var(trim($_POST["customerNumber"]), FILTER_SANITIZE_NUMBER_INT);
        $customerNumber = filter_var($customerNumber, FILTER_VALIDATE_INT);
        if (strlen($customerNumber) == 0) {
            array_push($errors, "<p class=\"error\">Invalid customer number format.</p>");
        }
    }

    if (isset($_POST["password"])) {
        $password = filter_var(trim($_POST["password"]), FILTER_SANITIZE_STRING);
        $password = validateInput($password, Pattern::PASSWORD);
        if (strlen($password) == 0) {
            $error_message = "<p class=\"error\">Password must contain at least <ul>";
            foreach ($password_criteria as $criteria) {
                $error_message .= "<li>$criteria</li>";
            }
            $error_message .= "</ul></p>";
            array_push($errors, $error_message);
        }
    }

    if (empty($errors)) {
        try {
            $sql = "SELECT COUNT(*) FROM Customer WHERE CustomerID = ? AND Password = SHA2(?, 256)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$customerNumber, $password]);

            if ($stmt->fetchColumn() == 0) {
                array_push($errors, "<p class=\"error\">Invalid customer number or password.</p>");
            } else {
                $sql = "SELECT * FROM Customer WHERE CustomerID = ? AND Password = SHA2(?, 256)";
                $stmt = $conn->prepare($sql);
                $stmt->execute([$customerNumber, $password]);
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                $_SESSION["CustomerID"] = $result["CustomerID"];
                header("Location: ./request.php");
            }
        } catch (PDOException $e) {
            array_push($errors, "<p class=\"error\">" . $e->getMessage() . "</p>");
        }
    }
}
