<?php

$password_criteria = ["1 x uppercase letter", "1 x lowercase letter", "1 x number", "1 of the following special characters (&#33, &#64, &#35, &#36, &#37, &#38)."];

function sanitiseInput($val)
{
    $val = trim($val);
    $val = stripslashes($val);
    $val = htmlspecialchars($val);
    return $val;
}

function validateInput($val, $pattern)
{
    return filter_var($val, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/" . $pattern . "/")));
}
