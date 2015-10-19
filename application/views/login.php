
<!DOCTYPE html>
<html>
<head>
 
  <meta charset="UTF-8">  
  <title>Weeding Planner</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:700,400&amp;subset=cyrillic,latin,greek,vietnamese">
  <link href="bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="<?=base_url()?>assets/animate.css/animate.min.css">
  <link href="<?=base_url()?>dist/css/style.css" rel="stylesheet">
  <link rel="stylesheet" href="<?=base_url()?>assets/honeysol/css/mbr-additional.css" type="text/css">
     <script src="<?=base_url()?>bower_components/jquery/dist/jquery.min.js"></script>
  
  
</head>
<body>
<section class="mbr-box mbr-section mbr-section--full-height mbr-section--bg-adapted mbr-parallax-background" id="header1-1" style="background-image: url(<?=base_url()?>images/bg.jpg);">
    <div class="mbr-box__magnet mbr-box__magnet--sm-padding mbr-box__magnet--center-center">
        
        <div class="mbr-box__container mbr-section__container container">
            <div class="mbr-box mbr-box--stretched"><div class="mbr-box__magnet mbr-box__magnet--center-center">
                <div class="mbr-hero animated fadeInUp">
                    <h1 class="mbr-hero__text">Wedding Planner Portal-Login</h1>
                </div>
                <div class="mbr-buttons btn-inverse mbr-buttons--center">
                <div class="panel panel-default">
                <div class="panel-body">
                    
                            <form class="form-inline" id="LoginForm" method="POST" action="<?=base_url()?>index.php/wedding/login">
                              <div class="form-group">
                                <label class="sr-only" for="exampleInputEmail3">Email address</label>
                                <input type="email" class="form-control" id="username" name="username" placeholder="Email" required>
                              </div>
                              <div class="form-group">
                                <label class="sr-only" for="exampleInputPassword3">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                              </div>
                              
                              <p class="btn btn-default" onclick="submit()">Sign in</p>
                            </form>
                    <div id="error" style="display:none;" >
                    </div>
                    </div>
              </div>
                    
              </div>
                
            </div></div>
        </div>
        <div class="mbr-arrow mbr-arrow--floating text-center">
            <div class="mbr-section__container container">
                <a class="mbr-arrow__link" href=""><i class="glyphicon glyphicon-menu-down"></i></a>
            </div>
        </div>
    </div>
</section>
</body>
</html>
<script>
      function submit() {

         // get the form data
         // there are many ways to get this data uSign jQuery (you can use the class or id also)
         var formData = {
             'username'              : $("#username").val(),
             'password'             : $("#password").val()

         };
        
         $.ajax({
             type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
             url         : '<?=base_url()?>index.php/wedding/login', // the url where we want to POST
             data        : formData, // our data object
             dataType    : 'json', // what type of data do we expect back from the server
             encode          : true
         })
         // uSign the done promise callback
         .done(function(data) {

             // log data to the console so we can see
             if(data.success == true){
               //  box.modal('hide');                
                 location.href='<?=base_url()?>index.php/wedding/dashboard';
             } else {
                  document.getElementById('error').style.display = "block";
                 $('#error').html(data.error);
             }
            
             // here we will handle errors and validation messages
         });
      }
</script>

