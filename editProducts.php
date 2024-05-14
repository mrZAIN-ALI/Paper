<?php
	include_once('./connection.php');

	echo $_GET['id'];
	$q = "SELECT * FROM product where id = ". $_GET['id'];
	$query = mysqli_query($link, $q);
	if($query){
		$row = mysqli_fetch_assoc($query);
		print_r($row);
	}

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

			$sql = "UPDATE product
        SET name = '$p_name', brand = '$p_brand', description = '$p_desc', price = '$p_price', image = '$file_name'
        WHERE id = ". $_GET['id'];
			$query = mysqli_query($link, $sql);

			if($query){
				echo "<h2>Product updated successfully</h2>";
				// Redirect to product list page
				header("Location: showProducts.php");
				exit();
			}else{
				echo "<h2>Failed to update product into database</h2>";
			}
		}else{
			echo "<h2>Product not updated</h2>";
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
			<input type="text" name="p_name" id="p_name" value="<?php echo $row['name'] ?>">
		</div>

		<div>
			<label for="p_brand">Brand</label>
			<input type="text" name="p_brand" id="p_brand" value="<?php echo $row['brand'] ?>">
		</div>

		<div>
			<label for="p_desc">Description</label>
			<input type="text" name="p_desc" id="p_desc" value="<?php echo $row['description'] ?>">
		</div>

		<div>
			<label for="p_price">Price</label>
			<input type="text" name="p_price" id="p_price" value="<?php echo $row['price'] ?>">
		</div>

		<div>
			<input type="file" name="image" value="<?php $row['image'] ?>">
		</div>

		<button type="submit" name="submit">Update</button>
	</form>

	<br><br>
	<button><a href="./showProducts.php">Show Products</a></button>
</body>
</html>
