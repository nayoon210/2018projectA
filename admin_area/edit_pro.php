<!DOCTYPE>

<?php

include("includes/db.php");
if(isset ($_GET['edit_pro'])){
	
	$get_id=$_GET['edit_pro'];
	
	$get_pro="select * from products where Product_id='$get_id'";

	$run_pro= mysqli_query($con,$get_pro);

	$i=0;

	$row_pro=mysqli_fetch_array($run_pro);
		
		$pro_id=$row_pro['Product_id'];
		$pro_title=$row_pro['Product_title'];
		$pro_image=$row_pro['Product_image'];
		$pro_price=$row_pro['Product_price'];
		$pro_desc=$row_pro['Product_desc'];
		$pro_keywords=$row_pro['Product_keyword'];
		$pro_cat=$row_pro['Product_cat'];
		$pro_brand=$row_pro['Product_brand'];
		
		$get_cats="select * from categories where Cat_id='$pro_cat'";
		
		$run_cats=mysqli_query($con,$get_cats);
		
		$row_cats=mysqli_fetch_array($run_cats);
		
		$category_title= $row_cats['Cat_title'];
		
		$get_brand="select * from brands where Brand_id='$pro_brand'";
		
		$run_brand=mysqli_query($con,$get_brand);
		
		$row_brand=mysqli_fetch_array($run_brand);
		
		$brand_title= $row_brand['Brand_title'];
}
?>
<html>

	<head>
		<title> Update Product</title>
		
		<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
		<script>tinymce.init({ selector:'textarea' });</script>
	</head>
		
		<body bgcolor="skyblue">
	
		<form action ="" method="post" enctype="multipart/form-data">
			
			<table align="center" width="795" border="2" bgcolor="#187eae">
				
				<tr align="center">
				
					<td colspan="7">
					<h2> Edit And Update Product</h2>
					</td>
					
				</tr>
				
				<tr>
				
					<td align="right"> <b> Product Title: </b> </td>
					<td> <input type="text" name="Product_title" size="60" value=<?php echo $pro_title;?> /></td>
				</tr>
				
				<tr>
				
					<td align="right"> <b> Product Category: </b> </td>
					<td> 
						
						<select name="Product_cat" >
							
							<option><?php echo $category_title;?></option>
							
							
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
							
							<option><?php echo $brand_title;?></option>
							
							
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
					<td> <input type="file" name="Product_image" /><img src="product_images/<?php echo $pro_image;?>" width="60" height="60"/></td>
				</tr>
				
				
				<tr>
				
					<td align="right"><b> Product Price: </b> </td>
					<td> <input type="text" name="Product_price" value=<?php echo $pro_price;?> /></td>
				</tr>
				
				
				<tr>
				
					<td align="right"><b> Product Description: </b> </td>
					<td> <textarea name="Product_desc" cols="20" rows="10" ><?php echo $pro_desc;?></textarea></td>
				</tr>
				
				<tr>
				
					<td align="right"> <b> Product Keywords: </b></td>
					<td> <input type="text" name="Product_keyword" size="50" value=<?php echo $pro_keywords;?> /></td>
				</tr>
				
				
				<tr align="center">
				
				
					<td colspan="7"> <input type="submit" name="update_product" value="Update Product" /></td>
				</tr>
			</table>
	
	
		</body>
	
</html>


<?php
	
	if(isset($_POST['update_product']))
	{
		$update_id=$pro_id;
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
		
		$update_product="update products set Product_cat='$Product_cat',Product_brand='$Product_brand',Product_title='$Product_title',Product_price='$Product_price',Product_desc='$Product_desc',Product_image='$Product_image',Product_keyword='$Product_keyword' where Product_id='$update_id'";
		
		
		$run_product=mysqli_query($con,$update_product);
		
		if($run_product){
			
			echo "<script>alert('Product Has Been Updated')</script>";
			echo "<script>window.open('index.php?view_products','_self')</script>";
		}
	}
	





?>