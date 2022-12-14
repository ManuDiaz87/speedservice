<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- FONTAWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- LIGHTBOX GALERIA DE IMAGENES -->
    <link rel="stylesheet" href="<?php echo RUTARAIZ; ?>/libs/lightbox2/dist/css/lightbox.css">	
    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">    <link rel="stylesheet" href="<?php echo RUTARAIZ; ?>/css/style.css">
    <link rel="shortcut icon" href="<?php echo RUTARAIZ; ?>/img/logo5.jpg" type="image/x-icon">
    
    <title>SpeedService</title>
</head>
<body>
  <?php 
  if(isset($_SESSION['idRol'])&& $_SESSION['idRol'] == 1)
  {
    require_once('conexion.php');
    $stmt = $conexion->prepare("SELECT COUNT(*) as totalRegistro FROM solicitud_servicio 
    INNER JOIN notificaciones ON solicitud_servicio.idSolicitud = notificaciones.idSolicitud
    WHERE notificaciones.visto = 1;");
    $stmt->execute();
    $resultado = $stmt->fetch();
    $notificaciones = $resultado['totalRegistro'];
  }
  if(isset($_SESSION['idRol'])&& $_SESSION['idRol'] == 2)
  {
    require_once('conexion.php');
    $stmt = $conexion->prepare("SELECT COUNT(*) as totalNotificaciones FROM notificaciones WHERE visto = 0 AND idProveedor = :idProveedor");
    $stmt->execute(array(':idProveedor' => $_SESSION['idUsuario']));
    $resultado = $stmt->fetch();
    $notificaciones = $resultado['totalNotificaciones'];
  }
  ?>
    
    <!-- ENCABEZADO -->
    <header>

        <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">

            <div class="container">
              <img class="img-logo" src="<?php echo RUTARAIZ; ?>/img/logo5.jpg" alt="">
              <a class="navbar-brand" href="<?php echo RUTARAIZ; ?>">SpeedService</a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">

                  <li class="nav-item">
                    <a class="nav-link <?php echo ($pagina == 'inicio') ? 'active' : ''; ?>" aria-current="page" href="<?php echo RUTARAIZ; ?>">Inicio</a>
                  </li>

                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Servicios</a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <li><a class="dropdown-item" href="<?php echo RUTARAIZ; ?>/paginas/serviciosFlete.php"><i class="fa-solid fa-arrow-right"></i> Fletes</a></li>
                      <li><a class="dropdown-item" href="<?php echo RUTARAIZ; ?>/paginas/serviciosRemis.php"><i class="fa-solid fa-arrow-right"></i> Remis</a></li>
                      <li><a class="dropdown-item" href="<?php echo RUTARAIZ; ?>/paginas/serviciosMandado.php"><i class="fa-solid fa-arrow-right"></i> Mandados</a></li>
                    </ul>
                  </li>

                  <li class="nav-item">
                    <a class="nav-link" href="<?php echo RUTARAIZ; ?>/paginas/nosotros.php">Nosotros</a>
                  </li>

                  <?php if(!isset($_SESSION['idUsuario'])) : ?>
                    <li class="nav-item">
                      <a class="nav-link" href="<?php echo RUTARAIZ; ?>/paginas/ingresar.php">Ingresar</a>
                    </li>
                  <?php else:  ?>
                    <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="<?php echo RUTARAIZ.'/img/usuarios/'.$_SESSION['imgUsuario'] ?>" alt="avatar" class="img-avatar">
                      </a>
                      <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <?php if($_SESSION['idRol'] == 3) : ?>
                        <li><a class="dropdown-item" href="<?php echo RUTARAIZ; ?>/adm/panel-adm.php">Panel de control</a></li>
                        <?php endif; ?>
                        <?php if($_SESSION['idRol'] == 1 ) : ?>
                          <li><a class="dropdown-item" href="<?php echo RUTARAIZ; ?>/paginas/elegirCatProv.php"><i class="fa-solid fa-handshake"></i> Ser proveedor</a></li>
                        <?php endif; ?>
                        <?php if($_SESSION['idRol'] == 1 ||$_SESSION['idRol'] == 2 ) : ?>
                          <li><a class="dropdown-item" href="<?php echo RUTARAIZ; ?>/paginas/listNotProv.php"><i class="fa-solid fa-bell"></i> Notificaciones <span class="badge boton-servicios"><?php echo (isset($notificaciones))?$notificaciones : 0; ?></span></a></li>
                        <?php endif; ?>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="<?php echo RUTARAIZ; ?>/procesos/cerrar-sesion.php"><i class="fa-solid fa-lock"></i> Cerrar Sesi??n</a></li>
                      </ul>
                    </li>

                    
                  <?php endif; ?>
                  <!-- 
                  <li class="nav-item">
                    <a class="nav-link cta" href="">Registr?? tu servicio</a>
                  </li>
-->
                </ul>
              </div>
            </div>

          </nav>

    </header>