<?php
session_start();

if(!isset($_SESSION['idUsuario'])){
    header('Location:../index.php');
}

$pagina = 'ver-mas';
require_once('../includes/config.php');
require_once('../includes/conexion.php');

if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['idSolicitud'])){
    $idSolicitud = $_GET['idSolicitud'];
    // FILTRAR POR PROVEEDOR LOGEADO ACTUALMENTE
    $stmt = $conexion->prepare("SELECT * FROM solicitud_servicio WHERE idSolicitud = :idSolicitud;");
    $stmt->execute(array(':idSolicitud' => $idSolicitud));
    $solicitud = $stmt->fetch();

/*
    if(isset($_GET['idSolicitud'])){
        verMas.php?idSolicitud=1
    }else if(isset($_GET['idUsuario'])){
        verMas.php?idUsuario=1
    }else{
        
        header('location:index.php');
    }
*/

}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $idSolicitud = $_POST['idSolicitud'];
    $fechaSolicitud = $_POST['fecha'];
    $horaSolicitud = $_POST['hora'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $estado = $_POST['estadoServicio'];
    
 
    $stmt = $conexion->prepare("UPDATE solicitud_servicio SET fecha=:fecha,hora=:hora,descripcion=:descripcion,precioServicio=:precio,idEstado=:idEstado WHERE solicitud_servicio.idSolicitud = $idSolicitud");
    $resultado = $stmt->execute(array(':fecha' => $fechaSolicitud, ':hora' => $horaSolicitud, ':descripcion' => $descripcion ,':precio' => $precio,':idEstado' => $estado));

        if($resultado){
            $stmt = $conexion->prepare("UPDATE notificaciones SET descripcion=:descripcion, visto=1 WHERE notificaciones.idSolicitud=:idSolicitud");
            $stmt->execute(array(':descripcion'=>$descripcion,':idSolicitud' => $idSolicitud));
            header('Location:../index.php');
        }
    
    
}

require_once('../includes/header.php');
?>

<section class="modificar-solicitud">
    <div class="container py-4">
        <h1 class="text-center">Modificar Solicitud</h1>

        <div class="row py-4">
            <form action="verMas.php" method="POST" class="col-md-6 mx-auto fondo-formulario" enctype="multipart/form-data">
                <input type="hidden" name="idSolicitud" value="<?php echo (isset($solicitud)) ? $solicitud['idSolicitud'] : '' ?>">
                <div class="mb-3">
                    <label for="fecha">Fecha del pedido: </label>
                    <input class="form-control" name="fecha" id="fecha" rows="5"value="<?php echo (isset($solicitud)) ? trim($solicitud['fecha']) : '' ?>">
                </div>
                <div class="mb-3">
                    <label for="hora">Hora del pedido: </label>
                    <input class="form-control" name="hora" id="hora" rows="5"value="<?php echo (isset($solicitud)) ? trim($solicitud['hora']) : '' ?>">
                </div>
                <div class="mb-3">
                    <label for="descripcion">Descripción del pedido: </label>
                    <textarea class="form-control" name="descripcion" id="descripcion" rows="5"><?php echo (isset($solicitud)) ? trim($solicitud['descripcion']) : '' ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="precio">Precio: </label>
                    <input class="form-control" name="precio" id="precio" rows="5"value="<?php echo (isset($solicitud)) ? trim($solicitud['precioServicio']) : '' ?>">
                </div>
                <div class="mb-2">
                    <label for="" class="text-dark"><b>Estado del servicio</b>:</label>
                    <div class="d-flex">                  
                        <div class="form-check d-flex align-items-center">
                            <input class="form-check-input" type="radio" name="estadoServicio" id="estadoServicio" <?php echo ($solicitud['idEstado'] == 1) ? 'checked' : '' ?> value="1">
                            <label class="form-check-label text-black" for="flete"> Pendiente </label>
                        </div>
                        
                        <div class="form-check d-flex align-items-center">
                            <input class="form-check-input" type="radio" name="estadoServicio" id="estadoServicio" <?php echo ($solicitud['idEstado'] == 2) ? 'checked' : '' ?> value="2">
                            <label class="form-check-label text-black" for="remis"> Aceptado </label>
                        </div>

                        <div class="form-check d-flex align-items-center">
                            <input class="form-check-input" type="radio" name="estadoServicio" id="estadoServicio" <?php echo ($solicitud['idEstado'] == 3) ? 'checked' : '' ?> value="3">
                            <label class="form-check-label text-black" for="mandado"> Cancelado </label>
                        </div>                      
                    </div>
                </div>

                <?php 
                        if(isset($notificacion)){
                            echo '<p class="bg-danger text-white text-center">'.$notificacion.'</p>';
                        }              
                ?>

                <button class="btn d-grid gap-2 col-5 mx-auto boton-crear-categoria" type="submit">Modificar</button>
            </form>
        </div>
    </div>
</section>


<?php
  require_once('../includes/footer.php');
?>