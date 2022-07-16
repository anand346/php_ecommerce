<?php include 'inc/header.php'; ?>
<div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2>Compare</h2>
						<table class="tblone">
							<tr>
								<th>SL</th>
								<th>Product Name</th>
								<th>Price</th>
								<th>Image</th>
								<th>Action</th>
							</tr>
							<?php
                                $cusid = Session::get("cusId");
								$getPd = $pd->getComparedData($cusid);
								if($getPd){
									$sl = 0;
									while($row = $getPd->fetch_assoc()){
										$sl++;
							?>
							<tr>
								<td><?php echo $sl ; ?></td>
								<td><?php echo $row['productName']; ?></td>
								<td>$<?php echo $row['price']; ?></td>
								<td><img src="admin/<?php echo $row['image']; ?>" alt=""/></td>
								<td><a href="details.php?proid=<?php echo $row['productId']; ?>">View</a></td>
							</tr>
							<?php } } ?>
							
						</table>
					</div>
					<div class="shopping">
						<div class="shopleft" style = "width:100%;text-align:center;">
							<a href="index.php"> <img src="images/shop.png" alt="" /></a>
						</div>
					</div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
<?php include 'inc/footer.php'; ?>