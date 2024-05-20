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
include 'components/nav.php'; // Asegúrate de que la ruta al archivo navbar.php sea correcta
renderNavbar()
?>
<?php
include '../server/db_connect.php'
?>
<div class="container">
    <h1 class="text-center mt-4">Reserva tu Evento</h1>

    <form class="mt-4 mb-4 form " action="../server/form_handler.php" method="post" >
    <input type="hidden" name="userId" value="<?php echo isset($user['userId']) ? $user['userId'] : 0; ?>">
    <div class="input-group mb-3">
  <span class="input-group-text" >Nombre</span>
  <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" id="FirstName" name="FirstName" required>

  <div class="input-group mt-3 mb-3">
  <span class="input-group-text">Apellido</span>
  <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" id="LastName" name="LastName" required>
</div>

<div class="input-group mb-3">
  <span class="input-group-text" >Email</span>
  <input type="email" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" id="Email" name="Email" required>
</div>

<div class="input-group mb-3">
  <span class="input-group-text">Número de Telefono</span>
  <input type="tel" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" id="PhoneNumber" name="PhoneNumber" required>
</div>

<div class="input-group mb-3">
  <span class="input-group-text" >Cantidad de Adultos</span>
  <input type="number" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" id="NumberOfAdults" name="NumberOfAdults" required>
</div>

<div class="input-group mb-3">
  <span class="input-group-text" >Cantidad de Niños</span>
  <input type="number" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" id="NumberOfChildren" name="NumberOfChildren" required>
</div>

<div class="input-group mb-3">
  <label class="input-group-text" for="inputGroupSelect01">Evento</label>
  <select class="form-select" id="inputGroupSelect01" name="EventName" required>
    <option value="Baloncesto">Baloncesto</option>
    <option value="Volleyball">Volleyball</option>
    <option value="Tennis">Tennis</option>
  </select>
</div>

<div class="input-group mb-3">
  <label class="input-group-text" for="inputGroupSelect01">Opciones</label>
  <select class="form-select" id="inputGroupSelect01" name="Week_day" required>
    <option value="Jueves">Jueves</option>
    <option value="Viernes">Viernes</option>
    <option value="Sabado">Sabado</option>
  </select>
</div>

</div>
<button class="btn btn-dark" type="submit">Somete Inscripción</button>
    </form>
</div>
<!-- Display success message if set -->
    
</body>
</html>
