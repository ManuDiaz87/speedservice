<?php
session_start();

if(!isset($_SESSION['idUsuario']) || $_SESSION['idRol'] != 3){
    header('Location:../index.php');
}

$pagina = 'listado-usuarios';
require_once('../../includes/config.php');
require_once('../../includes/conexion.php');


$stmt = $conexion->prepare("SELECT idUsuario,nombreCompleto,correo, fechaNacimiento
FROM usuarios 
");

$stmt->execute();
$usuarios = $stmt->fetchAll();

require_once('../../includes/header.php');
?>

<section class="alta-categorias">
    <div class="container">
        <h1 class="text-center py-5">Listado de usuarios</h1>

        <div class="table-responsive bg-white">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Fecha de nacimiento</th>
                        <th scope="col">Nombre y apellido</th>
                        <th scope="col">Correo electrónico</th>
                        <th scope="col">Acción</th>
                    </tr>
                    
                </thead>
                <tbody>
                    <?php
                        foreach ($usuarios as $fila) {
                            $originalDate = $fila['fechaNacimiento'];
                            $newDate = date("d-m-Y", strtotime($originalDate));
                            echo '
                                <tr>
                                    <td class="align-middle">'.$newDate.'</td>
                                    <td class="align-middle">'.$fila['nombreCompleto'].'</td>
                                    <td class="align-middle">'.$fila['correo'].'</td>
                                    
                                   <td class="align-middle">
                                   <a href="../servicios/detalle.php?idUsuario='.$fila['idUsuario'].'" class="icono-modificar"><i class="fa-regular fa-eye"></i></a></td>
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