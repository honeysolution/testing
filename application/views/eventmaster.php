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
                    <h1 class="page-header">Event Master Records</h1>                   
               </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
                <div class="col-lg-12 ">                   
                    <p class="pull-right"></p>                  
               </div>
                            
<span id="body_spinner_center" style="position: absolute;display: block;top: 50%;left: 50%;"></span>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="col-lg-6">
                    <div class="panel panel-primary ">
                        <div class="panel-heading panel-change">
                            Event Master (<?php echo sizeof($events); ?>)
                            
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Event Name</th>                                            
                                        </tr>
                                    </thead>
                                     <tbody>
                                        <?php if($events) { $i = 1 ; foreach($events as $data) { ?>
                                        <tr class="data_display">
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $data['event_name']; ?></td>
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
                    <div class="panel panel-primary ">
                        <div class="panel-heading panel-change">
                            Add Events
                            
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                        <form id="AddEventMaster"  role="form" >
                        <div class="form-group">
                        <label for="exampleInputEmail1">Event Name</label>
                        <input type="text" class="form-control"  name = "Event_Name" id="Event_Name" placeholder="Event Name" required> 
                        </div>
                        <div class="form-group pull-right">
                        <input type="submit" class="btn btn-default" value="Save">
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

</body>

</html>
