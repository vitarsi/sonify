<?php
session_start();
require_once "../config/db.php";

function cleanUp($text) {
    return htmlentities(trim(addslashes(strval($text))));
}
?>
