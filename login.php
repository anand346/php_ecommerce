<?php include 'inc/header.php'; ?>
<?php
	$login = Session::get("cusLogin");
	if($login == true){
		header("location:order.php");
	}

?>
<?php
	
	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])){
		$customerLogin = $cmr->customerLogin($_POST);
	}
?>
 <div class="main">
    <div class="content">
    	 <div class="login_panel">
		 	<?php
				if(isset($customerLogin)){
					echo $customerLogin;
				}
			
			?>
        	<h3>Existing Customers</h3>
        	<p>Sign in with the form below.</p>
        	<form action="" method="POST">
				<input name="email" type="text" placeholder="Enter email"/>
				<input name="password" type="password" placeholder="Enter password"/>
				<div class="buttons"><div><button type="submit" class="grey" name="login" >Sign In</button></div></div>
			</form>
		</div>
		<?php
			
			if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])){
				$customerReg = $cmr->customerRegistration($_POST);
			}
		?>
    	<div class="register_account">
			<?php
				if(isset($customerReg)){
					echo $customerReg;
				}
			
			?>
    		<h3>Register New Account</h3>
    		<form action="" method="post" >
		   			 <table>
		   				<tbody>
						<tr>
						<td>
							<div>
							<input type="text" name = "name" placeholder="name">
							</div>
							
							<div>
							   <input type="text" name="city" placeholder = "city" />
							</div>
							
							<div>
								<input type="text" name="zip" placeholder = "zip code" />
							</div>
							<div>
								<input type="text" name="email" placeholder = "Email address" >
							</div>
		    			 </td>
		    			<td>
							<div>
								<input type="text" name="address" placeholder = "Address" >
							</div>
							<div>
								<input type="text" name="country" placeholder = "country" >
							</div>
							<div>
								<input type="text" name="phone" placeholder = "phone" />
							</div>
							<div>
								<input type="text" name="password" placeholder = "password" >
							</div>
		    			</td>
		    </tr> 
		    </tbody></table> 
		   	<div class="search"><div><button class="grey" name="register" >Create Account</button></div></div>
		    <div class="clear"></div>
		    </form>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
 <?php include 'inc/footer.php'; ?>