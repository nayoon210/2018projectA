<?php
$con=mysqli_connect("localhost","root","","ecommerce");
if(mysqli_connect_errno())
	
	{
		
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}


		
//function cat()
//{
	
	//if(isset($_GET['add_cart']))
	//{
		
//	}
	
	
//}

//getting the user IP ADDRESS
function getIp() {
    $ip = $_SERVER['REMOTE_ADDR'];
 
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
 
    return $ip;
}		

//creating the shopping cart
function cart()
{
	if(isset($_GET['add_cart']))
	{
		global $con;
		
		$ip=getIp();
		
		$pro_id=$_GET['add_cart'];
		
		$check_pro="select * from cart where ip_add='$ip' AND p_id='$pro_id'";
		
		$run_check=mysqli_query($con, $check_pro);
		
		if(mysqli_num_rows($run_check)>0)
			
			{
				
				echo "";
			}
			else
			{
				$insert_pro=" insert into cart (p_id,ip_add) values('$pro_id','$ip') ";
				
				$run_pro=mysqli_query($con,$insert_pro);
				
				echo "<script>window.open('index.php','_self')</script>";
			}
	}
}

//getting total added items

function total_items()
{
	
	if(isset($_GET['add_cart']))
		
		{
			global $con;
			
			$ip= getIp();
			
			
			$get_items="select * from cart where ip_add='$ip'";
			
			$run_items= mysqli_query($con,$get_items);
			
			$count_items=mysqli_num_rows($run_items);
		}
			else
			{
				global $con;
				
				$ip= getIp();
			
			
			$get_items="select * from cart where ip_add='$ip'";
			
			$run_items= mysqli_query($con,$get_items);
			
			$count_items=mysqli_num_rows($run_items);	
			}
				
			
		
		
		
		echo $count_items;

		
		
}

//Getting The Total Price Of The Items In The Cart

	function total_price()

		{	
			$total=0;
		
			global $con;
			
			$ip=getIp();
			
			$sel_price="select * from cart where ip_add='$ip'";
			
			$run_price= mysqli_query($con,$sel_price);
			
			while($p_price=mysqli_fetch_array($run_price))
			{
				$pro_id=$p_price['p_id'];
				
				$pro_price="select * from products where Product_id='$pro_id'";
				
				$run_pro_price= mysqli_query($con,$pro_price);
				
				while($pp_price=mysqli_fetch_array($run_pro_price))
				{
					$Product_price=array($pp_price['Product_price']);
					
					$values= array_sum($Product_price);
					
					$total +=$values;
				}
				
			}
			
			echo "$".$total;
		}			
		
		
//getting the categories

function getCats()
{
		global $con;
		
		$get_cats="select * from categories";
		
		$run_cats=mysqli_query($con, $get_cats);
		
		while($row_cats=mysqli_fetch_array($run_cats))
		{
				$Cat_id=$row_cats['Cat_id'];
				$Cat_title=$row_cats['Cat_title'];
				
		echo "<li><a  href='index.php?cat=$Cat_id'>$Cat_title</a></li>";
		}	
}


//getting the brands

function getBrands()
{
		global $con;
		
		$get_brands="select * from brands";
		
		$run_brands=mysqli_query($con, $get_brands);
		
		while($row_brands=mysqli_fetch_array($run_brands))
		{
				$Brand_id=$row_brands['Brand_id'];
				$Brand_title=$row_brands['Brand_title'];
				
		echo "<li><a  href='index.php?brand=$Brand_id'>$Brand_title</a></li>";
		}	
}
function getPro()
{
	
	global $con;
	
		if(!isset($_GET['cat']))
		{
			if(!isset($_GET['brand']))
			{	
				$get_pro="select * from products order by RAND() LIMIT 0,6";
				
				$run_pro=mysqli_query($con,$get_pro);
	
				while($row_pro=mysqli_fetch_array($run_pro))
				{
				$pro_id=$row_pro['Product_id'];
				$pro_ca=$row_pro['Product_cat'];
				$pro_brand=$row_pro['Product_brand'];
				$pro_title=$row_pro['Product_title'];
				$pro_price=$row_pro['Product_price'];
				$pro_image=$row_pro['Product_image'];
				
				echo "
				
				<div id='single_product'>
				
					<h3>$pro_title</h3>
					<img src='admin_area/product_images/$pro_image' width='180' height='180' />
					
					<p><b>Price: $ $pro_price</b></p>
					
					
					
					<a href='details.php?pro_id=$pro_id' style='float:left'>Details</a>
					
					<a href='index.php?add_cart=$pro_id'><button style='float:right'>Add to cart</button></a>
				</div>
				
				";
				}	
			}
		}
}


function getCatPro()
{
	
	if(isset($_GET['cat']))
	{
		
		$Cat_id=$_GET['cat'];
		
		global $con;
		$get_cat_pro="select * from products where Product_cat='$Cat_id'";
	
		$run_cat_pro=mysqli_query($con,$get_cat_pro);
		
		$count_cats=mysqli_num_rows($run_cat_pro);
		
		if($count_cats==0){
			
			echo"<h2 style='padding:20px'>NO PRODUCTS WERE FOUND IN THIS CATEGORY!</h2>";
		}
	
		
	
	
		while($row_cat_pro=mysqli_fetch_array($run_cat_pro))
		{
			$pro_id=$row_cat_pro['Product_id'];
			$pro_cat=$row_cat_pro['Product_cat'];
			$pro_brand=$row_cat_pro['Product_brand'];
			$pro_title=$row_cat_pro['Product_title'];
			$pro_price=$row_cat_pro['Product_price'];
			$pro_image=$row_cat_pro['Product_image'];
			
			
			
				
				echo "
				
				<div id='single_product'>
				
					<h3>$pro_title</h3>
					<img src='admin_area/product_images/$pro_image' width='180' height'180'/>
					<p><b> $ $pro_price</b></p>
					
					<a href='details.php?pro_id=$pro_id' style='float:left'>Details</a>
					
					<a href='index.php?pro_id=$pro_id'><button style='float:right'>Add to cart</button></a>
				</div>
				
			
				";
			}
			
		}
	
}

function getBrandPro()
{
	
	if(isset($_GET['brand']))
	{
		
		$Brand_id=$_GET['brand'];
		
		global $con;
		$get_brand_pro="select * from products where Product_brand='$Brand_id'";
	
		$run_brand_pro=mysqli_query($con,$get_brand_pro);
		
		$count_brands=mysqli_num_rows($run_brand_pro);
		
		if($count_brands==0){
			
			echo"<h2 style='padding:20px'>NO PRODUCTS WERE FOUND IN THIS BRAND!</h2>";
		}
	
		
	
	
		while($row_brand_pro=mysqli_fetch_array($run_brand_pro))
		{
			$pro_id=$row_brand_pro['Product_id'];
			$pro_cat=$row_brand_pro['Product_cat'];
			$pro_brand=$row_brand_pro['Product_brand'];
			$pro_title=$row_brand_pro['Product_title'];
			$pro_price=$row_brand_pro['Product_price'];
			$pro_image=$row_brand_pro['Product_image'];
			
			
			
				
				echo "
				
				<div id='single_product'>
				
					<h3>$pro_title</h3>
					<img src='admin_area/product_images/$pro_image' width='180' height'180'/>
					<p><b> $ $pro_price</b></p>
					
					<a href='details.php?pro_id=$pro_id' style='float:left'>Details</a>
					
					<a href='index.php?pro_id=$pro_id'><button style='float:right'>Add to cart</button></a>
				</div>
				
			
				";
			}
			
		}
	
}






?>