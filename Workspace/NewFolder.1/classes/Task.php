<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Task
 *
 * @author mc
 */
class Task {
    
    public $db,
           $taskId,
           $taskData = array(); 
    
    
    
    
    public function __construct($taskId) {
        $this->db = Db::getInstance();
        $this->setTaskId($taskId);
        $this->setTaskData($this->fetchTaskData($this->getTaskId()));
    }
    
    function getTaskId() {
        return $this->taskId;
    }

    function getTaskData() {
        return $this->taskData;
    }

        
    private function setTaskId($taskId) {
        $this->taskId = $taskId;
    }
    
    private function setTaskData($taskData){
        $this->taskData = $taskData;
    }
    
    private function fetchTaskData($taskId){        
        if($this->db->doDbAction('select', 'user_task', array('id' => $taskId))->get_count()){
            return $this->db->doDbAction('select', 'user_task', array('id' => $taskId))->get_first_row();
        } else {
            header('location:index.php');
        }
                       
    }



    
    
            
    
    
    
    
}
