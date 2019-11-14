<?php

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
