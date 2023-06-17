<?php
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

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the form data
    $product_id = $_POST["productId"];
    $product_name = $_POST["productName"];
    $quantity = $_POST["quantity"];
    $description = $_POST["description"];

    // Validate unique product_id
    $sql = "SELECT * FROM inventory WHERE product_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // product_id already exists, display an error message
        echo "Error: product_id already exists. Please choose a different product_id.";
    } else {
        // Validate unique product_name
        $sql = "SELECT * FROM inventory WHERE product_name = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $product_name);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // product_name already exists, display an error message
            echo "Error: product_name already exists. Please choose a different product_name.";
        } else {
            // Insert the data into the database
            $sql = "INSERT INTO inventory (product_id, product_name, quantity, description) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("isss", $product_id, $product_name, $quantity, $description);
            $stmt->execute();

            // Check if the query was successful
            if ($stmt->affected_rows > 0) {
                header("Location: add_Inventory.php");
                exit();
                // Display success message
                echo "New inventory record created successfully";
            } else {
                echo "Error: " . $stmt->error;
            }
        }
    }   

    // Close the statement
    $stmt->close();
}

// Close the connection
$conn->close();
?>
