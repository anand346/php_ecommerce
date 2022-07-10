<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Brand.php'; ?>
<?php
    $brand = new Brand();
    if(isset($_GET['delbrand'])){
		$brandId = preg_replace("/[^-a-zA-Z0-9_]/","",$_GET['delbrand']);
		$delBrand = $brand->delBrandById($brandId);
	}
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Brand List</h2>
                <div class="block">
					<?php
						if(isset($delBrand)){
							echo $delBrand;
						}
					?>        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Brand Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$getBrand = $brand->getAllBrand();
							if($getBrand){
								$i = 0;
								while($row = $getBrand->fetch_assoc()){
									$i++;
						?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $row['brandName']; ?></td>
							<td><a href="brandedit.php?brandid=<?php echo $row['brandId']; ?>">Edit</a> || <a onclick = "return confirm('Are you sure want to delete ?');" href="?delbrand=<?php echo $row['brandId']; ?>">Delete</a></td>
						</tr>
						<?php
								}
							}
						?>
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

