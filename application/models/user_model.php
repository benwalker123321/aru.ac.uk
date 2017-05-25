<?php

class User_Model extends CI_Model{

            public function  can_log_in(){
                
                $this->db->where('username', $this->input->post('username'));
                $this->db->where('password', md5($this->input->post('password')));
                $this->db->limit(1);
                $query = $this->db->get('users');

                
                        if($query->num_rows() == 1){
                            // find user id
                          $userName =   $this->db->where('username', $this->input->post('username'));
                             $this->db->where('password', md5($this->input->post('password')));
                             $this->db->limit(1);
                             $query2 = $this->db->get('users', $userName);

                            $row = $query2->row();
                            $userID = $row->user_id;
                             
                                // find role id
                              $this->db->where('user_id', $userID );
                              $this->db->limit(1);
                              $query3 = $this->db->get('user_role');
                              $row2 = $query3->row();
                              $userRoleID = $row2->role_id;
                              
                              
                              // set up student id
                              $user = $this->db->where('user_id', $userID );
                              $this->db->limit(1);               
                              $query4 = $this->db->get('students',$user);
                              $row3 = $query4->row();                              
                              $studentID = $row3->student_id; 
             
                              
                        
                              
                              
                              
                              
                              if($userRoleID == 1){
                                  
                                  $data = array(      
                                    'username' => $this->input->post('username'),
                                    'is_loggedIn' => 1,
                                    'is_Manager' => true,  
                                    'user' => $userID
                                    
                                          
                               );
                                  
                              }else if($userRoleID == 2){
                                  
                                  
                                  
                                  
                                  
                                  $data = array(      
                                    'username' => $this->input->post('username'),
                                    'is_loggedIn' => 1,
                                    'is_Lecturer' => true,
                                    'user' => $userID,
                                    'lecturer' => $lecturerID  
                               );
                                  
                              }else if($userRoleID == 3){
                                  
                                  $data = array(      
                                    'username' => $this->input->post('username'),
                                    'is_loggedIn' => 1,
                                    'is_Student' => true,
                                    'user' => $userID,
                                    'SID' => $studentID    
                               );
                                  
                              }else if(!$userRoleID){
                                  
                                  $data = array(      
                                    'username' => $this->input->post('username'),
                                    'is_loggedIn' => 1,
                                    'user' => $userID,
                                    'SID' => $studentID        
                               );
                                  
                              } 
                                  
                               $this->session->set_userdata($data);   

                               return true;
                        }else{
                            
                           return false;
                            
                        }
                            
            
            }
            public function add_temp_user($key){                            
                $tempUserData = array(
                    
                    'username' => $this->input->post('username'),
                    'manager_id' => null,
                    'lecturer_id' => null,
                    'student_id' => null,
                    'personal_email' => $this->input->post('pEmail'),
                    'password' => $this->input->post('password'),
                    'key' => $key
                );
                
                $add_temp_user = $this->db->insert('temp_users', $tempUserData);
                
                    $this->db->where('key', $key);
                    $userIDQuery = $this->db->get('temp_users');                   
                    $userIDRow = $userIDQuery->row();
                    $userID = $userIDRow->user_id; 

                if($add_temp_user){

                    $tempStudentData = array(
                    'student_id' => "",    
                    'user_id' => $userID,    
                    'title' => $this->input->post('title'),
                    'first_name' => $this->input->post('fName'),
                    'surname' => $this->input->post('sName'),
                    'house' => $this->input->post('houseName'),
                    'street' => $this->input->post('streetName'),
                    'town' => $this->input->post('townName'),
                    'county' => $this->input->post('countyName'),
                    'country' => $this->input->post('countryName'),
                    'postcode' => $this->input->post('pCode'),
                    'home_number' => $this->input->post('homeNumber'),
                    'mobile_number' => $this->input->post('mobileNumber'),
                    'key' => $key
                );
 
                $add_temp_student = $this->db->insert('temp_students', $tempStudentData);
                
                if($add_temp_student){
                   return true; 
                }else{
                    return false;
                }
                    return true;
                    
                }else{
                    
                    return false;
                }

            }

            public function is_key_valid($key){
                
                $this->db->where('key', $key);
                $query = $this->db->get('temp_users');
                
                if($query->num_rows() == 1){
                    
                    return true;
                    
                }else{
                    
                    return false;
                    
                }
    
            }
            
            
            public function add_user($key){
                
                $this->db->where('key', $key);
                $temp_users = $this->db->get('temp_users');
                
                if($temp_users){

                    $row = $temp_users->row();
                     $userData = array(

                        'username' => $row->username,
                        'manager_id' => 0,
                        'lecturer_id' => 0,
                        'student_id' => "",
                        'personal_email' => $row-> personal_email,
                        'password' => $row-> password
                        
                    );
                    
                    $did_add_user = $this->db->insert('users', $userData); 

                }
                
                $this->db->where('key', $key);
                $temp_students = $this->db->get('temp_students');
                
                if($temp_students){
               
                    $row = $temp_students->row();

                    $studentData = array(
                        
                    'student_id' => $row->student_id,
                    'user_id' => $row->user_id,
                    'title' => $row->title,
                    'first_name' => $row->first_name,
                    'surname' => $row->surname,
                    'house' => $row->house,
                    'street' => $row->street,
                    'town' => $row->town,
                    'county' => $row->county,
                    'country' => $row->country,
                    'postcode' => $row->postcode,
                    'home_number' => $row->home_number,
                    'mobile_number' => $row->mobile_number

                    );
                    
                    $did_add_student = $this->db->insert('students', $studentData); 

                if($did_add_user){

                    $this->db->where('key', $key);
                    $this->db->delete('temp_users');
                   
                    $this->db->where('key', $key);
                    $this->db->delete('temp_students');
                    return true;
                }
                return false;
                
            }
            
            }

}
