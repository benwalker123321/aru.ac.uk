<?php

class Lecturerhome extends CI_Controller {

          public function index(){
              
                         if ($this->session->userdata('is_Lecturer')){  // stop unauthorised users from gaining access to this page                    
                                $this->load->view('lecturer/lecturerHome'); // loads lecturerHome Page
                                $this->load->helper('url');                      
                 }else{
                     
                     redirect('restricted');
                     
                 }
                       
             }
             
             
        public function load_group(){
            
            $this->load->model('Lecturer_Model');

            if($this->Lecturer_Model->load_group()){
                
                $this->load->view('lecturer/lecturerHome');
                
            }else{
                
               echo "Group Student IDs failed";
            }
            
      
            
        }
        
        
        public function take_register(){

             $this->load->model('Lecturer_Model');
                         if($this->Lecturer_Model->check_class_register_deadline(true)){
                             
                         if($this->Lecturer_Model->take_register(true)){

                             echo "Done";

                         }else{

                             echo"WHAT";
                         }
                         
                       }else{
            
                  echo "The time is not right for this class register to be taken or accessed";
            
                   } 

        }
             
             
             
             
             
             
             public function submit_attendance(){
                 
                 $this->load->model('Lecturer_Model');
                 
                 if($this->Lecturer_Model->submit_register(true)){
                     
                     echo "Register Submitted";
                     
                     $student1 = $this->input->post('studentID1');
                     $student2 = $this->input->post('studentID2');
                     
                     echo $student1;
                     echo $student2;
                     
                 if($this->Lecturer_Model->calculate_student_attendance(true)){
                     
                     echo "Attendance Updated";
                     
                     if($this->Lecturer_Model->update_student_module_attendance(true)){
                         
                         echo "<br>", "Module Attendance Updated";
                         
                     }else{
                         
                         echo "cannot update module attendance";
                     }
                     
                 }else{
                     
                     echo "could not update attendance";
                     
                 }    
                     
                     
                 }else{
                     
                     echo "cannot submit register";
           
                 }
                 
                 
                 
                 
             }
             
             
             public function find_grade(){
                 
                  $this->load->model('Lecturer_Model');
                  
             if($this->Lecturer_Model->find_grade()){
                 // do nothing
             }else{
                 
                 echo "error";
             }
                 
                 
             }
             
             
             public function load_assignment_mark_sheet(){
                 
                  $this->load->model('Lecturer_Model');
                 
                  if($this->Lecturer_Model->load_assignment_marking_scheme()){
                        
                        
                      
                  }else{
                      
                      echo 'error';
                   
                  }
                 
             }
             
             
             

} 

