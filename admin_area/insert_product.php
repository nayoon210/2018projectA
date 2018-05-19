<!DOCTYPE>

<?php

include("includes/db.php");

?>
<html>

	<head>
		<title> Inserting Product</title>
		
		<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
		<script>tinymce.init({ selector:'textarea' });</script>
	</head>
		
		<body bgcolor="skyblue">
	
		<form action="insert_product.php" method="post" enctype="multipart/form-data">
			
			<table align="center" width="795" border="2" bgcolor="#187eae">
				
				<tr align="center">
				
					<td colspan="7">
					<h2> Insert New Post Here</h2>
					</td>
					
				</tr>
				
				<tr>
				
					<td align="right"> <b> Product Title: </b> </td>
					<td> <input type="text" name="Product_title" size="60" required /></td>
				</tr>
				
				<tr>
				
					<td align="right"> <b> Product Category: </b> </td>
					<td> 
						
						<select name="Product_cat" required>
							
							<option>Select A Category</option>
							
							
							<?php
							$get_cats="select * from categories";
		
							$run_cats=mysqli_query($con, $get_cats);
		
							while($row_cats=mysqli_fetch_array($run_cats))
								{
									$Cat_id=$row_cats['Cat_id'];
									$Cat_title=$row_cats['Cat_title'];
				
									echo "<option value='$Cat_id'>$Cat_title</option>";
								}	
							
							?>
							
						</select>
					
					</td>
				</tr>
				
				
			<tr>
				
					<td align="right"> <b> Product Brand: </b></td>
					<td> <select name="Product_brand" required>
							
							<option>Select A Brand</option>
							
							
							<?php
							$get_brands="select * from brands";
		
							$run_brands=mysqli_query($con, $get_brands);
		
							while($row_brands=mysqli_fetch_array($run_brands))
								{
								$Brand_id=$row_brands['Brand_id'];
								$Brand_title=$row_brands['Brand_title'];
				
								echo "<option value='$Brand_id'>$Brand_title</option>";
								}
							
							?>
							
						</select></td>
				</tr>
				
				
				<tr>
				
					<td align="right"> <b> Product Image : </b></td>
					<td> <input type="file" name="Product_image" required /></td>
				</tr>
				
				
				<tr>
				
					<td align="right"><b> Product Price: </b> </td>
					<td> <input type="text" name="Product_price" required /></td>
				</tr>
				
				
				<tr>
				
					<td align="right"><b> Product Description: </b> </td>
					<td> <textarea name="Product_desc" cols="20" rows="10" ></textarea></td>
				</tr>
				
				<tr>
				
					<td align="right"> <b> Product Keywords: </b></td>
					<td> <input type="text" name="Product_keyword" size="50" required/></td>
				</tr>
				
				
				<tr align="center">
				
				
					<td colspan="7"> <input type="submit" name="insert_post" value="Insert Product Now" /></td>
				</tr>
			</table>
	
	
		</body>
	
</html>


<?php
	
	if(isset($_POST['insert_post']))
	{
			//getting the text data from the fields
		$Product_title=$_POST['Product_title'];
		$Product_cat=$_POST['Product_cat'];
		$Product_brand=$_POST['Product_brand'];
		
		$Product_price=$_POST['Product_price'];
		$Product_desc=$_POST['Product_desc'];
		$Product_keyword=$_POST['Product_keyword'];
		
		//getting the image from the field

		$Product_image=$_FILES['Product_image']['name'];
		$Product_image_tmp=$_FILES['Product_image']['tmp_name'];
		
		move_uploaded_file($Product_image_tmp,"product_images/$Product_image");
		
		$insert_product="insert into products(Product_cat,Product_brand,Product_title,Product_price,Product_desc,Product_image,Product_keyword) values ('$Product_cat','$Product_brand','$Product_title','$Product_price','$Product_desc','$Product_image','$Product_keyword')";
		
		
		$insert_pro=mysqli_query($con,$insert_product);
		
		if($insert_pro){
			
			echo "<script>alert('Product Has Been Inserted')</script>";
			echo "<script>window.open('index.php?insert_product','_self')</script>";
		}
	}
	





?>