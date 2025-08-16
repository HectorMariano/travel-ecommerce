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
    <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@500&display=swap" rel="stylesheet">

    <style>

        .Btn{
            width: 92%;
            border: 2px solid #ffffff;
            background-color: #79f4fb;
            font-family: 'Dosis', sans-serif;
            cursor: pointer;
        }

        .Mensaje{
            font-family: 'Dosis', sans-serif;
            font-size: 1.5em;
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
    <section id="Caja_Formulario">
        <img src="Imagenes/1177568.png" alt="Usuario">

        <?php

            if(isset($_GET['usuario'])){
            
                $nom_usuario = $_GET['usuario'];
                $conexion = mysqli_connect("127.0.0.1","root","123456789") or die ("Error en la conexión con la base de datos");
                #Selección de la base de datos
                mysqli_select_db($conexion, "cetiviajes") or die ("Error en la selección de la base de datos");
                $Resultado = mysqli_query($conexion, "SELECT * FROM `usuarios` WHERE `nombre` = '".$nom_usuario."';");
                
                while($row = mysqli_fetch_array($Resultado)){

                    echo'<div>';
                    echo'<form method = "POST">';
                        echo'<table style="width: 100%;">';
                            echo'<span>--- Formulario para Agregar Usuario ---</span><br><br><br>';
                            
                            echo'<tr>';
                                echo'<th>';
                                    echo'<label>Primer Nombre:</label><br>';
                                    echo'<input type="text" id="Primer_N" name="Primer_N" placeholder="Héctor" required value="'.$row['nombre'].'"><br><br>';
                                echo'</th>';

                                echo'<th>';
                                    echo'<label>Contraseña:</label><br>';
                                    echo'<input type="text" id="Password" name="Password" placeholder="***********" required value="'.$row['password'].'"><br><br>';
                                echo'</th>';
                            echo'</tr>';

                            echo'<tr>';
                                echo'<th>';
                                    echo'<label>Ultimo Apellido:</label><br>';
                                    echo'<input type="text" id="Ultimo_N" name="Ultimo_N" placeholder="Rodríguez" required value="'.$row['apellido'].'"><br><br>';
                                echo'</th>';

                                echo'<th>';
                                    echo'<label>Confirmar Contraseña:</label><br>';
                                    echo'<input type="text" id="Password2" name="Password2" placeholder="***********" required value="'.$row['password'].'"><br><br>';
                                echo'</th>';
                            echo'</tr>';

                            echo'<tr>';
                                echo'<th>';
                                    echo'<label>Nombre de Usuario:</label><br>';
                                    echo'<input type="text" id="Nombre_User" name="Nombre_User" placeholder="Heptor123" required value="'.$row['usuario'].'"><br><br>';
                                echo'</th>';

                                echo'<th>';
                                    echo'<label>Número de Telefono:</label><br>';
                                    echo'<input type="text" id="Telefono" name="Telefono" placeholder="33 3641 3250"  minlength="8" maxlength="10" required value="'.$row['telefono'].'"><br><br>';
                                echo'</th>';
                            echo'</tr>';

                            echo'<tr>';
                                echo'<th>';
                                    echo'<label>Correo:</label><br>';
                                    echo'<input type="email" id="Correo" name="Correo" required placeholder="ejemplo123@ceti.mx" value="'.$row['correo'].'"><br><br>';
                                echo'</th>';

                                echo'<th>';
                                    echo'<input class="Btn" style="font-size: 1.4em; margin-top: 4%;" name="editar" type="submit" id="btnEnviar" value="Editar Usuario"> ';
                                echo'</th>';
                            echo'</tr>';
                        echo'</table>';

                    if(isset ($_POST['editar'])) {

                        $nom_usuario = $_GET['usuario'];
                        $Nombre = $_POST['Primer_N'];
                        $Apellido = $_POST['Ultimo_N'];
                        $User = $_POST['Nombre_User'];
                        $Telefono = $_POST['Telefono'];
                        $Correo = $_POST['Correo'];
                        $Password = $_POST['Password'];
                        $Password2 = $_POST['Password2'];
                    
                        if (strcmp($Password, $Password2) === 0){
                        
                            $conexion = mysqli_connect("127.0.0.1","root","123456789") or die ("Error en la conexión con la base de datos");
                            #Selección de la base de datos
                            mysqli_select_db($conexion, "cetiviajes") or die ("Error en la selección de la base de datos");
                        
                            $sql = "UPDATE usuarios SET nombre='$Nombre', password='$Password', apellido='$Apellido', usuario='$User', correo='$Correo', telefono='$Telefono' WHERE nombre='$nom_usuario'";
                            $consulta = mysqli_query($conexion, $sql);
                            
                            if($consulta==true){ 
                                echo '<section style="text-align: center;">';
                                echo '<p class="Mensaje">Registro Completado Correctamente</p>';
                                echo '<META HTTP-EQUIV="REFRESH" CONTENT="2; URL=ModificarRegistros.php">';
                                echo '</section>';
                            }
                            else {
                                echo "Error en la Actualización";
                                mysqli_close($conexion);
                                echo '<META HTTP-EQUIV="REFRESH" CONTENT="2">';
                            }
                        
                        }else{
                            echo '<section style="text-align: center;">';
                            echo '<p class="Mensaje">ERROR <br> Las Contraseñas no Coinciden <br> Espere un Momento...</p>';
                            echo '</section>';
                            echo '<META HTTP-EQUIV="REFRESH" CONTENT="2">';
                        }
                    }
                    
                    echo'</form>';
                    echo '</div>';

                }

            }
            else{

                echo'<div>';
                    echo'<form method = "POST">';
                        echo'<table style="width: 100%;">';
                            echo'<span>--- Formulario para Agregar Usuario ---</span><br><br><br>';
                            
                            echo'<tr>';
                                echo'<th>';
                                    echo'<label>Primer Nombre:</label><br>';
                                    echo'<input type="text" id="Primer_N" name="Primer_N" placeholder="Héctor" required><br><br>';
                                echo'</th>';

                                echo'<th>';
                                    echo'<label>Contraseña:</label><br>';
                                    echo'<input type="text" id="Password" name="Password" placeholder="***********" required><br><br>';
                                echo'</th>';
                            echo'</tr>';

                            echo'<tr>';
                                echo'<th>';
                                    echo'<label>Ultimo Apellido:</label><br>';
                                    echo'<input type="text" id="Ultimo_N" name="Ultimo_N" placeholder="Rodríguez" required><br><br>';
                                echo'</th>';

                                echo'<th>';
                                    echo'<label>Confirmar Contraseña:</label><br>';
                                    echo'<input type="text" id="Password2" name="Password2" placeholder="***********" required><br><br>';
                                echo'</th>';
                            echo'</tr>';

                            echo'<tr>';
                                echo'<th>';
                                    echo'<label>Nombre de Usuario:</label><br>';
                                    echo'<input type="text" id="Nombre_User" name="Nombre_User" placeholder="Heptor123" required><br><br>';
                                echo'</th>';

                                echo'<th>';
                                    echo'<label>Número de Telefono:</label><br>';
                                    echo'<input type="text" id="Telefono" name="Telefono" placeholder="33 3641 3250"  minlength="8" maxlength="10" required><br><br>';
                                echo'</th>';
                            echo'</tr>';

                            echo'<tr>';
                                echo'<th>';
                                    echo'<label>Correo:</label><br>';
                                    echo'<input type="email" id="Correo" name="Correo" required placeholder="ejemplo123@ceti.mx"><br><br>';
                                echo'</th>';

                                echo'<th>';
                                    echo'<input class="Btn" style="font-size: 1.4em; margin-top: 4%;" name="enviar" type="submit" id="btnEnviar" value="Registrar"> ';
                                echo'</th>';
                            echo'</tr>';
                        echo'</table>';

                    if(isset ($_POST['enviar'])) {

                        $Nombre = $_POST['Primer_N'];
                        $Apellido = $_POST['Ultimo_N'];
                        $User = $_POST['Nombre_User'];
                        $Telefono = $_POST['Telefono'];
                        $Correo = $_POST['Correo'];
                        $Password = $_POST['Password'];
                        $Password2 = $_POST['Password2'];
                    
                        if (strcmp($Password, $Password2) === 0){
                        
                            $conexion = mysqli_connect("127.0.0.1","root","123456789") or die ("Error en la conexión con la base de datos");
                            #Selección de la base de datos
                            mysqli_select_db($conexion, "cetiviajes") or die ("Error en la selección de la base de datos");
                        
                            $consulta = mysqli_query($conexion, "INSERT INTO `usuarios` (`nombre`, `password`, `apellido`, `usuario`, `correo`, `telefono`) VALUES 
                                ('$Nombre', '$Password', '$Apellido', '$User', '$Correo', '$Telefono');");

                            if($consulta==true){ 
                                echo '<section style="text-align: center;">';
                                echo '<p class="Mensaje">Registro Completado Correctamente</p>';
                                echo '<META HTTP-EQUIV="REFRESH" CONTENT="2">';
                                echo '</section>';
                            }
                            else {
                                echo "Error en la consulta";
                                mysqli_close($conexion);
                                echo '<META HTTP-EQUIV="REFRESH" CONTENT="2">';
                            }
                        
                        }else{
                            echo '<section style="text-align: center;">';
                            echo '<p class="Mensaje">ERROR <br> Las Contraseñas no Coinciden <br> Espere un Momento...</p>';
                            echo '</section>';
                            echo '<META HTTP-EQUIV="REFRESH" CONTENT="2">';
                        }
                    }

                    echo'</form>';
                    echo '</div>';

            }

        ?>


        
    </section>

</body>

</html>