<!-- Optional JavaScript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>

<script>

var load = false; 
var email_in = '';  
var pass_in =  '';
var email_up = '';   
var pass_up = '';


$('.switch-form').click(function() {   
    
    if($(this).prop('id')=='id-signin')
    { 
        $(this).addClass('active').removeClass('notactive');
        $('#id-signup').addClass('notactive').removeClass('active');
        $('#form-signin').show();
        $('#form-signup').hide();
        email_in = $('#signin-email').val();
        pass_in = $('#signin-password').val();
        if ( email_in == '' ||  pass_in == '')
        {
            $('#submit-signin').prop('disabled', true);  
        }
        else
        {
            $('#submit-signin').prop('disabled', false);  
        }
    }
    else
    {
        $(this).addClass('active').removeClass('notactive');
        $('#id-signin').addClass('notactive').removeClass('active');
        $('#form-signin').hide();
        $('#form-signup').show();
        email_up = $('#signup-email').val();
        pass_up = $('#signup-password').val();
        if ( email_up == '' ||  pass_up == '')
        {
            $('#submit-signup').prop('disabled', true);  
        }
        else
        {
            $('#submit-signup').prop('disabled', false);  
        }  
    }
    
}); 
    

setTimeout(function(){ load = true; }, 2000);
$('.form-control').keyup(function () { // controlla se viene premuto un tasto alert('ciao'); 
if ( load ) {   
    if ( $('#form-signin').is(':visible') )  // controlla se il form  SIGNIN è visibile
    { 
        email_in = $('#signin-email').val(); 
        pass_in = $('#signin-password').val(); 
        if ( email_in == '' ||  pass_in == '')
        {
            $('#submit-signin').prop('disabled', true);  
        }
        else
        {
            $('#submit-signin').prop('disabled', false);  
        }
    }
    else if ( $('#form-signup').is(':visible') ) // controlla se il form  SIGNUP è visibile
    {
        email_up = $('#signup-email').val();
        pass_up = $('#signup-password').val();
        if ( email_up == '' || pass_up == '')
        {
            $('#submit-signup').prop('disabled', true);  
        }
        else
        {
            $('#submit-signup').prop('disabled', false);  
        }  
    }
    } //chiude load
})



/*SIGNUP*E*SIGNUP******************************************SIGNUP*E*SIGNUP*********************************************SIGNUP*E*SIGNUP*/    
$('.btn-submit').click(function(event){  
    event.preventDefault();
 
    if ( $(this).prop('id') == 'submit-signup' )
    {
        var email = $('#signup-email').val();
        var pass = $('#signup-password').val();
        $.ajax({
            type: 'POST',
            datatype: 'text',
            url: 'actions/action-signup.php',
            data: {email: email, password: pass },
            beforeSend: function(){ 
           },
            success: function(result){ 
                result = result.trim();
                var char = result.substring(0,1);
                if ( char == 'A' )
                {
                $('#message-signup').html(result);
                }
                else
                {
                $('#message-signup').html(result);
                }    
            },
           error: function(){
           }
        })  
    }
    else if ( $(this).prop('id') == 'submit-signin' )
    {
        var email_in = $('#signin-email').val();
        var pass_in = $('#signin-password').val();
        var setcookie = $('#setcookie').val();
        $.ajax({
            url: 'actions/action-signin.php',
            method: 'post',
            datatype: 'text',
            data: {email: email_in, password: pass_in, setcookie: setcookie },
            beforeSend: function(){

            },
            success: function(result){ 
                
                result = result.trim();
                var char = result.substring(0,1);
                if ( char == 'S' )
                {
                window.location.assign("http://www.danielemanzi.it/6-note/?page=textarea");
                }
                else
                {
                $('#message-signin').html(result);
                }    
            },
            error: function(){

            }
        })
    }  
    else if ( $(this).prop('id') == 'submit-recovery' )
    {
        var email = $('#email-recovery').val();
        $.ajax({
            type: 'POST',
            datatype: 'text',
            url: 'actions/action-recoverypass.php',
            data: {email: email },
            beforeSend: function(){ 
           },
            success: function(result){ 
                result = result.trim();
                var char = result.substring(0,1);
                if ( char == 'T' )
                {
                    $('#message-recovery').html(result);
                }
                else
                {
                    $('#message-recovery').html(result);
                }    
            },
           error: function(){
           }
        })  
    }
    else if ( $(this).prop('id') == 'submit-newpass' )
    {
        var newpassword = $('#new-password').val();
        var confirmpassword =$('#conf-new-password').val();
        $.ajax({
            type: 'POST',
            datatype: 'text',
            url: 'actions/action-newpass.php',
            data: {newpassword: newpassword, confirmpassword: confirmpassword },
            beforeSend: function(){ 
           },
            success: function(result){
                result = result.trim();
                var char = result.substring(0,1);
                if ( char == 'H' )
                {
                    $('#message-newpass').html(result);
                }
                else
                {
                    $('#message-newpass').html(result);
                }    
            },
           error: function(){
           }
        })  
    }
});
 
    
   
/*TEXTAREA*************************TEXTAREA******************************************************************************TEXTAREA*/
$('textarea').bind("input propertychange", function() { 
$.ajax({
    method: 'POST',
    url: 'updatedatabase.php', 
    data: {content:  $('textarea').val() },
    success: function(result)
    {
          $('textarea').html(result);
        console.log(result);
        //alert(result);
    }
});
}); 
</script> 
</body>
</html>