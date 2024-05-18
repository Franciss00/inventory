
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Logout</title>
</head>

<body style="background-color: black;">
<?php
echo "<script>
if (confirm('Are you sure you want to logout?')) { 
   window.location='login.php'; 
}else{
   window.location='sidepanel.php';
}
</script>";
?>
</body>

</html>