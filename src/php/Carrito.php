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
    <link rel="stylesheet" href="carro.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&family=Roboto+Condensed:ital,wght@1,300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Shadows+Into+Light&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Homenaje&display=swap" rel="stylesheet">

    <style>
        body {
            background-image: url(Imagenes/Registro-de-entrada-y-salida-de-personal.jpg);
            background-size: cover;
            width: 98%;
            height: fit-content;
            position: absolute;
            background-position: center center;
            background-attachment: fixed;
        }

        .Btn{
            font-family: 'Dosis', sans-serif;
            cursor: pointer;
            text-decoration: none;
        }
    </style>

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

    <section id="contenedor_general">

        <section id="lista_reservas">

            <div id="inicio">Viajes Reservados</div>
            <div id="tabla">

                <?php

                    $NombreArchivo;
                    if(isset($_SESSION["usuario"])){
                        $user = $_SESSION["usuario"];
                        $NombreArchivo = $user."_pedido.json";
                    }
                    else{
                        $admin = $_SESSION["admin"];
                        $NombreArchivo = $admin."_pedido.json";
                    }
                    $Total = 0;

                    if(file_exists($NombreArchivo)){
                        $archivo = file_get_contents($NombreArchivo);
                        $reservaciones = json_decode($archivo);
                        foreach ($reservaciones as $reserva) {

                            echo'<div>';
                                $conexion = mysqli_connect("127.0.0.1","root","123456789") or die ("Error en la conexión con la base de datos");
                                #Selección de la base de datos
                                mysqli_select_db($conexion, "cetiviajes") or die ("Error en la selección de la base de datos");

                                $Resultado = mysqli_query($conexion, "SELECT * FROM `destinos` WHERE `Nombre` = '".$reserva->{'destino'}."';");
                                while($row = mysqli_fetch_array($Resultado)){
                                    echo '<img class="ImgCarrito" src = "Destinos/'.$row['imagen'].'">';
                                }

                            echo '</div>';

                            echo'<div>';
                                    echo '<p> Viaje a: '.$reserva->{'destino'}.'<br>';
                                    echo 'Estado: '.$reserva->{'estado'}.'<br>';
                                    echo 'Hotel: '.$reserva->{'hotel'}.'<br><br>';
                                    echo 'Reservación Agendada:<br>'.$reserva->{'fecha_salida'}.'<br>';
                                    echo 'Viaje de Vuelta: <br>'.$reserva->{'fecha_regreso'}.'</p>';
                                    echo '</tr>';
                                
                            echo '</div>';

                            echo'<div>';
                                echo '<td><p>$'.$reserva->{'subtotal'}.'</p></td>';
                                
                                echo '<a href="EliminarCarro.php?name='.$reserva->{'destino'}.'&subTotal='.$reserva->{'subtotal'}.'" 
                                        class="Btn" style="font-size: 1em; margin-top: 2%;">Eliminar</a>';

                            echo '</div>';
                            
                            $Total = $Total+$reserva->{'subtotal'};
                            $_SESSION["Total"] = $Total;
                        }
                    }else{
                        echo '<span>Aún no ha agregado nada a su carrito</span>';
                    }
                ?>
            </div>
        </section>


        <?php

            $NombreArchivo;
            if(isset($_SESSION["usuario"])){
                $user = $_SESSION["usuario"];
                $NombreArchivo = $user."_pedido.json";
            }
            else{
                $admin = $_SESSION["admin"];
                $NombreArchivo = $admin."_pedido.json";
            }

            if(file_exists($NombreArchivo)){

                echo '<div id="reporte_precio">';
                        
                echo '<span>-- RESUMEN --</span>';
                echo '<br><br><br>';

                echo '<span>CÓDIGO PROMOCIONAL ACTIVO:</span><br>';
                echo '<span style="margin-left: 2%;">CetiViaja23</span><br><br><br>';
            
            
                echo '<span>SUBTOTAL </span>';
                echo '<span style="margin-left: 49%;">$'.$_SESSION["Total"].'</span><br><br>';

                $IVA = ($_SESSION["Total"]*.16) + $_SESSION["Total"];
                echo '<span>TOTAL (IVA INCLUIDO) </span>';
                echo '<span style="margin-left: 18%;">$'.$IVA.'</span><br>';

                echo '<br><br><br><br>';
                echo'<form action="CrearPdf.php">';
                echo'<input class="BtnPagar" name="pagar" type="submit" id="btnPagar" value="COMPLETAR PAGO">';
                echo'</form>';

                echo '</div>';
                echo '</section>';
            }
        ?>    

</body>

</html>