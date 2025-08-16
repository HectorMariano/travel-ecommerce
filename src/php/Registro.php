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
        
        <?php
            if(isset($_SESSION['usuario'])){
                echo '<li><a href="CerrarSesion.php">Cerrar Sesión</a></li>';
                echo '<li><a href="">Carrito</a></li>';
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

    <section id="Caja_Formulario">
        <img src="Imagenes/1177568.png" alt="Usuario">

        <div>
            <form method = "POST">
            <table style="width: 100%;">
                <tr>
                    <th>
                        <label>Primer Nombre:</label><br>
                        <input type="text" id="Primer_N" name="Primer_N" placeholder="Héctor" required><br><br>
                    </th>
                    <th>
                        <label>Contraseña:</label><br>
                        <input type="password" id="Password" name="Password" placeholder="***********" required><br><br>
                    </th>
                </tr>
                <tr>
                    <th>
                        <label>Ultimo Apellido:</label><br>
                        <input type="text" id="Ultimo_N" name="Ultimo_N" placeholder="Rodríguez" required><br><br>
                    </th>
                    <th>
                        <label>Confirmar Contraseña:</label><br>
                        <input type="password" id="Password2" name="Password2" placeholder="***********" required><br><br>
                    </th>
                </tr>
                <tr>
                    <th>
                        <label>Nombre de Usuario:</label><br>
                        <input type="text" id="Nombre_User" name="Nombre_User" placeholder="Heptor123" required><br><br>
                    </th>
                        
                    <th>
                        <label>Número de Telefono:</label><br>
                        <input type="text" id="Telefono" name="Telefono" placeholder="33 3641 3250"  minlength="8" maxlength="10" required><br><br>
                    </th>
                </tr>
                <tr>
                    <th>
                        <label>Correo:</label><br>
                        <input type="email" id="Correo" name="Correo" required placeholder="ejemplo123@ceti.mx"><br><br>
                    </th>
                    <th>
                        <input class="Btn" style="font-size: 1.4em; margin-top: 4%;" name="enviar" type="submit" id="btnEnviar" value="Registrarse"> 
                    </th>
                </tr>
            </table>
            
            </form>
        
            <?php
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
                            echo '<p class="Mensaje">Registro Completado Correctamente <br> Inicie Sesión para disfrutar su nueva membresía</p>';
                            echo '<META HTTP-EQUIV="REFRESH" CONTENT="2">';
                            echo '</section>';
                        }
                        else {
                            echo "Error en la consulta";
                            mysqli_close($conexion);
                        }

                    }else{
                        echo '<section style="text-align: center;">';
                        echo '<p class="Mensaje">ERROR <br> Las Contraseñas no Coinciden <br> Espere un Momento...</p>';
                        echo '</section>';
                        echo '<META HTTP-EQUIV="REFRESH" CONTENT="2">';
                    }

                
                }
            ?>
            
        </div>
    </section>

</body>

</html>