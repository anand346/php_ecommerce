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
                <h2>Order Page</h2>
            </div>
        </div>
       <div class="clear"></div>
    </div>
 </div>
<?php include 'inc/footer.php'; ?>