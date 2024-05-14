<?php

	include_once('./connection.php');

	$q= "SELECT * FROM product";
	$query = mysqli_query($link,$q);

	// print_r($query)

	// //// To delete a product
	if(isset($_GET['id'])){
		$q = "DELETE FROM product WHERE id = ". $_GET['id'];
		$query2 = mysqli_query($link, $q);
		if($query2){
			echo "Product deleted";
			header('LOCATION: showProducts.php');
			exit();
		}else{
			echo "Unable to delete Product";
		}
	}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
	<table border="1">
		<thead>
			<tr>
				<th>Name</th>
				<th>Brand</th>
				<th>Description</th>
				<th>Price</th>
				<th>Image</th>
				<th>Operations</th>
			</tr>
		</thead>
		<tbody>
			<?php
				if($query->num_rows > 0){
					while($row = mysqli_fetch_assoc($query)){
						// print_r($row);
			?>
				<tr>
					<td><?php echo $row['name'] ?></td>
					<td><?php echo $row['brand'] ?></td>
					<td><?php echo $row['description'] ?></td>
					<td><?php echo $row['price'] ?></td>
					<td><img width="100px" height="100px" src="Images/<?php echo $row['image'] ?>" alt=""></td>
					<td>
						<button><a href="./editProducts.php?id=<?php echo $row['id'] ?>">Edit</a></button>
						<button name="delete"><a href="./showProducts.php?id=<?php echo $row['id'] ?>">Delete</a></button>
					</td>

				</tr>
			<?php
					}
				}else{
					echo "<tr><td colspan = 6>No product found</td></tr>";
				}
			?>
			
		</tbody>
	</table>
</body>
</html>