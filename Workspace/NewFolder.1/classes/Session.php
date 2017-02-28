<?php

class Session {
    public static function setSession($sessionName, $value){
        $_SESSION[$sessionName] = $value;               
    }
           
    public static function isSetSession($sessionName){
        
        if(isset($_SESSION[$sessionName])){
            return true;
        } else {
            return false;
        }
    }
    
    public static function unsetSession($sessionName){
        if(isset($_SESSION[$sessionName])){
            unset($_SESSION[$sessionName]);
        } 
    }
    
    public static function checkSession($sessionName){
        
        if(isset($_SESSION[$sessionName]) && $_SESSION[$sessionName] != "") {
            return true ;
        } 
        return false;
    }
    
    
    public static function getSessionValue($sessionName){
        return $_SESSION[$sessionName];
    }
}
