<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once '/application/controllers/courseapplication.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title> ARU Course Apply</title>


</head>
<body>
Contact 07423817173 if you any issues. 
    <center><h1>Apply to A Course</h1> 
        <a href='<?php  echo base_url(). "index.php/main/logout" ?>'>Logout</a>
    <?php
        
            echo validation_errors();
    
            echo form_open('courseapplication/apply_validation');
                
                        echo "<h3>Course Details</h3>";#
                         echo form_input('SID', $this->session->userdata('SID'), 'hidden');
                            echo '</br>';          
                        echo "<p>Course Name</p>"; // computer science 

             //                          var_dump($courseName);
                        echo form_dropdown('course', $courseID, '');
                        echo form_submit('applyBtn', 'Apply');
                        echo form_submit('clearBtn', 'Reset');
                        
                                
            echo form_close();

    ?>
   </center>     

</body>
</html>

