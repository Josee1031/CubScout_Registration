<?php
include 'db_connect.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Start transaction
$conn->begin_transaction();

try {
    // Set parameters from form data
    $userId = isset($_POST['userId']) ? intval($_POST['userId']) : 0;
    $firstName = $_POST['FirstName'];
    $lastName = $_POST['LastName'];
    $email = $_POST['Email'];
    $phoneNumber = $_POST['PhoneNumber'];
    $numberOfAdults = intval($_POST['NumberOfAdults']);
    $numberOfChildren = intval($_POST['NumberOfChildren']);
    $event = $_POST['EventName'];
    $day = $_POST['Week_day'];

    if ($userId > 0) {
        // Update existing user
        $stmt1 = $conn->prepare("UPDATE Users SET FirstName = ?, LastName = ?, Email = ?, PhoneNumber = ? WHERE userId = ?");
        $stmt1->bind_param("ssssi", $firstName, $lastName, $email, $phoneNumber, $userId);
        $stmt1->execute();
        $stmt1->close();

        // Update existing registration
        $stmt2 = $conn->prepare("UPDATE Registrations SET NumberOfAdults = ?, NumberOfChildren = ?, Week_day = ?, EventName = ? WHERE userId = ?");
        $stmt2->bind_param("iissi", $numberOfAdults, $numberOfChildren, $day, $event, $userId);
        $stmt2->execute();
        $stmt2->close();
    } else {
        // Insert into Users table
        $stmt1 = $conn->prepare("INSERT INTO Users (FirstName, LastName, Email, PhoneNumber) VALUES (?, ?, ?, ?)");
        $stmt1->bind_param("ssss", $firstName, $lastName, $email, $phoneNumber);
        $stmt1->execute();
        $userId = $conn->insert_id; // Get the last inserted userId
        $stmt1->close();

        // Check if the event already exists
        $stmt3 = $conn->prepare("SELECT EventName FROM Events WHERE EventName = ?");
        $stmt3->bind_param("s", $event);
        $stmt3->execute();
        $stmt3->bind_result($existingEvent);
        $stmt3->fetch();
        $stmt3->close();

        // If the event does not exist, insert it
        if (!$existingEvent) {
            $stmt3 = $conn->prepare("INSERT INTO Events (EventName) VALUES (?)");
            $stmt3->bind_param("s", $event);
            $stmt3->execute();
            $stmt3->close();
        }

        // Insert into Registrations table with the EventName
        $stmt2 = $conn->prepare("INSERT INTO Registrations (NumberOfAdults, NumberOfChildren, Week_day, EventName, userId) VALUES (?, ?, ?, ?, ?)");
        $stmt2->bind_param("iissi", $numberOfAdults, $numberOfChildren, $day, $event, $userId);
        $stmt2->execute();
        $stmt2->close();
    }

    // If everything is fine, commit the transaction
    $conn->commit();

    // Redirect to table.php with userId
    header("Location: ../client/table.php?email=" . urlencode($email) . "&phoneNumber=" . urlencode($phoneNumber));
    exit;

} catch (Exception $e) {
    // An error occurred, rollback the transaction
    $conn->rollback();
    echo "Error: " . $e->getMessage();
}

// Close connection
$conn->close();
?>
