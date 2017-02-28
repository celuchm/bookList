<?php

class Hash {
    
    public static function generateHash($text, $salt = ""){
        return hash('sha256', $text . $salt);     
    }
    
    
    
    
    
    
}
