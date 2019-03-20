<?php
class Authentication{
    private $table = "users";
    private $user_id;
    private $username;
    private $password;
    private $member_id;
    private $conn;
    
    public function __construct($conn){
        $this->conn=$conn;
    }
    
    function login($username, $password){
        //performs login and sets the session variables.
        $sql="SELECT * FROM {$this->table} WHERE username ='{$username}'";
        $statement = $this->conn->prepare($sql);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        $keys= array_keys($result);
        for($i=0;$i<count($keys); $i++){
            $this->{$keys[$i]}=$result[$keys[$i]];
        }
        if(password_verify($password, $this->password)){
            Session::startSession($this->user_id);
            Helper::redirect("admin");
            return true;
        }else{
            return false;
        }
    }
    
    function logout(){
        //performs logout and cleanup activity !
        Session::destroySession();
    }
}







?>
