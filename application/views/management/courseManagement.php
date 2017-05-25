<?php

defined('BASEPATH') OR exit('No direct script access allowed');
 include_once '/application/controllers/management/courseManagement.php';



?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title> ARU Management Home</title>


</head>
<body>

    <center><h1> Management Home</h1> </center>

    <center>
       <?php
        
            echo validation_errors();
    
            
            // maybe make this output an method 
      /*      
            echo form_open('management/courseManagement/create_course_validation');
                        echo '<p>Course Name</p>';
                        echo form_input('courseName');
                            echo '<br> <br>';
                            echo '<p>Degree Type</p>';
                            
                            $degreeOptions = array(
                                
                                // for loop?
                                        '1' => 'BSc',
                                        '2' => 'BA',
                                        '3' => 'MSc',
                                        '4' => 'MA',
                                        '5' => 'MBA',
                                        '6' => 'MPhil',
                                        '7' => 'PhD'
                                );
                        echo form_dropdown('degreeType', $degreeOptions);

                            echo '<br> <br>';
                            echo '<p>Student Capacity</p>';
                            echo form_input('studentCap');
                            echo '<br> <br>';
                            
                           echo '<p>Start Year</p>';
                           echo form_input('startYear');
                           echo '<br> <br>';   
 
                          echo form_submit('createCourseBtn', 'Create Course');    
                                
            echo form_close();
 
    */
    ?>
            </center>
            
    
    <center>
        
        
        <?php
        
        
             echo form_open('management/courseManagement/create_module_form');
             
             echo "How Many Modules do you want to create?"; 
             echo form_input('numMods');
             
             echo form_submit('numOfModsBtn', 'Submit number' );
             echo form_close();
        
        
        
        ?>
        
       <?php
        /*
            echo validation_errors();
    
            echo form_open('management/courseManagement/create_module_validation');
                        echo '<p>Module Name</p>';
                        echo form_input('moduleName');
                            echo '<br> <br>';

                            echo '<p>Module Code</p>';
                            echo form_input('moduleCode');
                            echo '<br> <br>';
                            
                           echo '<p>Credits</p>';
                           echo form_input('moduleCredits');
                           echo '<br> <br>';   
 
                          echo form_submit('createModuleBtn', 'Create Module');    
                                
            echo form_close();
            
         * */

    ?>
            </center>
    
    
    
    
        
    
    
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

