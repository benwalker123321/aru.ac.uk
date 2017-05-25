<?php

defined('BASEPATH') OR exit('No direct script access allowed');

include_once 'application/controllers/lecturerHome.php';


?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title> ARU Lecturer Home</title>
<style type="text/css">

    #register{
        
        margin: 0 auto;
        
        
    }
    
</style>

</head>
<body>

    <center><h1>Lecturer Home</h1> </center>

    <?php
        
            echo validation_errors();

            echo form_open('Lecturerhome/load_group');
            
                    echo '<p> Enter Group ID</p>';
                    echo form_input('groupID');
                    echo '<br><br>';
                     echo '<p> Enter Session ID</p>';
                    echo form_input('class_session_id');
                    echo '<br><br>';
                    echo form_submit('selectGroup', 'Load Group Register');
            
            
            echo form_close(); 
            
           echo '<div id="register">';
           
           echo '</div>'
            
      
            
           
    ?>
    
    
    
    
    
    
    

    
            <?php
        if($this->session->userdata('is_loggedIn')){
       ?>
    <label id="welcomeLbl"> Welcome <?php echo $this->session->userdata('username');?> </label> 
    <br>
    <a href='<?php  echo base_url(). "index.php/main/logout" ?>'>Logout</a>
    <?php
        echo '<br>';
    ?>
    <?php
    }else{
                 
    ?>
       <label id="welcomeLbl"> Welcome Guest!</label>
        <?php
    }
    
    ?>
    
    
            
    
    
    

</body>
</html>

