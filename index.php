<?php include_once('inc/header.php') ; ?>
<?php include_once('inc/slider.php'); ?>

 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>Feature Products</h3>
    		</div>
    		<div class="clear"></div>
    	</div>	
	      <div class="section group">
			  	<?php
			  		$getFpd = $pd->getFeaturedProduct();
			 		if($getFpd){
						 while($row = $getFpd->fetch_assoc()){
			 	?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="details.php?proid=<?php echo $row['productId']; ?>"><img src="admin/<?php echo $row['image']; ?>" alt="" /></a>
					 <h2><?php echo $row['productName']; ?></h2>
					 <p><?php echo $fm->textShorten($row['body'],60) ; ?></p>
					 <p><span class="price">$<?php echo $row['price']; ?></span></p>
				     <div class="button"><span><a href="details.php?proid=<?php echo $row['productId']; ?>" class="details">Details</a></span></div>
				</div>
				<?php } } ?>
			</div>
			<div class="content_bottom">
    		<div class="heading">
    		<h3>New Products</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
			<div class="section group">
				<?php
			  		$getNpd = $pd->getNewProduct();
			 		if($getNpd){
						 while($row = $getNpd->fetch_assoc()){
			 	?>
				<div class="grid_1_of_4 images_1_of_4">
					<a href="details.php?proid=<?php echo $row['productId']; ?>"><img src="admin/<?php echo $row['image']; ?>" /></a>
					 <h2><?php echo $row['productName']; ?></h2>
					 <p><span class="price">$<?php echo $row['price']; ?></span></p>
				     <div class="button"><span><a href="details.php?proid=<?php echo $row['productId']; ?>">Details</a></span></div>
				</div>
				<?php } } ?>
			</div>
    </div>
 </div>

<?php include 'inc/footer.php'; ?>