<?php

class courseManagement extends CI_Controller {
    
        public function index(){

          $this->load->view('management/courseManagement');

        }
        
        public function create_course_validation(){
            
                $this->load->library('form_validation');
                $this->load->model('course_models/Course_Management_Model');
                    $this->form_validation->set_rules('courseName', 'Course Name', 'required|trim');
                    $this->form_validation->set_rules('degreeType', 'Degree Type', 'required|trim');
                    $this->form_validation->set_rules('studentCap', 'Student Capacity', 'required|trim');

                if($this->form_validation->run()){
                        
                       $this->Course_Management_Model->create_course();

                }else{
                    
                     $this->load->view('management/courseManagement');
                    
                }
                
        }
       public $numMods = null; 
        public function create_module_form(){
            
            
            $numMods = $this->input->post('numMods');
            // $j is used to make the id's for each of the form elements created in the for loop correct. 
            // $i is used to operate the for loop correctly. 
            $j = 1;     
                   echo form_open('management/courseManagement/create_modules_validation');
                   
                          
                   for($i = 0; $i < $numMods; $i++){ 
                       
                            echo 'Module Name';                     
                            echo form_input("moduleName$j");
                            
                            echo 'Module Code';
                            echo form_input("moduleCode$j");
                           
                           echo 'Credits';
                           echo form_input("moduleCredits$j");
                           
                           echo 'Student Capacity';
                           echo form_input("modStudentCap$j"); 
                           
                           echo 'Desired group code name';
                           echo form_input("dgcn$j"); 
                           
                           echo 'Number of Groups';
                           echo form_input("numOfGroups$j"); 
                           
                           echo "<br><br>";
                     $j++;
                     }       
                          echo form_submit('createModuleBtn', 'Create Module(S)');    
                                
                   echo form_close();            
      
        }
        
        public function create_modules_validation(){
            
           // make sure all boxes are filled in. 
           $this->load->library('form_validation'); 
           $this->load->model('course_models/Course_Management_Model');
           
           $this->form_validation->set_rules('moduleName1', 'Module Name', 'required|trim');
           
          
            if($this->form_validation->run()){
           
                 $this->Course_Management_Model->create_modules();
             
           }else{
                    
                     $this->load->view('management/courseManagement');
                    
                }
    
            
        }
        
        
        
        
        
       } 
