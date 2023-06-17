<?php
    // Start the session.
    session_start();
    if (!isset($_SESSION['user'])) {
        header('location: login.php');
        exit;
    }

    $user = $_SESSION['user'];

    include('../Connection/Connection.php');

    // Retrieve total inventory count from the database
    $sql = "SELECT COUNT(*) AS total_inventory FROM inventory";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $totalInventory = $row['total_inventory'];

    // Retrieve total customer count from the database
    $sql = "SELECT COUNT(*) AS total_customers FROM customer";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $totalCustomers = $row['total_customers'];

?>

<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../admin/files/admin.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css"/>
</head>
<body>
    <?php include('../admin/adminsidebar.php') ?>

    <div class="main-content">
        <h1 class="mb-4">Dashboard Control Panel</h1>
        <div class="row" data-aos="fade-up">
        
        
        <div class="bg-primary text-white p-4 rounded text-center" style="width: 180px">
            <h5 class="mb-0">Total Inventory</h5>
            <p class="h1 mb-0"><?php echo $totalInventory; ?></p>
        </div>
        
        <div class="bg-secondary text-white p-4 mx-4 rounded text-center" style="width: 195px">
            <h5 class="mb-0">Total Customers</h5>
            <p class="h1 mb-0"><?php echo $totalCustomers; ?></p>
        </div>
        </div>
    </div>

    <script src="../admin/files/adminscript.js"></script>
  <script src="../admin/files/rotate.js"></script>
  <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script>
    AOS.init();
  </script>
</body>
</html>
