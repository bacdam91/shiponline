<?php

// Direct access to this page will get denied
if (!isset($_POST["submit"])) {
    header("location: ../../register.php");
}
