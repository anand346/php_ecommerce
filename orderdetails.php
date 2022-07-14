<?php include 'inc/header.php'; ?>
<?php
	$login = Session::get("cusLogin");
	if($login == false){
		header("location:login.php");
	}

?>
 <div class="main">
    <div class="content">
    	<div class="section group">
            <div class="order">
                <h2>Your ordered details</h2>
                <table class="tblone">
                    <tr>
                        <th>No.</th>
                        <th>Product Name</th>
                        <th>Image</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    <?php
                        $cusId = Session::get("cusId");
                        $getOrder = $ct->getOrderedProduct($cusId);
                        if($getOrder){
                            $sl = 0;
                            while($row = $getOrder->fetch_assoc()){
                                $sl++;
                    ?>
                    <tr>
                        <td><?php echo $sl ; ?></td>
                        <td><?php echo $row['productName']; ?></td>
                        <td><img src="admin/<?php echo $row['image']; ?>" alt=""/></td>
                        <td><?php echo $row['quantity']; ?></td>
                        <td>$ 
                            <?php
                                $total = $row['price'];
                                echo $total;
                            ?>
                        </td>
                        <td><?php echo $fm->formatDate($row['date']); ?></td>
                        <td><?php 
                            if($row['status'] == 0){
                                echo "Pending";
                            }else{
                                echo "Shifted";
                            }
                        
                        ?></td>
                        <td>
                            <?php
                                if($row['status'] == 1){
                            ?>
                            <a onclick="return confirm('Are you surely want to delete this product ?');" href="">X</a>
                            <?php
                                }else{
                            ?>
                            N/A
                            <?php } ?>
                        </td>
                    </tr>
                    <?php } } ?>
                    
                </table>
            </div>
        </div>
       <div class="clear"></div>
    </div>
 </div>
<?php include 'inc/footer.php'; ?>