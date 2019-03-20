<?php
spl_autoload_register(function ($class_name) {
    include "../../classes/".$class_name . '.class.php';
});
include_once ("../../includes/constants.php");
if(isset($_POST['publish_post'])){
    $keys = array("post_category_id", "post_title", "post_body", "post_tags", "post_status");
//    die($_FILES['post_image']['name']);
    $db = new Database();
    $conn = $db->getConnection();
    $date = date('Y-m-d');
//    die($date);
    session_start();
    if(isset($_SESSION['user_id'])){
        $post_author_id = $_SESSION['user_id'];
    }else{
        die("How did u came here????");
    }
    $post = new Posts($conn);
    $data = array();
    foreach($keys as $key){
        $data += array($key=>$_POST[$key]);
    }
    $data += array("post_image"=>$_FILES['post_image']['name']);
    $data += array("post_author_id"=>$post_author_id);
    $data += array("post_date"=> $date);
    if($post->createPost($data)){
        //Now Upload Image
        $fileName = $_FILES['post_image']['name'];
        $tmpName = $_FILES['post_image']['tmp_name'];
        if(!move_uploaded_file($tmpName , "../../images/".$fileName))
            die("Error While Uploading Image");
    }else{
        die("Error While Inserting Post!");
    }

}