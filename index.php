<?php
session_start();

$pagina = 'inicio';
require_once('includes/config.php');
require_once('includes/conexion.php');

/* LISTAR CATEGORIAS */ 
$stmt = $conexion->prepare("SELECT * FROM categorias WHERE bajaCategoria = 0");
$stmt->execute();

$categorias = $stmt->fetchAll();

require_once('includes/header.php');

?>

  <section class="seccion-bienvenida">
    <div class="contenedor">
      <h1>SpeedService</h1>
      <p><i>El sitio que te permite generar ganancias al volante y pedir un servicio ahora. </i></p>
      <div class="d-flex justify-content-center align-items-center">
        <?php if(isset ($_SESSION['idRol'])) : ?>
          <div class="dropdown">
              <button class="btn boton-servicios dropdown-toggle" type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                Servicios
              </button>
              <ul class="dropdown-menu boton-desplegable-servicios" aria-labelledby="dropdownMenu2">
                <li class="m-1 bg-none"><a href="<?php echo RUTARAIZ; ?>/paginas/serviciosFlete.php"><i class="fa-solid fa-arrow-right"></i> Flete </a></li>
                <li class="m-1 bg-none"><a href="<?php echo RUTARAIZ; ?>/paginas/serviciosRemis.php"><i class="fa-solid fa-arrow-right"></i> Remis </a></li>
                <li class="m-1 bg-none"><a href="<?php echo RUTARAIZ; ?>/paginas/serviciosMandado.php"><i class="fa-solid fa-arrow-right"></i> Mandado </a></li>
                
              </ul>
        </div>
        <?php endif;  ?>
        <?php if(!isset ($_SESSION['idRol'])) : ?>
        <a href="paginas/registro.php" class="me-4">Registrarse</a>

        <?php endif;  ?>
      </div>
    </div>
  </section>

  <section class="seccion-servicios py-4">
    <div class="container">
      <h2 class="text-center mb-4">Nuestros Servicios</h2>
      
      <div class="row">

      <?php
        foreach($categorias as $fila){
        
            echo '
              <div class="col-md-4 mb-3">
                <div class="card">
                  <img src="img/categorias/'.$fila['imgCategoria'].'" class="card-img-top imagen-servicios" alt="remis">
                  <div class="card-body">
                    <h5 class="card-title">'.ucfirst($fila['categoria']).'</h5>
                    <p class="card-text"><i>'.$fila['descripcionCategoria'].'</i></p>';

                  if($fila['idCategoria'] == 1){
                    echo '
                      <a href="paginas/serviciosFlete.php" class="btn d-grid gap-2 col-10 mx-auto boton-servicios">Ver m??s</a>
                      
                      </div>
                      </div>
                    </div>
                  '; }
                  if($fila['idCategoria'] == 2){
                    echo '
                      <a href="paginas/serviciosMandado.php" class="btn d-grid gap-2 col-10 mx-auto boton-servicios">Ver m??s</a>
                      
                      </div>
                      </div>
                    </div>
                  '; }
                  if($fila['idCategoria'] == 3){
                    echo '
                      <a href="paginas/serviciosRemis.php" class="btn d-grid gap-2 col-10 mx-auto boton-servicios">Ver m??s</a>
                      
                      </div>
                      </div>
                    </div>
                  '; }
                  
                  
                    
             
          }
      
      ?>

      </div>
    </div>
  </section>

  <section class="info-servicios py-4 mt-3">
    <div class="container">

      <div class="row">

        <div class="col-md-4 text-center info-servicio">
          <div class="icono">
            <i class="fa-solid fa-id-card"></i>
          </div>
          <h5 class="encabezado-info">Seguridad</h5>
          <p class="descripcion-info">Nuestros choferes est??n registrados en bases de datos y cuentan con toda la documentaci??n respaldatoria para circular.</p>
        </div>

        <div class="col-md-4 text-center info-servicio">
          <div class="icono">
            <i class="fa-solid fa-clock-rotate-left"></i>
          </div>
          
          <h5 class="encabezado-info">24 horas</h5>
          <p class="descripcion-info">Solicit?? un servicio en cualquier momento del d??a y cualquier d??a del a??o.</p>
        </div>

        <div class="col-md-4 text-center info-servicio">
          <div class="icono">
            <i class="fa fa-money"></i>
          </div>
          
          <h5 class="encabezado-info">Transparencia</h5>
          <p class="descripcion-info">Observ?? el detalle de tu pedido. Compar?? viajes. <br>No te dejes enga??ar.</p>
        </div>

      </div>
    </div>
  </section>

<?php
  require_once('includes/footer.php');
?>