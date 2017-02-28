<?php


class TaskList {
    
    private $db,
            $username,
            $userId,
            $userTasks = array(),
            $userTasksCount;
    
    public function __construct(user $user) {
        $this->db = Db::getInstance();
        $this->username = $user->getUserName();
        $this->userId = $user->getUserId();
        $this->fetchTasks();
    }

    
    private function fetchTasks(){
        
        $userTasks = $this->db->doDbAction('select','user_task', array('user_id' => $this->get_userId()));
        $this->userTasksCount = $userTasks->get_count();
        $userTasks = $userTasks->get_result(); 
        
        foreach($userTasks as $task){
            $this->userTasks[] = $task;
        }        
    }
    
    function get_tasks() {
        return $this->userTasks;
    }

        
    function get_userId() {
        return $this->userId;
    }

     
    public function deleteTask(){
    }
    
    public function editTast(){
    }
    
    
    public function ifTasksExists(){
    }
    
    public function addTask($userId, $taskName, $taskDescription, $taskExpiry){
        // $this->db->insert('users', array('username' => $username, 'password' => $password));
        
        $this->db->doDbAction('insert', 'user_task', array(
            'user_id'               => $userId,
            'task_name'             => $taskName,
            'task_description'      => $taskDescription,
            'expiry_date'           => $taskExpiry
        ));
        return $this;
    }
    
    public function updateTask($taskId, $taskName, $taskDescription, $taskExpiry){
        
        $this->db->doDbAction('update', 'user_task', 
                array(
            'id' => $taskId    
            ),
                array(
            'task_name' => $taskName,
            'task_description' => $taskDescription,
            'expiry_date' => $taskExpiry));
        return $this;
    }
    
    public function printTasks(){      
        $printer = new TaskPrinter();        
        $taskIncrement = 1;
        foreach($this->userTasks as $taskValues){
            $printer->printTask($taskValues['task_name'],
                                $taskIncrement, 
                                $taskValues['expiry_date'], 
                                $taskValues['task_description'],
                                $taskValues['id']);
            $taskIncrement++;
        }        
    }   
}
