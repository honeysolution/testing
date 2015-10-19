<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

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
    function admin()
	{
		parent::__construct();
		$this->load->model('common_model');
        $this->load->model('home_model');
         $this->load->library('excel');
        
	} 
	public function index()
	{ 
        $this->load->view('admin');
	}
    public function create_admin()
    {
        
            $insert['admin_uname'] = 'dmsinfo.testing@gmail.com';
			$insert['admin_pass'] = base64_encode('admin')	;		                        
			$insert_id = $this->common_model->insertTableData('admin', $insert);
    }
    
    public function login()
    { 
       
        $username = $this->input->post('username');
		$password =  base64_encode($this->input->post('password'));
        
		$checkLogin = $this->common_model->selectRecord('SELECT * FROM `admin` WHERE `admin_uname`="' . $username . '" and `admin_pass`="' . $password . '"');
		if (!empty($checkLogin))
			{
			$admin_uname = $checkLogin->admin_uname;				
			$data['admin_uname'] = $admin_uname;
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
        //$user_id = $_SESSION['user_id'];
        $allproject= "SELECT * FROM assign_project_user";
		$data['allproject'] = $this->common_model->selectAllRecords($allproject); 
        $completed= "SELECT * FROM assign_project_user where status=1 ";
		$data['completed'] = $this->common_model->selectAllRecords($completed);
        $pending= "SELECT * FROM assign_project_user where status=0 ";
		$data['pending'] = $this->common_model->selectAllRecords($pending); 
         $agency= "SELECT * FROM agency ";
		$data['agency'] = $this->common_model->selectAllRecords($agency); 
        
        $project= "SELECT assign_project_user.*,project.* FROM assign_project_user,project WHERE assign_project_user.project_id=project.project_id  ORDER BY assign_project_user.project_id DESC";
		$data['project'] = $this->common_model->selectAllRecords($project);   
        
        $this->load->view('admin/index',$data);
    }
    public function projects()
    {
        
        $project= "SELECT assign_project_user.*,project.* FROM assign_project_user,project WHERE assign_project_user.project_id=project.project_id  ORDER BY assign_project_user.project_id DESC";
		$data['project'] = $this->common_model->selectAllRecords($project);        
        $this->load->view('admin/project',$data);
    }
    public function events($project_id = '')
    {
        
        $data['project'] = $this->common_model->selectRecord("SELECT * from project where project_id ='".$project_id."'");        
        $event_name= "SELECT * from event_names where event_id not in (select event_name from event)";
		$data['event_names'] = $this->common_model->selectAllRecords($event_name); 
        $event= "SELECT event.*,event_names.event_name as eventName from event,event_names where event.project_id = '".$project_id."' and event.event_name=event_names.event_id";
		$data['events'] = $this->common_model->selectAllRecords($event);        
        $this->load->view('admin/events',$data);
    }
    public function Activities($event_id='',$event_name='')
    {
        $data['event_id'] = $event_id;
       // $agency= "SELECT * from agency where user_id='".$_SESSION['user_id']."'";
		//$data['agency'] = $this->common_model->selectAllRecords($agency);
		$data['agency'] = '';
        $activity_name= "SELECT * from activity where event_id='".$event_name."'";
		$data['activity_name'] = $this->common_model->selectAllRecords($activity_name);
        $activity= "SELECT assign_project_event_activity.*,activity.activity_name as activityName,agency.agency_name as agencyName from assign_project_event_activity,activity,agency where assign_project_event_activity.event_id = '".$event_id."' and assign_project_event_activity.activity_id =activity.activity_id and assign_project_event_activity.agency_id= agency.agency_id";
		$data['activity'] = $this->common_model->selectAllRecords($activity);
        $this->load->view('admin/activities',$data);
       
       
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
    public function GetAgency()
    {
       $activityid = $this->input->post('agency_id');
		$data = $this->common_model->getagentlist($activityid);
		$agency = '';
		if ($data)
			{
			foreach($data as $row)
				{
				$agency.= "<option value='" . $row['agency_id'] . "'>" . $row['agency_name'] . "</option>";
				} //foreach
			} //if
		  else
			{
			$agency.= "<option value='0'>No Record Found</option>";
			}

		echo $agency;
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
       
            $insert['project_id'] = $this->input->post('project_id');
			$insert['event_name'] = $this->input->post('event_name');
			$insert['event_venue'] = $this->input->post('event_venue');
			$insert['event_date'] = date("Y-m-d", strtotime($this->input->post('event_date'))) ;
			$insert['event_time'] = $this->input->post('event_time');			
			$insert['event_add'] = $this->input->post('event_add');		                                        
			$insert_id = $this->common_model->insertTableData('event', $insert);
            if (!empty($insert_id))
			{
			$data['success'] = true;
			$data['error'] = 'Event Added Successfully';
			}
		  else
			{
			$data['success'] = false;
			$data['error'] = 'Error in Insert Event';
			}
 
        echo $json = json_encode($data);
    }
     public function weeddingUser()
    {
         $user = "SELECT * FROM user";
         $data['user'] = $this->common_model->selectAllRecords($user); 
        $this->load->view('admin/wuser',$data);
    } 
    public function familyuser()
    {
         $user = "SELECT * FROM family_user";
         $data['user'] = $this->common_model->selectAllRecords($user); 
        $this->load->view('admin/fuser',$data);
    }
     public function adduser()
    {
            $insert['email'] = $this->input->post('username');
			$insert['password'] = base64_encode($this->input->post('password'));			
			$insert_id = $this->common_model->insertTableData('user', $insert);
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
    public function addfuser()
    {
            $insert['user_name'] = $this->input->post('user_name');		
            $insert['user_mobile'] = $this->input->post('user_mobile');		
            $insert['user_email'] = $this->input->post('user_email');		
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
    
    public function excel()
    {
                $this->excel->setActiveSheetIndex(0);
                //name the worksheet
                $this->excel->getActiveSheet()->setTitle('Users Excel');
                //set cell A1 content with some text                
                $this->excel->getActiveSheet()->setCellValue('A1', 'User ID');
                $this->excel->getActiveSheet()->setCellValue('B1', 'Email');
                $this->excel->getActiveSheet()->setCellValue('C1', 'Registration Date');
                //merge cell A1 until C1
               
                //set aligment to center for that merged cell (A1 to C1)
                
                //make the font become bold
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
                
       for($col = ord('A'); $col <= ord('C'); $col++){
                //set column dimension
                $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
                 //change the font size
                $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);
                 
                $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        }
                //retrive contries table data
                $user = "SELECT user_id,email,regdate FROM user";
                $data = $this->common_model->selectAllRecords($user); 
                $exceldata="";
        foreach ($data as $row){
                $exceldata[] = $row;
        }
                //Fill data 
                $this->excel->getActiveSheet()->fromArray($exceldata, null, 'A3');
                 
                $this->excel->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $this->excel->getActiveSheet()->getStyle('B3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $this->excel->getActiveSheet()->getStyle('C3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                 
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
     public function agencyexcel()
    {
                $this->excel->setActiveSheetIndex(0);
                //name the worksheet
                $this->excel->getActiveSheet()->setTitle('Agency Excel');
                //set cell A1 content with some text                
                $this->excel->getActiveSheet()->setCellValue('A1', 'Agency Name');
                $this->excel->getActiveSheet()->setCellValue('B1', 'Person Name');
                $this->excel->getActiveSheet()->setCellValue('C1', 'Contact No');
                $this->excel->getActiveSheet()->setCellValue('D1', 'Description');
                $this->excel->getActiveSheet()->setCellValue('E1', 'Activity');
                $this->excel->getActiveSheet()->setCellValue('F1', 'Added By');
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
                $agency= "SELECT agency.agency_name,agency.contact_person_name,agency.mobile,agency.work_desc,activity.activity_name as activityName,user.email as username FROM agency,activity,user WHERE  agency.activity_id=activity.activity_id and agency.user_id=user.user_id";
		        $data = $this->common_model->selectAllRecords($agency);    
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
                 
                $filename='WeddingAgency.xls'; //save our workbook as this file name
                header('Content-Type: application/vnd.ms-excel'); //mime type
                header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
                header('Cache-Control: max-age=0'); //no cache
 
                //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
                //if you want to save it as .XLSX Excel 2007 format
                $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
                //force user to download the Excel file without writing it to server's HD
                $objWriter->save('php://output');
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
            $insert['activity_id'] = $this->input->post('activity_id');
			$insert['agency_id'] = $this->input->post('agency_id');
			$insert['asgn_detail_work'] = $this->input->post('asgn_detail_work');
			$insert['event_id'] = $this->input->post('event_id');			
			$insert_id = $this->common_model->insertTableData('assign_project_event_activity', $insert);
            if (!empty($insert_id))
			{
			$data['success'] = true;
			$data['error'] = 'Activity Added';
			}
		  else
			{
			$data['success'] = false;
			$data['error'] = 'Error in Insert Activity';
			}
 
        echo $json = json_encode($data);
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
    public function aagency()
    {
        
        $activity_name= "SELECT * from activity";
		$data['activity_name'] = $this->common_model->selectAllRecords($activity_name);
        $agency= "SELECT agency.*,activity.activity_name as activityName,user.email as username FROM agency,activity,user WHERE  agency.activity_id=activity.activity_id and agency.user_id=user.user_id";
		$data['agency'] = $this->common_model->selectAllRecords($agency);        
        $this->load->view('admin/aagency',$data);
    }
    public function activity_name()

	{ 
              
        $event_name= "SELECT * from event_names";
		$data['event_names'] = $this->common_model->selectAllRecords($event_name); 
        $this->load->view('admin/activity_name',$data);
	}
      
    
    public function addActivityname()
    {
       
        $insert['event_id'] = $_POST['event_name'];
        $insert['activity_name'] = $_POST['Activity_Name'];
        $insert['activity_details'] = $_POST['Activity_Details'];
        $insert['activity_remark'] = $_POST['Activity_Remark'];
        
        
      
       
        
        $insert_id = $this->common_model->insertTableData('activity', $insert);
        if(!$insert_id) {
            $data = array('success' => false, 'message' => 'Could not insert activity some error occurs ');
           
        }
        else
        {
    $data= array('success' => true, 'message' => 'activity successfully Inserted.');
        }
      echo  $json_response = json_encode($data);
    }
    
    public function event_name()
	{ 
        $this->load->view('admin/event_name');
	}
    
 public function addEventname()
    {
        
        $insert['event_name'] = $_POST['Event_Name'];
      
       
        
        $insert_id = $this->common_model->insertTableData('event_names', $insert);
        if(!$insert_id) {
            $data = array('success' => false, 'message' => 'Could not insert contact some error occurs ');
           
        }
        else
        {
    $data= array('success' => true, 'message' => 'Contact successfully Inserted.');
        }
      echo  $json_response = json_encode($data);
    }
     public function project_Master()
        
    {
         $this->load->view('admin/project_master');
        
    }
        
    
     
public function addProjectname()
    {
       
       
        $insert['project_name'] = $_POST['PROJECT_NAME'];
        $insert['project_type'] = $_POST['PROJECT_TYPE'];
        $insert['project_desc'] = $_POST['PROJECT_DESC'];
        $insert['project_city'] = $_POST['PROJECT_CITY'];
        $insert['project_start_date'] = $_POST['START_DATE'];
        
      
       
        
        $insert_id = $this->common_model->insertTableData('project', $insert);
        if(!$insert_id) {
            $data = array('success' => false, 'message' => 'Could not insert project some error occurs ');
           
        }
        else
        {
    $data= array('success' => true, 'message' => 'project successfully Inserted.');
        }
      echo  $json_response = json_encode($data);
    }
      
    
    
    
    
}
