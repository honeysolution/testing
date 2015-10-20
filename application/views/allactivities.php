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
                    &nbsp;
                  <p class="pull-right"> <a href="<?php echo base_url()?>index.php/wedding/actprint/<?php echo $project->project_id; ?>" class="btn btn-info"><i class=" glyphicon glyphicon-print"></i>&nbsp;&nbsp;Print</a>&nbsp;               </p>
               </div>
                <!-- /.col-lg-12 -->
            </div>
           
            <!-- /.row -->
           
    <div class="row">
       
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="text-center"><strong>Activity Summary for <?php echo $project->project_name; ?></strong></h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-condensed">
                            <thead>
                                <tr>
                                    <td><strong>Sr.No</strong></td>
                                    <td><strong>Activity Type</strong></td>                                    
                                    <td class="text-center" ><strong>Activity Details</strong></td>                                                                                                    
                                </tr>
                            </thead>                     
                             <tbody><?php if($activities ) { $i = 1 ; foreach($activities as $activity) { ?>
                              <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $activity['activity_type']; ?></td>                                    
                                    <td><table class="table table-bordered">
                                    <td><strong>Contact Person</strong></td>
                                    <td><strong>Contact Number</strong></td>
                                     <td><strong>Event Name</strong></td>
                                    <td><strong>Event Venue</strong></td>
                                    <td><strong>welcome Person</strong></td>    
                                        <?php foreach($activities_e as $activity_e)
                                        { if($activity['activity_type'] == $activity_e['activity_type']) 
                                        { ?>
                                       <tr> <td> <?php echo $activity_e['contact_per']; ?></td>
                                           <td><?php echo $activity_e['contact_mob']; ?></td>
                                   
                                    <?php   ;foreach($event as $data)
                                        {   if($activity_e['event_id'] == $data['event_id'])                                        {?>
                                       
                                           <td> <?php echo $data['eventName']; ?></td>
                                            <td><?php echo $data['event_venue']; ?></td>
                                            <td> <?php echo $data['welcome_person']; ?></td>
                                        </tr><?php } } } }?>
                                        </table>
                                    </td>                                    
                                    
                                </tr> <?php $i = $i+1;} }?>                               
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
     <?php $this->load->view('include/script_files'); ?> 
    <!-- jQuery -->

 
    <!-- jQuery -->
   
    
</html>

