<?php
class Posts{
    private $table = "posts";
    private $post_author;
    private $post_id;
    private $post_category_id;
    private $post_title;
    private $post_body;
    private $post_tags;
    private $post_author_id;
    private $post_status;
    private $post_date;
    private $post_image;
    private $created_at;
    private $updated_at;
    private $conn;
    
    public function __construct($conn){
        $this->conn=$conn;
    }
    
    function readAllPosts(){
        $sql = "SELECT * FROM {$this->table}";
        $statement = $this->conn->prepare($sql);
        $statement->execute();
        $result=$statement->fetchAll();
        return $result;
    }
    
    function readPost($post_id){
        $sql="SELECT * FROM {$this->table} WHERE post_id={$post_id}";
        $statement=$this->conn->prepare($sql);
        $statement->execute();
        //$result will hold the fetched result from db which is in the form of assoc array.
        $result=$statement->fetch(PDO::FETCH_ASSOC);
        //$keys now will hold all the key set i.e. the column names from the db i.e key in assoc arrays and their values will be fetched one by one in follwg for loop.
        $keys=array_keys($result);
        for($i=0;$i<count($keys);$i++){
            $this->{$keys[$i]}=$result[$keys[$i]];
        }
        // followg was method fetching value of each column of db one by one but it was replaced by for loop above. 
//        $this->post_id=$result['post_id'];
//        $this->post_body=$result['post_body'];
//        $this->post_author_id=$result['post_author_id'];
//        $this->post_image=$result['post_image'];
//        $this->post_date=$result['post_date'];
//        $this->post_tags=$result['post_tags'];
//        $this->post_status=$result['post_status'];
//        $this->post_title=$result['post_title'];
//        $this->post_category_id=$result['post_category_id'];
        
        $this->post_author = $this->getAuthorName($this->post_author_id);
        
    }
    
    function readAllPostsOfCategory($category_id){
        $sql="SELECT * FROM {$this->table} WHERE post_category_id={$category_id}";
        $statement=$this->conn->prepare($sql);
        $statement->execute();
        $result=$statement->fetchAll();
        return $result;
    }
    
    function readAllPostsBySearch($keywords){
        $sql="SELECT posts.post_id, posts.post_category_id, posts.post_title, posts.post_body,
        posts.post_tags, posts.post_author_id, posts.post_date, posts.post_image, posts.post_status, posts.created_at, posts.updated_at, CONCAT(members.member_first_name, CONCAT(\" \", members.member_last_name)) AS post_author FROM posts, members WHERE (members.member_id=posts.post_author_id) AND (members.member_first_name LIKE '%{$keywords}%' OR members.member_last_name LIKE '%{$keywords}%' OR posts.post_tags LIKE '%{$keywords}%' OR posts.post_title LIKE '%{$keywords}%' OR posts.post_body LIKE '%{$keywords}%' OR CONCAT(members.member_first_name, CONCAT(\" \", members.member_last_name)) LIKE '%{$keywords}%')";
        
        $statement=$this->conn->prepare($sql);
        $statement->execute();
        $result=$statement->fetchAll();
        return $result;
    }
    
    function readAllPostsOfAuthor($post_author_id){
        $sql="SEECT * FROM {$this->table} WHERE post_author_id = {$post_author_id}";
        $statement=$this->conn->prepare($sql);
        $statement->execute();
        $result=$statement->fetchAll();
        return $result;
    }
    
    function getAuthorName($post_author_id){
        $sql="SELECT member_first_name, member_last_name FROM members WHERE member_id={$post_author_id}";
        $statement = $this->conn->prepare($sql);
        $statement->execute();
        $result=$statement->fetch();
        return $result['member_first_name']." ".$result['member_last_name'];
        
        
    }
    
    function createPost($data){
        $columnString = implode(", ",array_keys($data));
        $valueString = ":".implode(", :",array_keys($data));
        
        $sql = "INSERT INTO {$this->table} ({$columnString}) VALUES ({$valueString})";
        
        $ps=$this->conn->prepare($sql);
        
//        echo $sql;
        $result=$ps->execute($data);
        if($result){
            return $this->conn->lastInsertId();
            //conn provides function lastInsertId() which is used to get id of last insert made to db.
        }else{
            return false;
        }
    }
    
    function updatePost($data, $condition){
        $i=0;
        $columnValueSet = "";
        foreach($data as $key=>$values){
            $comma = ($i<count($data)-1?",":"");
            $columnValues.=$key."='".$values."'".$comma;
            $i++;
        }
        $sql="UPDATE $this->table SET $columnValueSet WHERE  $condition";
        
        $ps=$this->conn->prepare($sql);
        $result=$ps->execute($data);
        if($result){
            return $ps-rowCount();
            //ps provides function rowCount() which is the count of rows affected by updation.
        }else{
            return false;
        }
    }
    
    public function setPostAsPublished($post_id){
        $data = array("post_status"=>"published");
        updatePost($data, "post_id={$post_id}");
    }
    public function setPostAsDraft($post_id){
        $data = array("post_status"=>"draft");
        updatePost($data, "post_id={$post_id}");
    }

    
    
   
    /**
     * @return mixed
     */
    public function getPostAuthor()
    {
        return $this->post_author;
    }

    /**
     * @return mixed
     */
    public function getPostId()
    {
        return $this->post_id;
    }

    /**
     * @return mixed
     */
    public function getPostCategoryId()
    {
        return $this->post_category_id;
    }

    /**
     * @return mixed
     */
    public function getPostTitle()
    {
        return $this->post_title;
    }

    /**
     * @return mixed
     */
    public function getPostBody()
    {
        return $this->post_body;
    }

    /**
     * @return mixed
     */
    public function getPostTags()
    {
        return $this->post_tags;
    }

    /**
     * @return mixed
     */
    public function getPostAuthorId()
    {
        return $this->post_author_id;
    }

    /**
     * @return mixed
     */
    public function getPostStatus()
    {
        return $this->post_status;
    }

    /**
     * @return mixed
     */
    public function getPostDate()
    {
        return $this->post_date;
    }

    /**
     * @return mixed
     */
    public function getPostImage()
    {
        return $this->post_image;
    }
}
//
//include_once("Database.class.php");
//$db = new Database();
//$connection = $db->getConnection();
//$postObject=new Posts($connection);
//$result=$postObject->readPost(1);




?>