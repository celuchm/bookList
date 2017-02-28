

<?php
session_start();
spl_autoload_register(function($className){
    require_once 'classes/'.$className.'.php';      
});


