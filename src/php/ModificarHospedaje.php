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
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">

    <style>
        .Btn{
            width: 70%;
            border: 2px solid #ffffff;
            background-color: #79f4fb;
            font-family: 'Dosis', sans-serif;
            cursor: pointer;
            font-size: 10px;
        }

    </style>

</head>

<nav>
    <ul>
        <li style="float: left"><p id="Titulo">CETI VIAJES</p></li>
        <li><a href="ModificarRegistros.php">Regresar</a></li>
    </ul>
</nav>

<body id="Modificacion" style="background-image: url(Imagenes/imagen_adaptada_750X392-10.jpg);">
    <section class="EspacioVacio"></section>

    <section id="ModificarAux">
        
        <?php

            if(isset($_GET['hospedaje'])){
            
                $nombre = $_GET['hospedaje'];
                $conexion = mysqli_connect("127.0.0.1","root","123456789") or die ("Error en la conexión con la base de datos");
                #Selección de la base de datos
                mysqli_select_db($conexion, "cetiviajes") or die ("Error en la selección de la base de datos");

                $resultado = mysqli_query($conexion, "SELECT * FROM `hospedaje` WHERE `nombre` = '".$nombre."';");
                while($row = mysqli_fetch_array($resultado)){

                    echo'<form method="POST">';
                    echo'<label style="font-weight: bold;"> --- Formulario Edición de Hospedaje ---</label><br><br>';
                    echo '<label>Hospedaje registrado para: '.$row['destino'].'</label><br><br>';

                    echo'<label for="nombre">Nombre: </label><br>';
                    echo'<input type="text" id="nombre" name="nombre" required placeholder="Le Resort" value="'.$row['nombre'].'"><br>';

                    echo'<label for="coste">Coste: </label><br>';
                    echo'$ <input type="number" id="coste" name="coste" required placeholder="1000" style="width: 16%;" min="1" value="'.$row['costo'].'"><br>';

                    echo'<label for="tipo1">Tipo de Habitación Disponible: </label><br>';
                    echo'<input type="text" id="tipo1" name="tipo1" required placeholder="Simple" value="'.$row['tipo_habitacion1'].'"><br>';

                    echo'<label for="tipo2">Tipo de Habitación Disponible: </label><br>';
                    echo'<input type="text" id="tipo2" name="tipo2" required placeholder="Doble" value="'.$row['tipo_habitacion2'].'"><br>';

                    echo'<label for="rating">Rating del Establecimiento: </label><br>';
                    echo'<input type="number" id="rating" name="rating" required placeholder="8.0" step="0.1" min="1.0" max="9.9" style="width: 12%;" value="'.$row['rating'].'"><br>'; 
                    
                    echo'<input class="Btn" style="font-size: 1.4em; margin-top: 4%; width: 70%; border: 2px solid #ffffff; background-color: #79f4fb;';
                    echo'cursor: pointer; font-size: 25px;" name="editar" type="submit" id="btnEnviar" value="Editar"><br>';

                    if(isset($_POST['editar'])){

                        $nombre_hospedaje = $_GET['hospedaje'];
                        $nombre = $_POST['nombre'];
                        $costo = $_POST['coste'];
                        $tipo1 = $_POST['tipo1'];
                        $tipo2 = $_POST['tipo2'];
                        $rating = $_POST['rating'];
                    
                        $conexion = mysqli_connect("127.0.0.1","root","123456789") or die ("Error en la conexión con la base de datos");
                        #Selección de la base de datos
                        mysqli_select_db($conexion, "cetiviajes") or die ("Error en la selección de la base de datos");
                        
                        $sql = "UPDATE hospedaje SET nombre='$nombre', costo='$costo', tipo_habitacion1='$tipo1', tipo_habitacion2='$tipo2', rating='$rating' WHERE nombre='$nombre_hospedaje'";
                        $consulta = mysqli_query($conexion, $sql);
                        
                        if($consulta==true){ 

                            echo 'Actualzación Exitosa';
                            echo '<META HTTP-EQUIV="REFRESH" CONTENT="2; URL=ModificarRegistros.php">';
                        }
                        else {
                            echo "Error en el Registro";
                            mysqli_close($conexion);
                        }
                        
                    }
                }

                

            }else{

                $conexion = mysqli_connect("127.0.0.1","root","123456789") or die ("Error en la conexión con la base de datos");
                #Selección de la base de datos
                mysqli_select_db($conexion, "cetiviajes") or die ("Error en la selección de la base de datos");

                echo'<form method="POST">';
                echo'<label style="font-weight: bold;"> --- Formulario Registro de Hospedaje ---</label><br><br>';

                echo'<label for="nombre">Nombre: </label><br>';
                echo'<input type="text" id="nombre" name="nombre" required placeholder="Le Resort"><br>';

                echo'<label for="coste">Coste: </label><br>';
                echo'$ <input type="number" id="coste" name="coste" required placeholder="1000" style="width: 16%;" min="1"><br>';

                echo'<label for="tipo1">Tipo de Habitación Disponible: </label><br>';
                echo'<input type="text" id="tipo1" name="tipo1" required placeholder="Simple"><br>';

                echo'<label for="tipo2">Tipo de Habitación Disponible: </label><br>';
                echo'<input type="text" id="tipo2" name="tipo2" required placeholder="Doble"><br>';

                echo'<label for="rating">Rating del Establecimiento: </label><br>';
                echo'<input type="number" id="rating" name="rating" required placeholder="8.0" step="0.1" min="1.0" max="9.9" style="width: 12%;"><br>';
                
                echo'<label for="destino">Destino al que pertenece disponibles: </label><br>';
                //$sql = "SELECT destinos.nombre FROM destinos INNER JOIN hospedaje ON destinos.nombre = hospedaje.destino";

                $sql = "SELECT * FROM `destinos` WHERE hospedaje IS NULL";
                $resultado = mysqli_query($conexion, $sql);

                if(mysqli_num_rows($resultado) != 0){

                    echo '<select name="destino" id="destino">';
                    while($fila = mysqli_fetch_array($resultado)){
                        echo '<option value="'.$fila['nombre'].'">'.$fila['nombre'].'</option>';
                    }
                    echo '</select>';
                    echo '<br>';    

                    echo'<input class="Btn" style="font-size: 1.4em; margin-top: 4%; width: 70%; border: 2px solid #ffffff; background-color: #79f4fb;';
                    echo'cursor: pointer; font-size: 25px;" name="enviar" type="submit" id="btnEnviar" value="Registrar"><br>';
                }
                else{

                    echo '<br>';
                    echo 'No hay Destinos Disponibles, registre un nuevo destino para continuar';
                    echo '<br>';
                    echo '<a href="ModificarDestino.php">Agregar Destino</a>';
                }


                if(isset($_POST['enviar'])){

                    $nombre = $_POST['nombre'];
                    $costo = $_POST['coste'];
                    $tipo1 = $_POST['tipo1'];
                    $tipo2 = $_POST['tipo2'];
                    $rating = $_POST['rating'];
                    $pertenece = $_POST['destino'];
                
                    $conexion = mysqli_connect("127.0.0.1","root","123456789") or die ("Error en la conexión con la base de datos");
                    #Selección de la base de datos
                    mysqli_select_db($conexion, "cetiviajes") or die ("Error en la selección de la base de datos");
                    
                    $consulta = mysqli_query($conexion, "INSERT INTO `hospedaje` (`nombre`, `costo`, `tipo_habitacion1`, `tipo_habitacion2`, `rating` , `destino`)
                    VALUES ('$nombre', '$costo', '$tipo1', '$tipo2', '$rating', '$pertenece');");
                    
                    if($consulta==true){ 

                        $consulta_aux = mysqli_query($conexion, "UPDATE `destinos` SET hospedaje='$nombre' WHERE nombre='$pertenece';");
                        if($consulta_aux == true){

                            echo 'Registro Exitoso';
                            echo '<META HTTP-EQUIV="REFRESH" CONTENT="2; URL=ModificarHospedaje.php">';
                        }
                        else {
                            echo "Error en el Registro";
                            mysqli_close($conexion);
                        }
                    }
                    else {
                        echo "Error en el Registro";
                        mysqli_close($conexion);
                    }
                    
                }
                echo '</form>';

            }
        ?>    
    </section>

</body>

<!--<footer style="margin-top: 3%;">
    <p>Hecho por Héctor Mariano Padilla Rodríguez - 21310386</p>
</footer>-->

</html>