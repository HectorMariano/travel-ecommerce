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

            if(isset($_GET['transportista'])){

                $transportista = $_GET['transportista'];
                $conexion = mysqli_connect("127.0.0.1","root","123456789") or die ("Error en la conexión con la base de datos");
                #Selección de la base de datos
                mysqli_select_db($conexion, "cetiviajes") or die ("Error en la selección de la base de datos");
                $Resultado = mysqli_query($conexion, "SELECT * FROM `agencia` WHERE `nombre` = '".$transportista."';");
                
                while($row = mysqli_fetch_array($Resultado)){

                echo'<form method="POST">';
                echo'<label style="font-weight: bold;"> --- Formulario Edición Agencia de Transporte ---</label><br><br>';

                echo'<label for="nombre">Nombre: </label><br>';
                echo'<input type="text" id="nombre" name="nombre" required placeholder="Fiesta Travel" value="'.$row['nombre'].'"><br>';

                echo'<label for="coste">Coste: </label><br>';
                echo'$ <input type="number" id="coste" name="coste" required placeholder="1000" style="width: 16%;" min="1" value="'.$row['coste'].'"><br>';

                echo'<label for="tipo">Tipo de Transporte: </label><br>';
                echo'<input type="text" id="tipo" name="tipo" required placeholder="Avión" value="'.$row['transporte'].'"><br>';

                echo'<label for="categoria">Categoria Asiento: </label><br>';
                echo'<input type="text" id="categoria" name="categoria" required placeholder="Transporte de Lujo o Económico" style="width: 80%;" value="'.$row['categoria'].'"><br>';

                echo'<label for="rating">Rating del Establecimiento: </label><br>';
                echo'<input type="number" id="rating" name="rating" required placeholder="8.0" step="0.1" min="1.0" max="10" style="width: 12%;" value="'.$row['rating'].'"><br>';

                echo'<input class="Btn" style="font-size: 1.4em; margin-top: 4%; width: 70%; border: 2px solid #ffffff; background-color: #79f4fb;';
                echo'cursor: pointer; font-size: 25px;" name="editar" type="submit" id="btnEnviar" value="Registrar"><br>';

                    if(isset($_POST['editar'])){
                        
                        $nombre_aux = $_GET['transportista'];
                        $nombre = $_POST['nombre'];
                        $coste = $_POST['coste'];
                        $transporte = $_POST['tipo'];
                        $categoria = $_POST['categoria'];
                        $rating = $_POST['rating'];

                        $conexion = mysqli_connect("127.0.0.1","root","123456789") or die ("Error en la conexión con la base de datos");
                        #Selección de la base de datos
                        mysqli_select_db($conexion, "cetiviajes") or die ("Error en la selección de la base de datos");
                        
                        $sql = "UPDATE agencia SET nombre='$nombre', transporte='$transporte', rating='$rating', categoria='$categoria', coste='$coste' WHERE nombre='$nombre_aux'";
                        $consulta = mysqli_query($conexion, $sql);
                        
                        if($consulta==true){ 
                            echo 'Actualización Exitosa';
                            echo '<META HTTP-EQUIV="REFRESH" CONTENT="2; URL=ModificarRegistros.php">';
                        }
                        else {
                            echo "Error en la Actualización";
                            mysqli_close($conexion);
                            echo '<META HTTP-EQUIV="REFRESH" CONTENT="2; URL=ModificarRegistros.php">';
                        }

                    }
                

                echo '</form>';
                }
            }
            else{

                echo'<form method="POST">';
                echo'<label style="font-weight: bold;"> --- Formulario Registro Agencia de Transporte ---</label><br><br>';

                echo'<label for="nombre">Nombre: </label><br>';
                echo'<input type="text" id="nombre" name="nombre" required placeholder="Fiesta Travel"><br>';

                echo'<label for="coste">Coste: </label><br>';
                echo'$ <input type="number" id="coste" name="coste" required placeholder="1000" style="width: 16%;" min="1"><br>';

                echo'<label for="tipo">Tipo de Transporte: </label><br>';
                echo'<input type="text" id="tipo" name="tipo" required placeholder="Avión"><br>';

                echo'<label for="categoria">Categoria Asiento: </label><br>';
                echo'<input type="text" id="categoria" name="categoria" required placeholder="Transporte de Lujo o Económico" style="width: 80%;"><br>';

                echo'<label for="rating">Rating del Establecimiento: </label><br>';
                echo'<input type="number" id="rating" name="rating" required placeholder="8.0" step="0.1" min="1.0" max="10" style="width: 12%;"><br>';

                echo'<input class="Btn" style="font-size: 1.4em; margin-top: 4%; width: 70%; border: 2px solid #ffffff; background-color: #79f4fb;';
                echo'cursor: pointer; font-size: 25px;" name="enviar" type="submit" id="btnEnviar" value="Registrar"><br>';

                    if(isset($_POST['enviar'])){

                        $nombre = $_POST['nombre'];
                        $coste = $_POST['coste'];
                        $transporte = $_POST['tipo'];
                        $categoria = $_POST['categoria'];
                        $rating = $_POST['rating'];

                        $conexion = mysqli_connect("127.0.0.1","root","123456789") or die ("Error en la conexión con la base de datos");
                        #Selección de la base de datos
                        mysqli_select_db($conexion, "cetiviajes") or die ("Error en la selección de la base de datos");

                        $consulta = mysqli_query($conexion, "INSERT INTO `agencia` (`nombre`, `transporte`, `rating`, `categoria`, `coste`) VALUES 
                        ('$nombre', '$transporte', '$rating', '$categoria', '$coste');");
                        
                        if($consulta==true){ 
                            echo 'Registro Exitoso';
                            echo '<META HTTP-EQUIV="REFRESH" CONTENT="2; URL=ModificarTransportista.php">';
                        }
                        else {
                            echo "Error en el Registro";
                            mysqli_close($conexion);
                            echo '<META HTTP-EQUIV="REFRESH" CONTENT="2; URL=ModificarTransportista.php">';
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