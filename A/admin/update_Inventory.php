<?php
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

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $productId = $_POST['product_id'];
    $quantity = $_POST['quantity'];
    $description = $_POST['description'];

    $stmt = $conn->prepare("UPDATE inventory SET quantity = ?, description = ? WHERE product_id = ?");
    $stmt->bind_param("isi", $quantity, $description, $productId);
    $stmt->execute();

    if ($stmt->error) {
        echo "Error updating inventory: " . $stmt->error;
    } else {
        header('location: update_Inventory.php');
        exit;
    }
}

// Pagination
$limit = 5; // Number of records to show per page
$page = isset($_GET['page']) ? $_GET['page'] : 1; // Get the current page from the URL
$start = ($page - 1) * $limit; // Calculate the starting index for the query

$sql = "SELECT product_id, product_name, quantity, description FROM inventory LIMIT $start, $limit";
$result = $conn->query($sql);

// Count total number of records in the table
$total = $conn->query("SELECT COUNT(*) AS count FROM inventory")->fetch_assoc()['count'];
$pages = ceil($total / $limit); // Calculate the total number of pages
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
<?php include('../admin/adminsidebar.php') ?>

<div class="main-content">
<div class="updateI"><h1>Update Inventory</h1></div>
<div class="updateI-table" data-aos="fade-up"> 
    <table>
        <tr>
            <th>Product ID</th>
            <th>Product Name</th>
            <th>Quantity</th>
            <th>Description</th>
            <th>Action</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["product_id"] . "</td>";
                echo "<td>" . $row["product_name"] . "</td>";
                echo "<td>
                        <form method='POST' action=''>
                            <input type='hidden' name='product_id' value='" . $row["product_id"] . "'>
                            <input type='number' name='quantity' value='" . $row["quantity"] . "'>
                        </td>";
                echo "<td><textarea name='description'>" . $row["description"] . "</textarea></td>";
                echo "<td>
                        <button type='submit' name='update'>Update</button>
                      </td>";
                echo "</form>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No inventory records found</td></tr>";
        }
        ?>
    </table>
    </div>    
    
    <!-- Pagination links -->
    <div class="pagination">
        <?php for ($i = 1; $i <= $pages; $i++) : ?>
            <a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
        <?php endfor; ?>
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
