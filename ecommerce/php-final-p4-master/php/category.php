<?php
include_once "database.php";
include_once "operation.php";
class Category extends database implements operation {
    private $id;
    private $name;
    private $photo;
    private $status;
    private $created_at;
    private $updated_at;

    // getters
    public function getId()
    {
        return $this->id;
    }
    public function getName()
    {
        return $this->name;
    }

    public function getphoto()
    {
        return $this->photo;
    }
     
    public function getStatus()
    {
        return $this->status;
    }
   
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    public function getUpdateAt()
    {
        return $this->updated_at;
    }

    // setters
    public function setId($id)
    {
        $this->id = $id;
    }
    public function setName($name)
    {
        $this->name = $name;
    }
  
    public function setphoto($photo)
    {
        $this->distance = $photo;
    }
    
    public function setStatus($status)
    {
        $this->status = $status;
    }
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }
   
    public function setUpdatedAt($updated_at)
    {
        $this->updated_at = $updated_at;
    }

    public function updateData(){
     
    }
    public function deleteData(){

    }
    public function insertData(){
    
    }
    public function getAllData(){
        $query= "SELECT `category`.* from`category`ORDER BY `category`.`name` ASC LIMIT 4";
          return $this->runDQL($query);
    }
    
}

?>