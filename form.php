<div class='container'>
    <h1 class="container-title"><i class="far fa-sticky-note"></i>&nbsp;Note</h1>

   <div id='switch-box'>
     <div class="switch-form active" id="id-signin">Accedi</div><div class="switch-form notactive" id="id-signup">Registrati</div>
    </div>
    
    <!---------------------------REGISTRATI-------------------------------------->
    <form id='form-signup' autocomplete='off'>
       <div class="message" id="message-signup"></div> 
        <div class="form-group">
         <!---    <label for="email">Email address</label> ----->
        <i class="far fa-envelope fa-lg"></i>
<input type="email" class="form-control" id="signup-email" name="email" aria-describedby="emailHelp" placeholder="Enter email">
           
        </div>
        <div class="form-group">
         <!---    <label for="password">Password</label> ----->
           <i class="fas fa-key fa-lg"></i> 
            <input type="password" class="form-control" id="signup-password" name="password" placeholder="Password">
        </div>
        <button type="submit" class="btn btn-primary btn-lg btn-submit" id="submit-signup">Registrati</button>
    </form>

    <!---------------------------ACCEDI-------------------------------------->
   
    <form method='post' id='form-signin'>
        <div class="message" id="message-signin"></div> 
        <div class="form-group">
           <!---   <label for="email">Email address</label> -------->
             <i class="far fa-envelope fa-lg"></i>  
             <input type="email" class="form-control" id="signin-email" name="email" aria-describedby="emailHelp" placeholder="Enter email">
        </div>
        <div class="form-group">
         <!---     <label for="password">Password</label> -------->
               <i class="fas fa-key fa-lg"></i>  
            <input type="password" class="form-control" id="signin-password" name="password" placeholder="Password">
            <a href="?page=inputemail"><small id="password-forgot" class="form-text text-muted">password dimenticata?</small></a>
        </div>
        <div class="form-check">
            <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name='setcookie' value=1>&nbsp;Rimani loggato
            </label>
        </div>        
        <button type="submit" class="btn btn-primary btn-lg btn-submit" id="submit-signin">Accedi</button>
    </form> 
      
</div>