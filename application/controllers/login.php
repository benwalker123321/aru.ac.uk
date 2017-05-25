<?php

defined('BASEPATH') OR exit('No direct script access allowed');
// session_start();
class Login extends CI_Controller {
    

             // MEMBER TYPE PAGES
             

            public function login_validation(){
                 
                 $this->load->library('form_validation');
                 
                 $this->form_validation->set_rules('username', 'Username', 'required|trim|callback_validate_credentials');
                 $this->form_validation->set_rules('password', 'Password', 'required|md5|trim');
                 
                 if($this->form_validation->run()){
                     
                     redirect('login/logInSuccessful');
                     
                 }else{
                     
                     $this->load->view('home');
                     
                 }

             }

             public function validate_credentials(){
                 
                 $this->load->Model('user_model');
                 
                 if($this->user_model->can_log_in()){

                        return true;
                    
                 } else{
                     
                     $this->form_validation->set_message('validate_credentials', 'Incorrect Username Or Password');
                     return false;
                 }

             }
             
             public function logInSuccessful(){   
                 
                 if($this->session->userdata('is_Student')){
                     
                     redirect('studentHome');
                 }
                  else if($this->session->userdata('is_Lecturer')){
                     
                     redirect('lecturerHome');
                 }
                 else if($this->session->userdata('is_Manager')){
                        
                      redirect('manHome');
                 }
                    else{
                     
                     redirect('courseApplication');
                 }
 
              }
             
             public function restricted(){
                 
                 $this->load->view('restricted');
                 
             } 
             
       
             
             public function logout(){
                 $this->load->view('logout');
                 $this->session->sess_destroy();
                 redirect('main');
             }

}

