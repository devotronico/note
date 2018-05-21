<?php

if ( $_SERVER["REQUEST_METHOD"] == "POST" )
{ 
 
include_once("../connection.php"); 
$message = $email = $password = "";
$active = 0;
    
// EMAIL validation
$email = trim($_POST['email']);
$email = $mysqli->escape_string($email);
$password = trim($_POST['password']);
$password = $mysqli->escape_string($password);
    
if( empty($email) )
{
    $message .= "Il campo <strong>email</strong> è vuoto.<br>";
} 
else
{
    $email = filter_var($email, FILTER_SANITIZE_EMAIL); // Remove all illegal characters from email

    // Validate e-mail
    if ( !filter_var($email, FILTER_VALIDATE_EMAIL) ) 
    {
       
         $message .= "<strong>".$email."</strong> non è un email valida.<br>";
    }
    else
    {
        $sql = "SELECT id FROM Users WHERE email = ?"; // Prepare a select statement

        if($stmt = $mysqli->prepare($sql))
        {
            $stmt->bind_param("s", $email);   // Bind variables to the prepared statement as parameters

            if($stmt->execute())  // Attempt to execute the prepared statement
            { 
                $stmt->store_result();  // store result

                if($stmt->num_rows == 1)
                {          
                    $message .= "L' email <strong>".$email."</strong> è già presa.<br>";
                } 
            } 
            else
            {
                $message = "Qualcosa è andato storto. Per favore prova più tardi.";
            }
        }
        $stmt->close();  // Close statement    
    }
}    


// PASSWORD validation
if ( empty($password) )
{
    $message .= "Il campo <strong>password</strong> è vuoto.<br>"; 
} 
else if ( strlen($password) < PASSWORD_LENGTH )
{
    $message .= "La <strong>password</strong> deve avere almeno ". PASSWORD_LENGTH ." caratteri.<br>";
} 
else
{
    $password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
}


if ( empty($message) ) 
{
    $hash = $mysqli->escape_string( md5( rand(0,1000) ) );
    $sql = "INSERT INTO Users (email, password, hash, active) VALUES (?, ?, ?, ?)";  // Prepare an insert statement

    if($stmt = $mysqli->prepare($sql))
    {
        $stmt->bind_param("sssi", $email, $password, $hash, $active); 

        if($stmt->execute()){                             
            // PREPARA EMAIL
            $to      = $email;
            $subject = 'Account Verification ( note.it )';


            require_once('email.php');
            $body_message = email_message( $email, $hash );             

            // FUNZIONA
            $headers = 'From:noreply@danielemanzi.it' . "\r\n"; // Set from headers
            $headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";

            if ( mail($to, $subject, $body_message, $headers) ):
                echo "Abbiamo mandato una email di attivazione a <strong>$email</strong>. Per favore segui le istruzioni contenute nell'email per attivare il tuo account. Se l'email non ti arriva, controlla la tua cartella spam o prova a collegarti ancora per inviare un'altra email di attivazione."; 
            else:
                echo 'Invio email fallito!';
            endif;
        } 
        else
        {
           echo "Qualcosa è andato storto. Per favore prova più tardi.";
        }
    }
    $stmt->close();   // Close statement
}
else
{
    echo "Ci sono i seguenti errori:<br>". $message;
}
    $mysqli->close(); // Close connection 
}
?>

    


