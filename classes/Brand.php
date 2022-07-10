<?php

$filepath = realpath(dirname(__DIR__));

include_once ($filepath.'/lib/Database.php');
include_once ($filepath.'/helpers/Format.php');
?>
<?php
class Brand{
    private $db;
    private $fm;
    public function __construct(){  
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function brandInsert($brandName){
        $brandName = $this->fm->validation($brandName);
        $brandName = $this->db->link->real_escape_string($brandName);
        if(empty($brandName)){
            $msg = "<span class = 'error'>Brand name must not be emptpy!</span> ";
            return $msg;
        }else{
            $query = "INSERT INTO tbl_brand(brandName) VALUES('{$brandName}')";
            $result = $this->db->insert($query);
            if($result){
                $msg = "<span class = 'success'>Brand Name Inserted Successfully.</span>";
                return $msg;
            }else{
                $msg = "<span class = 'error'>Brand Name Not Inserted.</span>";
                return $msg;
            }
        }
    }
    public function getAllBrand(){
        $query  = "SELECT * FROM tbl_brand ORDER BY brandId DESC";
        $result = $this->db->select($query);
        return $result;
    }
    public function getBrandById($id){
        $query = "SELECT * FROM tbl_brand WHERE brandId = $id";
        $result = $this->db->select($query);
        return $result;
    }
    public function brandUpdate($brandId,$brandName){
        $brandName = $this->fm->validation($brandName);
        $brandName = $this->db->link->real_escape_string($brandName);
        $brandId = $this->db->link->real_escape_string($brandId);
        if(empty($brandName)){
            $msg = "<span class = 'error'>Brand name must not be emptpy!</span> ";
            return $msg;
        }else{
            $query = "UPDATE tbl_brand SET brandName = '{$brandName}' WHERE brandId = $brandId ";
            $updated_row = $this->db->update($query);
            if($updated_row){
                $msg = "<span class = 'success'>Brand name updated successfully !</span> ";
                return $msg;
            }else{
                $msg = "<span class = 'error'>Brand name not updated !</span> ";
                return $msg;
            }
        }
    }
    public function delBrandById($brandId){
        
        $query = "DELETE FROM tbl_brand WHERE brandId = $brandId";
        $result = $this->db->delete($query);
        if($result){
            $msg = "<span class = 'success'>Brand name deleted successfully !</span> ";
            return $msg;
        }else{
            $msg = "<span class = 'error'>Brand name not deleted !</span> ";
            return $msg;
        }
    }
}

?>