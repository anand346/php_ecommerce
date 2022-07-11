<?php

$filepath = realpath(dirname(__DIR__));
// echo $filepath;die();   
include_once($filepath.'/lib/Database.php') ;
include_once($filepath.'/helpers/Format.php') ;
?>
<?php
class Product
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function productInsert($data, $file)
    {
        $productName = $this->db->link->real_escape_string($data['productName']);
        $catId = $this->db->link->real_escape_string($data['catId']);
        $brandId = $this->db->link->real_escape_string($data['brandId']);
        $body = $this->db->link->real_escape_string($data['body']);
        $price = $this->db->link->real_escape_string($data['price']);
        $type = $this->db->link->real_escape_string($data['type']);


        $permited  = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $file['image']['name'];
        $file_size = $file['image']['size'];
        $file_temp = $file['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $uploaded_image = "upload/" . $unique_image;

        if ($productName == "" || $catId == "" || $brandId == "" || $body == "" || $price == "" || $type == "") {
            $msg = "<span class = 'error'>Fields must not be empty.</span>";
            return $msg;
        } elseif ($file_size > 1048567) {
            $msg = "<span class = 'error'>Image size should be less than 1 mb.</span>";
            return $msg;
        } elseif (in_array($file_ext, $permited) === false) {
            $msg = "<span class = 'error'>you can only upload :- " . implode(', ', $permited) . "</span>";
            return $msg;
        } else {
            move_uploaded_file($file_temp, $uploaded_image);
            $query = "INSERT INTO tbl_product(productName,catId,brandId,body,price,image,type) VALUES('{$productName}','{$catId}','{$brandId}','{$body}','{$price}','{$uploaded_image}','{$type}')";
            $result = $this->db->insert($query);
            if ($result) {
                $msg = "<span class = 'success'>Product Inserted Successfully.</span>";
                return $msg;
            } else {
                $msg = "<span class = 'error'>Product Not Inserted.</span>";
                return $msg;
            }
        }
    }
    public function getAllProduct()
    {

        $query = "  SELECT p.*,c.catName,b.brandName 
                    FROM tbl_product as p,tbl_category as c,tbl_brand as b
                    WHERE p.catId = c.catId AND p.brandId = b.brandId
                    ORDER BY p.productId DESC
                    
                ";

        /* $query = "  SELECT tbl_product.*,tbl_category.catName,tbl_brand.brandName
                    FROM tbl_product
                    INNER JOIN tbl_category ON tbl_product.catId = tbl_category.catId
                    INNER JOIN tbl_brand ON tbl_product.brandId = tbl_brand.brandId
                    ORDER BY tbl_product.productId DESC
                ";
        */
        $result = $this->db->select($query);
        return $result;
    }
    public function getProById($id)
    {
        $query = "  SELECT p.*,c.catName,b.brandName 
                    FROM tbl_product as p,tbl_category as c,tbl_brand as b
                    WHERE p.catId = c.catId AND p.brandId = b.brandId AND p.productId = '{$id}'
                    ORDER BY p.productId DESC
                    
                ";
        $result = $this->db->select($query);
        return $result;
    }
    public function productUpdate($data, $file, $id)
    {
        $productName = $this->db->link->real_escape_string($data['productName']);
        $catId = $this->db->link->real_escape_string($data['catId']);
        $brandId = $this->db->link->real_escape_string($data['brandId']);
        $body = $this->db->link->real_escape_string($data['body']);
        $price = $this->db->link->real_escape_string($data['price']);
        $type = $this->db->link->real_escape_string($data['type']);
        
        if ($productName == "" || $catId == "" || $brandId == "" || $body == "" || $price == "" || $type == "") {
            $msg = "<span class = 'error'>Fields must not be empty.</span>";
            return $msg;
        }

        if(!empty($file['image']['name'])){
            $permited  = array('jpg', 'jpeg', 'png', 'gif');
            $file_name = $file['image']['name'];
            $file_size = $file['image']['size'];
            $file_temp = $file['image']['tmp_name'];

            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
            $uploaded_image = "upload/" . $unique_image;

            $alProduct = $this->getProById($id);
            $alresult = $alProduct->fetch_assoc();
            $alImage = $alresult['image'];
            unlink($alImage);

        }
        


        if (!empty($file_name)) {
            if ($file_size > 1048567) {
                $msg = "<span class = 'error'>Image size should be less than 1 mb.</span>";
                return $msg;
            } elseif (in_array($file_ext, $permited) === false) {
                $msg = "<span class = 'error'>you can only upload :- " . implode(', ', $permited) . "</span>";
                return $msg;
            } else {
                move_uploaded_file($file_temp, $uploaded_image);
                $query = "  UPDATE  tbl_product SET 
                    productName = '{$productName}',
                    catId = '{$catId}',
                    brandId = '{$brandId}',
                    body = '{$body}',
                    price = '{$price}',
                    image = '{$uploaded_image}',
                    type='{$type}'
                    WHERE productId = '{$id}'
                ";
                $result = $this->db->update($query);
                if ($result) {
                    $msg = "<span class = 'success'>Product Updated Successfully.</span>";
                    return $msg;
                } else {
                    $msg = "<span class = 'error'>Product Not Updated.</span>";
                    return $msg;
                }
            }
        }else{
            $query = "  UPDATE  tbl_product SET 
                productName = '{$productName}',
                catId = '{$catId}',
                brandId = '{$brandId}',
                body = '{$body}',
                price = '{$price}',
                type='{$type}'
                WHERE productId = '{$id}'
            ";
            $result = $this->db->update($query);
            if ($result) {
                $msg = "<span class = 'success'>Product Updated Successfully.</span>";
                return $msg;
            } else {
                $msg = "<span class = 'error'>Product Not Updated.</span>";
                return $msg;
            }
        }
    }
    public function delProById($proId){
        $query = "SELECT * FROM tbl_product WHERE productId = '$proId'";
        $getData = $this->db->select($query);
        if($getData){
            while($image = $getData->fetch_assoc()){
                $imgLink = $image['image'];
                unlink($imgLink);
            }
        }
        $delQuery = "DELETE FROM tbl_product WHERE productId = '$proId'";
        $deldata = $this->db->delete($delQuery);
        if ($deldata) {
            $msg = "<span class = 'success'>Product Deleted Successfully.</span>";
            return $msg;
        } else {
            $msg = "<span class = 'error'>Product Not Deleted.</span>";
            return $msg;
        }
    }
    public function getFeaturedProduct(){
        $query  = "SELECT * FROM tbl_product WHERE type = '0' ORDER BY productId DESC LIMIT 4";
        $result = $this->db->select($query);
        return $result;
    }
    public function getNewProduct(){
        $query  = "SELECT * FROM tbl_product ORDER BY productId DESC LIMIT 4";
        $result = $this->db->select($query);
        return $result; 
    }
    public function getSingleProduct($id){
        $query = "  SELECT p.*,c.catName,b.brandName 
                    FROM tbl_product as p,tbl_category as c,tbl_brand as b
                    WHERE p.catId = c.catId AND p.brandId = b.brandId AND p.productId = '{$id}'
                ";
        $result = $this->db->select($query);
        return $result;
    }

    public function latestFromIphone(){
        $query  = "SELECT * FROM tbl_product WHERE brandId = 3 ORDER BY productId DESC LIMIT 1";
        $result = $this->db->select($query);
        return $result; 
    }

    public function latestFromSamsung(){
        $query  = "SELECT * FROM tbl_product WHERE brandId = 1 ORDER BY productId DESC LIMIT 1";
        $result = $this->db->select($query);
        return $result; 
    }

    public function latestFromAcer(){
        $query  = "SELECT * FROM tbl_product WHERE brandId = 2 ORDER BY productId DESC LIMIT 1";
        $result = $this->db->select($query);
        return $result; 
    }

    public function latestFromHp(){
        $query  = "SELECT * FROM tbl_product WHERE brandId = 5 ORDER BY productId DESC LIMIT 1";
        $result = $this->db->select($query);
        return $result; 
    }
  
    public function getProductByCat($id){
        $id = $this->db->link->real_escape_string($id);
        $query = "  SELECT p.*,c.catName,b.brandName 
                    FROM tbl_product as p,tbl_category as c,tbl_brand as b
                    WHERE p.catId = c.catId AND p.brandId = b.brandId AND p.catId = '{$id}'
                    ORDER BY p.productId DESC         
                ";
        $result = $this->db->select($query);
        return $result;      
    }
}


?>