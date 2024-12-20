<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "surplus_food_management");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle registration form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];

    // Check if the ID already exists in the recipients table
    $check_user = $conn->query("SELECT * FROM recipients WHERE id = '$id'");
    if ($check_user->num_rows > 0) {
        $error_message = "Data already inserted.";
    } else {
        // Insert new recipient details into the database
        $sql = "INSERT INTO recipients (id, name) VALUES ('$id', '$name')";
        if ($conn->query($sql) === TRUE) {
            $success_message = "Registration successful! You can now proceed.";
        } else {
            $error_message = "Error: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donor Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center">User Registration</h2>

    <!-- Display messages -->
    <?php if (isset($error_message)): ?>
        <div class="alert alert-danger"><?= $error_message; ?></div>
    <?php elseif (isset($success_message)): ?>
        <div class="alert alert-success"><?= $success_message; ?></div>
    <?php endif; ?>

    <!-- Registration Form -->
    <form method="POST" action="">
        <div class="mb-3">
            <label for="id" class="form-label">ID</label>
            <input type="number" class="form-control" id="id" name="id" required>
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Full Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary w-100">Register</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
