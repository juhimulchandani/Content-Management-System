<?php 
spl_autoload_register(function ($class_name){
    include "../classes/".$class_name.'.class.php';
});
include_once("../includes/constants.php");
if(isset($_GET['page'])){
    $page = $_GET['page'];
}else{
    $page = '1';
}
$start = (ADMIN_POSTS_PER_PAGE*($page-1));
$end = ADMIN_POSTS_PER_PAGE
?>