<?php
$pagina = 'registro';
require_once('../includes/config.php');
require_once('../includes/conexion.php');
require_once('../includes/header.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $correoCliente = $_POST['correoCliente'];
    $passCliente = $_POST['passCliente'];

    if(empty($correoCliente) || empty($passCliente) ){
        $notificacion = 'Error: no puede dejar campos vacios.';
    }else{
        $stmt = $conexion->prepare("SELECT * FROM usuarios WHERE correo = :correo");  
        $stmt->execute(array(':correo' => $correoCliente)); 
        $usuario = $stmt->fetch();
        if(empty($usuario)){
           $notificacion = "Error: el correo ingresado no se encuentra registrado";
        }else{
            $validClave = password_verify($passCliente,$usuario['password']);    
            if($validClave == 1){

                /* INICIAMOS LAS VARIABLES DE SESSION */

                header("Location: index.php");

            }else{
                $notificacion = "Error: La contraseña ingresada es incorrecta.";
            }
        }
       
    }
}

?>

<main class="pagina-ingresar">
    <section class="seccion-login">
        <div class="container">
            <div class="row">

                <div class="col-md-5">
                    <h1 class="mb-1 text-center"><b>Formá parte de la nueva app de servicios de la Ciudad de Chivilcoy</b></h1>
                    <p class="text-center">Registrá tu servicio, cumplí con nuestros requisitos y ganá dinero. Aplica únicamente para aquellos que completen el proceso de registro exitosamente.</p>
                </div>

                <div class="offset-md-1 col-md-5">
                    <form action="ingresar.php" method="POST">
                        <div class="mb-3">
                            <label for="correoCliente">Correo:</label>
                            <input type="text" class="form-control" id="correoCliente" name="correoCliente">
                            <p class="text-white bg-danger msj-error">Error: El nombre debe tener al menos 6 caracteres.</p>
                        </div>
                        <div class="mb-3">
                            <label for="passCliente">Contraseña:</label>
                            <input type="text" class="form-control" id="passCliente" name="passCliente">
                            <p class="text-white bg-danger msj-error">Error: El nombre debe tener al menos 6 caracteres.</p>
                        </div>
                        <?php 
                        if(isset($notificacion)){
                            echo '<p class="bg-danger text-white text-center">'.$notificacion.'</p>';
                        }else if(isset($notificacionExito)){
                            echo '<p class="bg-success text-white text-center">'.$notificacionExito.'</p>';
                        }                    
                    ?>
                        <button type="submit" class="btn d-grid gap-2 col-6 mx-auto boton-servicio">Enviar solicitud</button>
                    </form>
                </div>

    </section>
</main>

<?php
  require_once('../includes/footer.php');
?>