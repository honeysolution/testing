<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('include/header_files');?>

<body>

<div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <h1>Wedding Admin Panel</h1>
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                    <div class="panel-body">
                          <form  id="LoginForm" method="POST" action="<?=base_url()?>index.php/admin/login">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="E-mail" name="username" id="username" type="text" >
                                </div>
                                <div class="form-group">
                                   <input type="password" class="form-control" id="apassword" name="apassword" placeholder="Password" required>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                    </label>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <p class="btn btn-lg btn-success btn-block" onclick="submit()">Login</p>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
<?php $this->load->view('include/script_files'); ?> 
    </body>
</html>
<script>
      function submit() {

         // get the form data
         // there are many ways to get this data uSign jQuery (you can use the class or id also)
         var formData = {
             'username'              : $("#username").val(),
             'password'             : $("#apassword").val()

         };
          console.log(formData);
        
         $.ajax({
             type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
             url         : '<?=base_url()?>index.php/admin/login', // the url where we want to POST
             data        : formData, // our data object
             dataType    : 'json', // what type of data do we expect back from the server
             encode          : true
         })
         // uSign the done promise callback
         .done(function(data) {

             // log data to the console so we can see
             if(data.success == true){
               //  box.modal('hide');                
                 location.href='<?=base_url()?>index.php/admin/dashboard';
             } else {
                  document.getElementById('error').style.display = "block";
                 $('#error').html(data.error);
             }
            
             // here we will handle errors and validation messages
         });
      }
</script>
