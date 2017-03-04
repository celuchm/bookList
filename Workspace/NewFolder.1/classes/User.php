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

        if($this->ifUserExist($username)){
            if($this->passwordMatch($username, $password)){
                Session::setSession('userLogged', $username);
                Session::setSession('logginSuccess', true);
                return true;
            }            
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
            $salt = $this->createSalt();
            $hashPassword = hash('sha256', $password.$salt);
            //echo $hashPassword;
            $this->db->doDbAction('insert','users', array('username' => $username, 'password' => $hashPassword, 'salt' => $salt));
            $this->registerError = array();
            return true;
        }      
    }
   
    public function ifUserExist($username, $password = ""){        
        $userData = $this->db->doDbAction('select','users', array('username' => $username));      
               
        if($userData->get_count()){
            return true;
        } 
        return false;      
    }    
    
    private function getSalt($username){
        return $this->db->doDbAction('select','users',array('username' => $username))->get_first_row()['salt'];
    }
    
    private function passwordMatch($username, $password){
        $salt = $this->getSalt($username);
        $ifUserWithPasswordExist = $this->db->doDbAction('select', 'users', array(
            'username' => $username,
            'password' => hash('sha256', $password.$salt)
        ));
        if($ifUserWithPasswordExist->get_count()){
            return true;
        }
        return false;        
    }
    
    
    private function createSalt(){
        return uniqid();
    }
       
}
