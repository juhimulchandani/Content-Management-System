<?php 
include_once("../includes/constants.php");
spl_autoload_register(function ($class_name){
    include "../classes/".$class_name.'.class.php';
});

if(isset($_POST['login'])){
    //you pressed login button !
    $username = $_POST['username'];
    $password = $_POST['password'];
    $db=new Database();
    $conn=$db->getConnection();
    $auth = new Authentication($conn);
    echo $auth->login($username, $password);
}

if(isset($_POST['logout'])){
    //you pressed login button
    $db=new Database();
    $conn=$db->getConnection();
    $auth = new Authentication($conn);
    $auth->logout();
}
?>