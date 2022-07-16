<?php include 'inc/header.php'; ?>
<?php
	$login = Session::get("cusLogin");
	if($login == false){
		header("location:login.php");
	}

?>
<?php

if(isset($_GET['confirmCusId'])){
    $shiftid = $_GET['confirmCusId'];
    $price   = $_GET['price'];
    $time    = $_GET['time'];


    $shift = $ct->productShiftConfirm($shiftid,$time,$price);
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
                            }else if($row['status'] == 1){
                                echo 'Shifted';
                                // echo '<a href="?confirmCusId='.$cusId.'&price='.$row['price'].'&time='.$row['date'].'">Shifted</a>';
                            }else{
                                echo "Done";
                            }
                        
                        ?></td>
                        <td>
                            <?php
                                if($row['status'] == 1){
                                    echo '<a href="?confirmCusId='.$cusId.'&price='.$row['price'].'&time='.$row['date'].'">Confirm</a>';
                                }else if($row['status'] == 2){
                                    echo "OK";
                                }else if($row['status'] == 0){
                                    echo "N/A";
                                } 
                             ?>
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

