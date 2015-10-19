<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('include/header_files');?>

<body>
    

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
           
            <!-- /.navbar-header -->
            <?php $this->load->view('include/top_header'); ?>
            <?php $this->load->view('include/top_nav_admin'); ?>    
            
            <!-- /.navbar-top-links -->
             <?php $this->load->view('include/nav_sidebar_admin'); ?> 
            
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <div class="row">
                
                <!-- /.col-lg-12 -->
            </div>
            
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary ">
                        <div class="panel-heading  panel-change">
                            Add Project
                        </div>
                        <!-- /.panel-heading -->
                        <div class="">
                  
                  <div class="modal-body" >
                    <form id="AddProject" method="POST" action="<?=base_url()?>index.php/admin/project_master" role="form" >
                        <div class="form-group">
                        <label for="exampleInputEmail1">Project Name</label>
                        <input type="text" class="form-control"  name = "PROJECT_NAME" id="PROJECT_NAME" placeholder="Project Name" required> 
                        </div>
                      
                          
                        
                        
                         <label for="exampleInputEmail1">Project Type</label>
                        <select class="form-control" name="PROJECT_TYPE" id="PROJECT_TYPE">
                            
                                    <option value="" selected>Select Type</option>
                                    <option>Wedding</option>
                                    <option>Birthday</option>
                                    
                        </select>
                        
                          <div class="form-group">
                        <label for="exampleInputPassword1">Project Description</label>
                          <textarea  class="form-control" name="PROJECT_DESC" id="PROJECT_DESC" required></textarea>
                      </div>
                        
                         <div class="form-group">
                        <label for="exampleInputEmail1">Project City</label>
                        <input type="text" class="form-control"  name = "PROJECT_CITY" id="PROJECT_CITY" placeholder="Project City" required> 
                        </div>
                        
                        
                        
                        
                         <div class="form-group">
                        <label for="exampleInputEmail1">Start Date</label>
                        <input type="text" class="form-control datepicker"  name = "START_DATE" id="START_DATE" placeholder="Start Date" required> 
                        </div>
                        
                         
                       
                        
                         
                  </div>
                  <div class="modal-footer">
                    <a class="btn btn-default" onclick="submit()">Save</a>
                    <button type="submit" class="btn btn-default">Cancel</button>
                  </div>
                      </form>
                </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
            <!-- /.row -->
      
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
    <?php $this->load->view('include/script_files'); ?> 
    <!-- jQuery -->
                    
    <script>
$(function(){
$('.datepicker').datepicker()
});
</script>                
        
        
<script>
      function submit()
    {
     
          //console.log($('input[name=Event_Name]').val());
         // get the form data
         // there are many ways to get this data uSign jQuery (you can use the class or id also)
         var formData = {
            
             'PROJECT_NAME': $("#PROJECT_NAME").val(),
             'PROJECT_TYPE': $("#PROJECT_TYPE").val(),
             'PROJECT_DESC': $("#PROJECT_DESC").val(),
             'PROJECT_CITY': $("#PROJECT_CITY").val(),
             'START_DATE': $("#START_DATE").val()
           
             
             
             /*
             'PROJECT_NAME'              : $('input[name=PROJECT_NAME]').val(),
             'PROJECT_TYPE'              : $('input[name=PROJECT_TYPE]').val(),
             'PROJECT_DESC'              : $('input[name=PROJECT_DESC]').val(),
             'PROJECT_CITY'              : $('input[name=PROJECT_CITY]').val(),
             'START_DATE'                : $('input[name=START_DATE]').val(),
            
            */
            
         };
         
   // console.log(formData);
         

         
        $.ajax({
             type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
             url         : 'http://localhost/Wedding_CI/index.php/admin/addProjectname', // the url where we want to POST
             data        : formData, // our data object
             dataType    : 'json', // what type of data do we expect back from the server
             encode          : true
         })
         // uSign the done promise callback
         .done(function(data) {

             // log data to the console so we can see
             if(data.success == true){
              bootbox.alert(data.message);
              $("#AddProject")[0].reset();
     
             } else {
                 bootbox.alert(data.message);
                 $('#error').html(data.error);
             }
           
             // here we will handle errors and validation messages
         });
    }
</script>                
        
   

</body>

</html>
