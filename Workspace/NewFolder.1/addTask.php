<?php
require_once 'init/init.php';
if(!Session::checkSession('userLogged')){
    header('location: index.php');
} else {
    $user = new User(Session::getSessionValue('userLogged'));
}




if(isset($_POST['taskName']) && isset($_POST['taskDate']) && isset($_POST['text'])){
    
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
         $userTasks->addTask($userTasks->get_userId(), $_POST['taskName'], $_POST['text'], $_POST['taskDate']);
         
         header('location:index.php');
         
         
     } else {
     print_r($validation->getValidationErrors());

     }
}



?>







<form action ="#" method="post" id="addTaskForm">
        <label for=="taskName"> task name
        <input type="text" name="taskName"></br>
        <label for="taskDate"> task expiration
        <input type="date" name="taskDate"></br>
        <textarea rows="4" cols="50" name="text"></textarea>
        <input type="submit" value="add">
</form>
