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
                    <h1 class="page-header">Events for <?php echo $project->project_name; ?></h1>                   
               </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
                <div class="col-lg-12 ">                   
                    <p class="pull-right"><a href="<?php echo base_url()?>index.php/wedding/AllEvents/<?php echo $project->project_id; ?>" class="btn btn-info"><i class="glyphicon glyphicon-log-in"></i>&nbsp;&nbsp;All Events</a>&nbsp;&nbsp;<a href="<?php echo base_url()?>index.php/wedding/allActivities/<?php echo $project->project_id; ?>" class="btn btn-info"><i class="glyphicon glyphicon-log-in"></i>&nbsp;&nbsp;All Activities</a>&nbsp;&nbsp;<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#EventModel">Add Events</button></p>                  
               </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
            <div class="col-lg-12 ">                   
                    <p class="well"><?php echo $error; ?></p>                  
               </div>            
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading panel-change">
                            Events (<?php echo sizeof($events); ?>)
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive" >
                                 
                                <table class="table table-striped" id="event_list">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Image</th>
                                            <th>Event Name</th>
                                            <th>Event Venue</th>
                                            <th>Event Date</th>
                                            <th>Event Address</th>
                                            <th>Operation</th>
                                        </tr>
                                    </thead>
                                    <tbody >
                                        <?php if($events) { $i = 1 ; foreach($events as $data) { ?>
                                        <tr class="data_display">
                                            <td><?php echo $i; ?></td>
                                           
                                            <td><img alt="100%x180" style="height: 100px; width: 100px; display: block;" src="<?php echo base_url()?>uploads/<?php echo $data['event_image']; ?>" data-holder-rendered=""></td>
                                            <td><?php echo $data['eventName']; ?></td>
                                            <td width="300"><?php echo $data['event_venue']; ?></td>
                                            <td><?php echo date("d-m-Y", strtotime($data['event_date'])); ?></td>
                                            <td><?php echo $data['event_add']; ?></td>                                                                                      
                                            <td><a href="<?=base_url()?>index.php/wedding/Activities/<?php echo $data['event_id']."/".$data['event_name'];  ?>"><i class="fa fa-plus fa-fw"></i>&nbsp;Activities</a>&nbsp;<a href="<?=base_url()?>index.php/wedding/editevent/<?php echo $data['event_id'];  ?>"><i class="fa fa-plus fa-fw"></i>&nbsp;Edit</a>&nbsp;
                                             <a href="#" id="<?php echo $data['event_id'];  ?>" data-toggle="tooltip" data-placement="left" title="Delete" class="deleteEvent"><i class="fa fa-times fa-fw"></i>&nbsp;Delete</a>

                                            </td>  
                                            <td><!--<form class="form-horizontal regform"  id="PicUpload" enctype="multipart/form-data"  method="POST" action="/index.php/wedding/uploadimg" >
                    
                    <input type="file" id="browse" name="userfile" style="display:none" onChange="Handlechange();"/>
                    <input type="hidden" name="img_eve" id="img_eve" value="">                            
<input type="text" id="filename" readonly="true" style="display:none"/>

     <button type="button" class="btn btn-default btn-rd" id="fakeBrowse" onclick="HandleBrowseClick();"><i class="fa fa-upload"></i>&nbsp;&nbsp;&nbsp; Upload from computer</button>
	   <input type="submit" value="upload" id="upload" name="upload"  style="display:none">-->
                    </form></td>
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

 
    <!-- jQuery -->
   
       <div id="EventModel" class="modal fade in" role="dialog">
              <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" onclick="javascript:window.location.reload()" >&times;</button>
                    <h4 class="modal-title ">Add Events</h4>
                     
                  </div>
                  <div class="modal-body"><center> Project :-<?php echo $project->project_name; ?></center>
                        <span id="body_spinner_center" style="position: absolute;display: block;top: 50%;left: 50%;z-index: 0;"></span>
                    <!--action="http://localhost/Wedding_CI/index.php/wedding/addEvents"-->
                    <form id="AddEvent" role="form" method="post" >
                      <div class="form-group">
                        <label for="exampleInputEmail1">Event Name</label>
                        <select name="event_name" id="event_name" class="form-control" required onchange="get_image(this.value)">
                        <?php if($event_names){  ?> <option value="" selected>Select</option> <?php
                                            foreach($event_names as $event) { ?>
                                            <option value="<?php echo $event['event_id']; ?>"><?php echo $event['event_name']; ?></option>                                                
                                            <?php }
                                             } 
                                             else { 
                                             ?> <option value="" selected>No Records Found</option>
                                             <?php }  ?>    
                       
                            
                          
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Event Image</label>
                        <label for="exampleInputPassword1" class="col-md-12">
                            <span  id="eventimg" class="col-md-12"></span>  </label>                        
                        <div class="col-md-12" > <input type="checkbox" name="usethis" id="chkbx" onclick="enb_img()" >Upload New</div>
                         
                      </div>    
                      <div class="form-group">
                        <label for="exampleInputPassword1">Event Image</label>
                        <input type="file" class="form-control" name="userfile" id="userfile" placeholder="Event Image" disabled="disabled" required>
                       <span  id="checkboxhandle" class="col-md-12"></span>  </label>   
                        <input type="hidden" class="form-control" name="event_image_direct" id="event_image_direct">
                      </div>
                        <div class="form-group">
                        <label for="exampleInputPassword1">Event Venue</label>
                        <input type="text" class="form-control" name="event_venue" id="event_venue" placeholder="Event Venue" required>
                      </div>
                      
                        <div class="row">  
                            <div class="col-md-6">
                                <div class="form-group">
                        <label for="exampleInputPassword1">Event Date</label>
                        <input type="text" class="form-control datepicker" name="event_date" id="event_date" placeholder="Event Date" required readonly> 
                                    
                                  
                                </div> 
                            </div>
                             <div class="col-md-6">
                                <div class="form-group">
                        <label for="exampleInputPassword1">Event Time</label>
                        <input type="text" class="form-control" name="event_time" id="event_time" placeholder="Event time" required>
                        <input type="hidden" class="form-control" name ="project_id" id="project_id" value="<?php echo $project_id; ?>">
                                </div> 
                            </div>
                        </div>  
                      <div class="form-group">
                        <label for="exampleInputPassword1">Event Address</label>
                          <textarea  class="form-control" name="event_add" id="event_add" required></textarea>
                      </div>
                       
                    <div class="form-group">
                        <div id="error"></div>
                      </div>    
                      
                  </div>
                  <div class="modal-footer">
                      <input type="submit"  class="btn btn-default" value="Save" id="upload" name="upload">
                  </div>
                    </form>
                </div>

              </div>
            </div>
</body>
<style>
.datepicker{z-index:1151 !important;} 
</style>
<script>
$(function(){
$('.datepicker').datepicker({ startDate: '-0m'})
});
    
    
    
function get_image(event_id) {
    $.ajax({
         type: "POST",
         url: "<?=base_url()?>index.php/wedding/EventImg",
         data: {
             "event_id": event_id
         },
        dataType: 'json',
         success: function(data) {
         
            
            //$("#eventimg").html("<img src='<?=base_url()?>uploads/'"+data.eve_img.event_img +"width='100' height='100'>");
            $("#eventimg").html("<img src='<?=base_url()?>uploads/"+data.eve_img.event_img+"' width='100' height='100'>");
             $('#event_image_direct').val(data.eve_img.event_img);
             // $("#replaceThis").append(responseData);
         }
     });
}   
function enb_img()
{
   if ($('input[type=checkbox]').is(':checked')) {
        $('#chkbx').val('checked');
     //   $("#checkboxhandle").html("<input type='hidden' name='u_img' id='u_mg' value='checked' >");
        $("#userfile").removeAttr("disabled");
    }
    else{
           $('#chkbx').val('unchecked');
   //     $("#checkboxhandle").html("<input type='hidden' name='u_img' id='u_mg' value='unchecked' >");
          $("#userfile").attr("disabled", "disabled");
    }
}
   
</script>
   <script type="text/javascript">
    
jQuery(function($) {
        var oTable1 =
            $('#event_list')
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
</html>
