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
                    <h1 class="page-header">Gallery</h1>                   
               </div>
                <!-- /.col-lg-12 -->
            </div>
           <div class="container content">
            <div class="row">
                
                    
               <div class="container">
	<div class="row">
        <?php foreach($gallery as $gallery) { ?>
		<div class="col-md-3 col-sm-4 col-xs-6" id="gallery"><p> <a href="#" id="<?php echo $gallery['id']; ?>" data-toggle="tooltip" data-placement="left" title="Delete" class="deletegallery"><i class="fa fa-times fa-fw"></i>&nbsp;Delete</a></p><img class="img-responsive" src="<?=base_url()?>uploads/<?php echo $gallery['image']; ?>" id="img-size" /><br></div>  <?php } ?>     
    </div>
</div>

            
        </div>

        
            <!-- /.row -->
            
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
     <?php $this->load->view('include/script_files'); ?>
    <!-- jQuery -->

      
</body>

</html>
    <script>
       $(".deletegallery").click(function() {
              var url = "http://localhost/Wedding_CI/";
        var del_id = $(this).attr('id');
        console.log(del_id);
        var info = 'id=' + del_id;
        if (confirm("Sure you want to delete this update? There is NO undo!")) {
            $.ajax({
                type: "POST",
                url: url+"index.php/wedding/deletegallery",
                data: info,
                success: function() {}
            });
            $(this).parents("#gallery").animate({
                    backgroundColor: "#fbc7c7"
                }, "fast")
                .animate({
                    opacity: "hide"
                }, "slow");
        }
        return false;
    });

    
    </script>
