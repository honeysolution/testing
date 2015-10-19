<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ApiController extends CI_Controller {

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
    function ApiController()
	{
		parent::__construct();
		$this->load->model('common_model');
        $this->load->model('home_model');
         $this->load->library('excel');
        
	} 
	public function index()
	{ 
        echo "<h1>404 ERROR!- Unknown Page</h1>";
	}
    public function login()
    { 
       
        $username = $this->input->post('USERNAME');
		$password =  base64_encode($this->input->post('PASSWORD'));
        
		$checkLogin = $this->common_model->selectRecord('SELECT * FROM `family_user` WHERE `user_name`="' . $username . '" and `password`="' . $password . '"');
		if (!empty($checkLogin))
			{            
			$user_id = $checkLogin->user_id;
			$project_id = $checkLogin->project_id;
            $data['RESPONSE_STATUS']= 1;
			//$data['USER_ID'] = $user_id;	
			//$data['PROJECT_ID'] = $project_id;	
			
			}
		  else
			{
            $data['RESPONSE_STATUS']= 0;   			
			}

		echo $json = json_encode($data);
	} 
   
    public function events()
    {
        $project_id = $this->input->post('PROJECT_ID');        
        $event= "SELECT event.event_id as EVENT_ID,event.event_venue as EVENT_VENUE,event.event_add as EVENT_ADDRESS,event.welcome_person as EVENT_WELCOME_PERSON,event.event_image as EVENT_IMAGE,(UNIX_TIMESTAMP(event.event_date)*1000)  as EVENT_TIME,event_names.event_name as EVENT_NAME from event,event_names where event.project_id = '".$project_id."' and event.event_name=event_names.event_id";
		$events_fetch = $this->common_model->selectAllRecords($event);
        $activity= "SELECT assign_project_event_activity.assign_project_event_activity_id as ACTIVITY_ID,activity.activity_name as ACTIVITY_NAME,assign_project_event_activity.asgn_detail_work as ACTIVITY_DESCRIPTION,assign_project_event_activity.contact_per as ACTIVITY_CONTACT_PERSON_NAME,assign_project_event_activity.contact_mob as ACTIVITY_CONTACT_PERSON_CONTACT,assign_project_event_activity.activity_image as ACTIVITY_IMAGE,assign_project_event_activity.status as ACTIVITY_STATUS,assign_project_event_activity.event_id as EVENT_ID from assign_project_event_activity,activity where  assign_project_event_activity.activity_id =activity.activity_id";
		$activity_fetch = $this->common_model->selectAllRecords($activity);
        $gallery= "SELECT gallery.id as IMAGE_ID,gallery.image as IMAGE_URL from gallery where  project_id ='".$project_id."'";
		$gallery_fetch = $this->common_model->selectAllRecords($gallery);        
        if(sizeof($events_fetch))
        {    
        $data['RESPONSE_STATUS']= 1;
        $data['IMAGE_PATH'] = base_url()."uploads/";
        $data['EVENTS'] = $events_fetch;                 
        $data['ACTIVITY'] = $activity_fetch;                 
        $data['GALLERY'] = $gallery_fetch;                
                       
        }
        else
        {
        $data['RESPONSE_STATUS']= 0;   
       
        }
        echo $json = json_encode($data);
        
    }
    public function viewcomment()
    {
        $project_id = $this->input->post('PROJECT_ID');
        $comments= "SELECT comments.comment_id as COMMENT_ID,comments.full_name as COMMENT_PERSON_NAME,comments.message as COMMENT_MESSAGE,comments.comment_date as COMMENT_DATE from comments where  project_id ='".$project_id."'";
		$comments_fetch = $this->common_model->selectAllRecords($comments);
        if(sizeof($comments_fetch))
        {    
        $data['RESPONSE_STATUS']= 1;                      
        $data['COMMENTS'] = $comments_fetch;                 
        }
        else
        {
        $data['RESPONSE_STATUS']= 0;   
       
        }
        echo $json = json_encode($data);
        
    }  
    public function addcomment()
    {
        $insert['project_id'] = $_POST['PROJECT_ID'];
        $insert['full_name'] = $_POST['COMMENT_PERSON_NAME'];
        $insert['message'] = $_POST['COMMENT_MESSAGE'];
        $insert['comment_date'] = $_POST['COMMENT_DATE'];
        $insert_id = $this->common_model->insertTableData('comments', $insert);
        if (!empty($insert_id))
		{
		$data['RESPONSE_STATUS']= 1;
		}
		else
		{
		$data['RESPONSE_STATUS']= 0;
		}
        echo $json = json_encode($data);
        
    }  
    
    public function addgalleryimage()
    {
        $filename = "gallery_".$_POST['PROJECT_ID']."_".rand().".jpg"; 
       // $path = './uploads/'.$filename;
        $path = './uploads/'.$filename; 
        $buffer = base64_decode ($_POST['IMAGE_UPLOADED']);
        file_put_contents ( $path, $buffer ); // Check the base64 contents and path 
        $ImageSize = filesize ( $path ); 
        if($ImageSize < 1048576)
            {
                $insert['project_id'] = $_POST['PROJECT_ID'];
                $insert['image'] = $filename;        
                $insert_id = $this->common_model->insertTableData('gallery', $insert);
                if (!empty($insert_id))
                {

                $data['RESPONSE_STATUS']= 1;
                }
                else
                {
                $data['RESPONSE_STATUS']= 0;
                }
            }
        else
            {
                 $data['RESPONSE_STATUS']= 2;
            }
        echo $json = json_encode($data);
    }

   
    
}
