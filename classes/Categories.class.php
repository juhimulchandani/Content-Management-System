<?php 
class Categories{
    private $table = "categories";
    private $category_id;
    private $category_name;
    private $category_status;
    private $conn;
    
    public function __construct($conn){
        $this->conn = $conn;
    }
    
    function readAllCategories(){
        $sql = "SELECT * FROM {$this->table}";
        $statement = $this->conn->prepare($sql);
        $statement->execute();
        $result=$statement->fetchAll();
        return $result;
    }
}
?>
