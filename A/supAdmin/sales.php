<?php
require 'nav.php';
require 'ads/cons.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="SuA.css">
    <title>sales</title>
</head>
<body>
 
 
 <a href="salesadd.php" id="add"  class="btn btn-outline-primary">Add Test <i class="bi bi-plus-square-dotted"></i></a>
<a href="#" id="add"  class="btn btn-outline-primary">Export to Excel <i class="bi bi-arrow-down-circle"></i></a>
 <!-- main -->
 <div class="table-responsive-sm">

      <div class="box1" > 
      
      <table class="table">
        <thead>
          <tr>
            <th>control number <a href="#"><i class="bi bi-arrow-up-short"></i></a> <a href="#"><i class="bi bi-arrow-down-short"></i></a></th>
            <th>order id <a href="#"><i class="bi bi-arrow-up-short"></i></a> <a href="#"><i class="bi bi-arrow-down-short"></i></a></th>
            <th>order name <a href="#"><i class="bi bi-arrow-up-short"></i></a> <a href="#"><i class="bi bi-arrow-down-short"></i></a></th>
            <th>quantity <a href="#"><i class="bi bi-arrow-up-short"></i></a> <a href="#"><i class="bi bi-arrow-down-short"></i></a></th>
            <th>Date & Time <a href="#"><i class="bi bi-arrow-up-short"></i></a> <a href="#"><i class="bi bi-arrow-down-short"></i></a></th>
            <th>Status <a href="#"><i class="bi bi-arrow-up-short"></i></a> <a href="#"><i class="bi bi-arrow-down-short"></i></a></th>
            <th>Description <a href="#"><i class="bi bi-arrow-up-short"></i></a> <a href="#"><i class="bi bi-arrow-down-short"></i></a></th>
            <th>action</th>
          </tr>
        </thead>
        <tbody>
    <?php

    #this is what you need to output result

    $sql ='select * from sales INNER JOIN orders ON control_number = order_id ;';
    $view_sales = mysqli_query($conn,$sql);
        while ($row = mysqli_fetch_assoc($view_sales)){
          $control_number = $row['control_number'];
          $order_id = $row['order_id'];
          $order_name = $row['order_name'];
          $qty = $row['qty'];
          $datetime = $row['datetime'];
          $status = $row['status'];
          $description = $row['description']; 
            
          echo"<tr>";
          echo"<td>{$control_number}</td>";
          echo"<td>{$order_id}</td>";
          echo"<td>{$order_name}</td>";
          echo"<td>{$qty}</td>";
          echo"<td>{$datetime}</td>";
          echo"<td>{$status}</td>";
          echo"<td>{$description}</td>";
          echo "<td><a href='#'><i class='bi bi-arrow-repeat'></i></a> </td>";
          echo"</tr>";
        }
    
    ?>

</tbody>
</table>    

      </div>
      </div>


      
<nav aria-label="Page navigation example">
  <ul class="pagination" id="pagelist">
    <li class="page-item"><a class="page-link" href="#"><<</a></li>
    <li class="page-item"><a class="page-link" href="#">1</a></li>
    <li class="page-item"><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
    <li class="page-item"><a class="page-link" href="#">>></a></li>
  </ul>
</nav>
  
</body>
</html>