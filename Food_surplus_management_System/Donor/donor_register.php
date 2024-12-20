<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "surplus_food_management");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle registration form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['contact'];
    $address = $_POST['address'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];

    // Check if email already exists
    $check_email = $conn->query("SELECT * FROM donors WHERE email = '$email'");
    if ($check_email->num_rows > 0) {
        $error_message = "Email already registered. Please log in.";
    } else {
        // Insert donor details including location
        $sql = "INSERT INTO donors (name, email, contact, address, password, latitude, longitude) 
                VALUES ('$name', '$email', '$phone', '$address', '$password', '$latitude', '$longitude')";
        if ($conn->query($sql) === TRUE) {
            $success_message = "Registration successful! You can now log in.";
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
    <h2 class="text-center">Donor Registration</h2>
    <?php if (isset($error_message)): ?>
        <div class="alert alert-danger"><?= $error_message; ?></div>
    <?php elseif (isset($success_message)): ?>
        <div class="alert alert-success"><?= $success_message; ?></div>
    <?php endif; ?>
    <form method="POST" action="">
        <div class="mb-3">
            <label for="name" class="form-label">Full Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="contact" class="form-label">Contact</label>
            <input type="text" class="form-control" id="contact" name="contact" required>
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="mb-3">
            <label for="location" class="form-label">Location</label>
            <button type="button" class="btn btn-secondary" id="getLocationButton">Get My Location</button>
            <input type="hidden" id="latitude" name="latitude">
            <input type="hidden" id="longitude" name="longitude">
        </div>
        <button type="submit" class="btn btn-primary w-100">Register</button>
    </form>
    <h1></h1>
    <a href="donor_login.php" class="btn btn-primary w-100">Login</a>
</div>

<script>
    // Get the user's location using the geolocation API
    document.getElementById('getLocationButton').addEventListener('click', function() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var latitude = position.coords.latitude;
                var longitude = position.coords.longitude;

                // Fill the hidden fields with the location data
                document.getElementById('latitude').value = latitude;
                document.getElementById('longitude').value = longitude;
                alert("Location fetched: Latitude " + latitude + " Longitude " + longitude);
            }, function(error) {
                alert("Error: " + error.message);
            });
        } else {
            alert("Geolocation is not supported by this browser.");
        }
    });
</script>

</body>
</html>
