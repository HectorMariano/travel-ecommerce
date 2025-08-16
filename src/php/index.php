<?php
// Start the session
    session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>CETI VIAJES</title>

    <link rel="shortcut icon" href="Imagenes/621px-CETI_Logo.png">
    <link rel="stylesheet" href="Estilos.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&family=Roboto+Condensed:ital,wght@1,300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Shadows+Into+Light&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@500&display=swap" rel="stylesheet">

</head>

<nav>
    <ul>
        <li style="float: left"><p id="Titulo">CETI VIAJES</p></li>
        
        <?php
            if(isset($_SESSION['usuario'])){
                echo '<li><a href="CerrarSesion.php">Cerrar Sesión</a></li>';
                echo '<li><a href="Carrito.php">Carrito</a></li>';
            }else if(isset($_SESSION['admin'])){
                echo '<li><a href="CerrarSesion.php">Cerrar Sesión</a></li>';
                echo '<li><a href="Carrito.php">Carrito</a></li>';
                echo '<li><a href="ModificarRegistros.php">Modificar registros</a></li>';
            }else{
                echo'<li><a href="Login.php">Iniciar Sesión</a></li>';
                echo '<li><a href="Registro.php">Registro</a></li>';
            }
        ?>
    
        <li><a href="Reservas.php">Reservar Ahora</a></li>
        <li><a href="index.php">Inicio</a></li>
    </ul>
</nav>

<body>
    <section class="EspacioVacio"></section>

    <section id="Inicio">
        <h2 id="Eslogan"></h2>
        <h1 style="margin-left: 80px; font-family: 'Quicksand', sans-serif;">Llego tu momento de viajar</h1>
        <h2 style="margin-left: 140px; font-family: 'Quicksand', sans-serif;">Te lo mereces y nosotros lo sabemos <br> Elige tu destino, dejanos el resto</h2>
    </section>

    <img id="ImgQuien" src="Imagenes/2640740.png" alt="Empresa iconos creados por Eucalyp - Flaticon">
    <section class="sectionInicio" style="float: right;">
        <h2 style="text-align: right; margin-right: 30px;">¿Quiénes Somos? - Aquello que nos separa del resto</h2>
        <p>
            CETI Viajes es una nueva empresa de turismo dedicada a la innovación del servicio en un mercado 
            inundado de sitios poco confiables, obsoletos y poco prácticos. <br><br>
            Nuestra misión es ofrecer las herramientas y servicio al cliente de la mejor calidad, con nuestro sistema innovador 
            y de confianza de la mano de nuestros asesores expertos al diseñar experiencias únicas al precio más accesible <br><br>
            Extendernos y posicionarnos como la mejor herramienta de turismo a lo largo México gracias a la seguridad y confianza 
            con la que atendemos a nuestros clientes es la visión que nos acompaña desde nuestra fundación
        </p>
    </section>

    <section class="sectionInicio" style="float: left;">
        <h2>Nuestra Historia</h2>
        <p>
            Fundada en 2010, nuestra empresa fue creada con la idea de ser una firma de negocios completamente
            digital, para aprovechar al maximo las tecnologías del mañana que día con día se fundamentan como una parte 
            escencial en nuestra vida cotidiana. <br> Nuestro valores se ven de la mano de nuestro directos Héctor Padilla quien,
            año con año, está en constate apoyo de la innovación y accesibilidad en busca de poder llegar a más personas
        </p>
    </section>
    <!--<img id="ImgHistoria" src="Imagenes/2234697.png" alt="Empresa iconos creados por Eucalyp - Flaticon">-->

    <section class="sectionInicio" style="float: right;">
        <h2 style="text-align: right; margin-right: 30px;">Catalogo de Productos</h2>
        <p>
            La Agencia solo está asociada con los destinos turisticos más importantes y de renombre del país, por ello en nuestra página
            podrá encontrar experiencias para todos los gustos, como la gran e imponente capital del país, Cuidad de México. <br> Podrá visitar las hermosas
            playas en Puerto Vallarta, Acapulco o Mazatlán e incluso adentrase en la historia del pueblo de México en destinos como Mérida, Teotihuacán,
            Veracruz y Queretaro. <br> Estos y muchos destinos más le esperan de la mano de los mejores hoteles, quienes respaldan nuestro viajes para hacer
            sus vacaciones aún más inolvidables
        </p>
    </section>
    <img id="ImgProductos" src="Imagenes/4524932.png" alt="Empresa iconos creados por Eucalyp - Flaticon">
    
</body>

<footer>
    <p>Hecho por Héctor Mariano Padilla Rodríguez - 21310386</p>
</footer>

</html>