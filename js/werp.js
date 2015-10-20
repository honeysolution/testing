$(document).ready(function() {
    var url = "http://localhost/Wedding_CI/";

    //add events

   $('#AddEvent').submit(function(event) {

 
        // get the form data
        // there are many ways to get this data uSign jQuery (you can use the class or id also)
     /*   var formData = {
            'project_id': $("#project_id").val(),
            'event_name': $("#event_name").val(),
            'event_image':$('#userfile').fieldValue(),
            'event_venue': $("#event_venue").val(),
            'event_date': $("#event_date").val(),
            'event_time': $("#event_time").val(),
            'event_add': $("#event_add").val()
            
        };
        console.log(formData);*/
       var opts = {
            lines: 13, // The number of lines to draw
            length: 20, // The length of each line
            width: 10, // The line thickness
            radius: 30, // The radius of the inner circle
            corners: 1, // Corner roundness (0..1)
            rotate: 0, // The rotation offset
            direction: 1, // 1: clockwise, -1: counterclockwise
            color: '#000', // #rgb or #rrggbb or array of colors
            speed: 1, // Rounds per second
            trail: 60, // Afterglow percentage
            shadow: false, // Whether to render a shadow
            hwaccel: false, // Whether to use hardware acceleration
            className: 'spinner', // The CSS class to assign to the spinner
            zIndex: 2e9, // The z-index (defaults to 2000000000)
            top: 0, // Top position relative to parent in px
            left: 0 // Left position relative to parent in px
        };
        var target = document.getElementById('modal_spinner_center');
        var spinner = new Spinner(opts).spin(target);

        $.ajax({
                type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
                url: url + 'index.php/wedding/addEvents', // the url where we want to POST
                data: new FormData(this),
                contentType: false,
cache: false,
processData:false,
            
           success: function(data){
              bootbox.alert("<div style='font-size:20px;padding:2px;margin-left:4px;'><i class='fa fa-check-square' style='font-size:20px;color:green;padding:2px;'></i>" + data + "</div>",function() {
                   $("#AddEvent")[0].reset();
                  
              });
             
     
             } 
	        
});
        event.preventDefault();
    });


   $('#AddEventMaster').submit(function(event) {


        // get the form data
        // there are many ways to get this data uSign jQuery (you can use the class or id also)
         var formData = {
             'Event_Name'              : $('input[name=Event_Name]').val()
            
            
         }; 
        var opts = {
            lines: 13, // The number of lines to draw
            length: 20, // The length of each line
            width: 10, // The line thickness
            radius: 30, // The radius of the inner circle
            corners: 1, // Corner roundness (0..1)
            rotate: 0, // The rotation offset
            direction: 1, // 1: clockwise, -1: counterclockwise
            color: '#000', // #rgb or #rrggbb or array of colors
            speed: 1, // Rounds per second
            trail: 60, // Afterglow percentage
            shadow: false, // Whether to render a shadow
            hwaccel: false, // Whether to use hardware acceleration
            className: 'spinner', // The CSS class to assign to the spinner
            zIndex: 2e9, // The z-index (defaults to 2000000000)
            top: 0, // Top position relative to parent in px
            left: 0 // Left position relative to parent in px
        };
        var target = document.getElementById('body_spinner_center');
        var spinner = new Spinner(opts).spin(target);

        $.ajax({
             type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
             url         : 'http://localhost/Wedding_CI/index.php/wedding/addEventname', // the url where we want to POST
             data        : formData, // our data object
             dataType    : 'json', // what type of data do we expect back from the server
             encode          : true
         })
         // uSign the done promise callback
          .done(function(data) {

             // log data to the console so we can see
             if(data.success == true){
              bootbox.alert("<div style='font-size:20px;padding:2px;margin-left:4px;'><i class='fa fa-check-square' style='font-size:20px;color:green;padding:2px;'></i>" + data.message + "</div>");
              $("#AddEventMaster")[0].reset();
     
             } else {
                 bootbox.alert(data.message);
                 //$('#error').html(data.error);
             }
             spinner.stop();
             // here we will handle errors and validation messages
         });
     event.preventDefault();
    });


$('#AddActivitymaster').submit(function(event) {


        // get the form data
        // there are many ways to get this data uSign jQuery (you can use the class or id also)
         var formData = {
           
             
             'Activity_Name'              : $('input[name=Activity_Name]').val(),
             'Activity_Details'              : $('input[name=Activity_Details]').val(),
             'Activity_Remark'              : $('input[name=Activity_Remark]').val()
            
            
         };
   // console.log(formData);
         var opts = {
            lines: 13, // The number of lines to draw
            length: 20, // The length of each line
            width: 10, // The line thickness
            radius: 30, // The radius of the inner circle
            corners: 1, // Corner roundness (0..1)
            rotate: 0, // The rotation offset
            direction: 1, // 1: clockwise, -1: counterclockwise
            color: '#000', // #rgb or #rrggbb or array of colors
            speed: 1, // Rounds per second
            trail: 60, // Afterglow percentage
            shadow: false, // Whether to render a shadow
            hwaccel: false, // Whether to use hardware acceleration
            className: 'spinner', // The CSS class to assign to the spinner
            zIndex: 2e9, // The z-index (defaults to 2000000000)
            top: 0, // Top position relative to parent in px
            left: 0 // Left position relative to parent in px
        };
        var target = document.getElementById('body_spinner_center');
        var spinner = new Spinner(opts).spin(target);

         
        $.ajax({
             type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
             url         : 'http://localhost/Wedding_CI/index.php/wedding/addActivitynamemaster', // the url where we want to POST
              data        : formData, // our data object
             dataType    : 'json', // what type of data do we expect back from the server
             encode          : true
         })
         // uSign the done promise callback
         .done(function(data) {

             // log data to the console so we can see
             if(data.success == true){
              bootbox.alert("<div style='font-size:20px;padding:2px;margin-left:4px;'><i class='fa fa-check-square' style='font-size:20px;color:green;padding:2px;'></i>" + data.message + "</div>",function() {
                   $("#AddActivitymaster")[0].reset();
                  
              });
             
     
             } else {
                 bootbox.alert(data.message);
                 //$('#error').html(data.error);
             }
             spinner.stop();
             // here we will handle errors and validation messages
         });
     event.preventDefault();
    });



    // Add Activity

    $('#AddActivity').submit(function(event) {

        // get the form data
        // there are many ways to get this data uSign jQuery (you can use the class or id also)
    /*    var formData = {
            'activity_id': $("#activity_id").val(),
            'agency_id': $("#agency_id").val(),
            'asgn_detail_work': $("#asgn_detail_work").val(),
            'asgn_max_time': $("#asgn_max_time").val(),
            'contact_per': $("#Contact_Person").val(),
            'contact_mob': $("#Contact_Number").val(),
            'event_id': $("#event_id").val()
        };*/
        var opts = {
            lines: 13, // The number of lines to draw
            length: 20, // The length of each line
            width: 10, // The line thickness
            radius: 30, // The radius of the inner circle
            corners: 1, // Corner roundness (0..1)
            rotate: 0, // The rotation offset
            direction: 1, // 1: clockwise, -1: counterclockwise
            color: '#000', // #rgb or #rrggbb or array of colors
            speed: 1, // Rounds per second
            trail: 60, // Afterglow percentage
            shadow: false, // Whether to render a shadow
            hwaccel: false, // Whether to use hardware acceleration
            className: 'spinner', // The CSS class to assign to the spinner
            zIndex: 2e9, // The z-index (defaults to 2000000000)
            top: 0, // Top position relative to parent in px
            left: 0 // Left position relative to parent in px
        };
        var target = document.getElementById('body_spinner_center');
        var spinner = new Spinner(opts).spin(target);

        $.ajax({
                type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
                url: url + 'index.php/wedding/addActivity', // the url where we want to POST
            //    data: formData, // our data object
            data : new FormData(this),
                 contentType: false,
cache: false,
processData:false,
            success: function(data){
                bootbox.alert("<div style='font-size:20px;padding:2px;margin-left:4px;'><i class='fa fa-check-square' style='font-size:20px;color:green;padding:2px;'></i>" + data + "</div>",function() {
                    $("#AddActivity")[0].reset();
                  
              });
             
             
     spinner.stop();
             } 
                
	        
});
        event.preventDefault();
    });

    // add agency.

    $('#AddAgency').submit(function(event) {



        // get the form data
        // there are many ways to get this data uSign jQuery (you can use the class or id also)
        var formData = {
            'agency_name': $("#agency_name").val(),
            'contact_person_name': $("#contact_person_name").val(),
            'mobile': $("#mobile").val(),
            'work_desc': $("#work_desc").val(),
            'activity_id': $("#activity_id").val()

        };
        var opts = {
            lines: 13, // The number of lines to draw
            length: 20, // The length of each line
            width: 10, // The line thickness
            radius: 30, // The radius of the inner circle
            corners: 1, // Corner roundness (0..1)
            rotate: 0, // The rotation offset
            direction: 1, // 1: clockwise, -1: counterclockwise
            color: '#000', // #rgb or #rrggbb or array of colors
            speed: 1, // Rounds per second
            trail: 60, // Afterglow percentage
            shadow: false, // Whether to render a shadow
            hwaccel: false, // Whether to use hardware acceleration
            className: 'spinner', // The CSS class to assign to the spinner
            zIndex: 2e9, // The z-index (defaults to 2000000000)
            top: 0, // Top position relative to parent in px
            left: 0 // Left position relative to parent in px
        };
        var target = document.getElementById('modal_spinner_center');
        var spinner = new Spinner(opts).spin(target);

        $.ajax({
                type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
                url: url + 'index.php/wedding/addAgency', // the url where we want to POST
                data: formData, // our data object
                dataType: 'json'
            })
            // uSign the done promise callback
            .done(function(data) {

                // log data to the console so we can see
                if (data.success == true) {
                    //  box.modal('hide');   
                       bootbox.alert("<div style='font-size:20px;padding:2px;margin-left:4px;'><i class='fa fa-check-square' style='font-size:20px;color:green;padding:2px;'></i>" + data.error + "</div>");
                  //  $('#error').html(data.error);
                     $('#AddAgency')[0].reset();
                } else {
                    $('#error').html(data.error);
                }
                spinner.stop();
                // here we will handle errors and validation messages
            });
        event.preventDefault();
    }); 
  
    $('#AddFamilyUser').submit(function(event) {



        // get the form data
        // there are many ways to get this data uSign jQuery (you can use the class or id also)
        var formData = {
            'username': $("#user_name").val(),
            'email': $("#user_email").val(),
            'mobile': $("#user_mobile").val()

        };
       
        var opts = {
            lines: 13, // The number of lines to draw
            length: 20, // The length of each line
            width: 10, // The line thickness
            radius: 30, // The radius of the inner circle
            corners: 1, // Corner roundness (0..1)
            rotate: 0, // The rotation offset
            direction: 1, // 1: clockwise, -1: counterclockwise
            color: '#000', // #rgb or #rrggbb or array of colors
            speed: 1, // Rounds per second
            trail: 60, // Afterglow percentage
            shadow: false, // Whether to render a shadow
            hwaccel: false, // Whether to use hardware acceleration
            className: 'spinner', // The CSS class to assign to the spinner
            zIndex: 2e9, // The z-index (defaults to 2000000000)
            top: 0, // Top position relative to parent in px
            left: 0 // Left position relative to parent in px
        };
        var target = document.getElementById('modal_spinner_center');
        var spinner = new Spinner(opts).spin(target);

        $.ajax({
                type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
                url: url + 'index.php/wedding/addfuser', // the url where we want to POST
                data: formData, // our data object
                dataType: 'json'
            })
            // uSign the done promise callback
            .done(function(data) {

                // log data to the console so we can see
                if (data.success == true) {
                    //  box.modal('hide');    
                      bootbox.alert("Family User Added Sucesfully...");
                   // $('#error').html(data.error);
                     $('#AddFamilyUser')[0].reset();
                } else {
                    $('#error').html(data.error);
                }
                spinner.stop();
                // here we will handle errors and validation messages
            });
        event.preventDefault();
    }); 
    
    $('#resetPass').submit(function(event) {
             
        if($("#password").val() == $("#confirm_pass").val())
        {
            var info = 'password=' + $("#password").val();
              $.ajax({
                type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
                url: url + 'index.php/wedding/resetPass', // the url where we want to POST
                data: info, // our data object
                dataType: 'json'
            })
            // uSign the done promise callback
            .done(function(data) {

                // log data to the console so we can see
                if (data.success == true) {
                    //  box.modal('hide');   
                      bootbox.alert("<div style='font-size:20px;padding:2px;margin-left:4px;'><i class='fa fa-check-square' style='font-size:20px;color:green;padding:2px;'></i>Password Reset Sucesfully...</div>");
                     // alert("Password Reset Sucesfully...");
                 //   $('#error').html(data.error);
                     $('#resetPass')[0].reset();
                } else {
                    $('#error').html(data.error);
                }
                spinner.stop();
                // here we will handle errors and validation messages
            });
        }
        else
            {
                alert("check confirm password");
            }



/*
        // get the form data
        // there are many ways to get this data uSign jQuery (you can use the class or id also)
        var formData = {
            'agency_name': $("#agency_name").val(),
            'contact_person_name': $("#contact_person_name").val(),
            'mobile': $("#mobile").val(),
            'work_desc': $("#work_desc").val(),
            'activity_id': $("#activity_id").val()

        };
        var opts = {
            lines: 13, // The number of lines to draw
            length: 20, // The length of each line
            width: 10, // The line thickness
            radius: 30, // The radius of the inner circle
            corners: 1, // Corner roundness (0..1)
            rotate: 0, // The rotation offset
            direction: 1, // 1: clockwise, -1: counterclockwise
            color: '#000', // #rgb or #rrggbb or array of colors
            speed: 1, // Rounds per second
            trail: 60, // Afterglow percentage
            shadow: false, // Whether to render a shadow
            hwaccel: false, // Whether to use hardware acceleration
            className: 'spinner', // The CSS class to assign to the spinner
            zIndex: 2e9, // The z-index (defaults to 2000000000)
            top: 0, // Top position relative to parent in px
            left: 0 // Left position relative to parent in px
        };
        var target = document.getElementById('modal_spinner_center');
        var spinner = new Spinner(opts).spin(target);

      */
        event.preventDefault();
    });

    //event delete

    $(".deleteEvent").click(function() {
        var del_id = $(this).attr('id');
        console.log(del_id);
        var info = 'id=' + del_id;
        if (confirm("Sure you want to delete this update? There is NO undo!")) {
            $.ajax({
                type: "POST",
                url: url+"index.php/wedding/deleteEvent",
                data: info,
                success: function() {}
            });
            $(this).parents(".data_display").animate({
                    backgroundColor: "#fbc7c7"
                }, "fast")
                .animate({
                    opacity: "hide"
                }, "slow");
        }
        return false;
    });

    //activity delete

    $(".deleteActivity").click(function() {
        var del_id = $(this).attr('id');
        console.log(del_id);
        var info = 'id=' + del_id;
        if (confirm("Sure you want to delete this update? There is NO undo!")) {
            $.ajax({
                type: "POST",
                url: url+"index.php/wedding/deleteActivity",
                data: info,
                success: function() {}
            });
            $(this).parents(".data_display").animate({
                    backgroundColor: "#fbc7c7"
                }, "fast")
                .animate({
                    opacity: "hide"
                }, "slow");
        }
        return false;
    });
    
    //agency Delete
    
               
       $(".delete").click(function(){
        var del_id = $(this).attr('id'); 
            console.log(del_id);
        var info = 'id=' + del_id;
        if(confirm("Sure you want to delete this update? There is NO undo!"))
        {
        $.ajax({
        type: "POST",
        url: url+"index.php/wedding/delAgency",
        data: info,
        success: function(){
        }
        });
        $(this).parents(".data_display").animate({ backgroundColor: "#fbc7c7" }, "fast")
        .animate({ opacity: "hide" }, "slow");
        }
        return false;
        });            
  
//change status
    
    
    
    
     $("#changeStatus").click(function() {
        var data = $(this).attr("data-id");
          var info = 'id=' + data;
      
         if(confirm("Sure you want to Change Status? There is NO undo!"))
        {
        $.ajax({
        type: "POST",
        url: url+"index.php/wedding/changeStatus",
        data: info,
        success: function(){
        }
        });
       window.location.reload()
        }
        return false;
    });
     $("#activityStatus").click(function() {
        var data = $(this).attr("data-id");
        var event = $(this).attr("event-id");
        var activity = $(this).attr("activity-id");
         var info = {
            'activity_id': activity,
            'event_id': event,
            'id': data
        };      
         if(confirm("Sure you want to Change Status? There is NO undo!"))
        {
        $.ajax({
        type: "POST",
        url: url+"index.php/wedding/activityStatus",
        data: info,
        success: function(){
        }
        });
       window.location.reload()
        }
        return false;
    });

});;