<?php
session_start();
if(!isset($_SESSION['idUsuario'])){
    header('Location:../index.php');
}
$pagina = 'servicios-mandado';
require_once('../includes/config.php');

require_once('../includes/conexion.php');

$busqueda = isset ($_REQUEST['busqueda']) ? $_REQUEST['busqueda'] : '' ;
$errorBusqueda = false;
if(empty($busqueda)){
    $stmt = $conexion->prepare("SELECT COUNT(*) as totalRegistro FROM servicios WHERE idCategoria = 2 AND idEstadoServicio=2 ");
    $stmt->execute();
    $resultado = $stmt->fetch();
    $totalRegistros = $resultado['totalRegistro'];
    $porPagina = 1; 
   

     if(empty($_GET['pagina'])){
         $pagina = 1; 
         $desde = 0;
     }else{
         $pagina = $_GET['pagina'];
         $desde = ($pagina-1) * $porPagina; 
     }

     
    $totalPaginas = ceil($totalRegistros / $porPagina);
   //No anda la pasada por parametros del limit
     $query = $conexion->prepare("SELECT DISTINCT nombreServicio, imgUsuario,urlFoto,idServicio,fechaAltaServicio FROM servicios
     INNER JOIN usuarios ON usuarios.idUsuario = servicios.idUsuario
     INNER JOIN vehiculos ON vehiculos.idVehiculo = servicios.idVehiculo
     INNER JOIN fotos_vehiculo ON fotos_vehiculo.idVehiculo = vehiculos.idVehiculo
     WHERE idCategoria = 2 AND idEstadoServicio=2 
     GROUP BY idServicio
     ORDER BY fechaAltaServicio ASC
     LIMIT $desde, $porPagina;");
     
    $query->execute();
    $servicios = $query->fetchAll();
    
    
    
}else{
    $stmt = $conexion->prepare("SELECT DISTINCT nombreServicio, imgUsuario,urlFoto,idServicio FROM servicios INNER JOIN usuarios ON usuarios.idUsuario = servicios.idUsuario INNER JOIN vehiculos ON vehiculos.idVehiculo = servicios.idVehiculo INNER JOIN fotos_vehiculo ON fotos_vehiculo.idVehiculo = vehiculos.idVehiculo WHERE nombreServicio LIKE :busqueda AND idCategoria = 2 AND idEstadoServicio=2  GROUP BY idServicio;");
    $stmt->execute(array(':busqueda' => '%'.$busqueda.'%'));
    $servicios = $stmt->fetchAll();
    $errorBusqueda = empty($servicios) ? true : false ;

}


require_once('../includes/header.php');
?>

<main class="pagina-servicios py-5">
    <section class="servicios">
        <div class="container">
            
            <section class="mt-2 mb-3"> 
                <form method="get">
			        <input type="text" id="busqueda" name="busqueda" placeholder=" Buscar servicio por nombre..." class="buscador">
			        <input type="submit" value="Buscar" class="boton-buscador-buscar">
		        </form>
	        </section>                    

            <div class="row">
                <div class="col-12 col-md-12 columna-servicios">
                    <h3>Mandados</h3>
                    <div class="row">
                  
                        <?php
                       if(!$errorBusqueda){
                        foreach($servicios as $fila){
                        
                            echo '
                            <div class="col-md-3 mb-3">
                                <div class="card">
                                <img src="../img/vehiculos/'.$fila['urlFoto'].'" class="card-img-top img-fluid imagen-servicios-vehiculo" alt="imgVehiculo">
                                    <div class="text-center">
                                        <img src="../img/usuarios/'.$fila['imgUsuario'].'" class="card-img-top img-fluid imagen-servicios-usuario" alt="imgUsuario">
                                    </div>
                                    <div class="card-body tarjeta-servicio">
                                        <h5 class="card-title">'.ucfirst($fila['nombreServicio']).'</h5>
                                        <div class="d-grid gap-2 d-md-block text-center">
                                            <a href="detalleServicio.php?idServicio='.$fila['idServicio'].'#form"  class="ov-btn-slide-left">Solicitar servicio</a>    
                                            <a href="detalleServicio.php?idServicio='.$fila['idServicio'].'" class="btn boton-servicios2">Detalle</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            ';
                        }
                    }else{
                        echo'
                        <div class="card-body tarjeta-servicio">
                        <h5 class="card-title">Error en la búsqueda</h5>
                        <div class="d-grid gap-2 d-md-block text-center">
                            <a href="serviciosMandado.php" class="btn boton-servicios">Volver</a>    
                           
                        </div>
                    </div>
                        ';
                    }
                        ?>
                        <?php if (!empty($servicios)|| $pagina !=1):?>
                            <nav aria-label="Page navigation example">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-center p-3">
                                    <li class="page-item disabled">
                                    <?php 
                                if($pagina != 1){
                            ?>
                                
                                    <li class="page-item"><a class="page-link text-black" href="?pagina=<?php echo $pagina - 1; ?>" aria-label="Anterior"><span aria-hidden="true">&laquo;</span><b>Anterior</b></a></li>
                            <?php                  
                                }
                            
                                for ($i=1; $i <= $totalPaginas; $i++){
                                
                                    echo ($pagina==$i) ? '<li class="page-item"><a class="page-link active" href="?pagina='.$i.'">'.$i.'</a></li>' : '<li class="page-item"><a class="page-link text-black" href="?pagina='.$i.'">'.$i.'</a></li>' ;
                                
                                }
                                
                                
                                if($pagina < $totalPaginas){
                            ?>
                                            <li class="page-item"><a class="page-link text-black" href="?pagina=<?php echo $pagina + 1; ?>" aria-label="Siguiente"><b>Siguiente</b><span aria-hidden="true">&raquo;</span></li></a>
                                    <?php } ?>
                                        </ul>
                            </nav>
                        <?php endif;  ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php
  require_once('../includes/footer.php');
?>