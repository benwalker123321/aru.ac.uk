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
class Manager_Model extends CI_Model{
    
    public function create_class_session(){
        
                     $sessionID =  "";
                     $classID = $this->input->post('classID');
                     $roomID = $this->input->post('roomID');
                     $moduleID = $this->input->post('moduleID');
                     $groupID = $this->input->post('groupID');
                     $lecturerID = $this->input->post('lecturerID');
                     $date = $this->input->post('date');
                     $startTime = $this->input->post('startTime');
                     $cutOffTime = $this->input->post('cutOffTime');
                     $endTime = $this->input->post('endTime');
                     $sessionStatus = "Scheduled";
                     $attendanceGrade = "TBD";
                     $attendance = 0;
      
                     $insertNewSessionData = array(
                         
                         'class_session_id' => $sessionID,
                         'class_type_id' => $classID,
                         'room_id' => $roomID,
                         'module_id' => $moduleID,
                         'group_id' => $groupID,
                         'lecturer_id' => $lecturerID,
                         'date' => $date,
                         'start_time' => $startTime,
                         'cut_off_time' => $cutOffTime,
                         'end_time' => $endTime,
                         'session_status' => $sessionStatus,
                         'attendance_grade' => $attendanceGrade,
                         'attendance%' => $attendance 
                         
                     );
                     
                     $createClassSession = $this->db->insert('class_sessions', $insertNewSessionData);

                     if($createClassSession){
                         
                         return true;
                         
                     }else{
                         
                         return false;
                     }
                     
    }
    
    
            public function create_attendance_cards(){
                $this->load->database();    
                $newSessionIDData = ("SELECT * FROM class_sessions ORDER BY class_session_id DESC LIMIT 1");
                $newSessionIDResult = $this->db->query($newSessionIDData);
            //    $newSessionIDResult->execute();               
                $row = $newSessionIDResult->row();
                $sessionID = $row->class_session_id;
                $groupID = $row->group_id; 
                
                $countStudentsInGroupData = ("SELECT * FROM student_groups WHERE group_id=$groupID");
                $countStudentsInGroupResult = $this->db->query($countStudentsInGroupData);
          //      $countStudentsInGroupResult->execute();
                
                $studentCount = $countStudentsInGroupResult->num_rows();
                
                for($i = 0; $i < $studentCount; $i++){
                        
                $row2 = $countStudentsInGroupResult->row($i);
                $studentID = $row2->student_id; 
                    
                    $attendanceCardData = array(
                        
                        'attendance_card_id' => '',
                        'class_session_id' => $sessionID,
                        'student_id' => $studentID,
                        'attendance_status' => 'TBD'
  
                    );
 
                    $createAttendanceCards = $this->db->insert('attendance_cards',$attendanceCardData); 
                    
                }
                    if($createAttendanceCards){
                        
                        return true;
                        
                    }else{
                        
                        return false;
                    }
                    

            }
    
    
}
                    
               
