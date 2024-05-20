<?php
function renderNavbar() {
    echo <<<HTML
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
  </head>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark container-fluid">
      <a class="navbar-brand" href="index.php">
        Manada 82 Eventos
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link col-12" href="form.php">Registro</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="login.php">Mis Citas</a>
          </li>
        </ul>
      </div>
    </nav>
HTML;
}
?>
