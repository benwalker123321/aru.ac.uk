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
    
    <?php
        
        echo form_open('Lecturerhome/find_grade');
            
        echo '<p> Enter  Intro mark</p>';
                    echo form_input('mark1');            
                    echo '<br><br>';
                    
        echo '<p> Enter  Briefing mark</p>';
                    echo form_input('mark2');
                    echo '<br><br>';
                    
        echo      '<p> Enter Lit Review mark</p>';
                    echo form_input('mark3');
                    echo '<br><br>'; 
       echo       '<p> Enter Design mark</p>';
                    echo form_input('mark4');
                    echo '<br><br>'; 
       echo      '<p> Enter Implementation mark</p>';
                    echo form_input('mark5');
                    echo '<br><br>'; 
       echo       '<p> Enter Testing mark</p>';             
                    echo form_input('mark6');
                    echo '<br><br>';
                    
       echo       '<p> Enter Evaluation mark</p>';             
                    echo form_input('mark7');
                    echo '<br><br>';
                    
       echo       '<p> Enter Conclusion mark</p>';
                    echo form_input('mark8');
                    echo '<br><br>'; 
       echo       '<p> Enter academic mark </p>';
                    echo form_input('mark9');
                    echo '<br><br>'; 
       echo      '<p> Enter presentation mark</p>';
                    echo form_input('mark10');
                    echo '<br><br>';             
     
                    
             echo form_submit('markEntered', 'find grade');

            echo form_close(); 

    ?>
         <?php
         
                echo form_open('Lecturerhome/load_assignment_mark_sheet');
            
                    echo '<p> Enter  assignment id</p>';
                                echo form_input('assignmentID');            
                                echo '<br><br>';
                    
                  
     
                    
             echo form_submit('assignmentIDEntered', 'enter assignment id');

            echo form_close();   
         
         
         ?>   
    
    
    

</body>
</html>

