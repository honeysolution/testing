<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

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
    function home()
	{
		parent::__construct();
		$this->load->model('common_model');
        $this->load->model('home_model');
        $this->load->library("pagination");
	} 
	public function index()
	{   
        $data['title'] = "DMS Fitoor Admin Panel";
        $data['header'] = "DMS Fitoor";
        $data['image_path']=   "http://www.dmssec.com/fitoor/assets/upload/image/profile";
        $members = "SELECT * FROM member";
        $data['members'] = $this->common_model->selectAllRecords($members);        
		$this->load->view('dashboard',$data);
	}
    public function ratecontrol()
	{   
        $sql = "SELECT DATE_FORMAT(regdate, '%M %Y') as month, COUNT(regdate) as total_user FROM member WHERE  regdate >= NOW() - INTERVAL 7 MONTH GROUP BY MONTH(regdate) order by mem_id ";
        $data['graph'] = $this->common_model->selectAllRecords($sql);  
            $results = array(
                'cols' => array (
                    array('label' => 'Date', 'type' => 'string'),
                    array('label' => 'Members', 'type' => 'number')
                ),
                'rows' => array()
            );

            if(sizeof($data['graph']))
            {
               foreach($data['graph'] as $row){

                     
                     $month = $row['month'];


                    $results['rows'][] = array('c' => array(
                    array('v' => $month),
                    array('v' => $row['total_user'])
                    ));
                }

            }

            else
            {
                $results['rows'][] = array('c' => array(
                array('v' => 0),
                array('v' => 0)
                ));
            }

          echo  $json = json_encode($results, JSON_NUMERIC_CHECK);
      //  $count = sizeof($data['graph']);
		//echo $json = json_encode($results);
	}
    public function addevent()
    {
       $data['title'] = "DMS Fitoor Admin Panel";
       $data['header'] = "DMS Fitoor";
       $this->load->view('event',$data);
    }  
    public function eventReport()
    {
       $data['title'] = "DMS Fitoor Admin Panel";
       $data['header'] = "DMS Fitoor";
       $sql_event = "SELECT * FROM `event`"; 
    $data['events'] = $this->common_model->selectAllRecords($sql_event);
       $this->load->view('event_report',$data);
    }
    public function editEvent($id='')
    {
       $data['title'] = "DMS Fitoor Admin Panel";
       $data['header'] = "DMS Fitoor";      
       $data['row_event'] =  $this->common_model->selectRecord('SELECT * FROM `event`  WHERE `event_id`="' . $id . '"');
       $this->load->view('event_edit',$data);
    }
    public function post()
    {
        $sql = "SELECT * FROM post";
		$data['post'] = $this->common_model->selectAllRecords($sql);
        $this->load->view('page-post',$data);
    }
    public function addNews()
    {
        
        $insert['event_title'] = $_POST['EVENT_TITLE'];
        $insert['event_image'] = $_POST['EVENT_IMAGE'];
        $insert['event_desc'] = $_POST['EVENT_DESCRIPTION'];
        $insert['event_date'] = $_POST['EVENT_DATE'];
        $insert['event_venue'] = $_POST['EVENT_VENUE'];
        $insert_id = $this->common_model->insertTableData('event', $insert);
        if(!$insert_id) {
            $data = array('success' => false, 'message' => 'Could not insert event some error occurs ');
           
        }
        else
        {
    $data= array('success' => true, 'message' => 'Event successfully Inserted.');
      
        }
      echo  $json_response = json_encode($data);
    }
    public function addnewsevent()
    {
        
      print_r($_POST);
    }
    public function contactus()
    {
        $insert['name'] = $_POST['inputName'];
        $insert['email'] = $_POST['inputEmail'];
        $insert['subject'] = $_POST['inputSubject'];
        $insert['message'] = $_POST['inputMessage'];
        $insert_id = $this->common_model->insertTableData('contactus', $insert);
        if(!$insert_id) {
            $data = array('success' => false, 'message' => 'Message could not be sent. Mailer Error: ');
           
        }
        else
        {
    $data= array('success' => true, 'message' => 'Thanks! We have received your message.');
      
        }
      echo  $json_response = json_encode($data);

 
      

    }
    public function alldt()
    {
           
        
        $sql = "SELECT * FROM categories WHERE status=1 ORDER BY cat_name ASC";
		$data['categories'] = $this->common_model->selectAllRecords($sql);
     
        $singers = "SELECT * FROM singers ORDER BY name ASC";
		$data['singers'] = $this->common_model->selectAllRecords($singers);
        
        $album = "SELECT * FROM album ORDER BY name ASC";
		$data['albums'] = $this->common_model->selectAllRecords($album);  
        
        $data['totalalbum'] = sizeof($data['albums']);
       
        
         $songs = "SELECT songs.*,singers.name as singername,categories.cat_name as categoryname,album.name as albumname FROM songs,categories,singers,album  WHERE songs.AlbumID = album.id AND  songs.SingerName = singers.id AND  songs.caregory = categories.id ORDER BY songs.songName ASC";
		$data['songs'] = $this->common_model->selectAllRecords($songs);
       echo  $json_response = json_encode($data);
        
        
    }
    
    
    public function album($s = null)
    {
        
        $selectsong = "SELECT * FROM album where name LIKE '".$s."%'";
		$data['song'] = $this->home_model->selectAllRecords($selectsong);
        print_r($data);
        echo $s;
        
    }
      public function albumSongs($s = null)
    {
        
        $selectsong = "SELECT songs.*,singers.name as singername,categories.cat_name as categoryname,album.name as albumname FROM songs,categories,singers,album  WHERE songs.AlbumID = album.id AND  songs.SingerName = singers.id AND  songs.caregory = categories.id and songs.AlbumID=".$s."";
		$data['AlbumSongs'] = $this->home_model->selectAllRecords($selectsong);
          
        $album = "SELECT * FROM album ORDER BY name ASC";
		$data['albums'] = $this->common_model->selectAllRecords($album); 
          
       $data['selectalbuminfo'] = $this->common_model->selectRecord('SELECT * FROM `album` WHERE `id`="' . $s . '"'); 
          
        echo $json = json_encode($data);
        
    }
    public function addToPlay($song_id='')
    {
     
       // $song_id = $this->input->post('user');
        
        
        
        $selectsong = "SELECT songs.*,singers.name as singername,categories.cat_name as categoryname,album.name as albumname FROM songs,categories,singers,album  WHERE songs.AlbumID = album.id AND  songs.SingerName = singers.id AND  songs.caregory = categories.id and songs.ID=".$song_id."";
		$data['song'] = $this->home_model->selectRecord($selectsong);
        
        if($data['song'])
        {
            $log['ip']=$_SERVER['REMOTE_ADDR']; 
            $log['song_id']=$song_id;
            $this->common_model->insertTableData('songlogs', $log);
            $data['success'] = true;
        }
//        $this->session->set_userdata('playlist',$data);
//       // $this->Session->write('list.items',$data);
//        //$list =  $this->Session->read('list.items');
// 
//       $list =  $_SESSION['playlist']['song'];
//               foreach ($list as $key => $value) {
//                   $result[$key] = $value;
//                }
//        $postdata['success'] = true;
//        $postdata['songname'] = $result['songName'];
//        $postdata['songpath'] = base_url()."music/".$result['songPath'];
        echo $json = json_encode($data);
        
    }
  function bhimalbum()
  {
     $this->load->view('AddAlbum'); 
  }
    function bhimsong()
  {
         $sql = "SELECT * FROM categories WHERE status=1 ORDER BY cat_name ASC";
		$data['categories'] = $this->common_model->selectAllRecords($sql);
     
        $singers = "SELECT * FROM singers ORDER BY name ASC";
		$data['singers'] = $this->common_model->selectAllRecords($singers);
        
        $album = "SELECT * FROM album ORDER BY name ASC";
		$data['albums'] = $this->common_model->selectAllRecords($album);
     $this->load->view('BhimSong',$data); 
        
  }
  function addalbum()
  {
      $insert['name'] = $_POST['name'];
      $insert['year'] = $_POST['year'];
       $insert_id = $this->common_model->insertTableData('album', $insert);
      redirect(base_url().'index.php/home/bhimalbum');
      
  }
    function addsong()
  {
      $insert['AlbumID'] = $_POST['AlbumID'];
      $insert['SingerName'] = $_POST['SingerName'];
      $insert['caregory'] = $_POST['caregory'];
      $insert['songName'] = $_POST['songName'];
      $insert['songPath'] = $_POST['songPath'].".mp3";
       $insert_id = $this->common_model->insertTableData('songs', $insert); 
        redirect(base_url().'index.php/home/bhimsong');
  }
}
