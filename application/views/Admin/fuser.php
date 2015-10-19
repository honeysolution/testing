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
                    <h1 class="page-header text-muted">Family User</h1>
                   
                               
                            
                     <p class="pull-right"><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#AddUserModel"><i class=" glyphicon glyphicon-plus"></i> &nbsp;Add User</button></p>  
                </div>
                <!-- /.col-lg-12 -->
            </div>
            
            <!-- /.row -->
            <!-- /.row -->
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary ">
                        <div class="panel-heading  panel-change">
                             User
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>User ID</th>
                                            <th>User Name</th>
                                            <th>User Mobile</th>
                                            <th>User Email</th>
                                            <th>Registration Date</th>
                                                                               
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if($user) { $i = 1 ; foreach($user as $data) { ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $data['user_id']; ?></td>
                                            <td><?php echo $data['user_name']; ?></td>
                                            <td><?php echo $data['user_mobile']; ?></td>
                                            <td><?php echo $data['user_email']; ?></td>
                                            <td><?php echo $data['reg_date']; ?></td>
                                           
                                            
                                            </tr>
                                        <?php $i++;}
                                        } 
                                        else
                                        { ?> <tr><td colspan="5"><center>No any User</center></td></tr><?php } ?>
                                        
                                        
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
   

        <div id="AddUserModel" class="modal fade in" role="dialog">
              <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" onclick="javascript:window.location.reload()" >&times;</button>
                    <h4 class="modal-title ">Add User</h4>
                  </div>
                  <div class="modal-body">
                       <span id="body_spinner_center" style="position: absolute;display: block;top: 50%;left: 50%;z-index: 0;"></span>
                    
                    <form id="AddFamilyUser" role="form" >
                      
                      <div class="form-group">
                        <label for="exampleInputPassword1">User Name</label>
                        <input type="text" class="form-control" name="user_name" id="user_name" placeholder="Username" required>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">User Mobile</label>
                         <input type="text" class="form-control" name="user_mobile" id="user_mobile" placeholder="User Mobile" required>
                       
                       </div> 
                        <div class="form-group">
                        <label for="exampleInputPassword1">User Email</label>
                         <input type="text" class="form-control" name="user_email" id="user_email" placeholder="User Email" required>
                       
                       </div> 
                     
                           
                    <div class="form-group">
                        <div id="error"></div>
                      </div>    
                      
                 
                  <div class="modal-footer">
                      <input type="submit"  class="btn btn-default" value="Create User">
                  </div>
                    </form>
                </div>

              </div>
            </div>
</body>
    

</html>
