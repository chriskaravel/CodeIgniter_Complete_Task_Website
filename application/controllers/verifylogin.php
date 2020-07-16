<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class verifylogin extends CI_Controller {
 
 function __construct()
 {
   parent::__construct();
   $this->load->model('acc_code','',TRUE);
 }
 
 
 function index()
 {  
   //This method will have the credentials validation
   $this->load->library('form_validation');
   //loading session library 
   $this->load->library('session');
 
   $this->form_validation->set_rules('access_code', 'Access Code', 'trim|required|callback_check_database');

   if($this->form_validation->run() == FALSE)
   {
     //Field validation failed.  User redirected to login page
     $this->load->view('login_view');
   }
   else
   {
     //Go to private area
   redirect('challenge', 'refresh');
   }
 
 }
   function check_database($access_code)
 {
   //Field validation succeeded.  Validate against database
   $access_code = $this->input->post('access_code');
 
   //query the database
   $result = $this->acc_code->login($access_code);

   if($result)
   { 
     $sess_array = array();
     foreach($result as $row)
     {
       $sess_array = array(
         'id' => $row->id,
         'access_code' => $access_code,
		 'content'=>$row->content,
		 'response'=>$row->response,
		 'start_date'=>$row->start_date,
		 'end_date'=>$row->end_date
       );
       $this->session->set_userdata('logged_in', $sess_array);
     }
     return TRUE;
   }
   else
   {
     $this->form_validation->set_message('check_database', 'Invalid Access Code');
     return false;
   }
 }

}
?>