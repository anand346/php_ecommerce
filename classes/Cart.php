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

    public function orderProduct($cusId){
        $sId = session_id();
        $query = "SELECT * FROM tbl_cart WHERE sId = '{$sId}'";
        $getProduct = $this->db->select($query);
        if($getProduct){
            while($row = $getProduct->fetch_assoc()){
                $productId = $row['productId'];
                $productName = $row['productName'];
                $quantity = $row['quantity'];
                $price = $row['price']*$quantity;
                $image = $row['image'];
                $insertQuery = "INSERT INTO tbl_order(cusId,productId,productName,quantity,price,image) VALUES('{$cusId}','{$productId}','{$productName}','{$quantity}','{$price}','{$image}')";
                $insertResult = $this->db->insert($insertQuery);
            }
        }
    }

    public function payableAmount($cusId){
        $query = "SELECT price FROM tbl_order WHERE cusId = '$cusId' AND date = now() ";
        $result = $this->db->select($query);
        return $result;      
    }

    public function getOrderedProduct($cusId){
        $query = "SELECT * FROM tbl_order WHERE cusId = '$cusId' ORDER BY date DESC";
        $result = $this->db->select($query);
        return $result;      
    }


    public function checkOrder($cusId){
        $query = "  SELECT  * FROM tbl_order WHERE cusId = '$cusId'";
        $result = $this->db->select($query);
        return $result;      
    }

    public function getAllOrderProduct(){
        $query = "SELECT  * FROM tbl_order ORDER BY date";
        $result = $this->db->select($query);
        return $result;
    }


    public function productShifted($shiftid,$time,$price){
        $shiftid = $this->db->link->real_escape_string($shiftid);
        $time = $this->db->link->real_escape_string($time);
        $price = $this->db->link->real_escape_string($price);

        $query       = "UPDATE tbl_order SET status = '1' WHERE cusId = '$shiftid' AND date = '{$time}' AND price = ' {$price}'";
        $updated_row = $this->db->update($query);
        if($updated_row){
            $msg = "<span class = 'success'>updated successfully !</span> ";
            return $msg;
            // header("location:cart.php");
        }else{
            $msg = "<span class = 'error'>not updated !</span> ";
            return $msg;
        }

    }

    public function delProductShifted($cusid,$time,$price){
        $cusid = $this->db->link->real_escape_string($cusid);
        $time = $this->db->link->real_escape_string($time);
        $price = $this->db->link->real_escape_string($price);

        $query = "DELETE FROM tbl_order WHERE cusId = $cusid AND price = '$price' AND date = '$time' ";
        $result = $this->db->delete($query);
        if($result){
            $msg = "<span class = 'success'>Order deleted successfully !</span> ";
            return $msg;
        }else{
            $msg = "<span class = 'error'>Order not deleted !</span> ";
            return $msg;
        }
    }

    public function productShiftConfirm($cusId,$time,$price){
        $cusId = $this->db->link->real_escape_string($cusId);
        $time = $this->db->link->real_escape_string($time);
        $price = $this->db->link->real_escape_string($price);

        $query       = "UPDATE tbl_order SET status = '2' WHERE cusId = '$cusId' AND date = '{$time}' AND price = ' {$price}'";
        $updated_row = $this->db->update($query);
        if($updated_row){
            $msg = "<span class = 'success'>updated successfully !</span> ";
            return $msg;
            // header("location:cart.php");
        }else{
            $msg = "<span class = 'error'>not updated !</span> ";
            return $msg;
        }

    }
}

?>