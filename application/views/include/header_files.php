<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>DMS Info Admin Template</title>

    <!-- Bootstrap Core CSS -->
    
    <link href="<?=base_url()?>bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?=base_url()?>bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="<?=base_url()?>dist/css/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?=base_url()?>dist/css/sb-admin-2.css" rel="stylesheet">
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker.css" rel="stylesheet">
    
    <link href="" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="<?=base_url()?>bower_components/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?=base_url()?>bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    
     <script src="<?=base_url()?>bower_components/jquery/dist/jquery.js"></script>
    
     <script src="<?=base_url()?>bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?=base_url()?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?=base_url()?>bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="<?=base_url()?>bower_components/raphael/raphael-min.js"></script>

    

    <!-- Custom Theme JavaScript -->
    <script src="<?=base_url()?>dist/js/sb-admin-2.js"></script>
    
    <script src="<?=base_url()?>dist/js/bootstrap-datepicker.js"></script>
    
    <script src="<?=base_url()?>dist/js/spin.min.js"></script>
    
    <script src="<?=base_url()?>js/werp.js"></script>

<script src="<?=base_url()?>js/jquery.dataTables.min.js"></script>

<script src="<?=base_url()?>js/jquery.dataTables.bootstrap.js"></script>

<script src="<?=base_url()?>js/spin.min.js"></script>
    
<script type="text/javascript" src="<?=base_url()?>js/bootbox.min.js"></script>    


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>


  <div id="resetPass" class="modal fade" role="dialog">
              <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal" >&times;</button>
                    <h4 class="modal-title ">Reset Password</h4>
                  </div>
                  <div class="modal-body">
                    <form id="resetPass" method="POST" action="<?=base_url()?>index.php/wedding/resetPass" role="form" >
                        <div class="form-group">
                        <label for="exampleInputEmail1">New Password</label>
                        <input type="Password" class="form-control" name = "password" id="password" placeholder="Password" required> 
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Confirm New Password</label>
                        <input type="text" class="form-control" name="confirm_pass" id="confirm_pass" placeholder="Confirm New Password" required>
                      </div>
                      
                       <div class="form-group">
                        <div id="error"></div>
                      </div>  
                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-default">Reset</button>
                  </div>
                      </form>
                </div>

              </div>
            </div>