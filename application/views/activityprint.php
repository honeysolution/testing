<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('include/header_files');?>

<body onload="myFunction()">

    
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

    <!-- /#wrapper -->
    
    <!-- jQuery -->

 
    <!-- jQuery -->
   
    
</html>
    <script>
function myFunction() {
    window.print();
     window.history.back();
}
</script>

