<?php

$filepath = realpath(dirname(__DIR__));

include_once ($filepath.'/lib/Database.php');
include_once ($filepath.'/helpers/Format.php');
?>
<?php
class Cart{
    private $db;
    private $fm;
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function addToCart($quantity,$id){
        $quantity = $this->fm->validation($quantity);
        $quantity = $this->db->link->real_escape_string($quantity);
        $productId = $this->db->link->real_escape_string($id);
        $sId = session_id();

        $squery = "SELECT * FROM tbl_product WHERE productId = '$productId'";
        $result  = $this->db->select($squery)->fetch_assoc();

        $productName = $result['productName'];
        $price       = $result['price'];
        $image       = $result['image'];

        $chquery = "SELECT * FROM tbl_cart WHERE productId = '$productId' AND sId = '{$sId}'";
        $resultChQuery = $this->db->select($chquery);
        if($resultChQuery){
            $msg = "Product Already Added";
            return $msg;    
        }else{
            $query = "INSERT INTO tbl_cart(sId,productId,productName,price,quantity,image) VALUES('{$sId}','{$productId}','{$productName}','{$price}','{$quantity}','{$image}')";
            $result = $this->db->insert($query);
            if ($result) {
                header("location:cart.php");
            } else {
                header("location:404.php");
            }    
        }
    }

    public function getCartProduct(){
        $sId = session_id();
        $query = "  SELECT  * FROM tbl_cart WHERE sId = '$sId'";

        $result = $this->db->select($query);
        return $result;

    }

    public function updateCartQuantity($cartId,$quantity){
        $cartId   = $this->db->link->real_escape_string($cartId);
        $quantity = $this->db->link->real_escape_string($quantity);

        $query       = "UPDATE tbl_cart SET quantity = '{$quantity}' WHERE cartId = $cartId ";
        $updated_row = $this->db->update($query);
        if($updated_row){
            // $msg = "<span class = 'success'>Quantity updated successfully !</span> ";
            // return $msg;
            header("location:cart.php");
        }else{
            $msg = "<span class = 'error'>Quantity not updated !</span> ";
            return $msg;
        }
    }

    public function delProductByCart($delCartId){
        $delCartId = $this->db->link->real_escape_string($delCartId);
        $query     = "DELETE FROM tbl_cart WHERE cartId = $delCartId";
        $result    = $this->db->delete($query);
        if($result){
            echo "<script>window.location = 'cart.php';</script>";
        }else{
            $msg = "<span class = 'error'>Cart not deleted !</span> ";
            return $msg;
        }
    }

    public function checkCartTable(){
        $sId = session_id();
        $query = "  SELECT  * FROM tbl_cart WHERE sId = '$sId'";
        $result = $this->db->select($query);
        return $result;
    }

    public function delCustomerData(){
        $sId = session_id();
        $query = "DELETE FROM tbl_cart WHERE sId = '{$sId}'";
        $this->db->delete($query);
    }

}

?>