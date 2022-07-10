<?php

include_once '../lib/Database.php';
include_once '../helpers/Format.php';
?>
<?php
class Category{
    private $db;
    private $fm;
    public function __construct(){  
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function catInsert($catName){
        $catName = $this->fm->validation($catName);
        $catName = $this->db->link->real_escape_string($catName);
        if(empty($catName)){
            $msg = "<span class = 'error'>Category name must not be empty!</span> ";
            return $msg;
        }else{
            $query = "INSERT INTO tbl_category(catName) VALUES('{$catName}')";
            $result = $this->db->insert($query);
            if($result){
                $msg = "<span class = 'success'>Category Inserted Successfully.</span>";
                return $msg;
            }else{
                $msg = "<span class = 'error'>Category Not Inserted.</span>";
                return $msg;
            }
        }
    }
    public function getAllCat(){
        $query  = "SELECT * FROM tbl_category ORDER BY catId DESC";
        $result = $this->db->select($query);
        return $result;

    }
    public function getCatById($id){
        $query = "SELECT * FROM tbl_category WHERE catId = $id";
        $result = $this->db->select($query);
        return $result;
    }
    public function catUpdate($catId,$catName){
        $catName = $this->fm->validation($catName);
        $catName = $this->db->link->real_escape_string($catName);
        $catId = $this->db->link->real_escape_string($catId);
        if(empty($catName)){
            $msg = "<span class = 'error'>Category name must not be emptpy!</span> ";
            return $msg;
        }else{
            $query = "UPDATE tbl_category SET catName = '{$catName}' WHERE catId = $catId ";
            $updated_row = $this->db->update($query);
            if($updated_row){
                $msg = "<span class = 'success'>Category updated successfully !</span> ";
                return $msg;
            }else{
                $msg = "<span class = 'error'>Category not updated !</span> ";
                return $msg;
            }
        }
    }
    public function delCatById($catId){
        $query = "DELETE FROM tbl_category WHERE catId = $catId";
        $result = $this->db->delete($query);
        if($result){
            $msg = "<span class = 'success'>Category deleted successfully !</span> ";
            return $msg;
        }else{
            $msg = "<span class = 'error'>Category not deleted !</span> ";
            return $msg;
        }
    }
}

?>