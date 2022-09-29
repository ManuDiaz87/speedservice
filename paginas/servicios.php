<?php
$pagina = 'servicios';
require_once('../includes/config.php');

require_once('../includes/conexion.php');
$stmt = $conexion->prepare("SELECT idServicio, nombreServicio, categoria, fechaAltaServicio, estado_servicio.idEstadoServicio,estadoServicio FROM servicios INNER JOIN categorias ON categorias.idCategoria = servicios.idCategoria INNER JOIN estado_servicio ON estado_servicio.idEstadoServicio = servicios.idEstadoServicio ORDER BY fechaAltaServicio DESC");
$stmt->execute();
$servicios = $stmt->fetchAll();
require_once('../includes/header.php');
?>

<main class="pagina-servicios py-5">
    <section class="servicios">
        <div class="container">
            <div class="row">
                <!-- COLUMNA FILTROS -->
                <div class="col-12 col-md-2">
                    <h3>Filtros</h3>
                </div>

                <!-- COLUMNA SERVICIOS -->
                <div class="col-12 col-md-10 columna-servicios">
                    <h2>Servicios:</h2>
                    <div class="row fila-servicios">

                        <div class="col-12 col-md-4 servicio-1">
                            <table class="table table-striped d-flex flex-wrap">
                                <thead>
                                    
                                    <tr class="table table-striped d-flex flex-wrap">
                                        <th scope="col">Fecha de solicitud</th>
                                        <th scope="col">Nombre del servicio</th>
                                        <th scope="col">Categoría</th>
                                        <th scope="col">Estado de servicio</th>
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
                                                    <td class="align-middle">'.$fila['categoria'].'</td>
                                                    <td class="align-middle">'.$fila['estadoServicio'].'</td>
                                                    <td class="align-middle">
                                                        <a href="detalle.php?id='.$fila['idServicio'].'" class="icono-modificar"><i class="fa-regular fa-eye"></i></a>
                                                    </td>
                                                </tr>
                                            ';
                                        }
                                    ?>
                                </tbody>

                            </table>
                        </div>
                        <div class="col-12 col-md-4 servicio-2">
                        <article class="servicio">
                                <a href="#"><img class="logo-servicio img-fluid" src="../img/servicio_remis.jpg" alt="imagen servicio"></a>
                                   <a href="3"><h3 class="titulo-servicio">Remises Noroeste</h3></a>
                                    <p class="descripcion">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quis illum ab excepturi nobis possimus? Est facere ipsum illo maxime magnam!</p>
                                    <p class="horario-servicio">Horario: 08:00 a 00:00 hs.</p>
                                    <p class="precio-servicio">Valor del servicio: $400</p>
                            </article>
                        </div>
                        <div class="col-12 col-md-4">
                        <article class="servicio">
                                <a href="#"><img class="logo-servicio img-fluid" src="../img/servicio_mandado.jpg" alt="imagen servicio" ></a>
                                   <a href="3"><h3 class="titulo-servicio">Remises Noroeste</h3></a>
                                    <p class="descripcion">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quis illum ab excepturi nobis possimus? Est facere ipsum illo maxime magnam!</p>
                                    <p class="horario-servicio">Horario: 08:00 a 00:00 hs.</p>
                                    <p class="precio-servicio">Valor del servicio: $400</p>
                            </article>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>
</main>

<?php
  require_once('../includes/footer.php');
?>