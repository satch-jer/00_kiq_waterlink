<?php

//function that strips out unnecessary spaces and slashes, and escapes all the special HTML characters.
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}