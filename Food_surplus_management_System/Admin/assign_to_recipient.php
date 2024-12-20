<?php
session_start();

// Check if the admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php");
    exit;
}

// Check if the donation_id is passed in the URL
if (isset($_GET['donation_id'])) {
    $donation_id = $_GET['donation_id'];

    // Database connection
    $conn = new mysqli("localhost", "root", "", "surplus_food_management");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch the donation details
    $donation_query = "SELECT * FROM donations WHERE id = '$donation_id'";
    $donation_result = $conn->query($donation_query);

    if ($donation_result->num_rows > 0) {
        $donation = $donation_result->fetch_assoc();
    } else {
        echo "Donation not found.";
        exit;
    }

    // Check if the form is submitted to assign the donation
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $recipient_id = $_POST['recipient_id'];

        // Update the donation with the recipient_id and change its status to 'Assigned'
        $update_query = "UPDATE donations SET recipient_id = '$recipient_id', status = 'Assigned' WHERE id = '$donation_id'";

        if ($conn->query($update_query) === TRUE) {
            echo "Donation has been assigned to the recipient!";
            header("Refresh: 2; url=admin_dashboard.php");  // Redirect to admin dashboard after 2 seconds
        } else {
            echo "Error: " . $conn->error;
        }
    }
} else {
    echo "Donation ID is missing.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assign Donation to Recipient</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Assign Donation to Recipient</h2>

    <h4>Donation Details</h4>
    <ul class="list-group mb-4">
        <li class="list-group-item">
            <strong>Food Type:</strong> <?= htmlspecialchars($donation['food_type']); ?>
        </li>
        <li class="list-group-item">
            <strong>Quantity:</strong> <?= htmlspecialchars($donation['quantity']); ?>
        </li>
        <li class="list-group-item">
            <strong>Pickup Address:</strong> <?= htmlspecialchars($donation['pickup_address']); ?>
        </li>
    </ul>

    <h4>Assign to Recipient</h4>
    <form method="POST" action="">
        <div class="mb-3">
            <label for="recipient_id" class="form-label">Recipient ID</label>
            <input type="number" class="form-control" id="recipient_id" name="recipient_id" required>
        </div>
        <button type="submit" class="btn btn-primary">Assign Donation</button>
    </form>

    <a href="admin_dashboard.php" class="btn btn-secondary mt-3">Back to Dashboard</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
