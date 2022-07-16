<?php include 'inc/header.php'; ?>
<?php
    if(isset($_GET['proid'])){
        $id = preg_replace("/[^-a-zA-Z0-9_]/","",$_GET['proid']);
    }
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
		$quantity = $_POST['quantity'];
		$addCart = $ct->addToCart($quantity,$id);
	}
?>
<?php
	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['compare'])){
		$productid = $_POST['productId'];
		$insertComp = $pd->insertCompareData($cusid,$productid);
	}

?>
<?php
	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['wlist'])){
		$productid = $id;
		$saveWlist = $pd->saveWishlistData($cusid,$productid);
	}

?>
<style>
	.mybutton{width : 100px;float:left;margin-right:50px;}
</style>
 <div class="main">
    <div class="content">
    	<div class="section group">
				<div class="cont-desc span_1_of_2">				
					<?php
						$getPd = $pd->getSingleProduct($id);
						if($getPd){
							while($result = $getPd->fetch_assoc()){
					?>
					<div class="grid images_3_of_2">
						<img src="admin/<?php echo $result['image'];?>" alt="" />
					</div>
					<div class="desc span_3_of_2">
						<h2><?php echo $result['productName'] ?></h2>
						<div class="price">
							<p>Price: <span>$<?php echo $result['price']; ?></span></p>
							<p>Category: <span><?php echo $result['catName']; ?></span></p>
							<p>Brand:<span><?php echo $result['brandName']; ?></span></p>
						</div>
						<div class="add-cart">
							<form action="" method="post">
								<input type="number" class="buyfield" name="quantity" value="1"/>
								<input type="submit" class="buysubmit" name="submit" value="Buy Now"/>
							</form>				
						</div>
					
							<?php
								if(isset($addCart)){
									echo $addCart;
								}	
							?>
							<?php
								if(isset($insertComp)){
									echo $insertComp;
								}	
							?>
							<?php
								if(isset($saveWlist)){
									echo $saveWlist;
								}	
							?>
						<?php
							$cusLogin = Session::get("cusLogin");
							if($cusLogin == "true"){
						?>
						<div class="add-cart">
							<div class="mybutton">
								<form action="" method="post">
									<input type="hidden" class="buyfield" name="productId" value="<?php echo $result['productId']; ?>"/>
									<input type="submit" class="buysubmit" name="compare" value="Add to compare"/>
								</form>
							</div>
							<div class="mybutton">
								<form action="" method="post">
									<input type="submit" class="buysubmit" name="wlist" value="Add to wishlist"/>
								</form>				
							</div>
						</div>
						<?php } ?>
					</div>
					<div class="product-desc">
						<h2>Product Details</h2>
						<?php echo $result['body']; ?>
					</div>
					<?php } } ?>
				</div>
				<div class="rightsidebar span_3_of_1">
					<h2>CATEGORIES</h2>
					<ul>
						<?php
						$getCat = $cat->getAllCat();
						if($getCat){
							while($row = $getCat->fetch_assoc()){
						?>
				      <li><a href="productbycat.php?catid=<?php echo $row['catId']; ?>"><?php echo $row['catName']; ?></a></li>
						<?php } } ?>
    				</ul>
    	
 				</div>
 		</div>
 	</div>
</div>
<?php include 'inc/footer.php'; ?>