<?php
session_start();
if (!isset($_SESSION['donor_id'])) {
    header("Location: donor_login.php");
    exit;
}

$conn = new mysqli("localhost", "root", "", "surplus_food_management");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch donor info and donations
$donor_id = $_SESSION['donor_id'];
$donor = $conn->query("SELECT * FROM donors WHERE id = $donor_id")->fetch_assoc();
$donations = $conn->query("SELECT * FROM donations WHERE donor_id = $donor_id");

// Handle new donation submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $food_type = $_POST['food_type'];
    $quantity = $_POST['quantity'];
    $pickup_address = $_POST['pickup_address'];

    $conn->query("INSERT INTO donations (donor_id, food_type, quantity, pickup_address, status) 
                  VALUES ($donor_id, '$food_type', '$quantity', '$pickup_address', 'Pending')");
    header("Refresh:0"); // Reload page to show updated list
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donor Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Welcome, <?= htmlspecialchars($donor['name']); ?>!</h2>

    <h3>Your Donations</h3>
    <ul class="list-group mb-4">
        <?php while ($donation = $donations->fetch_assoc()): ?>
            <li class="list-group-item">
                <?= htmlspecialchars($donation['food_type']); ?> - <?= htmlspecialchars($donation['quantity']); ?> units
                (<?= htmlspecialchars($donation['status']); ?>)
            </li>
        <?php endwhile; ?>
    </ul>

    <h3>Submit New Donation</h3>
    <form method="POST" action="">
        <div class="mb-3">
            <label for="food_type" class="form-label">Food Type</label>
            <input type="text" class="form-control" id="food_type" name="food_type" required>
        </div>
        <div class="mb-3">
            <label for="quantity" class="form-label">Quantity</label>
            <input type="number" class="form-control" id="quantity" name="quantity" required>
        </div>
        <div class="mb-3">
            <label for="pickup_address" class="form-label">Pickup Address</label>
            <textarea class="form-control" id="pickup_address" name="pickup_address" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary w-100">Submit Donation</button>
    </form>
<h1>        </h1>
    <a href="logout.php" class="btn btn-danger mb-3">Logout</a>
</div>
</body>
</html>
