<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "surplus_food_management");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $recipient_id = $_POST['recipient_id'];
    $food_type = $_POST['food_type'];
    $quantity = $_POST['quantity'];
    $delivery_address = $_POST['delivery_address'];

    // Insert request into database
    $sql = "INSERT INTO user_requests (recipient_id, food_type, quantity, delivery_address) 
            VALUES ('$recipient_id', '$food_type', '$quantity', '$delivery_address')";
    if ($conn->query($sql) === TRUE) {
        $success_message = "Request submitted successfully!";
    } else {
        $error_message = "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipient Request</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center">Recipient Request</h2>

    <!-- Display messages -->
    <?php if (isset($error_message)): ?>
        <div class="alert alert-danger"><?= $error_message; ?></div>
    <?php elseif (isset($success_message)): ?>
        <div class="alert alert-success"><?= $success_message; ?></div>
    <?php endif; ?>

    <!-- Request Form -->
    <form method="POST" action="">
        <div class="mb-3">
            <label for="recipient_id" class="form-label">Recipient ID</label>
            <input type="number" class="form-control" id="recipient_id" name="recipient_id" required>
        </div>
        <div class="mb-3">
            <label for="food_type" class="form-label">Food Type</label>
            <input type="text" class="form-control" id="food_type" name="food_type" required>
        </div>
        <div class="mb-3">
            <label for="quantity" class="form-label">Quantity</label>
            <input type="number" class="form-control" id="quantity" name="quantity" required>
        </div>
        <div class="mb-3">
            <label for="delivery_address" class="form-label">Delivery Address</label>
            <textarea class="form-control" id="delivery_address" name="delivery_address" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary w-100">Submit Request</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
