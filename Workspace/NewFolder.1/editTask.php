<?php
require_once 'init/init.php';
if(!Session::checkSession('userLogged')){
    header('location: index.php');
} else {
    $user = new User(Session::getSessionValue('userLogged'));
}




if(isset($_POST['taskName']) && isset($_POST['taskDate']) && isset($_POST['text']) && isset($_POST['taskId'])){
    
     $validation = new Validation();
     if($validation->validate(array(
             'taskName' => array(
                 'value'    => $_POST['taskName'],
                 'required' => true,
                 'length'   => 40           
             ),
             'taskDate' => array(
                 'value'    => $_POST['taskDate'],
                 'required' => true
             ),
             'text' => array(
                 'value'    => $_POST['text'],
                 'required' => true,
                 'length'   => 60
             )
         ))->isValid()){        
         
         $userTasks = new TaskList($user);
         $userTasks->updateTask($_POST['taskId'], $_POST['taskName'], $_POST['text'], $_POST['taskDate']);
         
         header('location:index.php');
         
         
     } else {
     print_r($validation->getValidationErrors());
     }
}






?>



<?php

    
    $task = new Task( $_GET['taskId']);
    $task = $task->getTaskData();
?>



<form action ="#" method="post" id="addTaskForm">
        <label for=="taskName"> task name
        <input type="text" name="taskName" value ="<?php echo $task['task_name'];?> "></br>
        <label for="taskDate" > task expiration
        <input type="date" name="taskDate" value ="<?php echo $task['expiry_date'];?>"></br>
        <textarea rows="4" cols="50" name="text"><?php echo $task['task_description'];?></textarea>
        <input type="hidden" name="taskId" value="<?php echo $_GET['taskId'];?>">
        <input type="submit" value="edit">
</form>
