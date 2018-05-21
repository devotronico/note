<?php

    if ( $_POST ) 
    {
        include("connection.php");
        $message = '';  

        if ( !$_POST['email'] ) 
        {
            $message .= "il campo <b>email</b> è vuoto<br>";
        }
        
        if ( !$_POST['password'] ) 
        {
            $message .= "il campo <b>password</b> è vuoto";
        }
        
        if ( $message != '' )
        {
            //$message = "<p>ci sono degli errori:</p>" . $message;
            //$message = "<p>il campo .$message.</p>" . $message;
            $message = "compila i campi email e password<b>";
        }
        else
        {
            if ( $_POST['signUp'] == '1')
            {
                $email = mysqli_real_escape_string($link, $_POST['email']);
                $query = "SELECT email FROM diario WHERE email = '". $email . "'LIMIT 1";
                $result = mysqli_query($link, $query);
                if ( mysqli_num_rows($result) > 0 )
                {
                    $message = 'email già registrata<br>';
                }
                else
                {
                    $password = mysqli_real_escape_string($link, $_POST['password']);
                    $query = "INSERT INTO diario (email, password) values('" . $email . "', '" . $password . "')";
                    if ( !mysqli_query($link, $query))
                    {
                         $message = 'registrazione NON avvenuta<br>';
                    }
                    else
                    {
                        $password = md5(md5(mysqli_insert_id($link)).$password);
                        $query = "UPDATE diario SET password = '".$password."' WHERE id = ".mysqli_insert_id($link)." LIMIT 1";
                        mysqli_query($link, $query);
                        $_SESSION['id'] = mysqli_insert_id($link);
                        if ( array_key_exists('stayloggedIn', $_POST) && $_POST['stayloggedIn'] == '1')
                        {
                            setcookie('id', mysqli_insert_id($link), time()+60*60*24*365);
                        }
                        //$message = 'registrazione completata<br>';
                        header("Location: loggedinpage.php");
                    }
                }
            }
            else if ( $_POST['signUp'] == '0')
            {
                $email = mysqli_real_escape_string($link, $_POST['email']);
                $query = "SELECT * FROM diario WHERE email = '". $email . "'LIMIT 1";
                $result = mysqli_query($link, $query);
                if ( mysqli_num_rows($result) == 1 )
                {
                    $row = mysqli_fetch_assoc($result);
                    $password = md5(md5($row['id']).$_POST['password']);
                    if ( $row['password'] == $password )
                    {
                        if ( array_key_exists('stayloggedIn', $_POST) && $_POST['stayloggedIn'] == '1')
                        {
                            setcookie('id', $row['id'], time()+60*60*24*365); 
                        }
                        $_SESSION['id'] = $row['id'];
                        header("Location: loggedinpage.php");  
                    } 
                    else
                    {
                        $message = 'password errata<br>';
                    }
                }
                else
                {
                     $message = 'email errata<br>';
                }
            }
        }
    }
*/
?>