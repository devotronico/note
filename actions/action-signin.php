<?php 
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST")
{ 
include_once("../connection.php"); 
  
// EMAIL validation
$email = trim($_POST['email']);
$email = $mysqli->escape_string($email);

$password = trim($_POST['password']);
$password = $mysqli->escape_string($password);
    
if( empty($email) )
{
    echo "Il campo <strong>email</strong> è vuoto.<br>";
    exit;
} 
/*
if ( empty($password) )
{
    echo "Il campo <strong>password</strong> è vuoto.<br>"; 
    exit;
} 
  */
$res = $mysqli->query("SELECT * FROM Users WHERE email='$email'");

if ( $res->num_rows == 0 )
{ 
    echo "La tua <strong>email</strong> è errata."; //echo $_SESSION['message'];
}
else
{ 
    $user = $res->fetch_assoc(); 
    
    if ( password_verify($password, $user['password']) )
    {
        if ( $user['active'] == 0 )
        {
            $email = $user['email'];
            $hash = $user['hash'];
            // PREPARA EMAIL
            $to      = $email;
            $subject = 'Account Verification ( note.it )';
            $message_body = '
            Grazie per esserti registrato!

            Per favore clicca su questo link per attivare il tuo account: 

            https://www.danielemanzi.it/6-note/?log=verify&email='.$email.'&hash='.$hash;   

            $headers = 'From:noreply@danielemanzi.it' . "\r\n"; 

            mail( $to, $subject, $message_body, $headers );

            echo "Prima di loggarti ti chiediamo di confermare la tua iscrizione.<br>
            Un link di conferma è stato mandato alla tua casella di posta <strong>$email</strong>,<br>
            per verificare il tuo account clicca sul link che trovi nella mail che ti abbiamo inviato!"; 
        }
        else
        {   
            $_SESSION['id'] = $user['id']; 
            $_SESSION['email'] = $user['email'];
            $_SESSION['ip'] = $user['ip'];
            $_SESSION['active'] = $user['active'];
            
            if ( array_key_exists('setcookie', $_POST) && $_POST['setcookie'] == '1')
            {
                setcookie('id', $_SESSION['id'], time()+60*60*24*365); 
            }
            echo 'SUCCESS';
        }
    }
    else 
    {
        echo "Questa <strong>password</strong> è errata, riprova."; //echo $_SESSION['message'];
    }
    $res->close();
}
$mysqli->close();
}
?>


