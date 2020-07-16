<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
	
	<link rel = "stylesheet" type = "text/css" 
	href = "<?php echo base_url(); ?>css/style.css">
   
   <title>Access Code Form</title>
 </head>
 <body id="page1">
	<div class="logincenter">   
		
		<?php echo form_open('verifylogin'); ?>  
			
		<label>enter your code:</label>  <br>
		<input type="text" size="60" id="access_code" name="access_code"/>
		<button class="ok" type="submit">OK</button>
		<?php echo validation_errors();?>
	</div>
	<div class="logo">
		<img src="<?php echo base_url(); ?>images/cwa.png" style="height:40px;width:80px;"/>
	 </div>
   </form>
 </body>
</html>