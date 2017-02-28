<?php
require_once 'init/init.php';
require_once 'htmlComponents/header.php';


echo '<div class="container">';

if(isset($_SESSION['logginSuccess']) && $_SESSION['logginSuccess']){
    echo '<div class="alert alert-success>login succesfull</div>';
    Session::unsetSession('logginSuccess');    
} elseif(isset($_SESSION['registerSuccess']) && $_SESSION['registerSuccess']) {
    echo '<div class="alert alert-success">register succesfull, you can now login</div>';
    Session::unsetSession('registerSuccess'); 
}

echo '</div>';

if(isset($user) && $user->isUserLogged()){
    //var_dump($user);
    echo '<div class="container">';
    $taskList = new TaskList($user);
    $taskList->printTasks();
    
    echo "</div>";
} else {    
 echo '<div class="alert alert-info" role="alert">To check and add tasks - <a href="login.php">log in</a></div>'; 
}

if(Session::checkSession('userLogged')){
    echo '<a href="addTask.php">add new task</a>';
}




?>


