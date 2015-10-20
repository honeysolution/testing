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
            <span id="body_spinner_center" style="position: absolute;display: block;top: 50%;left: 50%;"></span>  
            <div class="row">
                <div class="col-lg-12">                   
                    <h1 class="page-header">Activity Master Records</h1>                   
               </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
                <div class="col-lg-12 ">                   
                  
               </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="col-lg-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading panel-change">
                            Master Activity (<?php echo sizeof($activity_name); ?>)
                            
                        </div>
                        
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="activity_list">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Activity Name</th>
                                            <th>Details</th>
                                            <th>Remark</th>
                                            <th>Event Name</th>                                            
                                        </tr>
                                    </thead>
                                     <tbody>
                                        <?php if($activity_name) { $i = 1 ; foreach($activity_name as $data) { ?>
                                        <tr class="data_display">
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $data['activity_name']; ?></td>
                                            <td><?php echo $data['activity_details']; ?></td>
                                            <td><?php echo $data['activity_remark']; ?></td>
                                                                                                                              
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
                    
                     <div class="col-lg-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading panel-change">
                            Add Master Activity
                            
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                         <form id="AddActivitymaster" name="AddActivitymaster"  role="form"  action="" method ="post" >
                        
                       
                        
                        
                        
                        
                        <div class="form-group">
                        <label for="exampleInputEmail1">Activity Name</label>
                        <input type="text" class="form-control"  name = "Activity_Name" id="Activity_Name" placeholder="Activity Name" required onblur="activitynameval()"> 
						<span id="activitymsg" class="errormsg"></span>
                        </div>
                      
                        
                        <div class="form-group">
                        <label for="exampleInputEmail1">Activity Details</label>
                        <input type="text" class="form-control"  name = "Activity_Details" id="Activity_Details" placeholder="Activity Details" required onblur="activitydetails()"> 
						<span id="activitydetils" class="errormsg"></span>
                        </div>
                        
                        
                         <div class="form-group">
                        <label for="exampleInputEmail1">Activity Remark</label>
                        <input type="text" class="form-control"  name = "Activity_Remark" id="Activity_Remark" placeholder="Activity Remark" required onblur="actremarks()"> 
						<span id="activityrem" class="errormsg"></span>
                        </div>
                        
                   
                        
                        
                         <div class="form-group pull-right">
                             <button type="submit" value="Save">Save</button>
                        </div>
                        
                        
                         
                      
                      
                      
                         
                       
                        
                         
                  
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

       <script type="text/javascript">
    
jQuery(function($) {
        var oTable1 =
            $('#activity_list')
        //.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
        .dataTable( {
            bAutoWidth: false,
            "aoColumns": [
                { "asSorting": [ "asc"]},
                null, null,null, null,null,{ "bSortable": false },
                { "bSortable": false }
            ]
        });

        
    });

</script> 
</body>

</html>
