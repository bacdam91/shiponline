<?php

require_once("./database_handler.php");

// Direct access to this page will get denied
if (!isset($_POST["submit"])) {
    header("location: ../../register.php");
} else {
    $conn = connectToDatabase($servername, $db, $username, $password);

    $name = $_POST["name"];
    $password_01 = $_POST["password_01"];
    $password_02 = $_POST["password_02"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];

    $sql = "INSERT INTO Customer (name, password, email, phone) VALUES (?, ?, ?, ?)";
    $conn->prepare($sql)->execute([$name, $password_01, $email, $phone]);
}
