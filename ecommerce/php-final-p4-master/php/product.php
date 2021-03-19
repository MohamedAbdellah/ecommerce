<?php
include_once "database.php";
include_once "operation.php";
class product extends database implements operation {
    private $id;
    private $name;
    private $photo;
    private $code;
    private $price;
    private $stock;
    private $details;

    private $status;
    private $category_id;
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

    public function getcode()
    {
        return $this->code;
    }
    public function getprice()
    {
        return $this->price;
    }
    public function getstock()
    {
        return $this->stock;
    }
    public function getdetails()
    {
        return $this->details;
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

    public function getCategoryId()
    {
        return $this->category_id;
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
    public function setCategoryId($category_id)
    {
        return $this->category_id=$category_id;
    }


    public function setcode($code)
    {
        return $this->code=$code;
    }
    public function setprice($price)
    {
        return $this->price=$price;
    }
    public function setstock($stock)
    {
        return $this->stock=$stock;
    }
    public function setdetails($details)
    {
        return $this->details=$details;
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

    public function getAllDatafromsub(){
        $query= "SELECT `products`.* from`products` where `products`.`subcaterory_id`=$this->category_id";         //you can use filter latter instead of order by
        return $this->runDQL($query);     
    }

    public function productDetails(){
        $query= "SELECT `producr_review`.* from`producr_review` where `producr_review`.`id`=$this->id ";         //you can use filter latter instead of order by
        return $this->runDQL($query);     
    }
    


    public function getProductSpecs(){
        $query= "SELECT
        `products_specs`.*,
        `specs`.`keyEle`
    FROM
        `products_specs`
    JOIN `specs` 
    ON  `specs`.`id`=`products_specs`.`spec_id`
    WHERE
        `products_specs`.`product_id` = $this->id
        ";        
        
        return $this->runDQL($query);     
    }




    public function getAllData(){
        $query= "SELECT `products`.* from`products`";         //you can use filter latter instead of order by
        return $this->runDQL($query);     
    }
   
    public function getnewdata(){
        $query= "SELECT `products`.* from `products` ORDER BY `updated_at` DESC LIMIT 4 ";         //you can use filter latter instead of order by
        return $this->runDQL($query);     
    }

    public function getMostRatedData(){
        $query= "SELECT `producr_review`.* from `producr_review` ORDER BY `producr_review`.`product_avg_rate` DESC LIMIT 4 ";         //you can use filter latter instead of order by
        return $this->runDQL($query);     
    }
    public function getMostorderddData(){
        $query= "SELECT *, `products`.`name` FROM `product_orders` JOIN `products` ON `product_orders`.`product_id`=`products`.`id` ORDER BY `product_count` DESC   LIMIT 4 ";         //you can use filter latter instead of order by
        return $this->runDQL($query);     
    }

    
}
