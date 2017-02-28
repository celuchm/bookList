<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Validation
 *
 * @author mc
 * $validation->validate(array(
        'taskName' => array(
 *          'value'    => $_POST['taskName'],
            'required' => true,
            'length'   => 40           
        ),
        'taskDate' => array(
            'required' => true
        ),
        'text' => array(
            'required' => true,
            'length'   => 500
        )
    ));
 * 
 * 
 */
class Validation {
    
    private $validationErrors = array();
    
    function getValidationErrors() {
        return $this->validationErrors;
    }

        
    public function isValid(){
        return (count($this->validationErrors))? false : true;
    }
    
    public function validate($validationArray = array()){     
        
        foreach($validationArray as $validatedField => $validatedFieldRules){
            foreach($validatedFieldRules as $ruleName => $ruleValue){
                if($ruleName == 'value'){
                    $validatedFieldValue = $ruleValue;
                } else {
                    
                    switch($ruleName){
                        case 'required':                            
                            if($ruleValue == true){
                                if($validatedFieldValue == "") {
                                  $this->validationErrors[] = $this->getRuleErrorMessage($validatedField, $ruleName);
                                }
                            }
                        break;   
                            
                        case 'length' :
                            if(strlen($validatedFieldValue) > $ruleValue){
                                $this->validationErrors[] = $this->getRuleErrorMessage($validatedField, $ruleName);
                            }
                        break;    
                    }
                }
            }
        }
        return $this;
    }
    
    
    private function getRuleErrorMessage($validatedField, $ruleName){
        $message = "";
        switch ($ruleName){
            case 'required':
                $message = $validatedField." is required!";
            break;
      
            case 'length' :
                $message = $validatedField." is too long!";
        }
        return $message;
    }
    
    
    
}
