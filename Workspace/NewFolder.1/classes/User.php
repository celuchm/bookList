<?php


class User {
    
    private $db,
            $userId,
            $userName,
            $userLogged = false,
            $registerError= array();
            
           
    
    
    
    function __construct($username = null) {
        $this->db = Db::getInstance();
        if(!is_null($username)){
            $this->setUserName($username);
            $this->setUserId($username);
            $this->userLogged = true;
        }
    }
    
    private function setUserId($username) {
       $this->userId =  $this->db->doDbAction('select','users', array('username' => $username))->get_first_row()['id'];
             
    }
   
    function setUserName($userName) {
        $this->userName = $userName;
    }

    function isUserLogged() {
        return $this->userLogged;
    }

    function getUserId() {
        return $this->userId;
    }

    function getUserName() {
        return $this->userName;
    }
    
    function getRegisterError() {
        return $this->registerError;
    }
    
    
    public function login($username, $password){

        if($this->ifUserExist($username, $password)){
            Session::setSession('userLogged', $username);
            Session::setSession('logginSuccess', true);
            return true;
        } else {
            Session::setSession('logginSuccess', false);
            return false;
        }
    }
   
   
    public function register($username, $password, $passwordRepeat){
      
        if($this->ifUserExist($username)){
            $this->registerError[] = "login alredy exists!";
            if($password !== $passwordRepeat) {
            $this->registerError[] = "passwords must match!";
            }
            return false;
        }       
      
        if(!$this->ifUserExist($username)){
            $this->db->doDbAction('insert','users', array('username' => $username, 'password' => $password));
            $this->registerError = array();
            return true;
        }      
    }
   
    public function ifUserExist($username, $password = ""){
        $this->db->doDbAction('select','users', array('username' => $username));
        if($this->db->get_count()){
            return true;
        } 
        return false;      
    }    
}
