<?php

$pagina = 'nosotros';
require_once('../includes/config.php');
require_once('../includes/conexion.php');
require_once('../includes/header.php');

?>

<main>
    <section class="pagina-nosotros fondo-pagina-nosotros">
        <div class="container bg-white p-4">
            <h2>Nosotros</h2>
                    <div class="row mt-4 align-items-center justify-content-center">
                        <div class="col-12 col-md-4 text-center">
                            <img src="/img/nosotros_signo.jpg" alt="quienes_somos" class="imagen-nosotros">
                        </div>
                        <div class="col-12 col-md-8 fondo-fila-nosotros">
                            <h3 class="py-4 text-center">¿Quiénes somos?</h3>
                            <p class="text-center"><i>Somos dos estudiantes de la Tecnicatura Universitaria en Programación dictada por la UTN Regional San Nicolás en el Centro Universitario de la Ciudad de Chivilcoy. La idea de desarrollar Speedservice nació durante la cursada de Laboratorio IV, al momento de buscar y elegir una idea de proyecto para desarrollar el trabajo final de la mencionada materia.</i></p>
                        </div>
                    </div>
                    <div class="row mt-4 align-items-center justify-content-center">  
                        <div class="col-12 col-md-8 fondo-fila-nosotros">
                            <h3 class="py-4 text-center">Nuestro objetivo</h3>
                            <p class="text-center"><i>Crear una plataforma flexible, adaptable a otros servicios, que oficie de nexo entre proveedores y potenciales clientes con el fin de satisfacer las necesidades de estos últimos de una manera cómoda y eficiente.</i></p>
                        </div>
                        <div class="col-12 col-md-4 text-center">
                            <img src="/img/nosotros_objetivo.png" alt="objetivo" class="imagen-nosotros">
                        </div>
                    </div>
                        
                    <div class="row mt-4 align-items-center justify-content-center">
                        <div class="col-12 col-md-4 text-center">
                            <img src="/img/nosotros_vision.jpg" alt="vision" class="imagen-nosotros">
                        </div>
                        <div class="col-12 col-md-8 fondo-fila-nosotros">
                            <h3 class="py-4 text-center">Nuestra visión</h3>
                            <p class="text-center"><i>Afianzar la plataforma en la ciudad de Chivilcoy, liderar el mercado, y expandirla a otras ciudades vecinas.</i></p>
                        </div>
                    </div>

                    <div class="row mt-4 mb-4 align-items-center justify-content-center">
                        <div class="col-12 col-md-8 fondo-fila-nosotros">
                            <h3 class="py-3 text-center">Nuestros valores</h3>
                            <ul class="text-center">
                                <li><i> Innovación </i></li>
                                <li><i> Responsablidad </i></li>
                                <li><i> Transparencia </i></li>
                                <li><i> Satisfacción de los usuarios </i></li>
                                <li><i></i> Calidad </li>
                                <li></i> Flexibilidad y adaptabilidad </li>
                            </ul>
                        </div>
                        <div class="col-12 col-md-4 text-center">
                            <img src="/img/nosotros_valores.jpg" alt="vision" class="imagen-nosotros">
                        </div>
                    </div>
                    <div class="row p-2 align-items-center justify-content-center nosotros-contacto">
                        <h5> Para más información, contactanos </h5>
                        <a class="text-decoration-none text-black" href="https://www.linkedin.com/in/marianela-novelli"><p class="mb-2"><i class="fa-brands fa-linkedin icono-linkedin"></i> Marianela Novelli</p></li></a>
                        <a class="text-decoration-none text-black" href="https://www.linkedin.com/in/timoteo-pereyra"><p class="mb-2"><i class="fa-brands fa-linkedin icono-linkedin"></i> Timoteo Pereyra</p></li></a>
                    </div>
        </div>
    </section>
</main>


<?php
  require_once('../includes/footer.php');
?>}