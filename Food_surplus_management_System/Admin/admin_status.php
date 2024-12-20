<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "surplus_food_management");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the donation ID is provided
if (isset($_GET['id'])) {
    $donation_id = $_GET['id'];

    // Update the status of the donation
    $sql = "UPDATE donations SET status = 'Fulfilled' WHERE id = $donation_id";
    if ($conn->query($sql) === TRUE) {
        header("Location: admin_dashboard.php"); // Redirect to the admin dashboard after updating
        exit;
    } else {
        echo "Error updating record: " . $conn->error;
    }
} else {
    echo "Invalid donation ID.";
}

// Close the database connection
$conn->close();
?>
