<?php
require 'nav.php';

    $servername = "localhost";
    $username = 'root';
    $password = '';
    $dbname = "tentian";

    // Create a new connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Set the number of records per page
    $recordsPerPage = 5;

    // Get the current page number
    $currentPage = isset($_GET['page']) ? intval($_GET['page']) : 1;

    // Calculate the offset for the SQL query
    $offset = ($currentPage - 1) * $recordsPerPage;
    
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="SuA.css">
    <title>orders</title>
</head>
<body>

 <a href="salesadd.php" id="add"  class="btn btn-outline-primary">Add Test <i class="bi bi-plus-square-dotted"></i></a>
<a href="#" id="add"  class="btn btn-outline-primary">Export to Excel <i class="bi bi-arrow-down-circle"></i></a>
<div class="box1">
<table class="table">
<thead>
<tr>
  
    <th id="sort">Order ID <form method="POST" action="orders.php" ><button type="submit" name="idasd"><i class="bi bi-arrow-up-short"></i></button></form>
    <form method="POST" action="orders.php"><button type="submit" name="iddesc"><i class="bi bi-arrow-down-short"></i></button></form>
    </th>
   <!-- <th>Customer Name </th>  -->  
    <th id="sort">Order Name <form method="POST" action="orders.php" ><button type="submit" name="nameasd"><i class="bi bi-arrow-up-short"></i></button></form>
    <form method="POST" action="orders.php"><button type="submit" name="namedesc"><i class="bi bi-arrow-down-short"></i></button></form></th>
   
    <th id="sort">Order date <form method="POST" action="orders.php" ><button type="submit" name="dateasd"><i class="bi bi-arrow-up-short"></i></button></form>
    <form method="POST" action="orders.php"><button type="submit" name="datedesc"><i class="bi bi-arrow-down-short"></i></button></form></th>
    
    <th id="sort">Quantity <form method="POST" action="orders.php" ><button type="submit" name="qtyasd"><i class="bi bi-arrow-up-short"></i></button></form>
    <form method="POST" action="orders.php"><button type="submit" name="qtydesc"><i class="bi bi-arrow-down-short"></i></button></form></th>
   
    <th id="sort">Status <form method="POST" action="orders.php" ><button type="submit" name="statasd"><i class="bi bi-arrow-up-short"></i></button></form>
    <form method="POST" action="orders.php"><button type="submit" name="statdesc"><i class="bi bi-arrow-down-short"></i></button></form></th>
    
</tr>

</thead>
<tbody>
<?php

  $sort_option ="";
  $sort ="order_id";

      if(isset($_POST['idasd'])){
        $sort_option = "ASC";
        $sort ="order_id";

      }
      if(isset($_POST['iddesc'])){
        $sort_option = "DESC";
        $sort ="order_id";

      }
      if(isset($_POST['nameasd'])){
        $sort_option = "ASC";
        $sort = "order_name";
      }
      if(isset($_POST['namedesc'])){
        $sort_option = "DESC";
        $sort = "order_name";
      }
      if(isset($_POST['qtyasd'])){
        $sort_option = "ASC";
        $sort = "qty";
      }
      if(isset($_POST['qtydesc'])){
        $sort_option = "DESC";
        $sort = "qty";
      }
      if(isset($_POST['statasd'])){
        $sort_option = "ASC";
        $sort = "status";
      }
      if(isset($_POST['statdesc'])){
        $sort_option = "DESC";
        $sort = "status";
      }

  
  $sql = "SELECT * FROM orders ORDER BY $sort $sort_option;";
  $show = $conn->query($sql);
    if(mysqli_num_rows($show)>0)
    {
      foreach($show as $row){
          ?>
  <tr>
    <td><?= $row['order_id']; ?></td>
    <td><?= $row['order_name']; ?></td>
    <td><?= $row['datetime']; ?></td>
    <td><?= $row['qty']; ?></td>
    <td><?= $row['status']; ?></td>
  </tr>
          <?php
      }
    }else{

    }
    ?>


</tbody>
</table>
</div>

<?php
        // Retrieve the total number of records
        $totalRecords = $conn->query("SELECT COUNT(*) AS total FROM customer")->fetch_assoc()['total'];

        // Calculate the total number of pages
        $totalPages = ceil($totalRecords / $recordsPerPage);
        ?>

        <div class="pagination">
            <?php
            for ($i = 1; $i <= $totalPages; $i++) {
                $activeClass = ($i === $currentPage) ? "active" : "";
                echo "<a class='$activeClass' href='show_customer.php?page=$i'>$i</a>";
            }
            ?>

</body>
</html>