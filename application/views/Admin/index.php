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
                    <h1 class="page-header text-muted">Dashboard</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-comments fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo sizeof($allproject); ?></div>
                                    <div>Total Projects</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-tasks fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo sizeof($pending); ?></div>
                                    <div>Pending Projects</div>
                                </div>
                            </div>
                        </div>
                        <a href="<?=base_url()?>/index.php/wedding/projects">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-shopping-cart fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo sizeof($completed); ?></div>
                                    <div>Completed Projects</div>
                                </div>
                            </div>
                        </div>
                        <a href="<?=base_url()?>">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-support fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo sizeof($agency); ?></div>
                                    <div>Total Agency</div>
                                </div>
                            </div>
                        </div>
                        <a href="<?=base_url()?>/index.php/wedding/agency">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.row -->
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary ">
                        <div class="panel-heading  panel-change">
                            Projects 
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
                                            <th>Project Description</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Status</th>                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if($project) { $i = 1 ; foreach($project as $data) { ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $data['project_name']; ?></td>
                                            <td><?php echo $data['project_type']; ?></td>
                                            <td><?php echo $data['project_desc']; ?></td>
                                            <td><?php echo $data['project_start_date']; ?></td>
                                            <td><?php echo $data['project_entry_date']; ?></td>
                                            <td><?php echo $data['status'] == 0 ? '<button type="button" class="btn btn-danger">Pending</button>' : '<button type="button" class="btn btn-success">Completed</button>'; ?></td>  
                                            
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
