<?php
session_start();

if(!isset($_SESSION['idUsuario']) || $_SESSION['idRol'] != 3){
    header('Location:../index.php');
}

$pagina = 'listado-servicios';
require_once('../../includes/config.php');
require_once('../../includes/conexion.php');
if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['idUsuario'])){
    $idUsuario = $_GET['idUsuario'];
    $stmt = $conexion->prepare("SELECT idServicio, nombreServicio, descripcionServicio, categoria, fechaAltaServicio, alcance, estadoServicio, patente, imgUsuario, img_seguro, img_vtv, capacidad, tipo, nombreCompleto, telefono, correo, servicios.idVehiculo, categorias.idCategoria FROM servicios INNER JOIN categorias ON categorias.idCategoria = servicios.idCategoria INNER JOIN estado_servicio ON estado_servicio.idEstadoServicio = servicios.idEstadoServicio INNER JOIN vehiculos ON vehiculos.idVehiculo = servicios.idVehiculo INNER JOIN usuarios ON usuarios.idUsuario = servicios.idUsuario INNER JOIN tipo_vehiculo ON tipo_vehiculo.idTipo = vehiculos.idTipo WHERE usuarios.idUsuario = :idUsuario");
    $stmt->execute(array(':idUsuario' => $idUsuario));
    $datosServicio = $stmt->fetch();
    $nombreServicio = $datosServicio['nombreServicio'];
    $categoria = $datosServicio['idCategoria']; 
    $descripcionServicio = $datosServicio['descripcionServicio'];
    $tipoVehiculoServicio = $datosServicio['tipo'];

    /* ACCEDER A LAS IMÁGENES DEL VEHÍCULO */
    $stmt = $conexion->prepare('SELECT * FROM fotos_vehiculo WHERE idVehiculo = :idVehiculo');
    $stmt->execute(array(':idVehiculo' => $datosServicio['idVehiculo']));
    $fotosVehiculo = $stmt->fetchAll();
}

if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])){
    $idServicio = $_GET['id'];
    $stmt = $conexion->prepare("SELECT idServicio, nombreServicio, descripcionServicio, categoria, fechaAltaServicio, alcance, estadoServicio, patente, imgUsuario, img_seguro, img_vtv, capacidad, tipo, nombreCompleto, telefono, correo, servicios.idVehiculo, categorias.idCategoria FROM servicios INNER JOIN categorias ON categorias.idCategoria = servicios.idCategoria INNER JOIN estado_servicio ON estado_servicio.idEstadoServicio = servicios.idEstadoServicio INNER JOIN vehiculos ON vehiculos.idVehiculo = servicios.idVehiculo INNER JOIN usuarios ON usuarios.idUsuario = servicios.idUsuario INNER JOIN tipo_vehiculo ON tipo_vehiculo.idTipo = vehiculos.idTipo WHERE idServicio = :idServicio");
    $stmt->execute(array(':idServicio' => $idServicio));
    $datosServicio = $stmt->fetch();

    $nombreServicio = $datosServicio['nombreServicio'];
    $categoria = $datosServicio['idCategoria']; 
    $descripcionServicio = $datosServicio['descripcionServicio'];
    $tipoVehiculoServicio = $datosServicio['tipo'];

    /* ACCEDER A LAS IMÁGENES DEL VEHÍCULO */
    $stmt = $conexion->prepare('SELECT * FROM fotos_vehiculo WHERE idVehiculo = :idVehiculo');
    $stmt->execute(array(':idVehiculo' => $datosServicio['idVehiculo']));
    $fotosVehiculo = $stmt->fetchAll();
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $idServicio = $_POST['idServicio'];
    $nombreServicio = $_POST['nombreServicio'];
    $descripcionServicio = $_POST['descripcionServicio'];
    $idEstado = $_POST['estadoServicio'];
    $categoria = $_POST['categoriaServicio'];
    $descripcionServicio = $_POST['descripcionServicio'];
    $tipoVehiculoServicio = $_POST['tipoVehiculoServicio'];


    if(empty($idServicio) || empty($nombreServicio) || empty($descripcionServicio) || empty($idEstado)){
        $notificacion = "Error: no puede dejar campos vacíos.";
    }else{

        $stmt = $conexion->prepare("UPDATE servicios SET nombreServicio = :nombreServicio, descripcionServicio = :descripcionServicio ,idEstadoServicio = :idEstado WHERE idServicio = :idServicio");
        $resultado = $stmt->execute(array(':nombreServicio' => $nombreServicio, ':descripcionServicio' => $descripcionServicio, ':idEstado' => $idEstado, ':idServicio' => $idServicio));

        if($resultado){
            header('Location:listado.php');
        }else{
            $notificacion = 'Error: no se han podido realizar los cambios correctamente.';
        }
    }
}



require_once('../../includes/header.php');
?>

<section class="alta-categorias">
    <div class="container">
        <h1 class="text-center py-5">Detalle del Servicio</h1>

        <?php 
                if(isset($notificacion)){
                    echo '<p class="bg-danger text-white text-center">'.$notificacion.'</p>';
                }else if(isset($notificacionExito)){
                    echo '<p class="bg-success text-white text-center">'.$notificacionExito.'</p>';
                }                    
        ?>
        <form action="detalle.php" method="POST" class="bg-white p-4 form-detalle">
        <div class="row">
            <input type="hidden" name="idServicio" value="<?php echo $datosServicio['idServicio']; ?>">
            <div class="col-12 col-md-6">
                <h4 class="mb-4 py-2 bg-secondary text-white text-center">Datos del Proveedor</h4>
                <div class="mb-2">
                    <label for="" class="text-dark"><b>Foto de perfil</b>:</label>
                    <img src="../../img/usuarios/<?php echo $datosServicio['imgUsuario'];?>" class="card-img-top img-fluid imagen-servicios-usuario" alt="imgUsuario">                                 
                </div>
                <div class="mb-2">
                    <label for="" class="text-dark"><b>Nombre</b>:</label> <input type="text" value="<?php echo $datosServicio['nombreCompleto']; ?>" style="width: 310px;">
                </div>
                <div class="mb-2">
                    <label for="" class="text-dark"><b>Correo</b>:</label> <input type="text" value="<?php echo $datosServicio['correo']; ?>" style="width: 310px;">
                </div>
                <div class="mb-2">
                    <label for="" class="text-dark"><b>Teléfono</b>:</label> <input type="text" value="<?php echo $datosServicio['telefono']; ?>" style="width: 310px;">
                </div>
            </div>

            <div class="col-12 col-md-6">
                <h4 class="mb-4 py-2 bg-secondary text-white text-center">Datos del Servicio</h4>
                <div class="mb-2">
                    <label for="" class="text-dark me-2"><b>Fecha de solicitud</b>:</label> <input type="text" value="<?php echo $fechaSolicitud = date("d-m-Y", strtotime($datosServicio['fechaAltaServicio'])); ?>">
                </div>
                <div class="mb-2">
                    <label for="" class="text-dark"><b>Nombre</b>:</label> <input type="text" value="<?php echo $nombreServicio; ?>" name="nombreServicio" class="form-control">
                </div>
                
                <div class="mb-2">
                    <label for="" class="text-dark"><b>Categoría</b>:</label>
                    <div class="d-flex">                  
                        <div class="form-check d-flex align-items-center">
                            <input class="form-check-input" type="radio" name="categoriaServicio" id="flete" <?php echo ($categoria == 1) ? 'checked' : '' ?> value="1">
                            <label class="form-check-label text-black" for="flete"> Flete </label>
                        </div>
                        
                        <div class="form-check d-flex align-items-center">
                            <input class="form-check-input" type="radio" name="categoriaServicio" id="remis" <?php echo ($categoria == 3) ? 'checked' : '' ?> value="3">
                            <label class="form-check-label text-black" for="remis"> Remis </label>
                        </div>

                        <div class="form-check d-flex align-items-center">
                            <input class="form-check-input" type="radio" name="categoriaServicio" id="mandado" <?php echo ($categoria == 2) ? 'checked' : '' ?> value="2">
                            <label class="form-check-label text-black" for="mandado"> Mandado </label>
                        </div>                      
                    </div>
                </div>

                <div class="mb-2">
                    <label for="" class="text-dark"><b>Alcance (en km.)</b>:</label> <input type="text" value="<?php echo $datosServicio['alcance']; ?>">
                </div>
                <div class="mb-2">
                    <label for="" class="text-dark"><b>Descripción</b>:</label> <textarea value="<?php echo $datosServicio['descripcionServicio']; ?>" class="form-control" name="descripcionServicio"><?php echo $descripcionServicio; ?></textarea>
                </div>
            </div>

            <div class="col-12 col-md-6">
                <h4 class="mt-4 mb-4 py-2 bg-secondary text-white text-center">Datos del Vehículo</h4>
                <div class="mb-2">
                    <label for="" class="text-dark"><b>Patente</b>:</label> <input type="text" value="<?php echo $datosServicio['patente']; ?>">
                </div>
                <div class="mb-2">
                    <label for="" class="text-dark"><b>Tipo</b>:</label> <input type="text" value="<?php echo $tipoVehiculoServicio; ?>"name="tipoVehiculoServicio" >
                </div>
                <div class="mb-2">
                    <label for="" class="text-dark"><b>Imagen del seguro</b>:</label>
                    <a href="../../img/vehiculos/<?php echo $datosServicio['img_seguro']; ?>" data-lightbox="img-seguro"><img class="img-fluid img-detalle-servicio" src="../../img/vehiculos/<?php echo $datosServicio['img_seguro']; ?>" alt=""></a> 
                </div>
                <div class="mb-2">
                    <label for="" class="text-dark"><b>Imagen de la VTV</b>:</label>
                    <a href="../../img/vehiculos/<?php echo $datosServicio['img_vtv']; ?>" data-lightbox="img-vtv"><img class="img-fluid img-detalle-servicio" src="../../img/vehiculos/<?php echo $datosServicio['img_vtv']; ?>" alt=""></a> 
                </div>

                <div class="mb-2">
                    <label for="" class="text-dark"><b>Imágenes del vehículo</b>:</label>

                    <?php 
                        foreach ($fotosVehiculo as $foto) {
                            echo '
                                <a href="../../img/vehiculos/'.$foto['urlFoto'].'" data-lightbox="img-vehiculo"><img class="img-fluid img-detalle-servicio" src="../../img/vehiculos/'.$foto['urlFoto'].'" alt=""></a> 
                            ';
                        }
                    ?>

                </div>

                <div class="mb-2">
                    <label for="" class="text-dark"><b>Capacidad (en kg.)</b>:</label> <textarea value="<?php echo $datosServicio['capacidad']; ?>" class="form-control"><?php echo $datosServicio['capacidad']; ?></textarea>
                </div>
            </div>

            <div class="col-12 col-md-6">
                <h4 class="mt-4 mb-4 py-2 bg-secondary text-white text-center">Estado del Servicio</h4>
                <div class="mb-2">
                    <label for="" class="text-dark"><b>Estado</b>:</label> 
                    
                    <div class="d-flex">
                    <div class="form-check d-flex align-items-center">
                            <input class="form-check-input" type="radio" name="estadoServicio" id="pendiente" <?php echo ($datosServicio['estadoServicio'] == 'Pendiente de aprobación') ? 'checked' : '' ?> value="1">
                            <label class="form-check-label text-black" for="pendiente">
                                Pendiente
                            </label>
                        </div>

                        <div class="form-check d-flex align-items-center">
                            <input class="form-check-input" type="radio" name="estadoServicio" id="aprobado" <?php echo ($datosServicio['estadoServicio'] == 'Aprobado') ? 'checked' : '' ?> value="2">
                            <label class="form-check-label text-black" for="aprobado">
                                Aprobado
                            </label>
                        </div>

                        <div class="form-check d-flex align-items-center">
                            <input class="form-check-input" type="radio" name="estadoServicio" id="rechazado" <?php echo ($datosServicio['estadoServicio'] == 'Rechazado') ? 'checked' : '' ?> value="3">
                            <label class="form-check-label text-black" for="rechazado">
                                Rechazado
                            </label>
                        </div>
                    </div>
                   
                </div>
            </div>
            <button type="submit" class="btn col-md-4 mx-auto mt-4 boton-servicios"> Actualizar datos </button>
        </form>   
    </div>
</section>

<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

<?php
  require_once('../../includes/footer.php');
?>