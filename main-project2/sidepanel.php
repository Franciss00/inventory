<?php
include ('database/server.php');

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
<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8">
  <title>Table |</title>
  <link rel="stylesheet" href="style.css">
  <!-- Boxiocns CDN Link -->
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- bootstrap -->
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> -->
  <link rel="stylesheet" href="sidepanel.css">
</head>

<body>
  <!-- %%%%%%%%%%%%%%%%%%%%% -->
  <!-- side bar left -->
  <!-- %%%%%%%%%%%%%%%%%%%%% -->
  <div class="sidebar close">
    <ul class="nav-links">
      <li>
        <a href="#">
          <i class='bx bx-grid-alt'></i>
          <span class="link_name">Dashboard</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="index.php">Dashboard</a></li>
        </ul>
      </li>
      <li>
        <div class="iocn-link">
          <a href="#">
            <i class="fa-solid fa-user"></i>
            <span class="link_name">Users</span>
          </a>
          <!-- <i class='bx bxs-chevron-down arrow'></i> -->
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="#">Users</a></li>
        </ul>
      </li>
      <li>
        <div class="iocn-link">
          <a href="#">
            <i class="fa-solid fa-list"></i>
            <span class="link_name">Category</span>
          </a>
          <i class='bx bxs-chevron-down arrow'></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="#">Category</a></li>
          <li><a href="#">Pouch-Noodles</a></li>
          <li><a href="#">Cup-Noodles</a></li>
          <li><a href="#">Snaks</a></li>
          <li><a href="#">Drinks</a></li>
          <li><a href="#">Add-ons</a></li>
        </ul>
      </li>
      <!--  <li>
        <div class="iocn-link">
          <a href="#">
            <i class="fa-solid fa-store"></i>
            <span class="link_name">Branches</span>
          </a>
          <i class='bx bxs-chevron-down arrow'></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="#">Branches</a></li>
          <li><a href="#">Avocadoria</a></li>
          <li><a href="#">Dallida</a></li>
        </ul>
      </li> -->
      <!-- <li>
        <a href="#">
          <i class='bx bx-line-chart'></i>
          <span class="link_name">Chart</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="#">Chart</a></li>
        </ul>
      </li>
      <li> -->
      <!-- <div class="iocn-link">
          <a href="#">
            <i class='bx bx-plug'></i>
            <span class="link_name">Plugins</span>
          </a>
          <i class='bx bxs-chevron-down arrow'></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="#">Plugins</a></li>
          <li><a href="#">UI Face</a></li>
          <li><a href="#">Pigments</a></li>
          <li><a href="#">Box Icons</a></li>
        </ul>
      </li>
      <li>
        <a href="#">
          <i class='bx bx-compass'></i>
          <span class="link_name">Explore</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="#">Explore</a></li>
        </ul>
      </li>
      <li>
        <a href="#">
          <i class='bx bx-history'></i>
          <span class="link_name">History</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="#">History</a></li>
        </ul>
      </li>
      <li>
        <a href="#">
          <i class='bx bx-cog'></i>
          <span class="link_name">Setting</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="#">Setting</a></li>
        </ul>
      </li> -->
      <li>
        <div class="profile-details">
          <div class="profile-content">
            <i class="fa-regular fa-user"></i>
          </div>
          <div class="name-job">
            <div class="profile_name">ADMIN</div>
            <div class="job">admin</div>
          </div>
          <a href="logout.php?logout='1'"> <i class='bx bx-log-out'></i>
          </a>
        </div>
      </li>
    </ul>
  </div>
  <section class="home-section">
    <!-- Modal try -->
    <section class="modal hidden">
      <div class="flex">
        <button class="btn-close">⨉</button>
      </div>
      <div>
        <h1>Add <span class="h1-2">Product</span> </h1>
        <form method="post" action="sidepanel.php">
          <?php include ('errors.php'); ?>
          <div class="input-group">
            <label>Product Code</label>
            <input type="text" name="productCode" value="<?php echo $productCode; ?>">
          </div>
          <div class="input-group">
            <label>Category</label>
            <input type="name" name="category" value="<?php echo $category; ?>">
          </div>
          <div class="input-group">
            <label>Product Name</label>
            <input type="name" name="productName" value="<?php echo $productName; ?>">
          </div>
          <div class="input-group">
            <label>Product Quantity</label>
            <input type="name" name="productQuantity" value="<?php echo $productQuantity; ?>">
          </div>
          <div class="input-group">
            <label>Product Amount</label>
            <input type="name" name="productAmount" value="<?php echo $productAmount; ?>">
          </div>
          <div class="input-group">
            <label for="expirationDate">Expiration Date</label>
            <input type="date" name="expirationDate" value="<?php echo $expirationDate; ?>">
          </div>
          <div class="input-group">
            <button type="submit" class="btn" name="add_product">Add</button>
          </div>
        </form>
      </div>
    </section>
    <div class="overlay hidden"></div>
    <div class="home-content">
      <i class='bx bx-menu'></i>
      <span class="text">INVENTORY <span class="text2">SYSTEM</span></span>
      <div id="datetime"></div>
    </div>
    <div class="table-container">
      <table class="table">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Product Code</th>
            <th scope="col">Category</th>
            <th scope="col">Name</th>
            <th scope="col">Quantity</th>
            <th scope="col">Amount</th>
            <th scope="col">Expiration Date</th>
            <th class="th-action" scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $sql = "SELECT * FROM `products`";
          $result = mysqli_query($db, $sql);
          if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
              $id = $row['id'];
              $productCode = $row['productCode'];
              $category = $row['category'];
              $productName = $row['productName'];
              $productQuantity = $row['productQuantity'];
              $productAmount = $row['productAmount'];
              $expirationDate = $row['expirationDate'];
              echo '<tr>
            <td scope="row">' . $id . '</td>
            <td>' . $productCode . '</td>
            <td>' . $category . '</td>
            <td>' . $productName . '</td>
            <td>' . $productQuantity . '</td>
            <td>' . $productAmount . '</td>
            <td>' . $expirationDate . '</td>
            <td class="td-action">
                <a href="edit-product.php? edit-product=' . $productCode . '"> <button id="edit-btn" ><i class="fa-solid fa-pen-to-square"></i></button></a></i>
                <a href="sidepanel.php? deleteproductCode=' . $productCode . '"><button id="delete-btn"><i class="fa-solid fa-trash"></i></button></a></i>
            </td>';
            }
          }
          ?>
        </tbody>
      </table>
    </div>
  </section>
  <div class="one"></div>
  <!-- right side sidebar -->
  <div class="sidenav">
    <button class="btn3 btn-open"><i class="fa-solid fa-plus" style="font-size: 30px; margin-right: 20px;"></i></button>
    <div class="search-container">
      <input class="search expandright" id="myInput" onkeyup="myFunction()" type="search" name="q" placeholder="Search here">
      <label class="button searchbutton" for="myInput"><i class="fa-solid fa-magnifying-glass"></i></label>
    </div>
  </div>
  <script>
    // Function to update date and time
    function updateDateTime() {
      // Get current date and time
      var now = new Date();
      var datetime = now.toLocaleString();
      // Insert date and time into HTML
      document.getElementById("datetime").innerHTML = datetime;
    }
    // Call the function initially
    updateDateTime();
    // Update date and time every second (1000 milliseconds)
    setInterval(updateDateTime, 1000);
  </script>
  <script>
    let arrow = document.querySelectorAll(".arrow");
    for (var i = 0; i < arrow.length; i++) {
      arrow[i].addEventListener("click", (e) => {
        let arrowParent = e.target.parentElement.parentElement; //selecting main parent of arrow
        arrowParent.classList.toggle("showMenu");
      });
    }
    let sidebar = document.querySelector(".sidebar");
    let sidebarBtn = document.querySelector(".bx-menu");
    console.log(sidebarBtn);
    sidebarBtn.addEventListener("click", () => {
      sidebar.classList.toggle("close");
    });
  </script>
  <!-- modal script -->
  <script>
    const modal = document.querySelector(".modal");
    const overlay = document.querySelector(".overlay");
    const openModalBtn = document.querySelector(".btn-open");
    const closeModalBtn = document.querySelector(".btn-close");
    // close modal function
    const closeModal = function () {
      modal.classList.add("hidden");
      overlay.classList.add("hidden");
    };
    // close the modal   when the close button and overlay is clicked
    closeModalBtn.addEventListener("click", closeModal);
    overlay.addEventListener("click", closeModal);
    // close modal when the Esc key is pressed
    document.addEventListener("keydown", function (e) {
      if (e.key === "Escape" && !modal.classList.contains("hidden")) {
        closeModal();
      }
    });
    // open modal function
    const openModal = function () {
      modal.classList.remove("hidden");
      overlay.classList.remove("hidden");
    };
    // open modal event
    openModalBtn.addEventListener("click", openModal);
  </script>
  <!-- script for searchbar for table -->
 <!-- script for searchbar for table -->
<script>
  function myFunction() {
    var term = document.getElementById("myInput").value.toLowerCase();
    var rows = document.querySelectorAll(".table tbody tr");
    rows.forEach(function(row) {
      var displayStyle = row.textContent.toLowerCase().includes(term) ? "" : "none";
      row.style.display = displayStyle;
    });
  }
</script>

  <!-- my icon kit -->
  <script src="https://kit.fontawesome.com/972dc181b8.js" crossorigin="anonymous"></script>
</body>

</html>
