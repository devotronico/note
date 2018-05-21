  <?php
session_start();
    $message = '';
    $text = '';
    if ( array_key_exists('id', $_COOKIE) )
    {
       $_SESSION['id'] = $_COOKIE['id']; 
    }
       
    if ( array_key_exists('id', $_SESSION)  )
    {
        include("connection.php");
        $id = (int)$_SESSION['id'];
        $res = $mysqli->query("SELECT * FROM Users WHERE id = $id LIMIT 1");
        $row = $res->fetch_assoc();
        $text = $row['testo'];
        $email = $row['email'];
        $message = $row['email']."sei loggato!";
    }
    else
    {
        header("Location: index.php");
    }
?>

 
   
             
      <div id="container">
        <nav class="navbar navbar-expand-xl navbar-light navbar-custom  ">
<!--            <a class="navbar-brand" href="#">Diario segreto</a>-->
               <a class="navbar-brand" href="#"><i class="far fa-sticky-note"></i>&nbsp;Note</a>
            <span class="navbar-text"><?=$message?></span>
            <div class="navbar-nav ml-auto">
            
            
            
<!--
  <form method='post' id='form-logout'>
      <input type='hidden' name='sign' value='out'>
        <button type="submit" class="btn btn-primary btn-lg">Logout</button>
    </form> 
-->
           
           
           
                <a href="?page=logout"><button type="submit" class="btn btn-primary btn-lg">Logout</button></a>
            
            
            
            </div>
        </nav>
        <textarea><?php echo $text; ?></textarea>
    </div>
<?php include("footer.php"); ?> 