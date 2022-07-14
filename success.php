<?php include 'inc/header.php'; ?>
<?php
$login = Session::get("cusLogin");
if ($login == false) {
    header("location:login.php");
}

?>
<style>
    .psuccess {
        width: 500px;
        min-height: 200px;
        text-align: center;
        border: 1px solid #ddd;
        margin: 0 auto;
        padding: 50px;
    }

    .psuccess h2 {
        border-bottom: 1px solid #ddd;
        margin-bottom: 40px;
        padding-bottom: 10px;
    }
    .psuccess p{
        line-height: 25px;
        font-size: 18px;
        text-align: left;
    }
</style>
<div class="main">
    <div class="content">
        <div class="section group">
            <div class="psuccess">
                <h2>Success</h2>
                <?php
                    $cusId = Session::get("cusId");
                    $amount = $ct->payableAmount($cusId);
                    $sum = 0;
                    if($amount){
                        while($row = $amount->fetch_assoc()){
                            $sum += $row['price'];
                        }
                    }
                ?>
                <p style = "color:red;">Total Payable Amount(Including VAT) : $<?php
                    $vat = $sum*0.1;
                    echo $total = $sum + $vat;
                ?></p>
                <p>Thanks for purchase. Recieve your order successfully . We will contact you ASAP with delivery details.Here is your order details ... <a href="orderdetails.php">Visit here</a></p>
            </div>
        </div>
    </div>
</div>
<?php include 'inc/footer.php'; ?>