<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('location: login.php');
    exit();
}

$user = $_SESSION['user'];

include('../Connection/Connection.php');

if (isset($_POST['create'])) {
    $orderType = $_POST['order_type'];
    $quantity = $_POST['quantity'];
    $full_name = $user['full_name'];
    $complete_address = $user['complete_address'];
    $dateCreated = date('Y-m-d H:i:s'); // Get current date and time

    // Insert the order into the orders table
    $query = 'INSERT INTO orders (order_name, quantity, full_name, complete_address, date_created) 
              VALUES (:orderName, :quantity, :fullName, :completeAddress, :dateCreated)';
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':orderName', $orderType);
    $stmt->bindParam(':quantity', $quantity);
    $stmt->bindParam(':fullName', $full_name);
    $stmt->bindParam(':completeAddress', $complete_address);
    $stmt->bindParam(':dateCreated', $dateCreated);
    $stmt->execute();

    // Increment the order_id by 1
    $orderId = $conn->lastInsertId();
    $orderId++;

    // Update the auto_increment value for order_id column
    $query = "ALTER TABLE orders AUTO_INCREMENT = $orderId";
    $stmt = $conn->prepare($query);
    $stmt->execute();
}
?>

<!-- Rest of the HTML code remains the same -->


<!DOCTYPE html>
<html>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
<link rel="stylesheet" href="../CSS/navstyle.css">
<link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css"/>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&family=Roboto+Condensed&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins&family=Titillium+Web&display=swap" rel="stylesheet">
<title>Place Order</title>
</head>
<body>
<?php include ('../customer/customerSidebar.php')?>
  

 


<div class="container">

  <div class="contact-form" data-aos="zoom-in" data-aos-duration="1000">
    <form action="placeOrder.php" method="POST">  
      <div class="form-group">
        <h3>Place Your Order</h3>
      </div>

      <div class="quansel">
    
       <select name="order_type" class="orderType">
        <option value>*Select Order Type*</option>
         <option value="Water Bottle">Water Bottle (Bote ng Tubig)</option>
         <option value="New Gallon">New Gallon (Bagong Basyo)</option>
         <option value="Gallon Refill">Gallon Refill (Refill ng Basyo)</option>
       </select>
      </div> 

      <div class="orderInputsContainer">
      <div class="form-border">
        <input placeholder="Quantity" name="quantity"  type="number">
      </div>
      </div>

      <div class="orderbutton">
        <button name="create">Submit</button>
      </div>

    </form>
  </div>

</div>

<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>

</body>
</html>

</html>
