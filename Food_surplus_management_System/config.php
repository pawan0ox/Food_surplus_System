<?php
$conn = mysqli_connect('localhost', 'root', '', 'surplus_food_management');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>