<?php

defined('BASEPATH') OR exit('No direct script access allowed');
include_once '/application/controllers/studentHome.php';



?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title> ARU Student Home</title>


</head>
<body>

    <center><h1>Student Home</h1> </center>

    
    <?php    
    $moduleNeeded = '';
    
                    if($moduleNeeded == 'yes' ){
                    echo form_open('studentHome/add_modules');
                
                        echo "<h3>Choose a optional module ID</h3>";#
                         echo form_input('SID', $this->session->userdata('SID'), 'hidden');
                            echo '</br>';          
                        echo form_dropdown('module', $moduleID);
                        echo form_submit('applyBtn', 'Apply');
                        echo form_submit('clearBtn', 'Reset');
                        
                                
            echo form_close();
            
                    }else{
                        //
                    }
        ?>
    
    <?php
            echo form_open('studentHome/view_module_attendance');
                        echo "Select a module to view Attendance";
                         echo form_input('SID', $this->session->userdata('SID'), 'hidden');
                            echo '</br>';          
                        echo form_dropdown('moduleChosen', $module);
                        echo "<br>";
                        echo form_submit('applyBtn', 'Apply');
                        echo form_submit('clearBtn', 'Reset');
                        
                                
            echo form_close();
    ?>

            <br> <?php echo 'Overall: ' , $overallAttendanceStudent; ?>   
            <br>     
                       
                    
    
    
    
    
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

