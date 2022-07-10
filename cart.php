<?php include 'inc/header.php'; ?>
<?php
	if(isset($_GET['delCart'])){
		$delCartId = preg_replace("/[^-a-zA-Z0-9_]/","",$_GET['delCart']);
		$delCart = $ct->delProductByCart($delCartId);
	}
?>
<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$cartId = $_POST['cartId'];
		$quantity = $_POST['quantity'];
		$updateCart = $ct->updateCartQuantity($cartId,$quantity);
		if($quantity <= 0){
			$delCart = $ct->delProductByCart($cartId);
		}
	}

?>
<?php
	if(!isset($_GET['id'])){
		echo "<meta http-equiv='refresh' content = '0;URL=?id=live'";
	}

?>
 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2>Your Cart</h2>
					<?php
						if(isset($updateCart)){
							echo $updateCart;
						}
						if(isset($delCart)){
							echo $delCart;
						}
					?>
						<table class="tblone">
							<tr>
								<th width="5%">SL</th>
								<th width="30%">Product Name</th>
								<th width="10%">Image</th>
								<th width="15%">Price</th>
								<th width="15%">Quantity</th>
								<th width="10%">Total Price</th>
								<th width="10%">Action</th>
							</tr>
							<?php
								$getPro = $ct->getCartProduct();
								if($getPro){
									$sl = 0;
									$sum = 0;
									$qt = 0;
									while($row = $getPro->fetch_assoc()){
										$sl++;
							?>
							<tr>
								<td><?php echo $sl ; ?></td>
								<td><?php echo $row['productName']; ?></td>
								<td><img src="admin/<?php echo $row['image']; ?>" alt=""/></td>
								<td>Tk. <?php echo $row['price']; ?></td>
								<td>
									<form action="" method="post">
										<input type="hidden" name="cartId" value="<?php echo $row['cartId']; ?>"/>
										<input type="number" name="quantity" value="<?php echo $row['quantity']; ?>"/>
										<input type="submit" name="submit" value="Update"/>
									</form>
								</td>
								<td>$ 
									<?php
										$total = $row['price'] * $row['quantity'];
										echo $total;
								  	?>
								</td>
								<td><a onclick="return confirm('Are you surely want to delete this product ?');" href="?delCart=<?php echo $row['cartId']; ?>">X</a></td>
							</tr>
							<?php 
								$qt = $qt + $row['quantity'];
								$sum = $sum + $total; 
								Session::set("sum",$sum);
								Session::set("qty",$qt);
							?>
							<?php } } ?>
							
						</table>
						<?php
							$getData = $ct->checkCartTable();
							if($getData){
						?>
						<table style="float:right;text-align:left;" width="40%">
							<tr>
								<th>Sub Total : </th>
								<td>$ <?php 
									 if(isset($sum)){
										echo $sum;
									 }else{
										echo 0;
									 } 
									?>
								</td>
							</tr>
							<tr>
								<th>VAT : </th>
								<td>10%</td>
							</tr>
							<tr>
								<th>Grand Total :</th>
								<td>$ <?php
										if(isset($sum)){
											$vat    = $sum * 0.1;
											$gtotal = $vat + $sum;
											echo $gtotal;
										}else{
											echo 0;
										}
									   ?> 
								</td>
							</tr>
					   </table>
					   <?php
							}else{
								echo "Cart empty ! Please shop now .";
							}
					 
					 	?>
					</div>
					<div class="shopping">
						<div class="shopleft">
							<a href="index.php"> <img src="images/shop.png" alt="" /></a>
						</div>
						<div class="shopright">
							<a href="login.php"> <img src="images/check.png" alt="" /></a>
						</div>
					</div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
<?php include 'inc/footer.php'; ?>