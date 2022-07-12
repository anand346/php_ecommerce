<?php include 'inc/header.php'; ?>
<?php
	$login = Session::get("cusLogin");
	if($login == false){
		header("location:login.php");
	}

?>
<style>
    .tblone{width:550px;margin:0 auto;border : 2px solid #ddd;}
    .tblone tr td{text-align: justify;}
    .tblone input[type="text"]{width:400px;padding: 5px;font-size: 15px;}
</style>
<?php
	$id = Session::get("cusId");
	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])){
		$customerUpdate = $cmr->customerUpdate($_POST,$id);
	}
?>
 <div class="main">
    <div class="content">
    	<div class="section group">
            <?php
                $id = Session::get("cusId");
                $getData = $cmr->getCustomerData($id);
                if($getData){
                    while($row = $getData->fetch_assoc()){
            ?>  
            <form action="" method = "POST">
                <?php
                    if(isset($customerUpdate)){
                        echo $customerUpdate;
                    }
                        
                ?>
                <table class = "tblone">
                    <tr>
                        <td colspan="2"><h2>Update Profile Details</h2></td>
                    </tr>
                    <tr>
                        <td width = "20%">Name</td>
                        
                        <td><input type="text" value="<?php echo $row['name']; ?>" name = "name" /></td>
                    </tr>
                    <tr>
                        <td>Phone</td>
                        
                        <td><input type="text" value="<?php echo $row['phone']; ?>" name = "phone" /></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        
                        <td><input type="text" value="<?php echo $row['email']; ?>" name = "email" /></td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        
                        <td><input type="text" value="<?php echo $row['address']; ?>" name = "address" /></td>
                    </tr>
                    <tr>
                        <td>City</td>
                        
                        <td><input type="text" value="<?php echo $row['city']; ?>" name = "city" /></td>
                    </tr>
                    <tr>
                        <td>Zip code</td>
                        
                        <td><input type="text" value="<?php echo $row['zip']; ?>" name = "zip" /></td>
                    </tr>
                    <tr>
                        <td>Country</td>
                        <td><input type="text" value="<?php echo $row['country']; ?>" name = "country" /></td>
                    </tr>
                    <tr>
                        <td></td>
                        
                        <td><input type="submit" value="Save" name = "update" /></td>
                    </tr>
                </table>
            </form>
            <?php } } ?>
 		</div>
 	</div>
</div>
<?php include 'inc/footer.php'; ?>