<?php
session_start();
if (array_key_exists('content', $_POST))
{
    include("connection.php");
    $content = $mysqli->escape_string($_POST['content']);
    $id = (int)$_SESSION['id'];
    $query = "UPDATE Users SET testo = '$content' WHERE id = $id LIMIT 1 ";
    $mysqli->query($query);
    $mysqli->close;
}
?>