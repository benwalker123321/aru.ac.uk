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
class Course_General_Model extends CI_Model{
    
    
    
    public function get_course_ids(){
   
        $searchCourses = ('select *  from courses ');
        $searchCoursesQuery = $this->db->query($searchCourses);


            foreach($searchCoursesQuery->result_array() as $row){

                $courseIDList[$row['course_id']] = $row['course_id'];   
                            
            }      
        return $courseIDList;

    }
  
    public function get_course_names(){

        $searchCourses = ('SELECT * FROM courses ');
        $searchCoursesQuery = $this->db->query($searchCourses);
 
        
             foreach($searchCoursesQuery->result_array() as $row){

                $courseNameList[$row['course_name']] = $row['course_name'];   

            } 
            return $courseNameList;
        }

    
}