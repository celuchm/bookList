<?php
require_once 'init/init.php';

if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['passwordRepeat'])){
    if($_POST['username'] === "" || $_POST['password'] === "" || $_POST['passwordRepeat'] ===""){
        echo "fulfill all data!";
    } else {
        $user = new User();
        if($user->register($_POST['username'], $_POST['password'], $_POST['passwordRepeat'])){
            Session::setSession('registerSuccess', true);
            header('location:index.php');
        } else {
            foreach($user->getRegisterError() as $error){
                echo $error."</br>";
            }
        }        
    }
}




?>



<!DOCTYPE html>

<form action="#" method="post">
    
    <label for="username"> username
    <input type="text" name="username" id="username">
    </br>
    <label for="password"> password
    <input type="password" name="password" id="password">
    </br>
     <label for="passwordRepeat"> password repeat
    <input type="passwordRepeat" name="passwordRepeat" id="passwordRepeat">
    </br>
    <input type="submit" value="register">
    
    
</form>
