<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// session_start();
class Main extends CI_Controller {

                public function index()
                {
                     //   $this->login();

                    if (!$this->session->userdata('is_loggedIn') & !$this->session->userdata('is_Student') & !$this->session->userdata('is_Lecturer') & !$this->session->userdata('is_Manager')){
                                    
                                    $this->load->library('unit_test');
                                    $result = 9;
                                    $expectedResult = 10;
                                    $this->unit->run($result,$expectedResult);    
                                    
                                    
                                    $this->load->view('home');  

                               }else{
                                    if ($this->session->userdata('is_loggedIn') & !$this->session->userdata('is_Student') & !$this->session->userdata('is_Lecturer') & !$this->session->userdata('is_Manager')){
                                        
                                            redirect('GuestHome');
                                        
                                    }

                                    else if($this->session->userdata('is_Student')){                
                                        redirect('studentHome');

                                    }else if ($this->session->userdata('is_Lecturer')){
                                        redirect('lecturerhome');
                                    }else if($this->session->userdata('is_Manager')) {

                                        redirect('managerhome');
                                    }else{

                                             redirect('restricted');                             
                                    }
                                }     

                }     
                
                
                
                 public function logout(){
                 $this->load->view('logout');
                 $this->session->sess_destroy();
                 redirect('main');
             }
                
            }
	
