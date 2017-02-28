<?php
require_once 'init/init.php';
if(isset($_POST['username']) && isset($_POST['password'])){
    if($_POST['username'] === "" || $_POST['password'] === ""){
        echo "fulfill all data!";
    } else {
        $user = new User();
        if($user->login($_POST['username'], $_POST['password'])){
            header('location:index.php');            
        }                   
    }
}


if(isset($_SESSION['logginSuccess']) && !$_SESSION['logginSuccess']){
    echo "login error, try again";
    Session::unsetSession('logginSuccess');    
}







?>




<form action="#" method="post">
    
    <label for="username"> username
    <input type="text" name="username" id="username">
    </br>
    <label for="password"> password
    <input type="password" name="password" id="password">
    </br>
    <input type="submit" value="zaloguj">
    
    
</form>
