<?php
session_start();

if (!isset($_SESSION['username'])) {
	$_SESSION['msg'] = "You must log in first";
	header('location: login.php');
}
if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['username']);
	header("location: login.php");
}
?>
<!DOCTYPE html>
<html>

<head>
	<title>Home</title>
	<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/dark.min.css"> -->
</head>

<body>

	<!-- <form action="process-added-product.php" method="post">

		<h1>Add Products</h1>
		<div>
			<label for="productImage">Enter product image</label>
			<input type="file" accept=".jpg, .jpeg, .png" id="productImage">
		</div>
		<div>
			<label for="productCode">Product Code</label>
			<input type="text" id="productCode" name="productCode">
		</div>
		<div>
			<label for="productName">Product Name</label>
			<input type="text" id="productName" name="productName">
		</div>
		<div>
			<label for="productQuantity">Quantity</label>
			<input type="text" id="productQuantity" name="productQuantity">
		</div>
		<div>
			<label for="amount">Amount</label>
			<input type="text" id="amount" name="productAmount">
		</div>
		<button type="submit" name="add_product">Add</button>


	</form> -->

	<div class="header">
		<h2>Home Page</h2>
	</div>

	<div class="content">
		<!-- notification message -->
		<?php if (isset($_SESSION['success'])) : ?>
			<div class="error success">
				<h3>   
					<?php
					echo $_SESSION['success'];
					unset($_SESSION['success']);
					?>
				</h3>
			</div>
		<?php endif ?>

		<!-- logged in user information -->
		<?php if (isset($_SESSION['username'])) : ?>
			<p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
			<p> <a href="index.php?logout='1'" style="color: red;">logout</a> </p>
		<?php endif ?>
	</div>

</body>

</html>