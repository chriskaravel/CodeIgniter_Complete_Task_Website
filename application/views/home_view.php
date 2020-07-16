<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
	
	<link rel="stylesheet" 
	href="<?php echo base_url(); ?>css/font-awesome-4.6.3/css/font-awesome.min.css">
	<link rel = "stylesheet" type = "text/css" 
	href = "<?php echo base_url(); ?>css/style.css">
	
   <title>Content View</title>
 </head>
 <body id="page2">

 <div class="header">Welcome! Here is your challenge:</div>

 <div class="homewhite"><?php echo $content; ?></div>
 
	<div class="timestamp"><i class="fa fa-clock-o" aria-hidden="true"></i>Your time started at <?php echo $start_date; ?><br>
	<i class="fa fa-clock-o" aria-hidden="true"></i>Your time ended at <?php if ($end_date==NULL)echo'---'; else echo $end_date; ?></div>

  
  <div class="header"><i class="fa fa-upload" aria-hidden="true"></i> Upload your response</div>
 
  <div class="details">
        <?php  echo $error;?> 
      <?php echo form_open_multipart('challenge/do_upload');?> 
	  
	  </div>
	  <div class="upload">
    <form action = "" method = "">
         <input type = "file" name = "userfile" size = "20" /> 
		 	<div class="uploadcenter"> 
			<button class="submit" type="submit" value = "upload">SUBMIT</button>
	</div>
    </form> 
  </div>
  
  <br><br><br>
  <div class="details"> *Every time you upload a response your previous is replaced.Also the end time updates.</div>
  <div class="details"> **The accepted file types are:zip,rar,tar,gz,bz2.</div>
  <div class="details"><a href="login">Insert a new code</a></div>

 </body >
</html>