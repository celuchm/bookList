<?php

require_once 'init/init.php';
if(!Session::checkSession('userLogged') && !isset($_GET['taskId'])){
    header('location: index.php');
} else {
   
    $task = new Task($_GET['taskId']);
    $task->deleteTask();
    
    header('location:index.php');
    
}

