<?php

defined('BASEPATH') OR exit('No direct script access allowed');
 include_once 'application/controllers/manHome.php';



?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title> ARU Management Home</title>


</head>
<body>

    <center><h1> Management Home</h1> </center>

       <?php
        
            echo validation_errors();
    
            echo form_open('Manhome/session_validation');
                        echo '<p>Class ID</p>';
                        echo form_input('classID');
                            echo '</br>';
                            echo '</br>';
                        echo '<p>Room ID</p>';    
                        echo form_input('roomID');
                            echo '</br>';
                            echo '</br>';
                             echo '<p>Module ID</p>';    
                        echo form_input('moduleID');
                            echo '</br>';
                            echo '</br>';
                         echo '<p>Group ID</p>';    
                        echo form_input('groupID');
                            echo '</br>';
                            echo '</br>';    
                         echo '<p>Lecturer ID</p>';    
                        echo form_input('lecturerID');
                            echo '</br>';
                            echo '</br>';
                         echo '<p>Date</p>';    
                        echo form_input('date');
                            echo 'year/month/day </br>';
                            echo '</br>';
                         echo '<p>Start Time</p>';    
                        echo form_input('startTime');
                            echo '</br>';
                            echo '</br>';
                        echo '<p> Cut Off Time</p>';    
                        echo form_input('cutOffTime');
                            echo '</br>';
                            echo '</br>';     
                         echo '<p>End Time</p>';    
                        echo form_input('endTime');
                            echo '</br>';
                            echo '</br>';    
                        echo form_submit('createSessionBtn', 'Create Session');    
                                
            echo form_close();
    
    
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

