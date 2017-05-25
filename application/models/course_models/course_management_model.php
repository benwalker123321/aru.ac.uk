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
class Course_Management_Model extends CI_Model{
    
    
    public function create_course(){
             
        // create the insert array
        
        $newCourse = array(
                      
            'course_name' => $courseName = $this->input->post('courseName'),
            'student_capacity' => $this->input->post('studentCap'),
            'degree_id' => $degreeID = $this->input->post('degreeType'),
            'course_start_year' =>   $startYear = $this->input->post('startYear') 
                    
        );
        // see if course exists with inputted year    
        $this->db->where('course_name', $courseName);
        $this->db->where('degree_id', $degreeID); 
        $this->db->where('course_start_year', $startYear);
        $findMatchResult = $this->db->get('courses');
        
        if($findMatchResult->num_rows() <= 0){
            
      //      echo "This Course does not exist";  
            // insert the new course
            $insertNewCourse = $this->db->insert('courses',$newCourse);
            
            if($insertNewCourse){
                
           //     echo "Course Created";
                
            }else{
                
                echo "ERROR";
                
            }
   
        }else{
            
            echo "This course already exists with this year";
        }
        
    }
    
    
    public function edit_course(){
        
        $editCourse = array(
            
            
            
        );
        
    }
    // edit course
    // delete course
    
    // create module 
    // edit module 
    // delete module
    public function create_modules(){
        $j = 1; 
        for($i = 0; $i < 100; $i++){
            
            $createModuleData = array(
                
                'module_id' => '',
                'module_code' => $test = $this->input->post("moduleCode$j"),
                'module_name' => $this->input->post("moduleName$j"),
                'credits' =>  $this->input->post("moduleCredits$j"),
                'module_student_capacity' => $this->input->post("modStudentCap$j"),
                'desired_group_code_name' => $this->input->post("dgcn$j"),
                'number_of_groups' => $this->input->post("numOfGroups$j")
                       
            );
         
            // insert query 
            if($test == null){
                
                   return false;
                
            }else{
                
            $insertNewModule = $this->db->insert('modules',$createModuleData);
            
            create_groups(); 
            
            $j++;   
            
            
      
                if($insertNewModule){

                 // do nothing
                 // create groups based on that module   
                
               
                    
                    

                }else{

                    return false; 
                }
            
            }
        }  
            
    }
       
    
    public function create_groups(){
        
        // this function will create module groups
        // a lot of the data will be done in the background
        // the user only has to enter in the module ID. 
        // the program will do the rest alone
        // SUCH AS; count number of groups, students in each group 
        
    $newGroupData = array(
        
        'group_id' => '',
        'group_name' => $groupName,
        
        
    );
      
        
        
        
    }
        
        
    }
    // link module to course
    // unlink module to course

     
