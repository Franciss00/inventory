<?php
$errors = array();

// Connect to the database
$db = mysqli_connect('localhost', 'root', '', 'project');

// Check connection
if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}

// EDIT PRODUCT
if (isset($_POST['edit_product'])) {
    $productCode = mysqli_real_escape_string($db, $_POST['productCode']); // Assuming product code is not editable
    $category = mysqli_real_escape_string($db, $_POST['category']);
    $productName = mysqli_real_escape_string($db, $_POST['productName']);
    $productQuantity = (int)$_POST['productQuantity'];
    $productAmount = (float)$_POST['productAmount'];
    $expirationDate = $_POST['expirationDate'];

    // Form validation: ensure that the form is correctly filled
    if (empty($category) || empty($productName) || empty($expirationDate)) {
        array_push($errors, "Category, Product name, and Expiration date are required");
    }

    if (count($errors) === 0) {
        // Update the product details in the database
        $query = "UPDATE products SET category=?, productName=?, productQuantity=?, productAmount=?, expirationDate=? WHERE productCode=?";
        $stmt = mysqli_prepare($db, $query);
        mysqli_stmt_bind_param($stmt, 'ssidsi', $category, $productName, $productQuantity, $productAmount, $expirationDate, $productCode);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        header('Location: sidepanel.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title>Edit Product</title>
    <link rel="stylesheet" href="style.css">
    <!-- Add any other stylesheets or scripts you need -->
</head>

<body>
    <div class="edit-product-container">
        <h2>Edit Product</h2>
        <?php
        // Check if there are any errors
        if (count($errors) > 0) {
            echo '<div class="errors">';
            foreach ($errors as $error) {
                echo '<p>' . $error . '</p>';
            }
            echo '</div>';
        }
        ?>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <!-- Your form inputs here -->
        </form>
    </div>
</body>

</html>


<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title>Edit Product</title>
    <link rel="stylesheet" href="style.css">
    <!-- Add any other stylesheets or scripts you need -->
</head>

<body>
    <div class="edit-product-container">
        <h2>Edit Product</h2>
        <?php
        // Check if there are any errors
        if (count($errors) > 0) {
            echo '<div class="errors">';
            foreach ($errors as $error) {
                echo '<p>' . $error . '</p>';
            }
            echo '</div>';
        }
        ?>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="input-group">
                <label>Product Code</label>
                <input type="text" name="productCode" value="<?php echo isset($_POST['productCode']) ? $_POST['productCode'] : ''; ?>">
            </div>
            <div class="input-group">
                <label>Category</label>
                <input type="text" name="category" value="<?php echo isset($_POST['category']) ? $_POST['category'] : ''; ?>">
            </div>
            <div class="input-group">
                <label>Product Name</label>
                <input type="text" name="productName" value="<?php echo isset($_POST['productName']) ? $_POST['productName'] : ''; ?>">
            </div>
            <div class="input-group">
                <label>Product Quantity</label>
                <input type="text" name="productQuantity" value="<?php echo isset($_POST['productQuantity']) ? $_POST['productQuantity'] : ''; ?>">
            </div>
            <div class="input-group">
                <label>Product Amount</label>
                <input type="text" name="productAmount" value="<?php echo isset($_POST['productAmount']) ? $_POST['productAmount'] : ''; ?>">
            </div>
            <div class="input-group">
                <label for="expirationDate">Expiration Date</label>
                <input type="date" name="expirationDate" value="<?php echo isset($_POST['expirationDate']) ? $_POST['expirationDate'] : ''; ?>">
            </div>
            <div class="input-group">
                <button type="submit" class="btn" name="edit_product">Update Product</button>
            </div>
        </form>
    </div>
</body>

</html>
