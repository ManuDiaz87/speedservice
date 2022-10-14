<?php
$pagina = 'servicios-flete';
require_once('../includes/config.php');

require_once('../includes/conexion.php');

$busqueda = empty ($_REQUEST['busqueda']) ? '' : $_REQUEST['busqueda'];
if(empty($busqueda)){
    $stmt = $conexion->prepare("SELECT DISTINCT nombreServicio, imgUsuario,urlFoto,idServicio FROM servicios
    INNER JOIN usuarios ON usuarios.idUsuario = servicios.idUsuario
    INNER JOIN vehiculos ON vehiculos.idVehiculo = servicios.idVehiculo
    INNER JOIN fotos_vehiculo ON fotos_vehiculo.idVehiculo = vehiculos.idVehiculo
    WHERE idCategoria = 1
    GROUP BY idServicio;");
    $stmt->execute();
    $servicios = $stmt->fetchAll();
}else{
    $stmt = $conexion->prepare("SELECT DISTINCT nombreServicio, imgUsuario,urlFoto,idServicio FROM servicios INNER JOIN usuarios ON usuarios.idUsuario = servicios.idUsuario INNER JOIN vehiculos ON vehiculos.idVehiculo = servicios.idVehiculo INNER JOIN fotos_vehiculo ON fotos_vehiculo.idVehiculo = vehiculos.idVehiculo WHERE nombreServicio LIKE '%$busqueda%' AND idCategoria = 1 GROUP BY idServicio;");
    $stmt->execute();
    $servicios = $stmt->fetchAll();
    $errorBusqueda = empty($servicios) ? true : false ;

}



require_once('../includes/header.php');
?>
<main class="pagina-servicios py-5">
    <section class="servicios">
        <div class="container">
            <div class="row">
                
                <form method="get">
                    <input type="text" id="busqueda" name="busqueda" placeholder="Buscar servicio por nombre...">
                    <input type="submit" value="Buscar" class="btn btn-primary">
                </form>

                <!-- COLUMNA SERVICIOS -->
                <div class="col-12 col-md-12 columna-servicios">
                    <h3>Fletes</h3>
                    <div class="row fila-servicios">

                    <form method="get">
                  

                        <?php
                            foreach($servicios as $fila){
                            
                                echo '
                                <div class="col-md-4 mb-3">
                                    <div class="card">
                                    <img src="../img/vehiculos/'.$fila['urlFoto'].'" class="card-img-top img-fluid imagen-servicios-vehiculo" alt="imgVehiculo">
                                        <div class="text-center">
                                            <img src="../img/usuarios/'.$fila['imgUsuario'].'" class="card-img-top img-fluid imagen-servicios-usuario" alt="imgUsuario">
                                        </div>
                                        <div class="card-body tarjeta-servicio">
                                            <h5 class="card-title">'.ucfirst($fila['nombreServicio']).'</h5>
                                            <div class="d-grid gap-2 d-md-block text-center">
                                                <a href="#" class="ov-btn-slide-left">Solicitar servicio</a>    
                                                <a href="detalleServicio.php?idServicio='.$fila['idServicio'].'" class="btn boton-servicios2">Detalle</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                ';
                            }
                        
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </section>            
</main>

<script>
    let errorServidor = "<?php echo (isset($errorBusqueda)) ? $errorBusqueda : '' ;?>";
    
    if(errorServidor){
        alert('Error: no existen resultados para su búsqueda.'); 
        window.location.href = 'serviciosFlete.php';
    }
</script>

<?php
  require_once('../includes/footer.php');
?>
