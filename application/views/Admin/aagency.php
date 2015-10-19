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
                <div class="col-lg-12">                   
                    <h1 class="page-header">Agency</h1>                   
               </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
                <div class="col-lg-12 ">                   
                    <p class="pull-right"><a href="<?php echo base_url()?>index.php/admin/agencyexcel" class="btn btn-info"><i class="glyphicon glyphicon-log-in"></i>&nbsp;&nbsp;Export Excel</a></p>                  
               </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading panel-change">
                            Agency (<?php echo sizeof($agency); ?>)
                            
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Agency Name</th>
                                            <th>Person Name</th>
                                            <th>Contact No</th>
                                            <th>Description</th>
                                            <th>Activity</th>
                                            <th>Added By</th>
                                            
                                        </tr>
                                    </thead>
                                     <tbody>
                                        <?php if($agency) { $i = 1 ; foreach($agency as $data) { ?>
                                        <tr class="data_display">
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $data['agency_name']; ?></td>
                                            <td><?php echo $data['contact_person_name']; ?></td>
                                            <td><?php echo $data['mobile']; ?></td>
                                            <td><?php echo $data['work_desc']; ?></td>                                                                                      
                                            <td><?php echo $data['activityName']; ?></td>                                                                                      
                                            <td><?php echo $data['username']; ?></td>                                                                                      
                                           </tr>
                                        <?php $i++;}
                                        } 
                                        else
                                        { ?> <tr><td colspan="6"><center>No any Events</center></td></tr><?php } ?>                                        
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
     <?php $this->load->view('include/script_files'); ?>
    <!-- jQuery -->

       <div id="AgencyModel" class="modal fade" role="dialog">
              <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal" onclick="javascript:window.location.reload()" >&times;</button>
                    <h4 class="modal-title ">Add Agency</h4>
                  </div>
                  <div class="modal-body">
                    <form id="AddAgency" method="POST" action="<?=base_url()?>index.php/wedding/addAgency" role="form" >
                        <div class="form-group">
                        <label for="exampleInputEmail1">Agency Name</label>
                        <input type="text" class="form-control" name = "agency_name" id="agency_name" placeholder="Agency Name" required> 
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Person Name</label>
                        <input type="text" class="form-control" name="contact_person_name" id="contact_person_name" placeholder="Person Name" required>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Contact No</label>
                        <input type="text" class="form-control" name="mobile" id="mobile" placeholder="Contact No" required>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Work Description</label>
                        <input type="text" class="form-control" name="work_desc" id="work_desc" placeholder="Address" required>
                      </div> 
                        <div class="form-group">
                        <label for="exampleInputEmail1">Activity Name</label>
                        <select name="activity_id" id="activity_id" class="form-control" required>
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
                       <div class="form-group">
                        <div id="error"></div>
                      </div>  
                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-default">Save</button>
                  </div>
                      </form>
                </div>

              </div>
            </div>
        <script>
            
 
            

        
</script>
</body>

</html>
