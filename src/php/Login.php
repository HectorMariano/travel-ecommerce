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
    <link rel="stylesheet" href="Login.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&family=Roboto+Condensed:ital,wght@1,300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Shadows+Into+Light&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@500&display=swap" rel="stylesheet">

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
    
    <section id="Visualizar">
    <?php

        if(!isset($_SESSION['usuario'])){

            echo '<section id="Fondo">';

            echo '<h3>Ingrese sus Datos <br> para Iniciar Sesión</h3>';

            echo '<form style="padding-left: 4%;" method = "POST">';
            echo '<label>Nombre de Usuario:</label><br>';
            echo '<input type="text" id="Nombre_User" name="Nombre_User" placeholder="Heptor123" required><br><br>';

            echo '<label>Contraseña:</label><br>';
            echo '<input type="password" id="Password" name="Password" placeholder="***********" required><br><br>';

            echo '<input class="Btn" style="font-size: 1.4em; margin-top: 4%;" name="enviar" type="submit" id="btnEnviar" value="Iniciar Sesión">';
            echo '</form>';
        }else{
            echo $_SESSION['usuario'];
        }
    ?>

        <?php

            if(isset ($_POST['enviar'])){
                $User = $_POST['Nombre_User'];
                $Password = $_POST['Password'];

                $conexion = mysqli_connect("127.0.0.1","root","123456789") or die ("Error en la conexión con la base de datos");
                #Selección de la base de datos
                mysqli_select_db($conexion, "cetiviajes") or die ("Error en la selección de la base de datos");
                #Consulta para insertar
		        $sql = "SELECT `nombre`, `password`, `apellido`, `usuario`, `correo`, `telefono` FROM `usuarios` WHERE usuario = '$User' AND password = '$Password'";

                if($res = mysqli_query($conexion, $sql)){

                    if(mysqli_num_rows($res) > 0){ 
                        echo '<section style="text-align: center;">';
                        echo '<p class="Mensaje">Los Datos son Correctos <br> Espere un Momento mientras se inicia su sesión...</p>';
                        echo '</section>';
                        $_SESSION["usuario"] = $User;
                        echo '<META HTTP-EQUIV="REFRESH" CONTENT="4; URL=index.php">';
                        mysqli_close($conexion);
                    }
                    else{

                        $sql = "SELECT `usuario`, `nombre`, `correo`, `password` FROM `admins` WHERE usuario = '$User' AND password = '$Password'";
                        
                        if($res = mysqli_query($conexion, $sql)){
                            
                            if(mysqli_num_rows($res) > 0){ 
                                echo '<section style="text-align: center;">';
                                echo '<p class="Mensaje">Administrador Aceptado <br> Espere un Momento mientras se inicia su sesión...</p>';
                                echo '</section>';
                                $_SESSION["admin"] = $User;
                                echo '<META HTTP-EQUIV="REFRESH" CONTENT="4; URL=index.php">';
                                mysqli_close($conexion);
                            }
                            else{

                                echo '<p class="Mensaje">ERROR <br> El registro no existe o los datos son incorrectos</p>';
                                echo '<META HTTP-EQUIV="REFRESH" CONTENT="4; URL=Login.php">';
                            }
                        }
                        
                    }
                }
            }
        ?>

    </section>
    
    </section>

</body>

<footer>
    <p>Hecho por Héctor Mariano Padilla Rodríguez - 21310386</p>
</footer>

</html>