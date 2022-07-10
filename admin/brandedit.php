<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Brand.php'; ?>
<?php
    if(!isset($_GET['brandid']) OR $_GET['brandid'] == NULL){
        echo "<script>window.location = 'brandlist.php';</script>";
    }else{
        $id = preg_replace("/[^-a-zA-Z0-9_]/","",$_GET['brandid']);
        
    }
    $brand = new Brand();
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$brandName = $_POST['brandName'];
		$updateBrand = $brand->brandUpdate($id,$brandName);
	}
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Update Brand</h2>
               <div class="block copyblock"> 
                <?php
                    if(isset($updateBrand)){
                        echo $updateBrand;
                    }
                ?>
                <?php
                    $getBrand = $brand->getBrandById($id);
                    if($getBrand){
                        while($row = $getBrand->fetch_assoc()){
                ?>
                 <form action = "brandedit.php?brandid=<?php echo $id; ?>" method = "POST">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name = "brandName" placeholder="Enter Brand Name..." class="medium" value  = "<?php echo $row['brandName']; ?>" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>
                    </table>
                    </form>
                <?php } } ?>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>