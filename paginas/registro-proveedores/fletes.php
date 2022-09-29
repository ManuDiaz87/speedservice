<?php
session_start();

if(!isset($_SESSION['idUsuario'])){
    header('Location:../../index.php');
}

$pagina = 'alta-fletes';
require_once('../../includes/config.php');
require_once('../../includes/conexion.php');

/* LISTAR TIPO DE VEHICULOS */
$stmt = $conexion->prepare("SELECT * FROM tipo_vehiculo WHERE idTipo = 4 OR idTipo = 5");
$stmt->execute();

$tipoVehiculos = $stmt->fetchAll();


if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $nombreServicio = $_POST['nombreServicio'];
    $alcance = $_POST['alcance'];
    $horario = $_POST['horario'];
    $descripcionServicio = $_POST['descripcionServicio'];

    $patente = $_POST['patente'];
    $idTipoVehiculo = $_POST['idTipo'];
    $descripcionCapacidad = $_POST['descripcionCapacidad'];
    $descripcionVehiculo = $_POST['descripcionVehiculo'];
  

    $imgSeguro = $_FILES['polizaSeguro']['name'];
    $imgSeguroTmpName = $_FILES['polizaSeguro']['tmp_name'];
    $imgVtv = $_FILES['imgVTV']['name'];
    $imgVtvTmpName = $_FILES['imgVTV']['tmp_name'];
    $arregloImgVehiculo = $_FILES['fotosVehiculo'];

    $idEstadoServicio = 1;
    $tipoServicio = 1;



    if(empty($nombreServicio) || empty($alcance) || empty($horario) || empty($descripcionServicio) || empty($patente) || empty($idTipoVehiculo) || empty($descripcionCapacidad) || empty($descripcionVehiculo) || empty($imgSeguro) || empty($imgVtv) || empty($arregloImgVehiculo) ){
        $notificacion = "Error: No puede haber campos vacíos.";
    }else{
        
        

        $stmt = $conexion->prepare("INSERT INTO vehiculos(patente, img_seguro, img_vtv, capacidad, descripcionVehiculo, idTipo, idUsuario) VALUES (:patente,:imgSeguro,:imgVtv,:capacidad,:descripcion,:idTipo,:idUsuario)");
            $resultado = $stmt->execute(array(':patente' => $patente,':imgSeguro' => $imgSeguro, ':imgVtv' => $imgVtv, ':capacidad' => $descripcionCapacidad, ':descripcion' => $descripcionVehiculo, ':idTipo' => $idTipoVehiculo, ':idUsuario' => $_SESSION['idUsuario']));

            if($resultado){
                $idVehiculo = trim($conexion->lastInsertId());
                echo count($arregloImgVehiculo['name']);
                $longitud = (count($arregloImgVehiculo['name']) > 4) ? 4 : count($arregloImgVehiculo['name']);

                for ($i=0; $i < $longitud; $i++) { 

                    $stmt = $conexion->prepare("INSERT INTO fotos_vehiculo(urlFoto, idVehiculo) VALUES (:img, :idVehiculo)");
                    $stmt->execute(array(':img' => $arregloImgVehiculo['name'][$i], ':idVehiculo' => $idVehiculo));

                    $archivo_destino = '../../img/vehiculos/'.$arregloImgVehiculo['name'][$i];
                    move_uploaded_file($arregloImgVehiculo['tmp_name'][$i],$archivo_destino);

                }

                $stmt = $conexion->prepare("INSERT INTO servicios(nombreServicio, descripcionServicio, horarioServicio, idCategoria, idVehiculo, alcance, idEstadoServicio, idUsuario) VALUES (:servicio,:descripcion,:horario,:idCat,:idVehiculo,:alcance,:idEstado, :idUsuario)");
                
                $resultado = $stmt->execute(array(':servicio' => $nombreServicio,':descripcion' => $descripcionServicio,':horario' => $horario,':idCat' => $tipoServicio,'idVehiculo' => $idVehiculo, ':alcance' => $alcance,':idEstado' => $idEstadoServicio, ':idUsuario' => $_SESSION['idUsuario']));

                if($resultado){
                    $notificacionExito = 'Éxito: Se ha procesado el servicio correctamente';
                }else{
                    $notificacion = 'Ha ocurrido un error al intentar cargar el servicio';
                }

            }
    }

    
    
}


require_once('../../includes/header.php');
?>

<main class="registro-servicio">

    <seccion class="formulario py-4">
       <div class="container">
            <h1 class="text-center mb-4">Dar de alta un servicio</h1>
            
           <div class="row align-items-center">
           
               <div class="col-4 form-usuario d-flex flex-column align-items-center">
                   <?php echo '<h3 class="texto-usuario text-center">'.'Bienvenid@, '  .$_SESSION['nombre'].'</h3>';?>
                   <img src="<?php echo RUTARAIZ.'/img/usuarios/'.$_SESSION['imgUsuario'] ?>" alt="avatar" class="imagen_usuario m-0">
                   <p class="text-center texto-usuario"><i>Ya puedes registrar tu servicio. Los datos ingresados serán validados por los administradores del sitio.</i></p>
               </div>

               <div class="col-8">
                <?php 
                if(isset($notificacion)){
                    echo '<p class="bg-danger text-white text-center">'.$notificacion.'</p>';
                }else if(isset($notificacionExito)){
                    echo '<p class="bg-success text-white text-center">'.$notificacionExito.'</p>';
                }                    
                ?>

               <form action="fletes.php" method="POST" enctype="multipart/form-data" id="formRegistroFletes">

               <div class="row" id="datosServicio">
                        <div class="col-12 col-md-6 arregloForm row">
                            <div class="mb-3">
                                <label for="nombreServicio">Nombre del servicio:</label>
                                <input type="text" class="form-control" id="nombreServicio" name="nombreServicio" required>
                            </div>
                        
                            <div class="mb-3">
                                <label for="horario">Horario disponible:</label>
                                <input type="text" class="form-control" id="horario" name="horario" required>
                            </div>

                            
                            
                        </div>

                        <div class="col-12 col-md-6">

                        <div class="mb-3">
                                <label for="alcance">Alcance (kms. a la redonda):</label>
                                <input type="text" class="form-control" id="alcance" name="alcance" required>
                        </div>

                        <div class="mb-3">
                                <label for="descripcionServicio">Descripción del servicio:</label>
                                <textarea name="descripcionServicio" id="descripcionServicio" rows="6" class="form-control" required></textarea>
                            </div>
                            
                        </div>
                    </div>

                    <div class="row d-none opacity-0" id="datosVehiculo">
                        <div class="col-12 col-md-6 arregloForm">

                            <div class="mb-3">
                                <label for="patente">Patente:</label>
                                <input type="text" class="form-control" id="patente" name="patente" required>
                            </div>

                            <div class="mb-3">
                                <label for="idTipo">Tipo de vehiculo</label>
                                <select name="idTipo" id="idTipo" class="form-select" required>
                                    
                                    <?php 
                                        foreach ($tipoVehiculos as $fila) {
                                            echo '
                                            <option value="'.$fila['idTipo'].'">'.ucfirst($fila['tipo']).'</option>
                                            ';
                                        }
                                    ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="descripcionCapacidad">Capacidad de carga (kg.):</label>
                                <textarea name="descripcionCapacidad" id="descripcionCapacidad" rows="6" class="form-control" required></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="fotosVehiculo">Fotos del vehiculo (máximo 4):</label>
                                <input type="file" name="fotosVehiculo[]" multiple="multiple" class="form-control" required>
                            </div>
                            

                            </div>

                            <div class="col-12 col-md-6">

                                <div class="mb-3">
                                    <label for="polizaSeguro">Póliza de seguro:</label>
                                    <input type="file" class="form-control" id="polizaSeguro" name="polizaSeguro" required>
                                </div>
                                <div class="mb-3">
                                    <label for="imgVTV">Imagen de VTV:</label>
                                    <input type="file" class="form-control" id="imgVTV" name="imgVTV" required>
                                </div>

                                <div class="mb-3">
                                    <label for="descripcionVehiculo">Descripción del vehículo:</label>
                                    <textarea name="descripcionVehiculo" id="descripcionVehiculo" rows="6" class="form-control" required></textarea>
                                </div>
                            </div>

                        </div>
                   
                             
                        <button class="btn d-grid gap-2 col-5 mx-auto boton-servicio" id="btnSiguiente">Siguiente</button>
                   <button type="submit" class="btn d-grid gap-2 col-5 mx-auto boton-servicio d-none"  id="btnEnviar">Enviar solicitud</button>

               </form>
            
               </div>
           </div>
       </div>
   </seccion>

</main>
<script>
    let exitoServidor = "<?php echo (isset($notificacionExito)) ? $notificacionExito : '' ;?>";
    if (exitoServidor){
        alert(exitoServidor); 
        window.location.href = '/speedservice/paginas/servicios.php';
        
    }
</script>

<script src="../../js/alta-fletes.js"></script>
<?php 
require_once('../../includes/footer.php');
?>