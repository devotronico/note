<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
include_once("../connection.php"); 

    $newpassword = trim($_POST['newpassword']);
    $newpassword = $mysqli->escape_string($newpassword);
    $confirmpassword = trim($_POST['confirmpassword']);
    $confirmpassword = $mysqli->escape_string($confirmpassword);
    if( empty($newpassword) )
    {
        echo "Il campo <strong>password</strong> è vuoto.";
        exit;
    }
    else if( strlen($newpassword) < PASSWORD_LENGTH)
    {
        echo "La <strong>password</strong> deve avere almeno ". PASSWORD_LENGTH ." caratteri.";
        exit;
    }
    
    if ( $newpassword === $confirmpassword )  
    { 
        $password = password_hash($newpassword, PASSWORD_DEFAULT);
        
        $email = $mysqli->escape_string($_GET['email']);
        $hash = $mysqli->escape_string($_GET['hash']);
        
        $sql = "UPDATE Users SET password='$password' WHERE email='$email' AND hash='$hash'";
                 
        if ( $mysqli->query($sql) )
        {
            echo "Hai reimpostato una nuova password!";
        }
        $mysqli->close;
    }
    else
    {
        echo 'La <strong>password</strong> e <strong>conferma password</strong> devono essere uguali.<br>';
    }
}
?>