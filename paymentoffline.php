<?php include 'inc/header.php'; ?>
<?php
$login = Session::get("cusLogin");
if ($login == false) {
    header("location:login.php");
}
?>
<?php
    if(isset($_GET['orderid']) && $_GET['orderid'] == 'order'){
        $cusId = Session::get("cusId");
        $insertOrder = $ct->orderProduct($cusId);
        $delCart = $ct->delCustomerData();
        header("location:success.php");
    }

?>
<style>
    .division{width: 50%;float:left;}
    .tblone{width:500px;margin:0 auto;border : 2px solid #ddd;}
    .tblone tr td{text-align: justify;}
    .tbltwo{float:right;text-align:left;width: 60%;border:2px solid #ddd;margin-right:14px;margin-top: 12px;}
    .tbltwo tr td{text-align: justify;padding:5px 10px;}
    .ordernow{padding-bottom: 30px;}
    .ordernow a{width:200px;margin:20px auto 0;text-align: center;padding:5px;font-size:30px;display:block;background: #ff0000;color:#fff;border-radius: 3px;}
</style>
<div class="main">
    <div class="content">
        <div class="section group">
            <div class="division">
                <table class="tblone">
                    <tr>
                        <th>No</th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
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
                        <td>$<?php echo $row['price']; ?></td>
                        <td><?php echo $row['quantity']; ?></td>
                        <td>$<?php
                                $total = $row['price'] * $row['quantity'];
                                echo $total;
                            ?>
                        </td>
                    </tr>
                    <?php 
                        $qt = $qt + $row['quantity'];
                        $sum = $sum + $total; 
                    ?>
                    <?php } } ?>
                    
                </table>
                <table class = "tbltwo" >
                    <tr>
                        <td>Sub Total</td>
                        <td>:</td>
                        <td>$<?php 
                                if(isset($sum)){
                                echo $sum;
                                }else{
                                echo 0;
                                } 
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>VAT</td>
                        <td>:</td>
                        <td>10% ( $<?php echo $vat    = $sum * 0.1; ?> )</td>
                    </tr>
                    <tr>
                        <td>Grand Total</td>
                        <td>:</td>
                        <td>$<?php
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
                    <tr>
                        <td>Quantity</td>
                        <td>:</td>
                        <td><?php echo $qt; ?></td>
                    </tr>
                </table>
            </div>
            <div class="division">
                <?php
                    $id = Session::get("cusId");
                    $getData = $cmr->getCustomerData($id);
                    if($getData){
                        while($row = $getData->fetch_assoc()){
                ?>
                <table class = "tblone">
                    <tr>
                        <td colspan="3"><h2>Your Profile Details</h2></td>
                    </tr>
                    <tr>
                        <td width = "20%">Name</td>
                        <td width = "5%" >:</td>
                        <td><?php echo $row['name']; ?></td>
                    </tr>
                    <tr>
                        <td>Phone</td>
                        <td>:</td>
                        <td><?php echo $row['phone']; ?></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>:</td>
                        <td><?php echo $row['email']; ?></td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td>:</td>
                        <td><?php echo $row['address']; ?></td>
                    </tr>
                    <tr>
                        <td>City</td>
                        <td>:</td>
                        <td><?php echo $row['city']; ?></td>
                    </tr>
                    <tr>
                        <td>Zip code</td>
                        <td>:</td>
                        <td><?php echo $row['zip']; ?></td>
                    </tr>
                    <tr>
                        <td>Country</td>
                        <td>:</td>
                        <td><?php echo $row['country']; ?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td><a href="editprofile.php">Update Details</a></td>
                    </tr>
                </table>
                <?php } } ?>
            </div>
        </div>
    </div>
    <div class="ordernow"><a href="?orderid=order">Order</a></div>
</div>
<?php include 'inc/footer.php'; ?>