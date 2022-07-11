<?php include 'inc/header.php'; ?>
<?php

if(!isset($_GET['catid']) OR $_GET['catid'] == NULL){
	echo "<script>window.location = 'catlist.php';</script>";
}else{
	$id = preg_replace("/[^-a-zA-Z0-9_]/","",$_GET['catid']);
}

?>
 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>Latest from Category</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
				<?php
					$productByCat = $pd->getProductByCat($id);
					if($productByCat){
						while($row = $productByCat->fetch_assoc()){
				?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="details.php?proid=<?php echo $row['productId'] ?>">
					 	<img src="admin/<?php echo $row['image'] ?>" alt="" />
					 </a>
					 <h2><?php echo $row['productName']; ?></h2>
					 <p><?php echo $fm->textShorten($row['body'],30) ; ?></p>
					 <p><span class="price">$<?php echo $row['price']; ?></span></p>
					 <div class="button">
						<span>
							<a href="details.php?proid=<?php echo $row['productId']; ?>" class="details">Details</a>
						</span>
				     </div>
				</div>
				<?php } }else{
					header("location:404.php");
					// echo "Product of this category are not available ";
				} ?>
		 </div>
    </div>
 </div>
 <?php include 'inc/footer.php'; ?>