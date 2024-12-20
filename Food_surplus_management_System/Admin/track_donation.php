<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "surplus_food_management");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// If a donor_id is provided via the form, get donor's details
if (isset($_POST['donor_id'])) {
    $donor_id = $_POST['donor_id'];

    // Query the donor's latitude and longitude from the database
    $result = $conn->query("SELECT * FROM donors WHERE id = '$donor_id'");

    if ($result->num_rows > 0) {
        $donor = $result->fetch_assoc();
        $latitude = $donor['latitude'];
        $longitude = $donor['longitude'];
    } else {
        $error_message = "No donor found with that ID.";
        $latitude = $longitude = null;
    }
} else {
    $latitude = $longitude = null;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Track Donation</title>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBIERrbV0T3iWUTS008bWL-Un30ya1MhCc&callback=initMap" async defer></script>
    <style>
        #map {
            height: 400px;
            width: 100%;
        }
    </style>
</head>
<body>
<h2>Track Donation</h2>

<form method="POST" action="track_donation.php">
    <label for="donor_id">Enter Donor ID:</label>
    <input type="text" name="donor_id" id="donor_id" required>
    <button type="submit">Track Location </button>
</form>

<!-- Display map if donor ID is valid and coordinates are available -->
<?php if ($latitude !== null && $longitude !== null): ?>
    <h3>Donor Location</h3>
    <div id="map"></div>
    <script>
        function initMap() {
            var donorLocation = { lat: <?php echo $latitude; ?>, lng: <?php echo $longitude; ?> };

            // Check if the coordinates are valid
            if (isNaN(donorLocation.lat) || isNaN(donorLocation.lng)) {
                alert("Invalid coordinates for the donor.");
                return;
            }

            // Create the map centered at the donor's location
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 14,
                center: donorLocation
            });

            // Place a marker at the donor's location
            var marker = new google.maps.Marker({
                position: donorLocation,
                map: map,
                title: "Donor Location"
            });
        }
    </script>
<?php elseif (isset($error_message)): ?>
    <p style="color: red;"><?php echo $error_message; ?></p>
<?php endif; ?>

</body>
</html>
