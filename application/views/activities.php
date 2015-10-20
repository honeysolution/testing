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
                    <h1 class="page-header">Activities  </h1>                   
               </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
                <div class="col-lg-12 ">                   
                    <p class="pull-right"><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#ActivityModel">Add Activities</button></p>                  
               </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading panel-change">
                            Activities  (<?php echo sizeof($activity); ?>)                           
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Activity Name</th>
                                            <th>Activity Type</th>
                                            <th>Activity Agency</th>
                                            <th>Description</th>
                                            <th>Order Date</th>
                                            <th>Contact Person</th>
                                            <th>Contact Number</th>                                            
                                            <th>Status</th>
                                            <th>Operation</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if($activity) { $i = 1 ; foreach($activity as $data) { ?>
                                        <tr class="data_display">
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $data['activityName']; ?></td>
                                            <td><?php echo $data['activity_type']; ?></td>
                                            <td><?php echo $data['agencyName']; ?></td>
                                            <td><?php echo $data['asgn_detail_work']; ?></td>
                                            <td><?php echo $data['asgn_max_time']; ?></td>
                                              <td> <?php echo $data['contact_per']; ?></td> 
                                            <td> <?php echo $data['contact_mob']; ?></td>  
                                            <td><?php  echo $data['status'] == "Inprocess" ? '<button type="button" class="btn btn-danger" id="activityStatus" data-id="'.$data['assign_project_event_activity_id'].'" event-id="'.$data['event_id'].'" activity-id="'.$data['activity_id'].'" >Inprocess</button>' : '<button type="button" class="btn btn-success">Deliver</button>'; ?></td>  
                                            <td>
                                                
                                                <!--<a href="<?=base_url()?>index.php/wedding/Activities/<?php //echo $data['assign_project_event_activity_id'];  ?>" data-toggle="tooltip" data-placement="left" title="Edit"><i class="fa fa-jsfiddle fa-fw"></i>&nbsp;</a>-->
                                                <a href="#" id="<?php echo $data['assign_project_event_activity_id'];  ?>" data-toggle="tooltip" data-placement="left" title="Delete" class="deleteActivity"><i class="fa fa-times fa-fw"></i>&nbsp;</a>
                                            </td>                                           
                                        </tr>
                                        <?php $i++;}
                                        } 
                                        else
                                        { ?> <tr><td colspan="6"><center>No any activity</center></td></tr><?php } ?>                                        
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
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
   <!-- /#wrapper -->
    <?php $this->load->view('include/script_files'); ?> 
    <!-- jQuery -->
    <!-- Modal -->
            <div id="ActivityModel" class="modal fade" role="dialog">
              <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" onclick="javascript:window.location.reload()" >&times;</button>
                    <h4 class="modal-title ">Add Activity</h4>
                  </div>
                  <div class="modal-body">
                      <span id="body_spinner_center" style="position: absolute;display: block;top: 50%;left: 50%;z-index: 0;"></span>
                    <form id="AddActivity"  role="form" >
                     <div class="row">  
                            <div class="col-md-6">    
                      <div class="form-group">
                        <label for="exampleInputEmail1">Activity Name</label>
                          <input type="hidden" value="<?php echo $event->project_id; ?>" name="project_id">
                        <select name="activity_id" id="activity_id" class="form-control"  required>
                        <?php if($activity_name){  ?> <option value="" selected>Select</option> <?php
                                            foreach($activity_name as $event) { ?>
                                            <option value="<?php echo $event['activity_id']; ?>"><?php echo $event['activity_name']; ?></option>                                                
                                            <?php }
                                             } 
                                             else { 
                                             ?> <option value="" selected>No Records Found</option>
                                             <?php }  ?>    
                       
                            
                          
                        </select>
                          
                       </div>
                         </div>
                          <div class="col-md-6">    
                      <div class="form-group">
                        <label for="exampleInputPassword1">Activity Agency</label>
                       <select class="form-control" id="agency_id" name="agency_id">
                          <option value="" selected>Select</option>
                          <?php if($agency){  ?> <option value="" selected>Select</option> <?php
                                            foreach($agency as $agency) { ?>
                                            <option value="<?php echo $agency['agency_id']; ?>"><?php echo $agency['agency_name']; ?></option>                                                
                                            <?php }
                                             } 
                                             else { 
                                             ?> <option value="" selected>No Records Found</option>
                                             <?php }  ?>  
                        </select>
                      </div> 
                         </div>
                        </div>
                         <div class="row">  
                            <div class="col-md-6">    
                         <div class="form-group">
                        <label for="exampleInputPassword1">Activity Type</label>
                       <select name="activity_type" class="form-control" required>
                            <option value="">Select</option>
                            <option value="Decoration">Decoration</option>
                            <option value="Food">Food</option>
                            </select>
                      </div>
                             </div>
                             <div class="col-md-6">    
                         <div class="form-group">
                        <label for="exampleInputPassword1">Activity Image</label>
                        <input type="file" class="form-control" name="userfile" id="userfile" placeholder="Activity Image" required>
                      </div>
                             </div>
                        </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Work Details</label>
                        <textarea  class="form-control" name="asgn_detail_work" id="asgn_detail_work" required></textarea>
                      </div> 
                        <div class="row">  
                            <div class="col-md-6">    
                             <div class="form-group">
                        <label for="exampleInputEmail1">Contact Person</label>
                        <input type="text" class="form-control"  name = "contact_per" id="contact_per" placeholder="Contact Person" required> 
                        </div>
                            </div>
                            <div class="col-md-6"> 
                        <div class="form-group">
                        <label for="exampleInputEmail1">Contact Number</label>
                        <input type="text" class="form-control"  name = "contact_mob" id="contact_mob" placeholder="Contact Number" required> 
                        </div>
                            </div>
                        </div>
                         <div class="row">  
                            <div class="col-md-6">    
                             <div class="form-group">
                        <label for="exampleInputEmail1">Order Date</label>
                         <input type="text" class="form-control datepicker" name="asgn_max_time" id="asgn_max_time" placeholder="Order Date" required readonly> 
                        </div>
                            </div>
                            <div class="col-md-6"> 
                        <div class="form-group">
                        <label for="exampleInputEmail1">Order Status</label>
                        <select name="status" class="form-control" required>
                            <option value="">Select</option>
                            <option value="Inprocess">Inprocess</option>
                            <option value="Delever">Deliver</option>
                            </select>
                        </div>
                            </div>
                        </div>
                         
                       <div class="form-group">
                        <div id="error"></div>
                      </div>  
                  </div>
                  <div class="modal-footer">
                      <input type="hidden" value="<?php echo $event_id; ?>" name="event_id" id="event_id">
                    <input type="submit"  class="btn btn-default" value="Save">
                  </div>
                </form>
                </div>

              </div>
            </div>
        <style>
.datepicker{z-index:1151 !important;} 
</style>
<script>
$(function(){
$('.datepicker').datepicker({ startDate: '-0m'})
});
    
$(document).ready(function() {
     $('[data-toggle="tooltip"]').tooltip();
 });
 $(document).ready(function() {
     $('[data-toggle="popover"]').popover();
 });


 function get_agency(agency_id) {
     $.ajax({
         type: "POST",
         url: "<?=base_url()?>index.php/wedding/GetAgency",
         data: {
             "agency_id": agency_id
         },
         success: function(data) {
             $('#agency_id').prop('disabled', false);
             $("#agency_id").html(data);
             // $("#replaceThis").append(responseData);
         }
     });
}
</script>
</body>

</html>
