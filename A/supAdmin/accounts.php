<?php
 require 'ads/cons.php';
require_once 'nav.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="SuA.css">
    <title>accounts</title>
</head>
<body>

 <a href="salesadd.php" id="add"  class="btn btn-outline-primary">Add Test <i class="bi bi-plus-square-dotted"></i></a>
<a href="#" id="add"  class="btn btn-outline-primary">Export to Excel <i class="bi bi-arrow-down-circle"></i></a>
    
<div class="box1" > 
<table class="table table-hover">

<thead>
<tr>
    <th>ID <a href="#"><i class="bi bi-arrow-up-short"></i></a> <a href="#"><i class="bi bi-arrow-down-short"></i></a><th>
    <th>Name <a href="#"><i class="bi bi-arrow-up-short"></i></a> <a href="#"><i class="bi bi-arrow-down-short"></i></a></th>
    <th>Password <a href="#"><i class="bi bi-arrow-up-short"></i></a> <a href="#"><i class="bi bi-arrow-down-short"></i></a></th>
    <th>Address <a href="#"><i class="bi bi-arrow-up-short"></i></a> <a href="#"><i class="bi bi-arrow-down-short"></i></a></th>
    <th>Contact <a href="#"><i class="bi bi-arrow-up-short"></i></a> <a href="#"><i class="bi bi-arrow-down-short"></i></a></th>
    <th>action</th>
    
</tr>
</thead>
<tbody>
    <?php
$sql = "select * from accounts;";
$view_accounts = mysqli_query($conn,$sql);
while ($row = mysqli_fetch_assoc($view_accounts)){
    $user_id = $row['user_id'];
    $username = $row['username'];
    $password = $row['password'];
    $address = $row['address'];
    $contact = $row['contact'];

  echo "<tr>";
  echo "<td>{$user_id}</td>";
  echo "<td>{$username}</td>";
  echo "<td>{$password}</td>";
  echo "<td>{$address}</td>";
  echo "<td>{$contact}</td>";
  echo "<td><a href='#'><i class='bi bi-arrow-repeat'></i></a> <a href='#'><i class='bi bi-x-square'></i></a> </td>";
  echo"</tr>";
}
    ?>
</tbody>
</table>
</div>




</body>
</html>