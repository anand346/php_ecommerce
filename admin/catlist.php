<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Category.php'; ?>
<?php
    $cat = new Category();
    if(isset($_GET['delcat'])){
		$catId = preg_replace("/[^-a-zA-Z0-9_]/","",$_GET['delcat']);
		$delCat = $cat->delCatById($catId);
	}
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Category List</h2>
                <div class="block">
					<?php
						if(isset($delCat)){
							echo $delCat;
						}
					?>        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Category Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$getCat = $cat->getAllCat();
							if($getCat->num_rows > 0){
								$i = 0;
								while($row = $getCat->fetch_assoc()){
									$i++;
						?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $row['catName']; ?></td>
							<td><a href="catedit.php?catid=<?php echo $row['catId']; ?>">Edit</a> || <a onclick = "return confirm('Are you sure want to delete ?');" href="?delcat=<?php echo $row['catId']; ?>">Delete</a></td>
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

