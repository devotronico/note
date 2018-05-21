<?php   
if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) 
{  

    include("../connection.php"); 
    
    $email = trim($_POST['email']);
    $email = $mysqli->escape_string($email);
    
    if (empty($email) )
    { 
        echo "Il campo <strong>email</strong> è vuoto.";
        exit;
    } 
    
    $res = $mysqli->query("SELECT * FROM Users WHERE email='$email'");
    
    if ( $res->num_rows == 0 ) 
    { 
        echo "Questo utente non è registrato!"; 
    }
    else 
    { 
        $user = $res->fetch_assoc(); 
        
        $email = $user['email'];
        $hash = $user['hash'];

        $to      = $email;
        $subject = 'Password Reset Link ( note.it )';
        require_once('email-recoverypass.php');
        $message_body = email_message( $email, $hash ); 
    
        $headers = 'From:noreply@danielemanzi.it' . "\r\n"; 
        $headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
        
        if ( mail($to, $subject, $message_body, $headers) ):
            echo "Ti è stata mandata una mail a <strong>$email</strong> per reimpostare la tua password";
        else:
            echo 'Invio email fallito!';
        endif;

        $res->close();
    }
    $mysqli->close();
}

?>