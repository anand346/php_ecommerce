<?php include_once 'inc/header.php';?>
<?php include_once 'inc/sidebar.php';?>
<?php include_once '../classes/Product.php'; ?>
<?php include_once '../classes/Category.php'; ?>
<?php include_once '../classes/Brand.php'; ?>
<?php
    if(!isset($_GET['proid']) OR $_GET['proid'] == NULL){
        echo "<script>window.location = 'productlist.php';</script>";
    }else{
        $id = preg_replace("/[^-a-zA-Z0-9_]/","",$_GET['proid']);
        
    }
    $pd = new Product();
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
		$updateProduct = $pd->productUpdate($_POST,$_FILES,$id);
	}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Update Product</h2>
        <div class="block">    
            <?php
                if(isset($updateProduct)){
                    echo $updateProduct;
                }
            ?>
            <?php
                $getProd = $pd->getProById($id);
                if($getProd){
                    $row = $getProd->fetch_assoc();
            ?>
         <form action="" method="post" enctype="multipart/form-data">
            <table class="form">
               
                <tr>
                    <td>
                        <label>Name</label>
                    </td>
                    <td>
                        <input type="text" name = "productName" value = "<?php echo $row['productName']; ?>" class="medium" />
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Category</label>
                    </td>
                    <td>
                        <select id="select" name="catId">
                            <option>Select Category</option>
                            <?php
                                $cat = new Category();
                                $allCat = $cat->getAllCat();
                                if($allCat){
                                    while($result = $allCat->fetch_assoc()){
                                        if($result['catId'] == $row['catId']){
                                            $select = "selected";
                                        }else{
                                            $select = "";
                                        }
                            ?>
                            <option <?php echo $select; ?>  value="<?php echo $result['catId']; ?>"><?php echo $result['catName']; ?></option>
                            <?php } } ?>
                        </select>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Brand</label>
                    </td>
                    <td>
                        <select id="select" name="brandId">
                            <option>Select Brand</option>
                            <?php
                                $brand = new Brand();
                                $allBrand = $brand->getAllBrand();
                                if($allBrand){
                                    while($result = $allBrand->fetch_assoc()){
                                        if($result['brandId'] == $row['brandId']){
                                            $select = "selected";
                                        }else{
                                            $select = "";
                                        }
                            ?>
                            <option <?php echo $select ; ?> value="<?php echo $result['brandId']; ?>"><?php echo $result['brandName']; ?></option>
                            <?php } } ?>
                        </select>
                    </td>
                </tr>
				
				 <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Description</label>
                    </td>
                    <td>
                        <textarea class="tinymce" name = "body"><?php echo $row['body']; ?></textarea>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Price</label>
                    </td>
                    <td>
                        <input type="text" name = "price" value = "<?php echo $row['price']; ?>" class="medium" />
                    </td>
                </tr>
            
                <tr>
                    <td>
                        <label>Upload Image</label>
                    </td>
                    <td>
                        <img src="<?php echo $row['image']; ?>" alt="" height = "40" width = "60" >
                        <input type="file" name = "image" />
                    </td>
                </tr>
				
				<tr>
                    <td>
                        <label>Product Type</label>
                    </td>
                    <td>
                        <select id="select" name="type">
                            <option>Select Type</option>
                            <?php 
                                if($row['type'] == 0){
                            ?>
                            <option selected value="0">Featured</option>
                            <option value="1">General</option>
                            <?php }else{ ?>
                            <option  value="0">Featured</option>
                            <option selected value="1">General</option>
                            <?php } ?>
                        </select>
                    </td>
                </tr>

				<tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Update" />
                    </td>
                </tr>
            </table>
            </form>
            <?php
            }
            ?>
        </div>
    </div>
</div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php';?>


