<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('include/header_files');?>

<body onload="myFunction()">

    
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="text-center"><strong>Events Summary for <?php echo $project->project_name; ?></strong></h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-condensed">
                            <thead>
                                <tr>
                                    <td><strong>Sr.No</strong></td>
                                    <td><strong>Event Name</strong></td>
                                    <td ><strong>Event  Venue</strong></td> 
                                    <td ><strong>Event Address</strong></td> 
                                    <td class="text-center" ><strong>Activity Information</strong></td>                                    
                                                                       
                                </tr>
                            </thead>
                            <tbody><?php if($events) { $i = 1 ; foreach($events as $data) { ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $data['eventName']; ?></td>
                                    <td><?php echo $data['event_venue']; ?></td>
                                    <td><?php echo $data['event_add']; ?></td>
                                    <td><table class="table table-bordered">
                                    <td><strong>Sr.No</strong></td>
                                    <td><strong>Activity Name</strong></td>
                                    <td><strong>Agency Name</strong></td>
                                    <td><strong>Contact Person</strong></td>
                                    <td><strong>Contact Number</strong></td>
                                    <?php  $j = 1  ;foreach ($activity as $act)
                                        { if ($data['event_id'] == $act['event_id'])
                                        {?>
                                        <tr><td><?php echo $j; ?></td>
                                           <td> <?php echo $act['activityName']; ?></td>
                                            <td><?php echo $act['agencyName']; ?></td>
                                            <td> <?php echo $act['contact_per']; ?></td> 
                                            <td> <?php echo $act['contact_mob']; ?></td>  
                                        </tr><?php $j = $j+1;} }?>
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

