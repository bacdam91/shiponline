<?php

session_start();
unset($_SESSION["CustomerID"]);
header("Location: ./shiponline.php");
