<?php
session_start();

// initializing variables
$username = "";
$email = "";

$errors = array();

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'project');

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) {
    array_push($errors, "Username is required");
  }
  if (empty($email)) {
    array_push($errors, "Email is required");
  }
  if (empty($password_1)) {
    array_push($errors, "Password is required");
  }
  if ($password_1 != $password_2) {
    array_push($errors, "The two passwords do not match");
  }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);

  if ($user) { // if user exists
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
    $password = md5($password_1); //encrypt the password before saving in the database

    $query = "INSERT INTO users (username, email, password) 
  			  VALUES('$username', '$email', '$password')";
    mysqli_query($db, $query);
    $_SESSION['username'] = $username;
    $_SESSION['success'] = "You are now logged in";
    header('location: index.php');
  }
}

// EDIT PRODUCT
if (isset($_POST['edit_product'])) {
  $edit_product_code = mysqli_real_escape_string($db, $_POST['edit_product']);
  $category = mysqli_real_escape_string($db, $_POST['category']);
  $productName = mysqli_real_escape_string($db, $_POST['productName']);
  $productQuantity = mysqli_real_escape_string($db, $_POST['productQuantity']);
  $productAmount = mysqli_real_escape_string($db, $_POST['productAmount']);
  $expirationDate = mysqli_real_escape_string($db, $_POST['expirationDate']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($productName)) {
    array_push($errors, "Product name is required");
  }
  if (empty($productQuantity)) {
    array_push($errors, "Quantity is required");
  }
  if (empty($productAmount)) {
    array_push($errors, "Amount is required");
  }

  // Check if the product exists
  $product_check_query = "SELECT * FROM products WHERE productCode='$edit_product_code' LIMIT 1";
  $result = mysqli_query($db, $product_check_query);
  $product = mysqli_fetch_assoc($result);

  if (!$product) {
    array_push($errors, "Product does not exist for editing");
  }

  if (count($errors) == 0) {
    // Update the product details
    $query = "UPDATE products SET category='$category', productName='$productName', productQuantity='$productQuantity', productAmount='$productAmount', expirationDate='$expirationDate' WHERE productCode='$edit_product_code'";
    if(mysqli_query($db, $query)) {
      header('location: sidepanel.php');
    } else {
      array_push($errors, "Failed to update product");
    }
  }
}

// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//Add product
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

$productCode = "";
$category = "";
$productName = "";
$productQuantity = "";
$productAmount = "";
$expirationDate = '';

if (isset($_POST['add_product'])) {
  $productCode = mysqli_real_escape_string($db, $_POST['productCode']);
  $category = mysqli_real_escape_string($db, $_POST['category']);
  $productName = mysqli_real_escape_string($db, $_POST['productName']);
  $productQuantity = mysqli_real_escape_string($db, $_POST['productQuantity']);
  $productAmount = mysqli_real_escape_string($db, $_POST['productAmount']);
  $expirationDate = mysqli_real_escape_string($db, $_POST['expirationDate']);


  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($productCode)) {
    array_push($errors, "product code is required");
  }
  if (empty($productName)) {
    array_push($errors, "product name is required");
  }
  if (empty($productQuantity)) {
    array_push($errors, "Quantity is required");
  }
  if (empty($productAmount)) {
    array_push($errors, "Amount is required");
  }

  // first check the database to make sure 
  // a product does not already exist with the same Product code and/or product name
  $product_check_query = "SELECT * FROM products WHERE productCode='$productCode' OR productName='$productName' LIMIT 1";
  $result = mysqli_query($db, $product_check_query);
  $product = mysqli_fetch_assoc($result);

  if ($product) { // if product exists
    if ($product['productCode'] === $productCode) {
      array_push($errors, "Product Code already exists");
    }

    if ($product['productName'] === $productName) {
      array_push($errors, "Product Name already exists");
    }
  }

  if (count($errors) == 0) {
    // If it's a new product, insert it into the database
    $query = "INSERT INTO products (productCode, category, productName, productQuantity, productAmount, expirationDate) 
  			  VALUES('$productCode', '$category', '$productName', '$productQuantity', '$productAmount', '$expirationDate')";
    mysqli_query($db, $query);
    header('location: sidepanel.php');
  }
}

// DELETE PRODUCT
if (isset($_GET['deleteproductCode'])) {
  // Assuming $db is your database connection
  $productCode = mysqli_real_escape_string($db, $_GET['deleteproductCode']);

  // Prompting the user for confirmation using JavaScript
  echo '<script>
            var confirmDelete = confirm("Are you sure you want to delete the item?");
            if(confirmDelete) {
                window.location.href = "delete-product.php?confirmedDelete=' . $productCode . '";
            } else {
                window.location.href = "sidepanel.php";
            }
        </script>';
}

// LOGIN USER
if (isset($_POST['login_user'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($username)) {
    array_push($errors, "Username is required");
  }
  if (empty($password)) {
    array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
    $password = md5($password);
    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $results = mysqli_query($db, $query);
    if (mysqli_num_rows($results) == 1) {
      $_SESSION['username'] = $username;
      $_SESSION['success'] = "You are now logged in";
      header('location: sidepanel.php');
    } else {
      array_push($errors, "Wrong username/password combination");
    }
  }
}
?>
