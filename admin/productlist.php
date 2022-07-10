<?php include_once 'inc/header.php';?>
<?php include_once 'inc/sidebar.php';?>
<?php include_once '../classes/Product.php'; ?>
<?php include_once '../helpers/Format.php'; ?>
<?php
$pd = new Product();
$fm = new Format();
if(isset($_GET['delpro'])){
	$proId = preg_replace("/[^-a-zA-Z0-9_]/","",$_GET['delpro']);
	$delPro = $pd->delProById($proId);
}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Post List</h2>
        <div class="block">  
			<?php
				if(isset($delPro)){
					echo $delPro;
				}
			?>     
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>S.no.</th>
					<th>Product name</th>
					<th>Category</th>
					<th>Brand</th>
					<th>Description</th>
					<th>Price</th>
					<th>Image</th>
					<th>type</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$getPd = $pd->getAllProduct();
					if($getPd){
						$i = 0;
						while($row = $getPd->fetch_assoc()){
							$i++;
				?>
				<tr class="odd gradeX">
					<td><?php echo $i; ?></td>
					<td><?php echo $row['productName']; ?></td>
					<td><?php echo $row['catName']; ?></td>
					<td class="center"><?php echo $row['brandName']; ?></td>
					<td><?php echo $fm->textShorten($row['body'],50); ?></td>
					<td>$<?php echo $row['price']; ?></td>
					<td><img src="<?php echo $row['image']; ?>" alt="" height = "40" width = "60" ></td>
					<td class="center">
						<?php
							if($row['type'] == 0){
								echo "Featured";
							}else{
								echo "General";
							}
						?>
					</td>
					<td><a href="productedit.php?proid=<?php echo $row['productId']; ?>">Edit</a> || <a onclick = "return confirm('Are you sure want to delete ?');" href="?delpro=<?php echo $row['productId']; ?>">Delete</a></td>
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
