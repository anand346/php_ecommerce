<?php

$filepath = realpath(dirname(__DIR__));
// echo $filepath;die();
include_once ($filepath.'/lib/Database.php');
include_once ($filepath.'/helpers/Format.php');
?>
<?php
class Customer{
    private $db;
    private $fm;
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function customerRegistration($data){
        $name     = $this->db->link->real_escape_string($data['name']);
        $city     = $this->db->link->real_escape_string($data['city']);
        $zip      = $this->db->link->real_escape_string($data['zip']);
        $email    = $this->db->link->real_escape_string($data['email']);
        $address  = $this->db->link->real_escape_string($data['address']);
        $country  = $this->db->link->real_escape_string($data['country']);
        $phone    = $this->db->link->real_escape_string($data['phone']);
        $password = md5($this->db->link->real_escape_string($data['password']));
     
        if ($name == "" || $city == "" || $zip == "" || $email == "" || $address == "" || $country == "" || $phone == "" || $password == ""  ) {
            $msg = "<span class = 'error'>Fields must not be empty.</span>";
            return $msg;
        }

        $mailQuery = "SELECT * FROM tbl_customer WHERE email= '{$email}' LIMIT 1";
        $resultMail = $this->db->select($mailQuery);
        if($resultMail){
            $msg = "<span class = 'error'>Email is already in use.</span>";
            return $msg;
        }
        $query = "INSERT INTO tbl_customer(name,address,city,country,zip,phone,email,password) VALUES('{$name}','{$address}','{$city}','{$country}','{$zip}','{$phone}','{$email}','{$password}')";
        $result = $this->db->insert($query);
        if ($result) {
            $msg = "<span class = 'success'>Customer registration successful.</span>";
            return $msg;
        } else {
            $msg = "<span class = 'error'>Customer not registered.</span>";
            return $msg;
        }
    }

    public function customerLogin($data){
      $email    = $this->db->link->real_escape_string($data['email']);      
      $password = md5($this->db->link->real_escape_string($data['password']));

      if(empty($email) || empty($password)){
        $msg = "<span class = 'error'>Fields must not be empty.</span>";
        return $msg;
      }

      $query = "SELECT * FROM tbl_customer WHERE email = '{$email}' AND password = '{$password}' ";
      $result = $this->db->select($query);

      if($result){
        $values = $result->fetch_assoc();
        Session::set("cusLogin","true");
        Session::set("cusId",$values['id']);
        Session::set("cusName",$values['name']);
        header("location:cart.php");
      }else{
        $msg = "<span class = 'error'>Email or password does not match.</span>";
        return $msg;
      }
    }

    public function getCustomerData($id){
      $id = $this->db->link->real_escape_string($id);
      $query = "SELECT * FROM tbl_customer WHERE id = '$id'";
      $result = $this->db->select($query);
      return $result;
    }
  
    
    public function customerUpdate($data,$id){

        $id       = $this->db->link->real_escape_string($id);
        $name     = $this->db->link->real_escape_string($data['name']);
        $city     = $this->db->link->real_escape_string($data['city']);
        $zip      = $this->db->link->real_escape_string($data['zip']);
        $email    = $this->db->link->real_escape_string($data['email']);
        $address  = $this->db->link->real_escape_string($data['address']);
        $country  = $this->db->link->real_escape_string($data['country']);
        $phone    = $this->db->link->real_escape_string($data['phone']);

        if ($name == "" || $city == "" || $zip == "" || $email == "" || $address == "" || $country == "" || $phone == "") {
          $msg = "<span class = 'error'>Fields must not be empty.</span>";
          return $msg;
        }

        // $mailQuery = "SELECT * FROM tbl_customer WHERE email= '{$email}' LIMIT 1";
        // $resultMail = $this->db->select($mailQuery);
        // if($resultMail){
        //     $msg = "<span class = 'error'>Email is already in use.</span>";
        //     return $msg;
        // }
        $query = "UPDATE tbl_customer SET name = '{$name}' ,address = '{$address}',city = '{$city}',country = '{$country}',zip = '{$zip}',phone = '{$phone}',email = '{$email}' WHERE id = '$id'";
        $result = $this->db->update($query);
        if ($result) {
            $msg = "<span class = 'success'>Customer details updated successfully.</span>";
            return $msg;
        } else {
            $msg = "<span class = 'error'>Customer details not updated.</span>";
            return $msg;
        }
    }
}

?>