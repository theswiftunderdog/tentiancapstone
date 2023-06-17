<?php
    // Start the session.
    session_start();
    if (!isset($_SESSION['user'])) {
        header('location: login.php');
        exit;
    }

    $user = $_SESSION['user'];

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
    $recordsPerPage = 10;

    // Get the current page number
    $currentPage = isset($_GET['page']) ? intval($_GET['page']) : 1;

    // Calculate the offset for the SQL query
    $offset = ($currentPage - 1) * $recordsPerPage;

    // Retrieve inventory data from the database with pagination
    $sql = "SELECT product_id, product_name, quantity, description FROM inventory LIMIT $offset, $recordsPerPage";
    $result = $conn->query($sql);
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

<!-- ITO NA YUNG PANG CONTENT -->
<body>
    <?php include ('../admin/adminsidebar.php')?>

    <div class="main-content">
    <div class="showI"><h1>Show Inventory</h1></div>
    <div class="showI-table" data-aos="fade-up">
        <table>
            <thead>
                <tr>
                    <th>Product ID</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["product_id"] . "</td>";
                        echo "<td>" . $row["product_name"] . "</td>";
                        echo "<td>" . $row["quantity"] . "</td>";
                        echo "<td>" . $row["description"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No inventory records found</td></tr>";
                }
                ?>
            </tbody>
        </table>
        </div> 

        <?php
        // Retrieve the total number of records
        $totalRecords = $conn->query("SELECT COUNT(*) AS total FROM inventory")->fetch_assoc()['total'];

        // Calculate the total number of pages
        $totalPages = ceil($totalRecords / $recordsPerPage);
        ?>

        <div class="pagination">
            <?php
            for ($i = 1; $i <= $totalPages; $i++) {
                $activeClass = ($i === $currentPage) ? "active" : "";
                echo "<a class='page-link $activeClass' href='show_inventory.php?page=$i'>$i</a>";
            }
            ?>
        </div>
        
    </div>
</body>
<script src="../admin/files/adminscript.js"></script>
  <script src="../admin/files/rotate.js"></script>
  <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script>
    AOS.init();
  </script>
</html>
