<?php
session_start();

if(!isset($_SESSION['idUsuario']) || $_SESSION['idRol'] != 3){
    header('Location:../index.php');
}

$pagina = 'listado-servicios';
require_once('../../includes/config.php');
require_once('../../includes/conexion.php');

if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])){
    $idServicio = $_GET['id'];
    $stmt = $conexion->prepare("SELECT idServicio, nombreServicio, descripcionServicio, categoria, fechaAltaServicio, alcance, estadoServicio, patente, img_seguro, img_vtv, capacidad, tipo, nombreCompleto, telefono, correo FROM servicios INNER JOIN categorias ON categorias.idCategoria = servicios.idCategoria INNER JOIN estado_servicio ON estado_servicio.idEstadoServicio = servicios.idEstadoServicio INNER JOIN vehiculos ON vehiculos.idVehiculo = servicios.idVehiculo INNER JOIN usuarios ON usuarios.idUsuario = servicios.idUsuario INNER JOIN tipo_vehiculo ON tipo_vehiculo.idTipo = vehiculos.idTipo WHERE idServicio = :idServicio");
    $stmt->execute(array(':idServicio' => $idServicio));
    $datosServicio = $stmt->fetch();
}



require_once('../../includes/header.php');
?>

<section class="alta-categorias">
    <div class="container">
        <h1 class="text-center py-5">Detalle del Servicios</h1>

        <form action="detalle.php" method="POST" class="bg-white p-4 form-detalle">
        <div class="row">

            <div class="col-12 col-md-6 text-center">
                <h4 class="mb-4">Datos del Proveedor:</h4>
                <div class="mb-3">
                    <label for="" class="text-dark"><b>Nombre</b>:</label> <input type="text" value="<?php echo $datosServicio['nombreCompleto']; ?>">
                </div>
                <div class="mb-3">
                    <label for="" class="text-dark"><b>Correo</b>:</label> <input type="text" value="<?php echo $datosServicio['correo']; ?>">
                </div>
                <div class="mb-3">
                    <label for="" class="text-dark"><b>Teléfono</b>:</label> <input type="text" value="<?php echo $datosServicio['telefono']; ?>">
                </div>

            </div>

            <div class="col-12 col-md-6 text-center">
                <h4 class="mb-4">Datos del servicio:</h4>
                <div class="mb-3 d-flex align-items-center justify-content-center">
                    <label for="" class="text-dark me-2"><b>Fecha <br> de solicitud</b>:</label> <input type="text" value="<?php echo $datosServicio['fechaAltaServicio']; ?>">
                </div>
                <div class="mb-3">
                    <label for="" class="text-dark"><b>Servicio</b>:</label> <input type="text" value="<?php echo $datosServicio['nombreServicio']; ?>">
                </div>
                <div class="mb-3">
                    <label for="" class="text-dark"><b>Categoría</b>:</label> <input type="text" value="<?php echo $datosServicio['categoria']; ?>">
                </div>
                <div class="mb-3">
                    <label for="" class="text-dark"><b>Alcance</b>:</label> <input type="text" value="<?php echo $datosServicio['alcance']; ?>">
                </div>
                <div class="mb-3">
                    <label for="" class="text-dark"><b>Descripción</b>:</label> <textarea value="<?php echo $datosServicio['descripcionServicio']; ?>" class="form-control"><?php echo $datosServicio['descripcionServicio']; ?></textarea>
                </div>
            </div>

        </div>
        </form>
        
     

    </div>
</section>



<?php
  require_once('../../includes/footer.php');
?>