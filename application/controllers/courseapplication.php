<?php

defined('BASEPATH') OR exit('No direct script access allowed');
// session_start();
class Courseapplication extends CI_Controller {
    
            public function index(){
                
                          if ($this->session->userdata('is_loggedIn') & !$this->session->userdata('is_Student') & !$this->session->userdata('is_Lecturer') & !$this->session->userdata('is_Manager')){
                          $this->load->model('course_models/Course_General_Model');   
                          $courseIDList['courseID'] = $this->Course_General_Model->get_course_ids();
                          $courseNameList['courseName']  = $this->Course_Gernal_Model->get_course_names();
                          $this->load->view('apply',$courseIDList + $courseNameList);
                        
                          }else{
                              redirect('restricted');
                      }   
                           

            }
              public function restricted(){
                 
                 $this->load->view('restricted');
                 
             } 
                     

     public function apply_validation(){
         
                    $this->load->library('form_validation');
                    $this->form_validation->set_rules('course', ' Course Name', 'required|trim');
                    
         if($this->form_validation->run()){
             
                     $this->load->library('email'); 
                     $this->load->model('course_models/Course_Enrolment_Model'); 
                     // set values
                     $SID = $this->input->post('SID');
                     $course = $this->input->post('course');
                     $key = md5(uniqid());
                                        
                      // message headers                 
                     $this->email->from('benwalker184@gmail.com', 'Ben Walker');
                     $this->email->to('ben.walker2@student.anglia.ac.uk','Ben' );
                     $this->email->subject("Student Course Application");
                     //main message content
                        $message = "Hello Admin";
                        $message .= " The User, $SID , wants to enrolled to , $course "; 
                        $message .= "<a href='".base_url()."index.php/courseapplication/enroll_student/$key'> Click here to view application </a>";
                        $this->email->message($message);
                        
                       if($this->Course_Enrolment_Model->check_student_limit_on_course(true)){

                     if($this->Course_Enrolment_Model->add_temp_student_course($key)){
                     if($this->email->send()){
                         
                         echo "An email has been sent to managerment with your Course Application Details, An email to confirm your new student enrollment will be with you within 1-5 working days";
                          
                         echo "<a href='".base_url()."index.php/courseapplication/enroll_student/$key'> Click here to view application </a>";
                     }else{
                         
                       echo  "oops.. there seems to be a problem sending your application to our manaagement team please contact the site admin for help, thank you for your patience";
                         
                     }

                        }else {

                           $this->load->view('apply');
                           // something went wrong adding?
                        }
                 }else{
                     
                     echo "Sorry, occuring to our records the course you have chosen is already reached its limit of student it can take. Please choosen another course or contact us for more info";
                 } 
       }
       
     }
          
       
             // add user to perm student table and to student_course table
             public function enroll_student($key){
                 
             $this->load->model('course_models/Course_Enrolment_Model');
                 
             if($this->Course_Enrolment_Model->is_key_valid_course($key)){
                 if($this->Course_Enrolment_Model->add_student_course($key)){

                      redirect('main');
                      $this->load->view('main');
                      echo "You now have a full student account. You may have to logged and out to get everything working! ";
                     
                 }else{
                     echo "failed to add user";
                 }
            //     echo "key is valid";
             }else{
                 
             //    echo "Key is Not Valid" ; 
                 
                 redirect('main');
                 $this->load->view('main');
                 echo "Attention: You have already activated this account";
                 
             }                 
             }

    }       