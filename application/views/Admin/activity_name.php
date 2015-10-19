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
                            Add Activity
                        </div>
                        <!-- /.panel-heading -->
                        <div class="">
                  
                  <div class="modal-body" >
                    <form id="AddActivity" method="POST" action="<?=base_url()?>index.php/admin/activity_name" role="form" >
                        
                        <div class="form-group">
                        <label for="exampleInputEmail1">Event Name</label>
                        <select name="event_id" id="event_id" class="form-control" required>
                        <?php if($event_names){  ?> <option value="" selected>Select</option> <?php
                                            foreach($event_names as $event) { ?>
                                            <option value="<?php echo $event['event_id']; ?>"><?php echo $event['event_name']; ?></option>                                                
                                            <?php }
                                             } 
                                             else { 
                                             ?> <option value="" selected>No Records Found</option>
                                             <?php }  ?>    
                       
                            
                          
                        </select>
                                                 

                      </div>
                        
                        
                        
                        
                        <div class="form-group">
                        <label for="exampleInputEmail1">Activity Name</label>
                        <input type="text" class="form-control"  name = "Activity_Name" id="Activity_Name" placeholder="Activity Name" required> 
                        </div>
                      
                        
                        <div class="form-group">
                        <label for="exampleInputEmail1">Activity Details</label>
                        <input type="text" class="form-control"  name = "Activity_Details" id="Activity_Details" placeholder="Activity Details" required> 
                        </div>
                        
                        
                         <div class="form-group">
                        <label for="exampleInputEmail1">Activity Remark</label>
                        <input type="text" class="form-control"  name = "Activity_Remark" id="Activity_Remark" placeholder="Activity Remark" required> 
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
      function submit()
    {
     
          //console.log($('input[name=Event_Name]').val());
         // get the form data
         // there are many ways to get this data uSign jQuery (you can use the class or id also)
         var formData = {
             'event_name': $("#event_id").val(),
             
             'Activity_Name'              : $('input[name=Activity_Name]').val(),
             'Activity_Details'              : $('input[name=Activity_Details]').val(),
             'Activity_Remark'              : $('input[name=Activity_Remark]').val()
            
            
         };
   // console.log(formData);
         

         
        $.ajax({
             type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
             url         : 'http://localhost/Wedding_CI/index.php/admin/addActivityname', // the url where we want to POST
             data        : formData, // our data object
             dataType    : 'json', // what type of data do we expect back from the server
             encode          : true
         })
         // uSign the done promise callback
         .done(function(data) {

             // log data to the console so we can see
             if(data.success == true){
              bootbox.alert(data.message);
              $("#AddActivity")[0].reset();
     
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
