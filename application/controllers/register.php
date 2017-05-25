<?php

defined('BASEPATH') OR exit('No direct script access allowed');
// session_start();
class Register extends CI_Controller {
    
   public function index(){
                 
                 $this->load->view('guest/register');

             }
             
      public function register_validation(){

                 $this->load->library('form_validation');                 
                 $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[users.username]');
                 $this->form_validation->set_rules('pEmail', 'Personal Email', 'required|trim|valid_email');
                 $this->form_validation->set_rules('password', 'Password', 'required|md5|trim');
                 $this->form_validation->set_rules('confirmPassword', 'Confirm Password', 'required|md5|trim|matches[password]');
                
                 
                 
                    $this->form_validation->set_rules('title', 'Title', 'required|trim');
                    $this->form_validation->set_rules('fName', 'First Name', 'required|trim');
                    $this->form_validation->set_rules('sName', 'Surname', 'required|trim');
                    $this->form_validation->set_rules('houseName', 'House Name or Number', 'required|trim');
                    $this->form_validation->set_rules('streetName', 'Street Name', 'required|trim');
                    $this->form_validation->set_rules('townName', 'Town Name', 'required|trim');
                    $this->form_validation->set_rules('countyName', 'County Name', 'required|trim');
                    $this->form_validation->set_rules('countryName', 'Name of Country', 'required|trim');
                    $this->form_validation->set_rules('pCode', 'Postcodey', 'required|trim');
                    $this->form_validation->set_rules('homeNumber', 'Home Phone Number', 'required|trim');

                 if($this->form_validation->run()){

                     //generate a random key                     
                     $key = md5(uniqid());
                    
                     $this->load->library('Email');    $this->load->model('User_Model');                  
                     $this->email->from('benwalker184@gmail.com', 'Ben Walker');
                     $this->email->to($this->input->post('pEmail'));
                     $this->email->subject("Confirm Account Activation");
                     
                     $message = "Welcome to Anglia Ruskin University, thank you for signing up";
                     $message .= "<p>Click on the link below to activate your Guest Account with Anglia Ruskin University</p>";
                     $message .= "<a href='".base_url()."index.php/register/register_user/$key'> Click here to Activate Guest Account </a>";
                     
                     $this->email->message($message);    
                        $this->load->model('User_Model'); 
                     if($this->User_Model->add_temp_user($key)){
                         
                          if($this->email->send()){                         
                        echo "The Account Activation Email has Been sent to your personal email account";
                        echo "<a href='".base_url()."index.php/register/register_user/$key'> Click here to Activate Guest Account </a>";
                     }else{
                         
                       echo  "oops.. there seems to be a problem sending your an activation email please contact the site admin for help, thank you for your patience";
                     }
                         
                     }else{
                         
                         echo "problem adding user";
                     }
                     
                 }else{

                     $this->load->view('guest/register');
                 }
                 
                 
             }
             
             public function register_user($key){
                 
                 $this->load->model('User_Model');
                 
             if($this->User_Model->is_key_valid($key)){
                 if($this->User_Model->add_user($key)){

                     $data = array(

                         'is_logged_in' => 1
 
                     );

                     $this->session->set_userdata($data);
                     
                     
                      $this->load->view('home');
                      echo "You are now a member of this website, if you would like to apply to a course and upgrade you account click here.";
                     
                 }else{
                     echo "failed to add user";
                 }
            //     echo "key is valid";
             }else{
                 
             //    echo "Key is Not Valid" ; 
                 
                 $this->load->view('home');
                 echo "Attention: You have already activated this account";
                 
             }

        }
}           
             