<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php
	$filepath = realpath(dirname(__DIR__));
	include_once ($filepath.'/classes/Cart.php');
	$ct = new Cart();
	$fm = new Format();
?>
<?php
	if(isset($_GET['shiftid'])){
		$shiftid = $_GET['shiftid'];
		$price   = $_GET['price'];
		$time    = $_GET['time'];


		$shift = $ct->productShifted($shiftid,$time,$price);
	}
	if(isset($_GET['delproid'])){
		$delproid = $_GET['delproid'];
		$price   = $_GET['price'];
		$time    = $_GET['time'];


		$delOrder = $ct->delProductShifted($delproid,$time,$price);
	}


?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Inbox</h2>
				<?php
					if(isset($shift)){
						echo $shift;
					}
					if(isset($delOrder)){
						echo $delOrder;
					}
				
				?>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Id</th>
							<th>Order Date</th>
							<th>Product</th>
							<th>Quantity</th>
							<th>Price</th>
							<th>Cus. Id</th>
							<th>Address</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$ct = new Cart();
							$fm = new Format();
							$getOrder = $ct->getAllOrderProduct();
							if($getOrder){
								while($row = $getOrder->fetch_assoc()){
						?>
						<tr class="odd gradeX">
							<td><?php echo $row['id']; ?></td>
							<td><?php echo $fm->formatDate($row['date']); ?></td>
							<td><?php echo $row['productName']; ?></td>
							<td><?php echo $row['quantity']; ?></td>
							<td>$<?php echo $row['price']; ?></td>
							<td><?php echo $row['cusId']; ?></td>
							<td><a href="customer.php?cusid=<?php echo $row['cusId']; ?>">view details</a></td>
							<?php
								if($row['status'] == '0'){
									echo '<td><a href="?shiftid='.$row['cusId'].'&price='.$row['price'].'&time='.$row['date'].'">Shift</a></td>';
								}else if($row['status'] == '1'){
									echo "<td>Pending</td>";
								}else{
									echo '<td><a href="?delproid='.$row['cusId'].'&price='.$row['price'].'&time='.$row['date'].'">Confirmed</a></td>';
								}
							?>
							
						</tr>
						<?php } } ?>
					</tbody>
				</table>
               </div>
            </div>
        </div>
<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();

        $('.datatable').dataTable();
        setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
