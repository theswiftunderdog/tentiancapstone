<?php
    // Start the session.
    session_start();
    if (!isset($_SESSION['user'])) {
        header('location: login.php');
        exit;
    }

    $user = $_SESSION['user'];

    include('../Connection/Connection.php');

    // Retrieve order details for the logged-in user from the database
    $sql = "SELECT order_id, order_name, full_name, date_created, quantity, status FROM orders";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../admin/files/admin.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&family=Roboto+Condensed&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&family=Titillium+Web&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css"/>
</head>
<body>
    <?php include ('../admin/adminsidebar.php') ?>

    <div class="container">   
        <div class="box1">
            <h1>Customer's Order</h1>
        </div>

        <div class="order-table">
            <table class="tables">
                <thead>
                    <tr>
                        <th scope="col">Order ID</th>
                        <th scope="col">Customer Name</th>
                        <th scope="col">Order Name</th>
                        <th scope="col">Order Date</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $order): ?>
                        <tr>
                        <td><?= $order['order_id']; ?></td>
                            <td><?= $order['full_name']; ?></td>
                            <td><?= $order['order_name']; ?></td>
                            <td><?= $order['date_created']; ?></td>
                            <td><?= $order['quantity']; ?></td>
                            <td><?= $order['status']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>    
        </div>
    </div>

    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>
</html>