<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
include '../server/db_connect.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get email and phone number from the URL
$email = isset($_GET['email']) ? $_GET['email'] : '';
$phoneNumber = isset($_GET['phoneNumber']) ? $_GET['phoneNumber'] : '';

if (!empty($email) && !empty($phoneNumber)) {
    // Fetch user and registration data
    $sql = "
        SELECT u.userId, u.FirstName, u.LastName, u.Email, u.PhoneNumber,
               r.RegistrationId, r.NumberOfAdults, r.NumberOfChildren, r.Week_day, e.EventName
        FROM Users u
        LEFT JOIN Registrations r ON u.userId = r.userId
        LEFT JOIN Events e ON r.EventName = e.EventName
        WHERE u.Email = ? AND u.PhoneNumber = ?
    ";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $phoneNumber);
    $stmt->execute();
    $result = $stmt->get_result();
    $userData = [];
    while ($row = $result->fetch_assoc()) {
        if (!empty($row['RegistrationId'])) { // Only add rows with a RegistrationId
            $userData[] = $row;
        }
    }
    $stmt->close();
} else {
    die("Invalid email or phone number.");
}

function safe_html($value) {
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manada 82 Eventos</title>
    <link rel="icon" href="images/logo.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<style>
    .form {
        position: relative;
        z-index: 1;
        background: #FFFFFF;
        padding: 45px;
        text-align: center;
        box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
    }
    .background {
        background: linear-gradient(to top, #dfe9f3 0%, white 100%);
        min-height: 100vh;
    }
    .clickable-row {
        cursor: pointer;
    }
</style>
<body class="background">
<?php
include 'components/nav.php'; // Ensure the path to navbar.php is correct
renderNavbar();
?>

<div class="container mt-5">
    <h1 class="text-center mt-5">Registros</h1>
    <?php if (!empty($userData)): ?>
        <table class="table table-hover table-striped">
            <thead>
                <tr class="table-dark text-center">
                    <th>Registration ID</th>
                    <th>Number of Adults</th>
                    <th>Number of Children</th>
                    <th>Day</th>
                    <th>Event Name</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($userData as $user): ?>
                    <tr class="table-secondary text-center clickable-row" data-href="modify_appointment.php?registrationId=<?php echo safe_html($user['RegistrationId']); ?>&userId=<?php echo safe_html($user['userId']); ?>">
                        <td><?php echo safe_html($user['RegistrationId']); ?></td>
                        <td><?php echo safe_html($user['NumberOfAdults']); ?></td>
                        <td><?php echo safe_html($user['NumberOfChildren']); ?></td>
                        <td><?php echo safe_html($user['Week_day']); ?></td>
                        <td><?php echo safe_html($user['EventName']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No hay usuario con estas credenciales.</p>
    <?php endif; ?>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const rows = document.querySelectorAll('.clickable-row');
        rows.forEach(row => {
            row.addEventListener('click', () => {
                window.location.href = row.dataset.href;
            });
        });
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>

<?php
// Close connection
$conn->close();
?>
