<?php
require_once 'init/init.php';

Session::unsetSession('userLogged');
header('location:index.php');