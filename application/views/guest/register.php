<?php

defined('BASEPATH') OR exit('No direct script access allowed');
include_once 'application/controllers/register.php';

?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title> ARU Register</title>


</head>
<body>
Contact 07423817173 for problems. 
    <center><h1>Register A Guest Student Account</h1> 
        
        
        <p>Please note you will only be given a student ID and limited logged in privileges. <br> 
        You have to be enrolled onto a Course to gain full student account access and privileges</p>
    <?php
        
            echo validation_errors();
            echo form_open('Register/register_validation');
                        echo '<p> Username </p>';
                        echo form_input('username', $this->input->post('username'));
                            echo '</br>';
                        echo '<p> Personal Email: </p>';
                        echo form_input('pEmail', $this->input->post('pEmail'));
                            echo '</br>';                            
                        echo '<p>Password: </p>';    
                        echo form_password('password');
                            echo '</br>';
                        echo '<p>Confirm Password: </p>';    
                        echo form_password('confirmPassword');
                            echo '</br>';    

                        echo "<h3>Personal Details</h3>";
                            
                        echo '<p> Title  </p>';
                        echo form_input('title', $this->input->post('title'));
                            echo '</br>';
                        echo '<p> First Name </p>';
                        echo form_input('fName', $this->input->post('fName'));
                            echo '</br>';
                        echo '<p> Surname </p>';
                        echo form_input('sName', $this->input->post('sName'));
                            echo '</br>';
                            echo '<p> House Name </p>';
                        echo form_input('houseName', $this->input->post('hName'));
                            echo '</br>';
                            echo '<p> Street Name </p>';
                        echo form_input('streetName', $this->input->post('strName'));
                            echo '</br>'; 
                            echo '<p> Town Name </p>';
                        echo form_input('townName', $this->input->post('toName'));
                            echo '</br>'; 
                            echo '<p> County/State </p>';
                        echo form_input('countyName', $this->input->post('countyName'));
                            echo '</br>'; 
                            echo '<p> Country </p>';
                        echo form_input('countryName', $this->input->post('countryName'));
                            echo '</br>'; 
                        echo '<p> Postcode </p>';
                        echo form_input('pCode', $this->input->post('pCode'));
                            echo '</br>';     
                            echo '<p> Home Phone Number </p>';
                        echo form_input('homeNumber', $this->input->post('homeNumber'));
                            echo '</br>'; 
                            echo '<p> Mobile Number </p>';
                        echo form_input('mobileNumber', $this->input->post('mobileNumber'));
                            echo '</br>';     
                            echo '</br>';
            
                            echo form_submit('confirm', 'Confirm Details');    
                            
             echo form_close();

  //  Personal email
    ?>
   </center>     

</body>
</html>

