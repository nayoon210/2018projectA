<!DOCTYPE>
<?php
session_start();
include("functions/functions.php");

?>
<html>
	<head>
		<title> HONGIK ART </title>



		<link rel="stylesheet" href="styles/style.css?ver=7" media="all"/>
	</head>

<body>
<!-- Main Container Starts Here-->
	<div class="main_wrapper">
	<!-- Header Starts Here-->
		<div class="header_wrapper">

			<a href="index.php"><img id="logo" src="images/logo.gif" /></a>
			<div class="statelogoff">
         <!--@css(/css/module/layout/statelogoff.css)-->
         <a href="/member/login.html" class="log">로그인</a>
         <a href="/member/join.html">회원가입</a>
         <a href="cart.php">장바구니 <span class="count {$basket_count_display|display} {$basket_count_display_class}"><span class="{$basket_count_class}"><!--{$basket_count}--></span></span></a>
         <a href="/myshop/order/list.html">주문조회</a>
         <a href="customer/my_account.php">마이쇼핑</a>
         <a href="">게시판</a>
     </div>





		</div>
		<!-- Header Ends Here-->

		<!-- Navigation Bar Starts-->
		<div class="menubar">

				<ul id="menu">

				<li> <a href="index.php">Home</a></li>
				<li> <a href="all_products.php">전시정보</a></li>
				<li> <a href="">회화</a> </li>
				<li> <a href="#">공예</li>
				<li> <a href="">디자인</a></li>
				<li> <a href="#">아트상품</li>

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

			<?php cart(); ?>

				<div id="shopping_cart">

					<span style="float:right; font-size:15px; padding:5px; line-height:40px;">



					<?php

					if(isset($_SESSION['customer_email'])){

						echo "<b> Welcome: </b> ". $_SESSION['customer_email'] . "<b style='color:yellow;'> Your</b>" ;
					}
					else
					{
						echo "<b> Welcome Guest: </b>";
					}
					?>


					  <b style="color:yellow">Shopping cart-</b> Total Item: <?php total_items()?> Total Price: <?php total_price(); ?> <a href = "cart.php" style="color:yellow">Go To Cart</a>

					<?php


					if(!isset($_SESSION['customer_email'])){

						echo "<a href='checkout.php' style='color:orange'>Login</a>";
					}

					else{

						echo "<a href = 'logout.php' style='color:orange'>Logout</a>";
					}


					?>

					</span>


				</div>





				<div id="products_box">

				<?php getPro();  ?>
				<?php getCatPro(); ?>
				<?php getBrandPro(); ?>
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
