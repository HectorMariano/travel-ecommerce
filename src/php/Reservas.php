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
    <link rel="stylesheet" href="Reservas.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&family=Roboto+Condensed:ital,wght@1,300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Shadows+Into+Light&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Raleway&display=swap" rel="stylesheet">


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
                echo '<li><a href="ModificarRegistros.php">Modificar Registros</a></li>';
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

    <section id="TablaDestino">
      <table>
            <tr>
            <?php
                $salto = 0;
                $conexion = mysqli_connect("127.0.0.1","root","123456789") or die ("Error en la conexión con la base de datos");
                #Selección de la base de datos
                mysqli_select_db($conexion, "cetiviajes") or die ("Error en la selección de la base de datos");

                if(isset ($_POST['busqueda'])) {
                    
                    $busqueda = $_POST['busqueda'];
                    $criterio = $_POST['criterio'];

                    //$Resultado = mysqli_query($conexion, "SELECT * FROM `destinos` WHERE '".$busqueda."' = '".$criterio."';");
                    $sql = "SELECT * FROM `destinos` WHERE $criterio = '$busqueda'";

                    if($res = mysqli_query($conexion, $sql)){   
                        if(mysqli_num_rows($res) > 0){ 

                            if(mysqli_num_rows($res) == 1){
                                
                                $Resultado = mysqli_query($conexion, "SELECT * FROM `destinos` WHERE $criterio = '".$busqueda."';");
                                while($fila = mysqli_fetch_array($Resultado)){
                        
                                    echo'<td>';
                                    echo '<div><br><br>';
                                    echo $fila["descripcion"];
                                    echo '<br><br><br>';
                                    //echo "Aqui va el coste";
                                    echo '</div>';
            
                                    echo '<img src="Destinos/'.$fila["imagen"].'" alt="'.$fila["nombre"].'"><br>';
                                    echo '<a href="Destino.php?destino='.$fila["nombre"].'">'.$fila["nombre"].' - '.$fila["estado"].'</a>';
                                    echo '</td> <td></td>   <td></td>';
                                }
                            }
                            else if(mysqli_num_rows($res) == 2){
                                
                                $Resultado = mysqli_query($conexion, "SELECT * FROM `destinos` WHERE $criterio = '".$busqueda."';");
                                while($fila = mysqli_fetch_array($Resultado)){
                        
                                    echo'<td>';
                                    echo '<div><br><br>';
                                    echo $fila["descripcion"];
                                    echo '<br><br><br>';
                                    //echo "Aqui va el coste";
                                    echo '</div>';
            
                                    echo '<img src="Destinos/'.$fila["imagen"].'" alt="'.$fila["nombre"].'"><br>';
                                    echo '<a href="Destino.php?destino='.$fila["nombre"].'">'.$fila["nombre"].' - '.$fila["estado"].'</a>';
                                    echo '</td> <td></td>';
                                }
                            }
                            else if(mysqli_num_rows($res) >= 3){
                                
                                $Resultado = mysqli_query($conexion, "SELECT * FROM `destinos` WHERE $criterio = '".$busqueda."';");
                                while($fila = mysqli_fetch_array($Resultado)){
                        
                                    echo'<td>';
                                    echo '<div><br><br>';
                                    echo $fila["descripcion"];
                                    echo '<br><br><br>';
                                    //echo "Aqui va el coste";
                                    echo '</div>';
            
                                    echo '<img src="Destinos/'.$fila["imagen"].'" alt="'.$fila["nombre"].'"><br>';
                                    echo '<a href="Destino.php?destino='.$fila["nombre"].'">'.$fila["nombre"].' - '.$fila["estado"].'</a>';
                                    echo '</td>';
                                    $salto++;
            
                                    if(($salto%3) == 0){
                                        echo '</tr><tr>';
                                    }
                                }
                            }


                        }
                        else{
                            echo '<p class="Mensaje">ERROR <br> El registro no existe o los datos son incorrectos</p>';
                            echo '<META HTTP-EQUIV="REFRESH" CONTENT="3; URL=Reservas.php">';
                        }
                    }

                   /* while($fila = mysqli_fetch_array($Resultado)){
                    
                        echo'<td>';
                        echo '<div><br><br>';
                        echo $fila["descripcion"];
                        echo '<br><br><br>';
                        //echo "Aqui va el coste";
                        echo '</div>';

                        echo '<img src="'.$fila["imagen"].'" alt="'.$fila["nombre"].'"><br>';
                        echo '<a href="Destino.php?destino='.$fila["nombre"].'">'.$fila["nombre"].' - '.$fila["estado"].'</a>';
                        echo '</td>';
                        $salto++;

                        if(($salto%3) == 0){
                            echo '</tr><tr>';
                        }
                    }*/

                }
                else{

                    $Resultado = mysqli_query($conexion, "SELECT * FROM `destinos`;");
                    //$Resultado2 = mysqli_query($conexion, "SELECT * FROM `hospedaje`;");
                    
                    while($fila = mysqli_fetch_array($Resultado)){
                        
                        echo'<td>';
                        echo '<div><br><br>';
                        echo $fila["descripcion"];
                        echo '<br><br><br>';
                        //echo "Aqui va el coste";
                        echo '</div>';

                        echo '<img src="Destinos/'.$fila["imagen"].'" alt="'.$fila["nombre"].'"><br>';
                        echo '<a href="Destino.php?destino='.$fila["nombre"].'">'.$fila["nombre"].' - '.$fila["estado"].'</a>';
                        echo '</td>';
                        $salto++;

                        if(($salto%3) == 0){
                            echo '</tr><tr>';
                        }
                    }
                }
     


                
            ?>

            
        </table>
    </section>

    <section id="NavegadorLateral">
        <h4>Filtrar Resultados</h4><br>
        <a href="#">- Mejor Puntuación</a><br>
        <a href="">- Disponibilidad</a><br>
        <a href="">- Ubicación</a><br>
        <a href="">- Precio de Viaje</a><br><br>

        <form id="BarraBusqueda" method = "POST">
            <input type="search" name="busqueda" placeholder="Estado, Municipio, ...">

            <select name="criterio" id="criterio">
                <option value="nombre">Nombre</option>
                <option value="estado">Estado</option>
            </select>

            <input type="submit" value="Buscar" style="font-size: 16px;">
        </form>

    </section>


</body>

<footer>
    <p>Hecho por Héctor Mariano Padilla Rodríguez - 21310386</p>
</footer>

</html>