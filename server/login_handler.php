<?php
include 'db_connect.php'; // Ensure this file contains the connection to your database
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$email = $_POST['Email'];
$phoneNumber = $_POST['PhoneNumber'];

// Close connection before redirecting
$conn->close();

// Redirect to table.php with email and phone number as URL parameters
header("Location: ../client/table.php?email=" . urlencode($email) . "&phoneNumber=" . urlencode($phoneNumber));
exit;

