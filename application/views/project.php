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
                    <h1 class="page-header">Dashboard</h1>
                    <p class="pull-right"><a href="<?php echo base_url()?>index.php/wedding/projectexcel" class="btn btn-info"><i class="glyphicon glyphicon-log-in"></i>&nbsp;&nbsp;Export Excel</a></p>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading panel-change">
                            Projects (<?php echo sizeof($project); ?>)
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Project Name</th>
                                            <th>Project Type</th>
                                            <th>Description</th>
                                            <th>City</th>
                                            <th>Start Date</th> 
                                            <th>Status</th>
                                            <th>Operation</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if($project) { $i = 1 ; foreach($project as $data) { ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $data['project_name']; ?></td>
                                            <td><?php echo $data['project_type']; ?></td>
                                            <td><?php echo $data['project_desc']; ?></td>
                                            <td><?php echo $data['project_city']; ?></td>
                                            <td><?php echo $data['project_start_date']; ?></td> 
                                            <td><?php echo $data['status'] == 0 ? '<button type="button" class="btn btn-danger" id="changeStatus" data-id="'.$data['project_id'].'">Pending</button>' : '<button type="button" class="btn btn-success">Completed</button>'; ?></td>  
                                            <td><a href="<?=base_url()?>index.php/wedding/events/<?php echo $data['project_id'];   ?>"><i class="fa fa-plus fa-fw"></i>&nbsp;Events</a>&nbsp;<a href="<?=base_url()?>index.php/wedding/gallery/<?php echo $data['project_id'];   ?>"><i class="fa fa-plus fa-fw"></i>&nbsp;Gallery </a>&nbsp;<a href="<?=base_url()?>index.php/wedding/comments/<?php echo $data['project_id'];   ?>"><i class="fa fa-plus fa-fw"></i>&nbsp;Comments</a></td>                                           
                                        </tr>
                                        <?php $i++;}
                                        } 
                                        else
                                        { ?> <tr><td colspan="5"><center>No any Projects</center></td></tr><?php } ?>                                        
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
</body>

</html>
