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
class Student_Model extends CI_Model{
    
    
    public function check_student_can_add_module(){
        
                // FIND the course the student is on
            $findStudentCourse = ("SELECT * FROM student_course WHERE student_id=$studentID");
            $findStudentCourseResult = $this->db->prepare($findStudentCourse);
	    $findStudentCourseResult->execute();
            $row = $findStudentCourseResult->row();
            $courseID = $row->course_id;  
            
            // Now gather the course credit limit from that course
            
            $courseCreditLimitData = ("SELECT credit_limit from course  WHERE course_id=$courseID");
            $courseCreditLimitQuery = $this->db->query($courseCreditLimitData);
            
            $clRow = $findStudentCourseQuery->row();
            $courseCreditLimit = $clRow->credit_limit; 
             
            
                    $studentID = $this->session->userdata('SID');
                    $findStudentModuleData = ("SELECT * FROM student_modules WHERE student_id=$studentID");
                    $findStudentModulesQuery = $this->db->query($findStudentModuleData);
                    $row = $findStudentModulesQuery->row();
                    $courseID = $row->course_id; 
 
                    $findCourseModules = ("SELECT module_id FROM course_modules WHERE course_id=$courseID AND optional_compulsory='c' ");
                    $findCourseModulesQuery = $this->db->prepare($findCourseModules);
                    $findCourseModulesQuery->execute; 

                    $numMods = $findCourseModulesQuery->num_rows();

                        for ($i= 0; $i < $numMods; $i++){

                            $module = $findCourseModulesQuery->row($i);

                              $assignStudentModule = array(

                             'student_id' => $studentID,
                             'module_id' => $module->module_id,
                             'module_attendance' => 0

                         );

                             
                        }

        
    }
    
    
    
     public function show_optional_modules(){
                 
                 
              $studentID = $this->session->userdata('SID');
              
                    $findStudentCourse = ("SELECT * FROM student_course WHERE student_id=$studentID");
                    $findStudentCourseQuery = $this->db->query($findStudentCourse);
                    $row = $findStudentCourseQuery->row();
                    $courseID = $row->course_id;  
                    $findCourseModules = ("SELECT module_id FROM course_modules WHERE course_id=$courseID AND optional_compulsory='o' ");
                    $findCourseModulesQuery = $this->db->query($findCourseModules);

                       foreach($findCourseModulesQuery->result_array() as $row){

                           $moduleIDList[$row['module_id']] = $row['module_id'];   
                            
                     }      
                     return $moduleIDList;
                    

     }
     
       public function show_assigned_modules(){
                 
                 
              $studentID = $this->session->userdata('SID');
              
                   $this->db->where('student_id', $studentID);
                   $getStudentModules = $this->db->get('student_modules');
              
              

                       foreach($getStudentModules->result_array() as $row){

                           $moduleList[$row['module_id']] = $row['module_id'];   
                            
                     }      
                     return $moduleList;
 
     }
     
     
     

             public function add_modules(){
                    
               $studentID = $this->session->userdata('SID');  
                 
                 $assignStudentModule = array(

                             'student_id' => $studentID,
                             'module_id' => $this->input->post('module'),
                             'module_attendance' => 0

                         );
                 
                         $assignOptionalModule = $this->db->insert('student_modules', $assignStudentModule); 

             }
             
             public function get_overall_attendance(){
                 
                 $studentID = $this->session->userdata('SID');
                 $this->db->where('student_id',$studentID );
                 $studentOverallAttendanceQuery = $this->db->get('student_overall_attendance');
                 $row = $studentOverallAttendanceQuery->row();                
                 $overallAttendance = $row->overall_attendance; 
                    return $overallAttendance;
             }
             
             
             public function get_module_attendance(){
                 
                 $studentID = $this->input->post('SID');
                 $moduleID = $this->input->post('moduleChosen');
                 
                 $this->db->where('student_id',$studentID);
                 $this->db->where('module_id',$moduleID);
                 $getAttendanceQuery = $this->db->get('student_modules');
 
                 $row = $getAttendanceQuery->row();
                 
                 $moduleAttendance = $row->module_attendance; 
                 
                 if($moduleAttendance){
                     
                    echo $moduleAttendance;
                        return true;
                 }else{
                 
                     return false;
                 }
                
                 
             }
             
             
    
}
                    
               
