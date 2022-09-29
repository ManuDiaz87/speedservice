<?php
session_start();

if(!isset($_SESSION['idUsuario']) || $_SESSION['idRol'] != 3){
    header('Location:../index.php');
}

$pagina = 'listado-servicios';
require_once('../../includes/config.php');
require_once('../../includes/conexion.php');


$stmt = $conexion->prepare("SELECT idServicio, nombreServicio, categoria, fechaAltaServicio, estado_servicio.idEstadoServicio,estadoServicio FROM servicios INNER JOIN categorias ON categorias.idCategoria = servicios.idCategoria INNER JOIN estado_servicio ON estado_servicio.idEstadoServicio = servicios.idEstadoServicio ORDER BY fechaAltaServicio DESC");
$stmt->execute();
$servicios = $stmt->fetchAll();

require_once('../../includes/header.php');
?>

<section class="alta-categorias">
    <div class="container">
        <h1 class="text-center py-5">Listado de Servicios</h1>

        <div class="table-responsive bg-white">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Fecha de solicitud</th>
                        <th scope="col">Nombre del servicio</th>
                        <th scope="col">Categoría</th>
                        <th scope="col">Estado del servicio</th>
                        <th scope="col">Acción</th>
                    </tr>
                    
                </thead>
                <tbody>
                    <?php
                        foreach ($servicios as $fila) {
                            $originalDate = $fila['fechaAltaServicio'];
                            $newDate = date("d-m-Y", strtotime($originalDate));
                            echo '
                                <tr>
                                    <td class="align-middle">'.$newDate.'</td>
                                    <td class="align-middle">'.$fila['nombreServicio'].'</td>
                                    <td class="align-middle">'.$fila['categoria'].'</td>';
                                    
                                    if ($fila['idEstadoServicio'] == 1){ 
                                        echo '<td class="align-middle text-warning fw-bold">'.$fila['estadoServicio'].'</td>';
                                    }else if ($fila['idEstadoServicio'] == 3){ 
                                        echo '<td class="align-middle text-danger fw-bold">'.$fila['estadoServicio'].'</td>';
                                    }else{ 
                                        echo '<td class="align-middle text-success fw-bold">'.$fila['estadoServicio'].'</td>';
                                    }
                                    
                            echo '<td class="align-middle">
                                    <a href="detalle.php?id='.$fila['idServicio'].'" class="icono-modificar"><i class="fa-regular fa-eye"></i></a></td>
                                </tr>';
                        }                       
                    ?>
                </tbody>

            </table>
        </div>
    </div>
</section>


<?php
  require_once('../../includes/footer.php');
?>