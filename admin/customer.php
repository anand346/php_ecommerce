<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php
$filepath = realpath(dirname(__DIR__));
include_once ($filepath.'/classes/Customer.php');

?>
<?php
    if(!isset($_GET['cusid']) OR $_GET['cusid'] == NULL){
        echo "<script>window.location = 'inbox.php';</script>";
    }else{
        $cusid = preg_replace("/[^-a-zA-Z0-9_]/","",$_GET['cusid']);
        
    }
    
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        echo "<script>window.location = 'inbox.php';</script>";
	}
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Customer Details</h2>
               <div class="block copyblock"> 
                <?php
                    $cmr = new Customer();
                    $getCus = $cmr->getCustomerData($cusid);
                    if($getCus){
                        while($row = $getCus->fetch_assoc()){
                ?>
                 <form action = "" method = "POST">
                    <table class="form">					
                        <tr>
                            <td>Name</td>
                            <td>
                                <input type="text" readonly class="medium" value  = "<?php echo $row['name']; ?>" />
                            </td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td>
                                <input type="text" readonly class="medium" value  = "<?php echo $row['address']; ?>" />
                            </td>
                        </tr>
                        <tr>
                            <td>City</td>
                            <td>
                                <input type="text" readonly class="medium" value  = "<?php echo $row['city']; ?>" />
                            </td>
                        </tr>
                        <tr>
                            <td>Zip code</td>
                            <td>
                                <input type="text" readonly class="medium" value  = "<?php echo $row['zip']; ?>" />
                            </td>
                        </tr>
                        <tr>
                            <td>Phone</td>
                            <td>
                                <input type="text" readonly class="medium" value  = "<?php echo $row['phone']; ?>" />
                            </td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>
                                <input type="text" readonly class="medium" value  = "<?php echo $row['email']; ?>" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="OK" />
                            </td>
                        </tr>
                    </table>
                    </form>
                <?php } } ?>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>