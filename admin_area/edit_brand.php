<?php



include("includes/db.php");

if(isset($_GET['edit_brand'])){

$Brand_id=$_GET['edit_brand'];

$get_brand="select * from brands where Brand_id='$Brand_id'";

$run_brand=mysqli_query($con,$get_brand);

$row_brand=mysqli_fetch_array($run_brand);

$Brand_id=$row_brand['Brand_id'];

$Brand_title=$row_brand['Brand_title'];

}
?>

<form action="" method="post" style="padding:80px;">

<b>Update Brand</b>

<input type="text" name="new_brand" value="<?php echo $Brand_title ?>"/>

<input type="submit" name="update_brand" value="Update Brand"/>

</form>

<?php



if(isset($_POST['update_brand'])){
	
	$update_id=$Brand_id;
	
	$new_brand=$_POST['new_brand'];
	
	$update_brand="update brands set Brand_title='$new_brand' where Brand_id='$update_id'";
	
	$run_update=mysqli_query($con,$update_brand);
	
	if($run_update)
	{
		echo "<script> alert('New Brand has been updated!')</script>";
		echo "<script> window.open('index.php?view_brands','_self')</script>";
	}
}
?>