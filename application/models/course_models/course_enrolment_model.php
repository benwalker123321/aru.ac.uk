<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of course_model
 *
 * @author Ben
 */
class Course_Enrolment_Model extends CI_Model{
     
    public function check_student_limit_on_course(){
        
        // count student_course_limit
        //get number of students allowed on course
        $this->load->database();
        $chosenCourse = $this->input->post('course');
        $studentLimit = ("SELECT * FROM courses WHERE course_id=$chosenCourse");
        $studentLimitQuery = $this->db->query($studentLimit);
        $row = $studentLimitQuery->row();
        $courseLimit = $row->student_limit; 

        // count number of students on student_course
        
        $numOfstudentOnTempCourse = $this->db->query("SELECT * from temp_student_course where course_id=$chosenCourse");

        $numOfstudentOnTempCourseResult =  $numOfstudentOnTempCourse->num_rows(); 

        $numOfstudentOnCourse = $this->db->query("SELECT * from student_course where course_id=$chosenCourse");
        
        $numOfstudentOnCourseResult =  $numOfstudentOnCourse->num_rows(); 

        $sum = $numOfstudentOnTempCourseResult + $numOfstudentOnCourseResult;

                        if ($sum >= $courseLimit){         
                           return false;
                        }else{
                          //  echo "course NOT full";
                           return true; 
                        }

    }    

    public function add_temp_student_course($key){

        
                $studentCourseData = array(
                    'student_id'  => $this->input->post('SID'),    
                    'course_id' => $this->input->post('course'),
                    'key' => $key
                );
                
                $add_temp_student_course = $this->db->insert('temp_student_course',$studentCourseData);
 
                if($add_temp_student_course){
                   return true; 
                }else{
                    return false;
                }
            }

             public function is_key_valid_course($key){
                
                $this->db->where('key', $key);
                $query = $this->db->get('temp_student_course');
                
                if($query->num_rows() == 1){
                    
                    return true;
                    
                }else{
                    
                    return false;
                    
                }
 
            }
     
            

            public function add_student_course($key){
              
                    
                    $this->db->where('key', $key);
                    $temp_student_course = $this->db->get('temp_student_course');
                    
                    $row = $temp_student_course->row();
                    
                    $addStudentToCourse = array(
                        
                        'student_id' => $row->student_id,
                        'course_id' => $row->course_id
                        
                    );
                    
                    $did_add_student_course = $this->db->insert('student_course', $addStudentToCourse); 

                if($did_add_student_course){
                    
                    $studentID = $this->session->userdata('SID');
                    $findStudentCourse = ("SELECT * FROM student_course WHERE student_id=$studentID");
                    $findStudentCourseQuery = $this->db->query($findStudentCourse);
                    $row = $findStudentCourseQuery->row();
                    $courseID = $row->course_id; 
 
                    $findCourseModules = ("SELECT module_id FROM course_modules WHERE course_id=$courseID AND optional_compulsory='c' ");
                    $findCourseModulesQuery = $this->db->query($findCourseModules);

                    $numMods = $findCourseModulesQuery->num_rows();

                        for ($i= 0; $i < $numMods; $i++){

                            $module = $findCourseModulesQuery->row($i);

                              $assignStudentModule = array(

                             'student_id' => $studentID,
                             'module_id' => $module->module_id,
                             'module_attendance' => 0

                         );

                             $assignModule = $this->db->insert('student_modules', $assignStudentModule); 
                        }
            
                    $roleStudent = array(
                                     'user_id' => $this->session->userdata('user'), // This way the real user has to be logged on first. Stops anyone else completing the enrollment!
                                     'role_id' => 3
                                    );
                     $this->db->insert('user_role',$roleStudent);
                     
                     $studentAttendance = array(
                                     'student_id' => $studentID, // This way the real user has to be logged on first. Stops anyone else completing the enrollment!
                                     'overall_attendance' => 0
                                    );
                    
                    $this->db->insert('student_overall_attendance',$studentAttendance);
                    
                    $this->db->where('key', $key);
                    $this->db->delete('temp_student_course');
                    
                      $data = array(      
                                    'is_loggedIn' => 1,
                                    'is_Student' => true,
                               );
                    
                     $this->session->set_userdata($data); 
                    
                    return true;
                    
                }
                return false;
         
            }
            
            // remove student from module
            //
    
}