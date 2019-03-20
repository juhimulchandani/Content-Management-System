<?php
require_once("constants.php");
require_once("classes/Helper.class.php");
require_once("classes/Database.class.php");
require_once("classes/Posts.class.php");
require_once("classes/Categories.class.php");
require_once("classes/Session.class.php");
require_once("classes/Authentication.class.php");

spl_autoload_register(function ($class_name){
    include BASEURL."classes/".$class_name.'.class.php';
});
?>