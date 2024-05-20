<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
include '../server/db_connect.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get userId and registrationId from the URL
$userId = isset($_GET['userId']) ? intval($_GET['userId']) : 0;
$registrationId = isset($_GET['registrationId']) ? intval($_GET['registrationId']) : 0;

if ($userId > 0 && $registrationId > 0) {
    // Fetch existing user and registration data
    $sql = "
        SELECT u.userId, u.FirstName, u.LastName, u.Email, u.PhoneNumber, 
               r.NumberOfAdults, r.NumberOfChildren, r.Week_day, r.EventName
        FROM Users u
        LEFT JOIN Registrations r ON u.userId = r.userId
        WHERE r.RegistrationId = ? AND u.userId = ?
    ";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $registrationId, $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();
} else {
    die("Invalid userId or registrationId.");
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
body {
    background: linear-gradient(to top, #dfe9f3 0%, white 100%);
    min-height: 100vh;
}
</style>
<body class="background">
    <?php
    include 'components/nav.php'; // Ensure the path to the navbar file is correct
    renderNavbar();
    ?>
    <div class="container">
        <h1 class="text-center mt-4">Modifica tus Reservaciones</h1>

        <form class="mt-4 mb-4 form" method="post" action="../server/form_handler.php">
            <div class="input-group mb-3">
                <span class="input-group-text">Nombre</span>
                <input type="text" class="form-control" id="FirstName" name="FirstName" value="<?php echo safe_html($user['FirstName']); ?>" required>
            </div>

            <div class="input-group mt-3 mb-3">
                <span class="input-group-text">Apellido</span>
                <input type="text" class="form-control" id="LastName" name="LastName" value="<?php echo safe_html($user['LastName']); ?>" required>
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text">Email</span>
                <input type="email" class="form-control" id="Email" name="Email" value="<?php echo safe_html($user['Email']); ?>" required>
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text">Phone Number</span>
                <input type="tel" class="form-control" id="PhoneNumber" name="PhoneNumber" value="<?php echo safe_html($user['PhoneNumber']); ?>" required>
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text">Cantidad de Adultos</span>
                <input type="number" class="form-control" id="NumberOfAdults" name="NumberOfAdults" value="<?php echo safe_html($user['NumberOfAdults']); ?>" required>
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text">Cantidad de Niños</span>
                <input type="number" class="form-control" id="NumberOfChildren" name="NumberOfChildren" value="<?php echo safe_html($user['NumberOfChildren']); ?>" required>
            </div>

            <div class="input-group mb-3">
                <label class="input-group-text" for="EventName">Evento</label>
                <select class="form-select" id="EventName" name="EventName" required>
                    <option value="Baloncesto" <?php echo $user['EventName'] == 'Baloncesto' ? 'selected' : ''; ?>>Baloncesto</option>
                    <option value="Volleyball" <?php echo $user['EventName'] == 'Volleyball' ? 'selected' : ''; ?>>Volleyball</option>
                    <option value="Tennis" <?php echo $user['EventName'] == 'Tennis' ? 'selected' : ''; ?>>Tennis</option>
                </select>
            </div>

            <div class="input-group mb-3">
                <label class="input-group-text" for="Week_day">Day</label>
                <select class="form-select" id="Week_day" name="Week_day" required>
                    <option value="">Choose...</option>
                    <option value="Jueves" <?php echo $user['Week_day'] == 'Jueves' ? 'selected' : ''; ?>>Jueves</option>
                    <option value="Viernes" <?php echo $user['Week_day'] == 'Viernes' ? 'selected' : ''; ?>>Viernes</option>
                    <option value="Sabado" <?php echo $user['Week_day'] == 'Sabado' ? 'selected' : ''; ?>>Sabado</option>
                </select>
            </div>

            <input type="hidden" name="registrationId" value="<?php echo $registrationId; ?>">
            <input type="hidden" name="userId" value="<?php echo $user['userId']; ?>">
            <button class="btn btn-dark" type="submit">Submit</button>
            <button class="btn btn-danger" type="button" onclick="deleteReservation(<?php echo $registrationId; ?>, <?php echo $user['userId']; ?>)">Delete Reservation</button>
        </form>
    </div>

    <script>
        function deleteReservation(registrationId, userId) {
            if (confirm('Are you sure you want to delete this reservation?')) {
                window.location.href = '../server/delete_handler.php?registrationId=' + registrationId + '&userId=' + userId;
            }
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>

<?php
$conn->close();
?>
