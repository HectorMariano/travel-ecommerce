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

<body id="Modificacion">
    <section class="EspacioVacio"></section>

    <section id="ModificarDestino">
        <img src="" alt="">

        <?php

            if(isset($_GET['destino'])){

                $destino = $_GET['destino'];
                $conexion = mysqli_connect("127.0.0.1","root","123456789") or die ("Error en la conexión con la base de datos");
                #Selección de la base de datos
                mysqli_select_db($conexion, "cetiviajes") or die ("Error en la selección de la base de datos");
                $Resultado = mysqli_query($conexion, "SELECT * FROM `destinos` WHERE `Nombre` = '".$destino."';");

                while($row = mysqli_fetch_array($Resultado)){

                    echo'<form method="POST" enctype="multipart/form-data">';
                    echo'<label style="font-weight: bold;"> --- Formulario Edición de Destino ---</label><br><br>';

                    echo'<label for="destino">Nombre:</label><br>';
                    echo'<input type="text" id="destino" name="destino" required placeholder="Cascada Azul" value="'.$row['nombre'].'"><br>';

                    echo'<label for="estado">Estado: </label><br>';
                    echo'<input type="text" id="estado" name="estado" required placeholder="CDMX" value="'.$row['estado'].'"><br>';

                    echo'<label for="descrip">Descripción:</label><br>';
                    echo'<textarea name="descrp" rows="8" cols="40" placeholder="Ubicado entre las ciudades del Estado de México y..." required>'.$row['descripcion'].'</textarea><br>';

                    echo'<label for="img">Imagen Actual - '.$row['imagen'].'</label><br>';
                    echo'<img src = "Destinos/'.$row['imagen'].'"><br>';

                    echo'<label for="img">Imagen (Maximo 5MB)</label><br>';
                    echo'<input type="file" id="imagen" name="imagen" accept="image/png, image/jpg, image/jpeg" style="border-bottom: 0px;"><br>';

                    echo'<input class="Btn" style="font-size: 1.4em; margin-top: 4%; width: 70%; border: 2px solid #ffffff; background-color: #79f4fb;';
                    echo'cursor: pointer; font-size: 25px;" name="editar" type="submit" id="btnEnviar" value="Registrar"><br>';

                    if(isset($_POST['editar'])){
                        $file = $_FILES["imagen"]["name"];

                        if($file == ""){
                            $nombre = $_POST['destino'];
                            $nombre_aux= $_GET['destino'];
                            $estado = $_POST['estado'];
                            $descripcion = $_POST['descrp'];

                            $conexion = mysqli_connect("127.0.0.1","root","123456789") or die ("Error en la conexión con la base de datos");
                            #Selección de la base de datos
                            mysqli_select_db($conexion, "cetiviajes") or die ("Error en la selección de la base de datos");
                            $sql = "UPDATE destinos SET nombre='$nombre', estado='$estado', descripcion='$descripcion' WHERE nombre='$nombre_aux'";

                            $consulta = mysqli_query($conexion, $sql);
                            
                            if($consulta==true){ 
                                echo 'Registro Actualizado';
                                echo '<META HTTP-EQUIV="REFRESH" CONTENT="2; URL=ModificarRegistros.php">';
                            }
                            else {
                                echo "Error en el Registro";
                                mysqli_close($conexion);
                                echo '<META HTTP-EQUIV="REFRESH" CONTENT="2; URL=Modificar?destino='.$nombre.'.php">';
                            } 
                        }

                        else if($_FILES["imagen"]["error"] > 0){

                            echo "Error al Cargar la Imagen";
                            echo '<META HTTP-EQUIV="REFRESH" CONTENT="2; URL=Modificar?destino='.$nombre.'.php">';
                        }
                        else{

                            $extension = array("image/png", "image/jpg", "image/jpeg");
                            if(in_array($_FILES['imagen']['type'], $extension) && $_FILES['imagen']['size'] <= (5000*1024)){

                                $nombre = $_POST['destino'];
                                $nombre_aux= $_GET['destino'];
                                $estado = $_POST['estado'];
                                $descripcion = $_POST['descrp'];
                                $imagen = $_FILES['imagen']['name'];
                                $operacion = move_uploaded_file($_FILES['imagen']['tmp_name'], 'Destinos/'.$imagen);
                                
                                if($operacion){

                                    $conexion = mysqli_connect("127.0.0.1","root","123456789") or die ("Error en la conexión con la base de datos");
                                    #Selección de la base de datos
                                    mysqli_select_db($conexion, "cetiviajes") or die ("Error en la selección de la base de datos");
                                    $sql = "UPDATE destinos SET nombre='$nombre', estado='$estado', descripcion='$descripcion', imagen='$imagen' WHERE nombre='$nombre_aux'";

                                    $consulta = mysqli_query($conexion, $sql);
                                    
                                    if($consulta==true){ 
                                        echo 'Registro Actualizado';
                                        echo '<META HTTP-EQUIV="REFRESH" CONTENT="2; URL=ModificarRegistros.php">';
                                    }
                                    else {
                                        echo "Error en el Registro";
                                        mysqli_close($conexion);
                                        echo '<META HTTP-EQUIV="REFRESH" CONTENT="2; URL=Modificar?destino='.$nombre.'.php">';
                                    }
                                }
                                else{

                                    echo 'Error al Subir Archivo';
                                    echo '<META HTTP-EQUIV="REFRESH" CONTENT="2; URL=Modificar?destino='.$nombre.'.php">';
                                }

                            }else{

                                echo "Tipo de Archivo o Tamaño no Permitido";
                                echo '<META HTTP-EQUIV="REFRESH" CONTENT="2; URL=Modificar?destino='.$nombre.'.php">';
                            }
                        }

                    }
                    echo '</form>';

                }
            }
            else{

                echo'<form method="POST" enctype="multipart/form-data">';
                    echo'<label style="font-weight: bold;"> --- Formulario Registro de Destino ---</label><br><br>';

                    echo'<label for="destino">Nombre:</label><br>';
                    echo'<input type="text" id="destino" name="destino" required placeholder="Cascada Azul"><br>';

                    echo'<label for="estado">Estado: </label><br>';
                    echo'<input type="text" id="estado" name="estado" required placeholder="CDMX"><br>';

                    echo'<label for="descrip">Descripción:</label><br>';
                    echo'<textarea name="descrp" rows="10" cols="40" placeholder="Ubicado entre las ciudades del Estado de México y..." required></textarea><br>';

                    echo'<label for="img">Imagen (Maximo 5MB)</label><br>';
                    echo'<input type="file" id="imagen" name="imagen" accept="image/png, image/jpg, image/jpeg" style="border-bottom: 0px;"><br>';

                    echo'<input class="Btn" style="font-size: 1.4em; margin-top: 4%; width: 70%; border: 2px solid #ffffff; background-color: #79f4fb;';
                    echo'cursor: pointer; font-size: 25px;" name="enviar" type="submit" id="btnEnviar" value="Registrar"><br>';

                        if(isset($_POST['enviar'])){
                            if($_FILES["imagen"]["error"] > 0){

                                echo "Error al Cargar la Imagen";
                                echo '<META HTTP-EQUIV="REFRESH" CONTENT="2; URL=Modificar.php">';
                            }else{

                                $extension = array("image/png", "image/jpg", "image/jpeg");
                                if(in_array($_FILES['imagen']['type'], $extension) && $_FILES['imagen']['size'] <= (5000*1024)){

                                    $nombre = $_POST['destino'];
                                    $estado = $_POST['estado'];
                                    $descripcion = $_POST['descrp'];
                                    $imagen = $_FILES['imagen']['name'];
                                    $operacion = move_uploaded_file($_FILES['imagen']['tmp_name'], 'Destinos/'.$imagen);
                                    
                                    if($operacion){

                                        $conexion = mysqli_connect("127.0.0.1","root","123456789") or die ("Error en la conexión con la base de datos");
                                        #Selección de la base de datos
                                        mysqli_select_db($conexion, "cetiviajes") or die ("Error en la selección de la base de datos");

                                        $consulta = mysqli_query($conexion, "INSERT INTO `destinos` (`nombre`, `estado`, `descripcion`, `imagen`) VALUES 
                                            ('$nombre', '$estado', '$descripcion', '$imagen');");
                                        
                                        if($consulta==true){ 
                                            echo 'Registro Exitoso';
                                            echo '<META HTTP-EQUIV="REFRESH" CONTENT="2; URL=ModificarDestino.php">';
                                        }
                                        else {
                                            echo "Error en el Registro";
                                            mysqli_close($conexion);
                                            echo '<META HTTP-EQUIV="REFRESH" CONTENT="2; URL=ModificarDestino.php">';
                                        }
                                    }
                                    else{

                                        echo 'Error al Subir Archivo';
                                    }

                                }else{

                                    echo "Tipo de Archivo o Tamaño no Permitido";
                                    echo '<META HTTP-EQUIV="REFRESH" CONTENT="2; URL=Modificar.php">';
                                }
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