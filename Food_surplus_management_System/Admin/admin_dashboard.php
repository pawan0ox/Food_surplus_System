<?php
session_start();

// Check if the admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php");
    exit;
}

// Database connection
$conn = new mysqli("localhost", "root", "", "surplus_food_management");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all donations along with donor details
$sql = "SELECT donations.*, donors.name AS donor_name, donors.contact AS donor_contact 
        FROM donations 
        JOIN donors ON donations.donor_id = donors.id
        ORDER BY donations.created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Welcome, Admin!</h1>
    <p>This is your dashboard. Below are the food items donated by users:</p>

    <div>
        <a href="user_register.php" class="btn btn-primary mt-3">Register User</a>
        <a href="track_donation.php" class="btn btn-primary mt-3">track donation</a>
    </div>

    <h3 class="mt-4">Food Donations</h3>
    <div id="foodItemsList" class="list-group">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="list-group-item">';
                echo '<h5 class="mb-1">Food Type: ' . htmlspecialchars($row['food_type']) . '</h5>';
                echo '<p class="mb-1">Quantity: ' . htmlspecialchars($row['quantity']) . ' units</p>';
                echo '<small>Donor: ' . htmlspecialchars($row['donor_name']) . ' | Contact: ' . htmlspecialchars($row['donor_contact']) . '</small>';
                echo '<p>Status: ' . htmlspecialchars($row['status']) . '</p>';
                echo '<a href="assign_to_recipient.php?donation_id=' . $row['id'] . '" class="btn btn-success btn-sm">Mark as Fulfilled</a>';


                echo '</div>';
            }
        } else {
            echo '<p class="text-danger">No donations available at the moment.</p>';
        }
        ?>
    </div>

    <a href="logout.php" class="btn btn-danger mt-3">Logout</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
