<?php
	include_once('./connection.php');

	if(isset($_POST['submit'])){

		$p_name = $_POST['p_name'];
		$p_brand = $_POST['p_brand'];
		$p_desc = $_POST['p_desc'];
		$p_price = $_POST['p_price'];

		$file_name = $_FILES['image']['name'];
		$tempname = $_FILES['image']['tmp_name'];
		$folder = 'Images/'.$file_name;

		// Move uploaded file to destination folder
		if(move_uploaded_file($tempname, $folder)){

			$sql = "INSERT INTO product (name, brand, description, price, image) 
			VALUES ('$p_name', '$p_brand', '$p_desc', '$p_price', '$file_name')";
			$query = mysqli_query($link, $sql);

			if($query){
				echo "<h2>Product uploaded successfully</h2>";
			}else{
				echo "<h2>Failed to insert product into database</h2>";
			}
		}else{
			echo "<h2>Product not uploaded</h2>";
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Product Insertion</title>
</head>
<body>
	<form action="#" method="POST" enctype="multipart/form-data">
		<div>
			<label for="p_name">Product Name</label>
			<input type="text" name="p_name" id="p_name">
		</div>

		<div>
			<label for="p_brand">Brand</label>
			<input type="text" name="p_brand" id="p_brand">
		</div>

		<div>
			<label for="p_desc">Description</label>
			<input type="text" name="p_desc" id="p_desc">
		</div>

		<div>
			<label for="p_price">Price</label>
			<input type="text" name="p_price" id="p_price">
		</div>

		<div>
			<input type="file" name="image">
		</div>

		<button type="submit" name="submit">Submit</button>
	</form>

	<br><br>
	<button><a href="./showProducts.php">Show Products</a></button>
</body>
</html>
