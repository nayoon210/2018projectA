<!DOCTYPE>
<?php
include("functions/functions.php");

?>
<html>
	<head>
		<title> My Online Shop </title>
		
		
		
		<link rel="stylesheet" href="styles/style.css" media="all"/>
	</head>
	
<body>
<!-- Main Container Starts Here-->
	<div class="main_wrapper"> 
	<!-- Header Starts Here-->
		<div class="header_wrapper"> 	
			
			<a href="index.php"><img id="logo" src="images/logo.gif" /></a>
			<img id="banner" src="images/abc.gif"/>
			
			
				
		
		
		</div>
		<!-- Header Ends Here-->
		
		<!-- Navigation Bar Starts-->
		<div class="menubar"> 
				
				<ul id="menu">
				
				<li> <a href="index.php">Home</a></li>
				<li> <a href="all_products.php">All Products</a></li>
				<li> <a href="customer/my_account.php">My Account</a> </li>
				<li> <a href="#">Sign Up</li>
				<li> <a href="cart.php">Shopping Cart</a></li>
				<li> <a href="#">Contact Us</li>
				
				</ul>
					<div id="form">
					
						<form method ="get" action="results.php" enctype="multipart/form-data">
						
							<input type="text" name="user_query" placeholder="Search A Product"/>
							<input type="Submit" name="Search" value="Search"/>
						</form>
					
					</div>
				</div>
	<!--Navigation Ends-->
	
	<!--Content Wrapper Starts-->
		<div class="content_wrapper">
		
		
		
			<div id="sidebar"> 
				
				<div id="sidebar_title">Categories</div>
				
					<ul id="cats">
					
						<?php getCats(); ?>
					</ul>
				
				<div id="sidebar_title">Brands</div>
				
					<ul id="cats">
					
						<?php getBrands();?>
						
					</ul>
				
				
			</div>
		
			<div id="content_area"> 
				<div id="shopping_cart">
					
					<span style="float:right; font-size:18px; padding:5px; line-height:40px;">
					
					Welcome Guest!  <b style="color:yellow">Shopping cart-</b> Total Item: Total Price:<a href = "cart.php" style="color:yellow">Go To Cart</a>
					
					</span>
					
					
				</div>
			
				
				<div id="products_box">
				
				<?php
				
				if(isset($_GET['pro_id'])){
					
				$Product_id=$_GET['pro_id'];
				
				$get_pro="select * from products where Product_id='$Product_id' ";
				
				$run_pro=mysqli_query($con,$get_pro);
	
				while($row_pro=mysqli_fetch_array($run_pro))
				{
				$pro_id=$row_pro['Product_id'];
				
				$pro_brand=$row_pro['Product_brand'];
				$pro_title=$row_pro['Product_title'];
				$pro_price=$row_pro['Product_price'];
				$pro_image=$row_pro['Product_image'];
				$pro_desc=$row_pro['Product_desc'];
				
				echo "
				
				<div id='single_product'>
				
					<h3>$pro_title</h3>
					<img src='admin_area/product_images/$pro_image' width='400' height='300' />
					
					<p><b> $ $pro_price</b></p>
					
					<p>$pro_desc</p>
					
					<a href='index.php' style='float:left'>Go Back</a>
					
					<a href='index.php?pro_id=$pro_id'><button style='float:right'>Add to cart</button></a>
				</div>
				
				";
				
			}
				}
			
			?>
				
				</div>
			
			
			</div>
		</div>
		<!--Content Wrapper Ends-->
		
		<div id="footer"> 
			
			<h2 style ="text-align:center; padding-top:30px">&copy; 2016 AYUSH KUMAR MATHUR </h2>
		
		</div>
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	</div>
<!-- Main Container Ends  Here-->


</body>
</html>	
	
	