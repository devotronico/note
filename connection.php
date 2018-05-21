<?php
define('DB_SERVER', '89.46.111.58');
define('DB_USERNAME', 'Sql1176037');
define('DB_PASSWORD', '88w2410cp6');
define('DB_NAME', 'Sql1176037_3');
$mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if($mysqli === false || $mysqli->connect_error ) { die("ERROR: Could not connect. " . $mysqli->connect_error); }

define('PASSWORD_LENGTH', 8);
?>


