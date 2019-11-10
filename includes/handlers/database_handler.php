<?php

$config = parse_ini_file("../../config.ini");

$servername = $config["servername"];
$db = $config["dbname"];
$username = $config["username"];
$password = $config["password"];

function connectToDatabase($servername, $db, $username, $password)
{
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Connected successfully";
        return $conn;
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}
