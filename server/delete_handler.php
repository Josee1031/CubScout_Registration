<?php
include 'db_connect.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get registrationId from the URL
$registrationId = isset($_GET['registrationId']) ? intval($_GET['registrationId']) : 0;

// Get userId from the URL
$userId = isset($_GET['userId']) ? intval($_GET['userId']) : 0;

if ($registrationId > 0) {
    // Delete registration data
    $sql = "DELETE FROM Registrations WHERE registrationId = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $registrationId);
    $stmt->execute();
    $stmt->close();
}

// Redirect to the table page with the userId
header("Location: ../client/index.php");
$conn->close();

