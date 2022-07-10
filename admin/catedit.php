<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Category.php'; ?>
<?php
    if(!isset($_GET['catid']) OR $_GET['catid'] == NULL){
        echo "<script>window.location = 'catlist.php';</script>";
    }else{
        $id = preg_replace("/[^-a-zA-Z0-9_]/","",$_GET['catid']);
        
    }
    $cat = new Category();
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$catName = $_POST['catName'];
		$updateCat = $cat->catUpdate($id,$catName);
	}
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Update Category</h2>
               <div class="block copyblock"> 
                <?php
                    if(isset($updateCat)){
                        echo $updateCat;
                    }
                ?>
                <?php
                    $getCat = $cat->getCatById($id);
                    if($getCat->num_rows > 0){
                        while($row = $getCat->fetch_assoc()){
                ?>
                 <form action = "catedit.php?catid=<?php echo $id; ?>" method = "POST">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name = "catName" placeholder="Enter Category Name..." class="medium" value  = "<?php echo $row['catName']; ?>" />
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