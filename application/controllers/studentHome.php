<?php

class StudentHome extends CI_Controller {

          public function index(){
              
                         if ($this->session->userdata('is_Student')){  // stop unauthorised users from gaining access to this page                    
                                $this->load->model('Student_Model');
                                $moduleIDList['moduleID'] = $this->Student_Model->show_optional_modules();
                                $overallAttendance['overallAttendanceStudent'] = $this->Student_Model->get_overall_attendance();
                                $moduleList['module'] = $this->Student_Model->show_assigned_modules();
                                
                                
                                $this->load->view('studentHome', $moduleIDList + $overallAttendance + $moduleList); // loads studentHome Page
                                $this->load->helper('url'); 
                                
                 }else{
                     
                     redirect('restricted');
                     
                 }
                       
             }
          
             public function add_modules(){
                 
                 $this->load->model('Student_Model');
                 
                 if($this->Student_Model->add_modules()){
                     
                     
                     
                 }else{
                     
                        
                     echo "error";
                     
                 }
                 
                 
             }
             
             public function view_module_attendance(){
                 
                 
                 $this->load->model('Student_Model');
                 
                 if($this->Student_Model->get_module_attendance(true)){

                    
                     
                 }else{
                     
                     echo "cannot load module attendance";
                     
                 }
                 
                 
                 
             }
        
           
             

} 

