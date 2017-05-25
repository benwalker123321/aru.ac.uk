<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of managerment_model
 *
 * @author Ben
 */
class Lecturer_Model extends CI_Model{

    
    public function load_group(){
          
        
            // save inputs
            $groupID = $this->input->post('groupID');
            $sessionID = $this->input->post('class_session_id');
           // count how many student in group 
            $this->db->select('*');
            $this->db->where('group_id', $groupID);
            $studentsInGroup = $this->db->get('student_groups');
            $numOfStuInGroup = $studentsInGroup->num_rows(); 
 
            if($studentsInGroup){
               // open class register form 
                echo '<div id="register">';
                 echo form_open('lecturerHome/take_register');
          
                        echo '<br><br>';
                         echo '<table id="classRegister" border="2">';
                         echo '<tr>';
                            echo '<th>Student ID</th>';
                            echo '<th>Attendance Status</th>';  
                         echo '</tr>';
             
                               
                              for($i = 0; $i < $numOfStuInGroup; $i++ ){  
                                  
                                  $aS = array(
                                    
                                      'name' => 'aS'.$i.'',
                                      'placeholder' => 'aS'.$i.'',
                                      
                                      
                                  );

                                    // collect all student id that are within that group class session. 
                                  
                                    $this->db->select('student_id');
                                    $this->db->where('class_session_id', $sessionID);
                                    $getStudentIDAttendanceCard = $this->db->get('attendance_cards');
                                    $studentIDa = $getStudentIDAttendanceCard->row($i);
                                    $studentID = $studentIDa->student_id;                                 
                                       echo '<tr>','<td>', form_input('sid',$studentID),'</td>','<td>', form_input($aS), '</td>', '</tr>';
                                        echo '<input hidden type="text" name="class_session_id", value= "'.$sessionID.'" >';
                                } 
                 
                        echo '</table>';
                        echo form_submit('subAttendance', 'Submit Attendance');    
                                
            echo form_close();
            
            echo '</div>';
                
                return true;
                
            }else{
                
                return false; 
            }
            
        
    }
    
        public function check_class_register_deadline(){
      
        // get session ID entered
        $sessionID = $this->input->post('class_session_id');
        // set correct timezone
        date_default_timezone_set("America/New_York");
        // collect the current time 
        $currentTime = date("h:i:s");
        $currentDate = date("Y/m/d");
        
        //search of session date
        $this->db->select('*');
        $this->db->where('class_session_id', $sessionID);
        $getSessionInfo = $this->db->get('class_sessions');          
        $fetchDate = $getSessionInfo->row(); 
        $scheduledDate = $fetchDate->date;
        echo $scheduledDate; 
        // check is the date is right
        
        if($currentDate == $scheduledDate ){
        
        // get session start time
        $fetchStartTime = $getSessionInfo->row();
        $scheduledStartTime = $fetchStartTime->start_time;
        // get session cut off time
        $fetchCutOffTime = $getSessionInfo->row();
        $scheduledCutOffTime = $fetchCutOffTime->cut_off_time; 
                                  
        
       if($currentTime >= $scheduledStartTime && $currentTime < $scheduledCutOffTime){
          
           return true; 
          
        
       }else{
            
            return false; 
            
        }
        
        }else{
            
            echo "This is the wrong day for the class session to be registered.";
            
        }
    }
    
    public function take_register(){
        
        $sessionID = $this->input->post('class_session_id');
        
        $this->db->select('student_id');
        $this->db->where('class_session_id',$sessionID);
        $getSIDs = $this->db->get('attendance_cards');      
        $getNumSIDs = $getSIDs->num_rows();

        for($j = 0; $j < $getNumSIDs;$j++){
            
         $sid = $getSIDs->row($j);  
         $sid1 = $sid->student_id;   
        
            $aS = array(
                
                'name' => 'aS'.$j.''

            );
            
           $as = implode($aS);

            $data = array(
                    
              'attendance_status' =>   $this->input->post($as)
                
           );
     
        
         $this->db->where('student_id', $sid1 );  
         $this->db->where('class_session_id', $sessionID);
         $updateAttendance = $this->db->update('attendance_cards', $data);
          

        }
         
        if($updateAttendance){
            
            return true; 
            
        }else{
            
            return false;
        }
        
        
    }
    
    
    

 
    public function calculate_student_attendance(){
        
         $studentID = $this->input->post('studentID');
         // find out all sessions from student
         $this->db->where('student_ID', $studentID);
         $countSessions = $this->db->get('attendance_cards');
         $totalSessions = $countSessions->num_rows(); 
        
        // find out all sessions from student where it equals YES OR TBD
         
         $this->db->where('student_ID', $studentID);
         $this->db->where('attendance_status', 'TBD');
         $this->db->or_where('attendance_status', 'YES');
         $countPosSessions = $this->db->get('attendance_cards');
         $totalPosSessions = $countPosSessions->num_rows(); 

         if($totalPosSessions && $totalSessions > 0){
             
             // calculate
             
             $overallAttendance = ($totalPosSessions / $totalSessions) * 100;
             
             $overallAttendanceData = array(
                 
                 'overall_attendance' => $overallAttendance
                 
             );
             
             
             $this->db->where('student_id', $studentID);
             $updateOverAllAttendance = $this->db->update('student_overall_attendance', $overallAttendanceData); 
             
             if($updateOverAllAttendance){
                 
                 return true;
                 
             }else{
                 
                 return false;
             }
             
             
         }else{
             
             echo "cannot deal with zero in division";
             
         }

        
    }

    
    public function update_student_module_attendance(){
        
        $studentID = $this->input->post('studentID');
        $moduleID = $this->input->post('moduleID');
        
        // find out all session attendance or TBD
        $this->db->select('*');
        $this->db->from('attendance_cards');
        $this->db->join('class_sessions', 'attendance_cards.class_session_id = class_sessions.class_session_id');
        $this->db->where('class_sessions.module_id', $moduleID);
        $this->db->where('attendance_cards.student_id', $studentID);
        $this->db->where('attendance_cards.attendance_status', 'YES');
        $this->db->or_where('attendance_cards.attendance_status', 'TBD');
        $studentPSessionsQuery = $this->db->get();
        $totalPStudentSessions = $studentPSessionsQuery->num_rows();
        // find out number of all sessions
        $this->db->select('*');
        $this->db->from('attendance_cards');
        $this->db->join('class_sessions', 'attendance_cards.class_session_id = class_sessions.class_session_id');
        $this->db->where('class_sessions.module_id', $moduleID);
        $this->db->where('attendance_cards.student_id', $studentID);
        $studentALLSessionsQuery = $this->db->get();
        $totalALLStudentSessions = $studentALLSessionsQuery->num_rows();
        
        if($totalPStudentSessions && $totalALLStudentSessions > 0){
            // * 50 becuse the number of rows seems to be doubled *50 or *100 / 2 gets the right result for now
            $moduleAttendance = ($totalPStudentSessions / $totalALLStudentSessions) * 50;
            
                $moduleAttendanceData = array(
                 
                 'module_attendance' => $moduleAttendance
                 
             );

             $this->db->where('student_id', $studentID);
             $this->db->where('module_id', $moduleID);
             $updateModuleAttendance = $this->db->update('student_modules', $moduleAttendanceData); 
             
             if($updateModuleAttendance){
                 
                 return true;
                 
             }else{
                 
                 return false;
             }
            
            
        }else{
            
            echo "Cannot Divide by 0";
        }

        
        
    }
    
    public function find_grade(){
    
   //find the correct grade for mark given to each marking element on an assignment

    for($i = 1; $i < 11; $i++ ){
        
   $mark = $this->input->post('mark'.$i.'');  
    
    $this->db->select('grade');
    $this->db->where("$mark BETWEEN mark_min AND mark_max",NULL, false );
    $this->db->limit(1);
    $findgrade = $this->db->get('grades');
    
    $theGrade = $findgrade->row();
    $displayGrade = $theGrade->grade;
    
    echo $displayGrade, ' ';
    echo '<br>';
    }

    $mark1 = $this->input->post('mark1') * 0.10; 
    $mark2 = $this->input->post('mark2') * 0.10; 
    $mark3 = $this->input->post('mark3') * 0.10; 
    $mark4 = $this->input->post('mark4') * 0.10; 
    $mark5 = $this->input->post('mark5') * 0.10; 
    $mark6 = $this->input->post('mark6') * 0.10; 
    $mark7 = $this->input->post('mark7') * 0.10; 
    $mark8 = $this->input->post('mark8') * 0.10; 
    $mark9 = $this->input->post('mark9') * 0.10; 
    $mark10 = $this->input->post('mark10')* 0.10; 

    
    
    $overallMark = $mark1 + $mark2 + $mark3 + $mark4 + $mark5 + $mark6 + $mark7 + $mark8 + $mark9 + $mark10 ;
    
    $overallMarkRounded = round($overallMark);
    
   
    
    $this->db->select('grade');
    $this->db->where("$overallMarkRounded BETWEEN mark_min AND mark_max",NULL, false );
    $this->db->limit(1);
    $findgrade = $this->db->get('grades');
    
    $theGrade = $findgrade->row();
    $displayGrade = $theGrade->grade;
    
    echo 'Overall Grade: ', $displayGrade, '  <br> ';
    
    
    echo $overallMarkRounded;
    
    
    
    
    if($displayGrade){
        
        return true;
    }else{
        
        return false;
    }
    
    
    

}

            public function load_assignment_marking_scheme(){
                
                // get assignment scheme template id 
                $assignmentID = $this->input->post('assignmentID');
                
                // search assignment scheme template
                
                $this->db->select('element_one', 'element_two','element_three','element_four','element_five','element_six','element_seven','element_eight','element_nine','element_ten');
                $this->db->where('marking_scheme_id', $assignmentID);
                $this->db->limit(1);
                $findAssignmentMS = $this->db->get('marking_schemes');
                // get the data 
                $findAssignmentInfo = $findAssignmentMS->row();           
                
                // make the table and form
                
                echo '<table border="1" >';
                
                echo form_open('lecturer/submit_assignment_marks');
                
                 echo '<tr>';
                        echo '<th>', 'Student ID: ', form_input('studentID',''), '</th>';
                        echo '<th>', 'Module ID: ', form_input('moduleID',''),'</th>';
                        echo '<th>', 'Assignment ID: ', form_input('assignmentID',''.$assignmentID.''),'</th>';
                echo '</tr>';
                
                echo '<br>';
                
                echo '<tr>';
                        echo '<th>', 'Marking Element', '</th>';
                        echo '<th>', 'Mark Obtained', '</th>';
                        echo '<th>', 'Element Value', '</th>';
                echo '</tr>';
                 $j= 2;
                for($i = 0; $i < 11; $i++ ){
                   $findCol = $findAssignmentInfo->col($j);        
                    echo '<tr>' , '<td>', $findCol , form_input('marksObtained', ''), form_input('elementValue',''), '</td>' , '</tr>';
                    
                    $j++;
                    
                }

                echo form_close();
                    
                echo '</table>';   
                
                $hello = 'hello'; 
                
            if($hello){
                return true;
            }else{
                return false; 
            }
            
          
             
                
                
                
                
            }
            
            public function submit_assignment_marks(){
                
                
                
            }
            
            
            public function publish_assignment(){
                
                
            }



}
                    
               
