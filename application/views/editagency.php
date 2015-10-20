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
                    <p class="well">Home-><a href="<?=base_url();?>index.php/wedding/agency">Agency</a><br><?php echo $error; ?></p>                  
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
                        <form id="EditAgency" method="POST" action="<?=base_url()?>index.php/wedding/editagency" role="form" >
                        <div class="form-group">
                        <label for="exampleInputEmail1">Agency Name</label>
                        <input type="text" class="form-control" name = "agency_name" id="agency_name" placeholder="Agency Name" value="<?php echo $agency->agency_name ; ?>"> 
                             <input type="hidden" class="form-control" name="agency_id" id="agency_id"  value="<?php echo $agency->agency_id; ?>" readonly>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Person Name</label>
                        <input type="text" class="form-control" name="contact_person_name" id="contact_person_name" placeholder="Person Name" value="<?php echo $agency->contact_person_name ; ?>">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Contact No</label>
                        <input type="text" class="form-control" name="mobile" id="mobile" placeholder="Contact No" value="<?php echo $agency->mobile ; ?>">
                      </div>
                      
                      <div class="form-group">
                        <label for="exampleInputPassword1">Work Description</label>
                        <input type="text" class="form-control" name="work_desc" id="work_desc" placeholder="Address" value="<?php echo $agency->work_desc ; ?>">
                      </div> 
                      
                       <div class="form-group">
                        <div id="error"></div>
                      </div>  
                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-default" data-dismiss="close">Save</button>
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
