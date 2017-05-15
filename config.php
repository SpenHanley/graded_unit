<?php
/*
Output buffering. Without output buffering (which is default),
your HTML is sent to the browser in pieces as PHP processes through
your script. With output buffering, your HTML is stored in a variable
and sent to the browser as one piece at the end of your script.
*/

ob_start();
session_start();
defined("DB_HOST") ? null : define("DB_HOST", "localhost");
defined("DB_USER") ? null : define("DB_USER", "spen");
defined("DB_PASS") ? null : define("DB_PASS", "hanley");
defined("DB_NAME") ? null : define("DB_NAME", "spen");

$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
require_once("functions.php");
?>