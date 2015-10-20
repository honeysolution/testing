<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wedding extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
    function wedding()
	{
		parent::__construct();
		$this->load->model('common_model');
        $this->load->model('home_model');
        $this->load->library('excel');
        $this->load->library('upload');
         //$this->load->library("pdf");
        
	} 
	public function index()
	{ 
        $this->load->view('login');
	}
    public function login()
    { 
       
        $username = $this->input->post('username');
		$password =  base64_encode($this->input->post('password'));
		$checkLogin = $this->common_model->selectRecord('SELECT * FROM `user` WHERE `email`="' . $username . '" and `password`="' . $password . '"');
		if (!empty($checkLogin))
			{
			$user_id = $checkLogin->user_id;
			$user_email = $checkLogin->email;			
			$data = array(
				'user_id' => $user_id,
				'user_name' => $user_email,
				
			);
			$this->session->set_userdata($data);
			$data['success'] = true;
			}
		  else
			{
			$data['success'] = false;
			$data['error'] = 'Username or Password Incorrect';
			}

		echo $json = json_encode($data);
	}
    function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url());
	}
    public function dashboard()
    {
        $user_id = $_SESSION['user_id'];
        $allproject= "SELECT * FROM assign_project_user WHERE user_id='".$user_id."'";
		$data['allproject'] = $this->common_model->selectAllRecords($allproject); 
        $completed= "SELECT * FROM assign_project_user WHERE user_id='".$user_id."' and status=1";
		$data['completed'] = $this->common_model->selectAllRecords($completed);
        $pending= "SELECT * FROM assign_project_user WHERE user_id='".$user_id."' and status=0";
		$data['pending'] = $this->common_model->selectAllRecords($pending); 
         $agency= "SELECT * FROM agency WHERE user_id='".$user_id."'";
		$data['agency'] = $this->common_model->selectAllRecords($agency); 
        
        $project= "SELECT assign_project_user.*,project.* FROM assign_project_user,project WHERE assign_project_user.project_id=project.project_id and assign_project_user.user_id='".$user_id."' ORDER BY assign_project_user.project_id DESC";
		$data['project'] = $this->common_model->selectAllRecords($project);   
        
        $this->load->view('index',$data);
    }
    public function projects()
    {
        $user_id = $_SESSION['user_id'];
        $project= "SELECT assign_project_user.*,project.* FROM assign_project_user,project WHERE assign_project_user.project_id=project.project_id and assign_project_user.user_id='".$user_id."' ORDER BY assign_project_user.project_id DESC";
		$data['project'] = $this->common_model->selectAllRecords($project);        
        $this->load->view('project',$data);
    }
    
    
     public function projectexcel()
    {
                $this->excel->setActiveSheetIndex(0);
                //name the worksheet
                $this->excel->getActiveSheet()->setTitle('Project Excel');
                //set cell A1 content with some text                
                $this->excel->getActiveSheet()->setCellValue('A1', 'Assign Date');
                $this->excel->getActiveSheet()->setCellValue('B1', 'Name');
                $this->excel->getActiveSheet()->setCellValue('C1', 'Type');
                $this->excel->getActiveSheet()->setCellValue('D1', 'Description');
                $this->excel->getActiveSheet()->setCellValue('E1', 'City');
                $this->excel->getActiveSheet()->setCellValue('F1', 'Stari Date');
                //merge cell A1 until C1
               
                //set aligment to center for that merged cell (A1 to C1)
                
                //make the font become bold
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
                
       for($col = ord('A'); $col <= ord('C'); $col++){
                //set column dimension
                $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
                 //change the font size
                $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);
                 
                $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        }
                //retrive contries table data
                $user_id = $_SESSION['user_id'];
                $project= "SELECT assign_project_user.entry_date as entry,project.project_name as project_name,project.project_type as project_type,project.project_desc as project_desc,project.project_city as project_city,project.project_start_date as project_start_date FROM assign_project_user,project WHERE assign_project_user.project_id=project.project_id and assign_project_user.user_id='".$user_id."' ORDER BY assign_project_user.project_id DESC";
		        $data = $this->common_model->selectAllRecords($project);        
                $exceldata="";
        foreach ($data as $row){
                $exceldata[] = $row;
        }
                //Fill data 
                $this->excel->getActiveSheet()->fromArray($exceldata, null, 'A3');
                 
                $this->excel->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $this->excel->getActiveSheet()->getStyle('B3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $this->excel->getActiveSheet()->getStyle('C3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                 $this->excel->getActiveSheet()->getStyle('D3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $this->excel->getActiveSheet()->getStyle('E3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $this->excel->getActiveSheet()->getStyle('F3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                 
                $filename='WeddingOrganiserUser.xls'; //save our workbook as this file name
                header('Content-Type: application/vnd.ms-excel'); //mime type
                header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
                header('Cache-Control: max-age=0'); //no cache
 
                //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
                //if you want to save it as .XLSX Excel 2007 format
                $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
                //force user to download the Excel file without writing it to server's HD
                $objWriter->save('php://output');
                 
    }
         
    public function events($project_id = '')
    {
        
        
        $data['project_id'] = $project_id;
        $data['error'] = '';
        $data['project'] = $this->common_model->selectRecord("SELECT * from project where project_id ='".$project_id."'");        
        $event_name= "SELECT * from event_names` where event_id not in (select event_name from event where project_id ='".$project_id."')";
		$data['event_names'] = $this->common_model->selectAllRecords($event_name); 
        $event= "SELECT event.*,event_names.event_name as eventName from event,event_names where event.project_id = '".$project_id."' and event.event_name=event_names.event_id";
		$data['events'] = $this->common_model->selectAllRecords($event);        
        $this->load->view('events',$data);
        
        
    } 
    public function familyuser()
    {
         $user = "SELECT * FROM family_user";
         $data['user'] = $this->common_model->selectAllRecords($user); 
        $this->load->view('fuser',$data);
    }
        
    public function addfuser()
    {
       
            $insert['user_name'] = $this->input->post('username');		
            $insert['user_email'] = $this->input->post('email');		
            $insert['user_mobile'] = $this->input->post('mobile');		
			$insert_id = $this->common_model->insertTableData('family_user', $insert);
            if (!empty($insert_id))
			{
			$data['success'] = true;
			$data['error'] = 'User Added Successfully';
			}
		  else
			{
			$data['success'] = false;
			$data['error'] = 'Error in Insert User';
			}
 
        echo $json = json_encode($data);
    }
    
    public function allActivities($project_id = '')
    {
        $data['project_id'] = $project_id;
        $data['project'] = $this->common_model->selectRecord("SELECT * from project where project_id ='".$project_id."'");
        $activities= "SELECT DISTINCT(assign_project_event_activity.activity_type) as activity_type from assign_project_event_activity where project_id = '".$project_id."'";
		$data['activities'] = $this->common_model->selectAllRecords($activities); 
        $activities_e= "SELECT assign_project_event_activity.* from assign_project_event_activity where project_id = '".$project_id."'";
		$data['activities_e'] = $this->common_model->selectAllRecords($activities_e);        
        $event= "SELECT event.*,event_names.event_name as eventName from event,event_names where event.project_id = '".$project_id."'and event.event_name=event_names.event_id";
		$data['event'] = $this->common_model->selectAllRecords($event);
      
        $this->load->view('allactivities',$data);
        
    
        
    }
    
    public function comments($project_id = '')
    {
        
        
        $data['project_id'] = $project_id;
        $data['error'] = '';
       
        $comments= "SELECT * from comments where project_id = '".$project_id."'";
		$data['comments'] = $this->common_model->selectAllRecords($comments);       
        
        $this->load->view('comments',$data);
        
        
    }
    
    public function gallery($project_id = '')
    {
        
        
        $data['project_id'] = $project_id;
        $data['error'] = '';
       
        $gallery= "SELECT * from gallery where project_id = '".$project_id."'";
		$data['gallery'] = $this->common_model->selectAllRecords($gallery);       
        
        $this->load->view('gallery',$data);
        
        
    }
    
      
    
        public function deletegallery()
    {
        $arr['id']=$this->input->post('id');
        $delete =  $this->home_model->deleteRecord('gallery', $arr);

        if($delete)
        {
            $data['success'] = true;
            $data['error'] = 'Delete Successfull';
		}
		 else
		{
		$data['success'] = false;
		$data['error'] = 'Invalid Delete Operation';
		}

		echo $json = json_encode($data);
        
       
       
    }
    public function Activities($event_id='',$event_name='')
    {
        $data['event_id'] = $event_id;
        $agency= "SELECT * from agency where user_id='".$_SESSION['user_id']."'";
		$data['agency'] = $this->common_model->selectAllRecords($agency);
        $data['event']= $this->common_model->selectRecord('SELECT * from event where  event_id ="'.$event_id.'"');
		
		//$data['agency'] = '';
        //$activity_name= "SELECT * from activity where event_id='".$event_name."'";
        $activity_name= "SELECT * from activity ";
		$data['activity_name'] = $this->common_model->selectAllRecords($activity_name);
        $activity= "SELECT assign_project_event_activity.*,activity.activity_name as activityName,agency.agency_name as agencyName from assign_project_event_activity,activity,agency where assign_project_event_activity.event_id = '".$event_id."' and assign_project_event_activity.activity_id =activity.activity_id and assign_project_event_activity.agency_id= agency.agency_id";
		$data['activity'] = $this->common_model->selectAllRecords($activity);
        $this->load->view('activities',$data);
       
       
    }
    public function deleteActivity()
    {
        $arr['assign_project_event_activity_id']=$this->input->post('id');
        $delete =  $this->home_model->deleteRecord('assign_project_event_activity', $arr);
        if($delete)
        {
            $data['success'] = true;
            $data['error'] = 'Delete Successfull';
		}
		 else
		{
		$data['success'] = false;
		$data['error'] = 'Invalid Delete Operation';
		}

		echo $json = json_encode($data);
        
       
       
    }  
    public function deletecomment()
    {
        $arr['comment_id']=$this->input->post('id');
        $delete =  $this->home_model->deleteRecord('comments', $arr);
        if($delete)
        {
            $data['success'] = true;
            $data['error'] = 'Delete Successfull';
		}
		 else
		{
		$data['success'] = false;
		$data['error'] = 'Invalid Delete Operation';
		}

		echo $json = json_encode($data);
        
       
       
    }
    public function delAgency()
    {
        $arr['agency_id']=$this->input->post('id');
        $delete =  $this->home_model->deleteRecord('agency', $arr);
        if($delete)
        {
            $data['success'] = true;
            $data['error'] = 'Delete Successfull';
		}
		 else
		{
		$data['success'] = false;
		$data['error'] = 'Invalid Delete Operation';
		}

		echo $json = json_encode($data);
        
       
       
    }
    public function EventImg()
    {
       $event_id = $this->input->post('event_id');
       $data['eve_img']= $this->common_model->selectRecord('SELECT * from event_names where  event_id ="'.$event_id.'"');
        echo $json = json_encode($data);
       
    }
       
       
     
    public function deleteEvent()
    {
        $arr['event_id']=$this->input->post('id');
        $delete =  $this->home_model->deleteRecord('event', $arr);
      //  $delete =  $this->home_model->deleteRecord('assign_project_event_activity', $arr);
        if($delete)
        {
            $data['success'] = true;
            $data['error'] = 'Delete Successfull';
		}
		 else
		{
		$data['success'] = false;
		$data['error'] = 'Invalid Delete Operation';
		}

		echo $json = json_encode($data);
        
       
       
    }
    public function changeStatus()
    {
        $arr['project_id']=$this->input->post('id');
        $update['status'] = 1;
        $delete =  $this->home_model-> updateTableData('assign_project_user',$update,$arr);
        $delete2 =  $this->home_model-> updateTableData('project',$update,$arr);
        
      //  $delete =  $this->home_model->deleteRecord('assign_project_event_activity', $arr);
        if($delete)
        {
            $data['success'] = true;
            $data['error'] = 'Delete Successfull';
		}
		 else
		{
		$data['success'] = false;
		$data['error'] = 'Invalid Delete Operation';
		}

		echo $json = json_encode($data);
          
    }
    public function activityStatus()
    {
        $arr['assign_project_event_activity_id']=$this->input->post('id');
        $arr['event_id']=$this->input->post('event_id');
        $arr['activity_id']=$this->input->post('activity_id');
        $update['status'] = 1;
        $delete =  $this->home_model-> updateTableData('assign_project_event_activity',$update,$arr);
             
      //  $delete =  $this->home_model->deleteRecord('assign_project_event_activity', $arr);
        if($delete)
        {
            $data['success'] = true;
            $data['error'] = 'Delete Successfull';
		}
		 else
		{
		$data['success'] = false;
		$data['error'] = 'Invalid Delete Operation';
		}

		echo $json = json_encode($data);
          
    }
    //update password 
    public function resetPass()
    {
       
        $arr['user_id']=$_SESSION['user_id'];      
        $update['password']=base64_encode($this->input->post('password'));
        $delete =  $this->home_model-> updateTableData('user',$update,$arr);
             
      //  $delete =  $this->home_model->deleteRecord('assign_project_event_activity', $arr);
        if($delete)
        {
            $data['success'] = true;
            $data['error'] = 'password reset success';
		}
		 else
		{
		$data['success'] = false;
		$data['error'] = 'invalid operation';
		}

		echo $json = json_encode($data);
          
    }
   
    public function addEvents()
    {
      
            $upld = $this->input->post('usethis');  
            if($upld == "checked")
            {    
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '8000';
            $config['max_width'] = '3000';
            $config['max_height'] = '1000';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if (!$this->upload->do_upload())
			{
			
			$data = "Please select image size 512*512 ". $this->upload->display_errors();
            
			}
		  else
			{
			$insert['project_id'] = $this->input->post('project_id');
			$insert['event_name'] = $this->input->post('event_name');
			$insert['event_venue'] = $this->input->post('event_venue');
			$insert['event_date'] = date("Y-m-d", strtotime($this->input->post('event_date'))) ;
			$insert['event_time'] = $this->input->post('event_time');			
			$insert['event_add'] = $this->input->post('event_add');	
			$info = $this->upload->data();
			$insert['event_image'] = $info['file_name'];
            $insert_id = $this->common_model->insertTableData('event', $insert); 
			if (!empty($insert_id))
			{
           $data = 'Event Added Successfully';
              
			}
		  else
			{
			$data= 'Error in Insert Event';
			}
         
      
    }echo $json = json_encode($data);
            }
        else
        {
            
            $insert['project_id'] = $this->input->post('project_id');
			$insert['event_name'] = $this->input->post('event_name');
			$insert['event_venue'] = $this->input->post('event_venue');
			$insert['event_image'] = $this->input->post('event_image_direct');
			$insert['event_date'] = date("Y-m-d", strtotime($this->input->post('event_date'))) ;
			$insert['event_time'] = $this->input->post('event_time');			
			$insert['event_add'] = $this->input->post('event_add');	
			
            $insert_id = $this->common_model->insertTableData('event', $insert); 
			if (!empty($insert_id))
			{
           $data = 'Event Added Successfully';
              
			}
		  else
			{
			$data= 'Error in Insert Event';
			}
            echo $json = json_encode($data);
        }
       
    }
    public function addAgency()
    {
            $insert['agency_name'] = $this->input->post('agency_name');
			$insert['contact_person_name'] = $this->input->post('contact_person_name');
			$insert['mobile'] = $this->input->post('mobile');
			$insert['work_desc'] = $this->input->post('work_desc');
			$insert['activity_id'] = $this->input->post('activity_id');			
			$insert['user_id'] = $_SESSION['user_id'];			
			$insert_id = $this->common_model->insertTableData('agency', $insert);
            if (!empty($insert_id))
			{
			$data['success'] = true;
			$data['error'] = 'Agency Added Successfully';
			}
		  else
			{
			$data['success'] = false;
			$data['error'] = 'Error in Insert Agency';
			}
 
        echo $json = json_encode($data);
    }
    
    public function addActivity()
    {
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '8000';
            $config['max_width'] = '3000';
            $config['max_height'] = '1000';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if (!$this->upload->do_upload())
			{
			
			$data = "Please select image size 512*512 ". $this->upload->display_errors();
            
			}
		  else
			{
            $insert['activity_id'] = $this->input->post('activity_id');
			$insert['agency_id'] = $this->input->post('agency_id');
			$insert['asgn_detail_work'] = $this->input->post('asgn_detail_work');
			$insert['activity_type'] = $this->input->post('activity_type');
			$insert['status'] = $this->input->post('status');
			$insert['contact_per'] = $this->input->post('contact_per');
			$insert['contact_mob'] = $this->input->post('contact_mob');
			$insert['asgn_max_time'] = $this->input->post('asgn_max_time');
			$insert['project_id'] = $this->input->post('project_id');
			$insert['event_id'] = $this->input->post('event_id');
            $info = $this->upload->data();
			$insert['activity_image'] = $info['file_name'];  
			$insert_id = $this->common_model->insertTableData('assign_project_event_activity', $insert);
            if (!empty($insert_id))
			{
			$data ='Activity Added';
			}
		  else
			{
			$data= 'Error in Insert Activity';
			}
 
        echo $json = json_encode($data);
    }
    }
    public function agency()
    {
        $user_id = $_SESSION['user_id'];
        $activity_name= "SELECT * from activity";
		$data['activity_name'] = $this->common_model->selectAllRecords($activity_name);
        $agency= "SELECT agency.*,activity.activity_name as activityName FROM agency,activity WHERE agency.user_id='".$user_id."' and agency.activity_id=activity.activity_id";
		$data['agency'] = $this->common_model->selectAllRecords($agency);        
        $this->load->view('agency',$data);
    }
    public function eventmaster()
    {
        
        $events= "SELECT * FROM event_names";
		$data['events'] = $this->common_model->selectAllRecords($events);        
        $this->load->view('eventmaster',$data);
    }
    public function activitymaster()
    {
        $event_names = "SELECT * from event_names";
        $data['event_names'] = $this->common_model->selectAllRecords($event_names);
        $activity_name= "SELECT activity.*,event_names.event_name as eventname from activity,event_names where activity.event_id = event_names.event_id";
		$data['activity_name'] = $this->common_model->selectAllRecords($activity_name);
           
        $this->load->view('activitymaster',$data);
    }
    
    
     public function AllImage($project_id='')
    {
       $data['project_id'] = $project_id;
           
        $this->load->view('UploadImage',$data);
    }
    function uploadimg()
		{
        var_dump(is_dir('./uploads/'));
        print_r($_POST);
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size'] = '8000';
		$config['max_width'] = '3000';
		$config['max_height'] = '1000';
		$this->load->library('upload', $config);
        $this->upload->initialize($config);
		if (!$this->upload->do_upload())
			{
			$response['success'] = false;
			$response['error'] = $this->upload->display_errors();
			}
		  else
			{
			$data['error'] = '';
			$data['userid'] = 5;
			$info = $this->upload->data();
			$insert['event_image'] = $info['file_name'];
			$arr['event_id'] = $_POST['img_eve'];			
			$table = 'event';
			$insert_id =$this->common_model->updateTableData($table, $insert, $arr);
			
			$response['success'] = true;
			}

		echo $json = json_encode($response);
		}
    
    public function AllEvents($project_id = '')
    {
        $data['project_id'] = $project_id;
        $data['project'] = $this->common_model->selectRecord("SELECT * from project where project_id ='".$project_id."'");
        $event= "SELECT event.*,event_names.event_name as eventName from event,event_names where event.project_id = '".$project_id."' and event.event_name=event_names.event_id";
		$data['events'] = $this->common_model->selectAllRecords($event);        
        $activity= "SELECT assign_project_event_activity.*,activity.activity_name as activityName,agency.agency_name as agencyName from assign_project_event_activity,activity,agency where assign_project_event_activity.activity_id =activity.activity_id and assign_project_event_activity.agency_id= agency.agency_id";
		$data['activity'] = $this->common_model->selectAllRecords($activity);
        
        $this->load->view('allevents',$data);
        
    }
    public function toprint($project_id = '')
    {
        $data['project_id'] = $project_id;
        $data['project'] = $this->common_model->selectRecord("SELECT * from project where project_id ='".$project_id."'");
        $event= "SELECT event.*,event_names.event_name as eventName from event,event_names where event.project_id = '".$project_id."' and event.event_name=event_names.event_id";
		$data['events'] = $this->common_model->selectAllRecords($event);        
        $activity= "SELECT assign_project_event_activity.*,activity.activity_name as activityName,agency.agency_name as agencyName from assign_project_event_activity,activity,agency where assign_project_event_activity.activity_id =activity.activity_id and assign_project_event_activity.agency_id= agency.agency_id";
		$data['activity'] = $this->common_model->selectAllRecords($activity);
        
        $this->load->view('print',$data);
        
    }
     public function actprint($project_id = '')
    {
        $data['project_id'] = $project_id;
        $data['project'] = $this->common_model->selectRecord("SELECT * from project where project_id ='".$project_id."'");
        $activities= "SELECT DISTINCT(assign_project_event_activity.activity_type) as activity_type from assign_project_event_activity where project_id = '".$project_id."'";
		$data['activities'] = $this->common_model->selectAllRecords($activities); 
        $activities_e= "SELECT assign_project_event_activity.* from assign_project_event_activity where project_id = '".$project_id."'";
		$data['activities_e'] = $this->common_model->selectAllRecords($activities_e);        
        $event= "SELECT event.*,event_names.event_name as eventName from event,event_names where event.project_id = '".$project_id."'and event.event_name=event_names.event_id";
		$data['event'] = $this->common_model->selectAllRecords($event);
        
        $this->load->view('activityprint',$data);
        
    }
    
    public function addEventname()
    {
        
        $insert['event_name'] = $_POST['Event_Name'];
      
       
        
        $insert_id = $this->common_model->insertTableData('event_names', $insert);
        if(!$insert_id) {
            $data = array('success' => false, 'message' => 'Error In Adding Event ... Please Contact Administrator ');
           
        }
        else
        {
    $data= array('success' => true, 'message' => 'Event added in master successfully Inserted.');
        }
      echo  $json_response = json_encode($data);
    } 
    public function editevent($event_id = '')
    {
        $data['error']="";
        
        
        if ($_POST)
			{
			            $arr['event_id']=$this->input->post('event_id');
                        $update['event_venue'] = $this->input->post('event_venue');
                        $update['event_date'] = $this->input->post('event_date');
                        $update['event_time'] = $this->input->post('event_time');                    
                        $update['event_add'] = $this->input->post('event_add');                    
                        $delete =  $this->home_model-> updateTableData('event',$update,$arr);
                         $event= "SELECT event.*,event_names.event_name as eventName from event,event_names where event.event_id = '".$arr['event_id']."' and event.event_name=event_names.event_id";
                        $data['events'] = $this->common_model->selectRecord($event); 
                        $data['error'] = 'Updated Sucessfully';
                        $this->load->view('editevent',$data);
			}
        $event= "SELECT event.*,event_names.event_name as eventName from event,event_names where event.event_id = '".$event_id."' and event.event_name=event_names.event_id";
		$data['events'] = $this->common_model->selectRecord($event); 
        $this->load->view('editevent',$data);
       
    }
    public function editagency($agency_id = '')
    {
        $data['error']="";
        
        
        if ($_POST)
			{
			            $arr['agency_id']=$this->input->post('agency_id');
                        $update['agency_name'] = $this->input->post('agency_name');
                        $update['contact_person_name'] = $this->input->post('contact_person_name');
                        $update['mobile'] = $this->input->post('mobile');                    
                        $update['work_desc'] = $this->input->post('work_desc');                    
                        $delete =  $this->home_model->updateTableData('agency',$update,$arr);
                         $agency= "SELECT * from agency where agency_id= '".$arr['agency_id']."'";
		                 $data['agency'] = $this->common_model->selectRecord($agency); 
                        $data['error'] = 'Updated Sucessfully';
                        $this->load->view('editagency',$data);
			}
        $agency= "SELECT * from agency where agency_id= '".$agency_id."'";
		$data['agency'] = $this->common_model->selectRecord($agency); 
        $this->load->view('editagency',$data);
       
    }
public function addActivitynamemaster()
    {
       
      
        $insert['activity_name'] = $_POST['Activity_Name'];
        $insert['activity_details'] = $_POST['Activity_Details'];
        $insert['activity_remark'] = $_POST['Activity_Remark']; $insert_id = $this->common_model->insertTableData('activity', $insert);
        if(!$insert_id) {
            $data = array('success' => false, 'message' => 'Could not insert activity some error occurs ');
           
        }
        else
        {
          $data= array('success' => true, 'message' => 'Activity added successfully.');
        }
      echo  $json_response = json_encode($data);
    }
    
}
