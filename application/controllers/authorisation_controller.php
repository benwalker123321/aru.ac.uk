<?php

class Authorisation_Controller extends CI_Controller {

          public function managementHome(){
                 
                 if ($this->session->userdata('is_Manager')){
                     
                     $this->load->view('managementHome');
                     
                 }else{
                     
                     redirect('main/restricted');
                     
                 }
                 
             }
             
             public function lecturerHome(){
                 
                 if ($this->session->userdata('is_Lecturer')){
                     
                     $this->load->view('lecturerHome');
                     
                 }else{
                     
                     redirect('main/restricted');
                     
                 }
                 
             }
             
             public function studentHome(){
                 
                 if ($this->session->userdata('is_Student')){
                     
                     $this->load->view('studentHome');
                     
                 }else{
                     
                     redirect('main/restricted');
                     
                 }
             }   
             
              public function restricted(){
                 
                 $this->load->view('restricted');
                 
             } 
    
} 

