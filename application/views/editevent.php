<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('include/header_files');?>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
           
            <!-- /.navbar-header -->
            <?php $this->load->view('include/top_header'); ?>
            <?php $this->load->view('include/top_nav'); ?>    
            
            <!-- /.navbar-top-links -->
             <?php $this->load->view('include/nav_sidebar'); ?> 
            
            <!-- /.navbar-static-side -->
        </nav>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">                   
                    <h1 class="page-header">Edit Events</h1>                   
               </div>
                <!-- /.col-lg-12 -->
            </div>
             <div class="row">
            <div class="col-lg-12 ">                   
                    <p class="well">Home-><a href="<?=base_url();?>index.php/wedding/events/<?php echo $events->project_id; ?>">Events</a><br><?php echo $error; ?></p>                  
               </div>            
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
             <span id="body_spinner_center" style="position: absolute;display: block;top: 50%;left: 50%;"></span>
                    
                     <div class="col-lg-8">
                    <div class="panel panel-primary">
                        <div class="panel-heading panel-change">
                            Edit Events
                            
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body"> 
                        <form id="AddEvent" name="AddEvent" role="form" enctype="multipart/form-data" method="post" action="http://localhost/Wedding_CI/index.php/wedding/editevent">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Event Name</label>
                         <input type="text" class="form-control" name="event_name" id="event_name"  value="<?php echo $events->eventName; ?>" readonly>
                         <input type="hidden" class="form-control" name="event_id" id="event_id"  value="<?php echo $events->event_id; ?>" readonly>
                      </div>
                      
                        <div class="form-group">
                        <label for="exampleInputPassword1">Event Venue</label>
                        <input type="text" class="form-control" name="event_venue" id="event_venue"  value="<?php echo $events->event_venue; ?>" required onblur="eventvenue();">
						<span id="eventvenuemsg" class="errormsg"></span>
                      </div>
                      
                        <div class="row">  
                            <div class="col-md-6">
                                <div class="form-group">
                        <label for="exampleInputPassword1">Event Date</label>
                        <input type="text" class="form-control datepicker" name="event_date" id="event_date" value="<?php echo $events->event_date; ?>" required readonly onblur="evedatevalid()"> 
                          <span id="evedatemsg" class="errormsg"></span>          
                                  
                                </div> 
                            </div>
                             <div class="col-md-6">
                                <div class="form-group">
                        <label for="exampleInputPassword1">Event Time</label>
                        <input type="text" class="form-control" name="event_time" id="event_time" value="<?php echo $events->event_time; ?>" required onblur="evetimemax()">
						<span id="evetimemsg" class="errormsg"></span>  
                      
                                </div> 
                            </div>
                        </div>  
                      <div class="form-group">
                        <label for="exampleInputPassword1">Event Address</label>
                          <textarea  class="form-control" name="event_add"  required onblur="evedaddval()"><?php echo $events->event_add; ?></textarea>
						   <span id="msgeveadd" class="errormsg"></span>
                      </div>
                       
                    <div class="form-group">
                        <div id="error"></div>
                      </div>    
                      
                  </div>
                  <div class="modal-footer">
                      <input type="submit"  class="btn btn-default" value="Save" id="upload" name="upload">
                  </div>
                    </form>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                    </div>
                
            <!-- /.row -->
      
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
     <?php $this->load->view('include/script_files'); ?>
    <!-- jQuery -->

<style>
.datepicker{z-index:1151 !important;} 
</style>
<script>
$(function(){
$('.datepicker').datepicker()
});
</script>
</body>

</html>
