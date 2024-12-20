<?php
session_start();
$conn = new mysqli("localhost", "root", "", "surplus_food_management");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle login form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $result = $conn->query("SELECT * FROM donors WHERE email = '$email'");
    if ($result->num_rows === 1) {
        $donor = $result->fetch_assoc();
        if (password_verify($password, $donor['password'])) {
            // Set session and redirect
            $_SESSION['donor_id'] = $donor['id'];
            header("Location: donor_dashboard.php");
            exit;
        } else {
            $error_message = "Invalid password!";
        }
    } else {
        $error_message = "No account found with that email!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donor Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center">Donor Login</h2>
    <?php if (isset($error_message)): ?>
        <div class="alert alert-danger"><?= $error_message; ?></div>
    <?php endif; ?>
    <form method="POST" action="">
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Login</button>
    </form>
    <h1></h1>
    <a href="../Homepage.php" class="btn btn-danger mb-3 w-100">Back</a>
</div>
</body>
</html>
