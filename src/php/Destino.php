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
    <link rel="stylesheet" href="Destino.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&family=Roboto+Condensed:ital,wght@1,300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Shadows+Into+Light&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Raleway&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Abel&display=swap" rel="stylesheet">


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

    <section id="Visualizar">
        <?php

            if(isset($_GET['destino'])){
                $_SESSION["destino"] = $_GET['destino'];
                echo '<META HTTP-EQUIV="REFRESH" CONTENT="0; URL=Destino.php">';
            }
        ?>

        <?php

            $conexion = mysqli_connect("127.0.0.1","root","123456789") or die ("Error en la conexión con la base de datos");
            #Selección de la base de datos
            mysqli_select_db($conexion, "cetiviajes") or die ("Error en la selección de la base de datos");

            $id = $_SESSION["destino"];
            $Resultado = mysqli_query($conexion, "SELECT * FROM `destinos` WHERE `Nombre` = '".$id."';");
            $Resultado2 = mysqli_query($conexion, "SELECT * FROM `hospedaje` WHERE `destino` = '".$id."';");

            while($row = mysqli_fetch_array($Resultado)){
               while($row2 = mysqli_fetch_array($Resultado2)){
                        
                echo '<section id="Descripcion">';
                echo '<form action="AgregarCarro.php" method="POST" name="AgregarCarro">';

                echo '<h1 class="Texto" style="color:#000000;">- Nombre del Destino -</h1>';
                echo '<input type="text" name="destino" style="color:#000000;" class="CajasCompra" value="'.$row['nombre'].'" readonly="readonly">';
                echo '<input type="text" name="estado" style="color:#000000;" class="CajasCompra" value="'.$row['estado'].'" readonly="readonly">';
                
                echo '<section class="Auxiliar">';
                echo '<h1 class="Texto" style="color:#000000;">- Hotel <input type="text" name="hotel" style=" color:#000000; width:auto; font-size: 1.0em;" class="CajasCompra" value="'.$row2['nombre'].'" readonly="readonly"> <br>';	
                echo '&nbsp; Rating <input type="text" name="rating_hotel" style=" color:#000000; width:10%; font-size: 1.0em;" class="CajasCompra" value="'.$row2['rating'].'" readonly="readonly"> Estrellas <br>';	
                echo '&nbsp; Costo por Noche $<input type="text" name="costo_noche" style="color:#000000; width:70px; font-size: 1.0em;" class="CajasCompra" value="'.$row2['costo'].'" readonly="readonly">MXN <br>';
                           
                echo '&nbsp; Habitacion Disponible ';
                echo '<select name="tipo_habitacion" id="tipo_habitacion">';
                echo '<option value="'.$row2['tipo_habitacion1'].'">'.$row2['tipo_habitacion1'].'</option>';
                echo '<option value="'.$row2['tipo_habitacion2'].'">'.$row2['tipo_habitacion2'].'</option>';
                echo '</select>';
                echo '</h1>';
                echo '</section>';  //Auxiliar

                echo '<h1 class="Texto" style="color:#000000; margin-bottom: 2%; margin-left: auto; margin-right;">- Agencia de Viajes Recomendada -</h1>';
                echo '<section class="Agencias">';
                $query = "SELECT nombre FROM agencia";
                $espacio = 0;
                                              
                echo '<table> <tr>';
                if($informacion = mysqli_query($conexion, $query)){
                    while($fila = mysqli_fetch_row($informacion)){

                        echo'<td>';
                        echo '<a href="Destino.php?agencia='.$fila[0].'" >'.$fila[0].'</a>';
                        echo'</td>';
                        $espacio ++;

                        if(($espacio%2) == 0){
                            echo '</tr><tr>';
                        }
                    }
                }
                echo '</table>';
                echo '</section>'; //Agencias
                
                if(isset($_GET['agencia'])){
                    $Agencia = $_GET['agencia'];
                    $consulta = mysqli_query($conexion, "SELECT * FROM `agencia` WHERE `nombre` = '".$Agencia."';");

                    while($row3 = mysqli_fetch_array($consulta)){
                        echo '<section class="Auxiliar">';
                        echo '<h1 class="Texto" style="color:#000000; margin-bottom: 2%;">- Agencia <input type="text" name="agencia" style=" color:#000000; width:auto; font-size: 1.0em;" class="CajasCompra" value="'.$row3['nombre'].'" readonly="readonly"> <br>';	
                        echo '&nbsp; Rating <input type="text" name="rating_agencia" style=" color:#000000; width:10%; font-size: 1.0em;" class="CajasCompra" value="'.$row3['rating'].'" readonly="readonly"> Estrellas <br>';	
                        echo '&nbsp; Coste del Viaje $<input type="number" name="costo_viaje" style="color:#000000; width:70px; font-size: 1.0em;" class="CajasCompra" value="'.$row3['coste'].'" readonly="readonly">MXN <br>';
                        echo '&nbsp; Transporte <input type="text" name="transporte_agencia" style=" color:#000000; width:20%; font-size: 1.0em;" class="CajasCompra" value="'.$row3['transporte'].'" readonly="readonly"> <br>';	
                        echo '&nbsp; Clase <input type="text" name="categoria_agencia" style=" color:#000000; width:60%; font-size: 1.0em;" class="CajasCompra" value="'.$row3['categoria'].'" readonly="readonly">';	           

                        echo '</h1>';
                        echo '<br>';

                        if(isset($_SESSION['usuario']) || isset($_SESSION['admin'])){

                            echo '<div class="fecha">';
                            echo '<div>';
                            echo '<label for="dia_salida">Fecha de Salida:</label>';
                            echo '<input type="date" class="estilo_fecha" id="dia_salida" name="dia_salida" value="2023-01-01" min="2023-01-01" max="2023-12-30">';
                            echo '</div>';

                            echo '<div>';
                            echo '<label for="dia_regreso">Fecha de Regreso:</label>';
                            echo '<input type="date" class="estilo_fecha" id="dia_regreso" name="dia_regreso" value="2023-01-02" min="2023-01-02" max="2023-12-31">';
                            echo '</div>';
                            echo '</div>';

                            echo '<input class="Btn" style="font-size: 1.4em; margin-top: 4%;" name="enviar" type="submit" id="btnEnviar" value="Agregar a Carrito">';
                        }
                        echo '</form>';

                        echo '</section>';  //Auxiliar
                    }
                }

                echo '</section>';  //Descripcion

                echo '<img class="ImgDescripcion" src = "Destinos/'.$row['imagen'].'">';
                echo '<section id = "PieImagen">'; 
                echo '<h1 class="Texto" style="color:#000000;">- Descripcion del Lugar -</h1>';
                echo '<h1 class="Texto" style="color:#000000;">'.$row['descripcion'].'</h1>';
                echo '</section>';
                  
                }
            }
        mysqli_close($conexion);
        ?>

        

    </section>
</body>

<footer>
    <p>Hecho por Héctor Mariano Padilla Rodríguez - 21310386</p>
</footer>

</html>