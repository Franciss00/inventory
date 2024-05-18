<?php
// Include the file where you establish your database connection
include('database/server.php');

if (isset($_GET['deleteproductCode'])) {
  // Assuming $db is your database connection
  $productCode = mysqli_real_escape_string($db, $_GET['deleteproductCode']);

  // JavaScript to display the confirmation message
  echo '<script>
              var confirmDelete = confirm("Are you sure you want to delete the item?");
              if(confirmDelete) {
                  window.location.href = "delete-product.php?confirmedDelete=' . $productCode . '";
              } else {
                  window.location.href = "sidepanel.php";
              }
          </script>';
}



if (isset($_GET['confirmedDelete'])) {
  $productCode = mysqli_real_escape_string($db, $_GET['confirmedDelete']);
  $sql = "DELETE FROM products WHERE productCode = '$productCode'";
  $result = mysqli_query($db, $sql);
  if ($result) {
    header('Location: sidepanel.php');
  } else {
    echo "Failed to delete the item.";
  }
}
?>
