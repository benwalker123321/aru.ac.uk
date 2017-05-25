<?php

class Manhome extends CI_Controller {

          public function index(){
              
                         if ($this->session->userdata('is_Manager')){  // stop unauthorised users from gaining access to this page                    
                                $this->load->view('management/managementHome'); // loads managementHome Page
                                $this->load->helper('url');                      
                 }else{
                     
                     redirect('restricted');
                     
                 }
                       
             }
             
             public function session_validation(){
                 $this->load->library('form_validation');
        
                 $this->form_validation->set_rules('classID', 'classID', 'required|trim');
                 $this->form_validation->set_rules('roomID', 'roomID', 'required|trim');
                 $this->form_validation->set_rules('moduleID', 'moduleID', 'required|trim');
                 $this->form_validation->set_rules('groupID', 'groupID', 'required|trim');
                 $this->form_validation->set_rules('lecturerID', 'lecturerID', 'required|trim');
                 $this->form_validation->set_rules('date', 'date', 'required|trim');
                 $this->form_validation->set_rules('startTime', 'startTime', 'required|trim');
                 $this->form_validation->set_rules('endTime', 'endTime', 'required|trim');
                 
                   if($this->form_validation->run()){
                     
                     $this->load->model('Manager_Model');
                     
                     if($this->Manager_Model->create_class_session(true)){
                         
                         echo "Session Created";
                         
                         if($this->Manager_Model->create_attendance_cards(true)){
                             
                             echo "attendance cards created";
                             
                         }else{
                             
                             echo "attendance not created";
                             
                         }
                           
                     }else{
    
                         echo "Session Not Created";
                        
                     }

                 }else {
                     echo "validation failed";
                     
                 }

             }
} 

