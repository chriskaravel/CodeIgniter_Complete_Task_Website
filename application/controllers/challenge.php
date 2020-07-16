<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class challenge extends CI_Controller {
	
 function __construct()
 {
	parent::__construct();
	$this->load->helper(array('form', 'url')); 
	$this->load->helper("file");
 }
 
 function index()
 {
	$this->load->library('session');
	$session_data = $this->session->userdata('logged_in');
    if($this->session->userdata('logged_in'))
   {   
	 $this -> db -> select('*');
	 $this -> db -> from('challenge');
	 $this -> db -> where('access_code', $session_data['access_code']); 
	 $query = $this -> db -> get();	
	 $stDate= $query->row()->start_date;	
	 if(empty($stDate)) 
	 {  
		$this->load->helper('date');
		$date = date('Y-m-d H:i:s'); 
		$data2 = array(
		'start_date'=>$date,
		);
		$this -> db -> where('access_code', $session_data['access_code']);
		$this->db->update('challenge',$data2);
	 } 
	 $this -> db -> select('*');
	 $this -> db -> from('challenge');
	 $this -> db -> where('access_code', $session_data['access_code']); 
	 $query = $this -> db -> get();
     $data['access_code'] = $session_data['access_code'];
	 $data['content'] = $query->row()->content;
	 $data['response'] = $query->row()->response;
	 $data['start_date'] = $query->row()->start_date;
	 $data['end_date'] = $query->row()->end_date;
	 $data['error']= null;
	 $this->load->view('home_view',$data); 
   }
   else
   {
     //If no session, redirect to login page
     redirect('login', 'refresh');
   }
 }
 
 public function do_upload() 
 { 
	$this->load->library('session');
	$session_data = $this->session->userdata('logged_in');
	$config['upload_path']   = './uploads/'; 
	$config['allowed_types'] = 'zip|tar|rar|gz|bz2';
	$id=$session_data['id'];
	$config['file_name'] = 'uploadedfile';
	$this->load->library('upload', $config);
	$this -> db -> select('*');
	$this -> db -> from('challenge');
	$this -> db -> where('access_code', $session_data['access_code']);
	$this -> db -> limit(1);
	$query = $this -> db -> get();
	$response = $query->row()->response;
    if ( ! $this->upload->do_upload('userfile')) 
	{
		$error = array('error' => $this->upload->display_errors()); 
		$this -> db -> select('*');
		$this -> db -> from('challenge');
		$this -> db -> where('access_code', $session_data['access_code']); 
		$query = $this -> db -> get();
		$data['access_code'] = $session_data['access_code'];
		$data['content'] = $query->row()->content;
		$data['response'] = $query->row()->response;
		$data['start_date'] = $query->row()->start_date;
		$data['end_date'] = $query->row()->end_date;
		$data['error']=$this->load->view('upload_form', $error, TRUE);	
		$this->load->view ('home_view', $data);	
    }
    else 
	{ 
		$data = array('upload_data' => $this->upload->data()); 
		$this->load->helper('date');
		$date = date('Y-m-d H:i:s'); 
		$name = $this->upload->data('file_name');
		$file = "./uploads/$name";
		$newfile = './uploads/challenge-'.$id.'.rar';
		rename($file, $newfile);
		$data2 = array(
		'response'=>'challenge-'.$id.'',
		'end_date'=>$date,
		);
		$this -> db -> where('access_code', $session_data['access_code']);
		$this->db->update('challenge',$data2);
		echo "<script>
		alert('Your file was successfully uploaded!');
		</script>";
		redirect('challenge', 'refresh');
    } 
 } 

 function login()
 {
   $this->session->unset_userdata('logged_in');
   session_destroy();
   redirect('login', 'refresh');
 }
 
}
 
?>