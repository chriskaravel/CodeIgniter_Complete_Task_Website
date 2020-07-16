<?php
Class acc_code extends CI_Model
{
 function login($access_code)
 {
	$this -> db -> select('*');
	$this -> db -> from('challenge');
	$this -> db -> where('access_code', $access_code);
	$this -> db -> limit(1);
	$query = $this -> db -> get();

   if($query -> num_rows() == 1)
   {
     return $query->result();
   }
   else
   {
     return false;
   }
 }
}
?>