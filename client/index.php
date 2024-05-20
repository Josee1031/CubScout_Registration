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


<body class="background">
  <?php
  include 'components/nav.php'; // Asegúrate de que la ruta al archivo navbar.php sea correcta
  renderNavbar();
  ?>
  
  <div id="main" class="container min-vh-100 d-flex align-items-center justify-content-center">
    <div class="row w-100">
        <div class="col-lg-8 p-4">
            <h2>¡Bienvenido al Portal de Eventos de la Manada 82!</h2>
            <p class="mt-3 mb-4">En este espacio digital, miembros y familias pueden gestionar su participación en las diversas actividades y eventos organizados por nuestra manada. Nuestro objetivo es facilitar el acceso a la información y mejorar la experiencia de todos en el grupo.</p>
            <h3>Funcionalidades del Portal:</h3>
            <ul class="mb-4">
                <li><strong>Registrarse a Eventos:</strong> ¿Listo para una nueva aventura? Accede al formulario de registro para inscribirte en los próximos eventos. ¡No te pierdas la oportunidad de aprender, explorar y divertirte con tus compañeros scouts!</li>
                <li><strong>Ver Citas:</strong> Mantén un control de tus eventos programados fácilmente. Solo necesitas ingresar tu número de teléfono y tu email para consultar las actividades en las que estás inscrito.</li>
            </ul>
            <p>Explora, aprende y crece con la Manada 82. ¡Prepárate para vivir experiencias inolvidables junto a tus amigos y líderes scouts!</p>
            <a href="form.php"><button type="button" class="btn btn-outline-dark mt-3">Reserva tu espacio</button></a>
        </div>

        <div class="col-lg-4 d-flex align-items-center">
            <img src="images/logo.png" class="img-fluid"/>
        </div>
    </div>
</div>

  
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>   
</body>
</html>
