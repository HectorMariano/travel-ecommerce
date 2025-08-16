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

    <style>
        body{
            background-image: url(Imagenes/f075944a0b75077d5e9510e2984c4427.jpg);
            width: 98%;
            height: fit-content;
            background-position: center center;
            background-attachment: fixed;
        }
    </style>

</head>

<nav>
    <ul>
        <li style="float: left"><p id="Titulo">CETI VIAJES</p></li>
        <li><a href="CerrarSesion.php">Cerrar Sesión</a></li>
        <li><a href="Carrito.php">Carrito</a></li>
        <li><a href="ModificarRegistros.php">Modificar Registros</a></li>
        <li><a href="Reservas.php">Reservar Ahora</a></li>
        <li><a href="index.php">Inicio</a></li>
    </ul>
</nav>

<body>
    <section class="EspacioVacio"></section>

    <section id="NavegadorLateralAux">
        <h4>Seleccione una tabla para comenzar</h4>

        <a href="BuscarRegistros.php?destinos">- Destinos -</a><br>
        <a href="BuscarRegistros.php?hospedaje">- Hospedajes -</a><br>
        <a href="BuscarRegistros.php?agencia">- Agencias -</a><br>
        <a href="BuscarRegistros.php?usuarios">- Usuarios -</a><br><br>

        <?php

            if(isset($_GET['destinos'])){
                echo '<form method = "POST">';

                echo '<input type="search" name="busqueda" placeholder="CDMX    " required>';
                echo '<select name="criterio" id="criterio">';
                    echo '<option value="nombre">Nombre</option>
                          <option value="estado">Estado</option>';
                echo '</select>';
                echo'<input class="Btn" style="margin-top: 4%;" name="enviar" type="submit" id="btnEnviar" value="Buscar">';
                
                echo '</form>';
                echo '</section>';

                if(isset($_POST['enviar'])){
                    $busqueda = $_POST['busqueda'];
                    $criterio = $_POST['criterio'];

                    echo '<section id="Tablas_Modificar" style="width: 77%; margin-left: 5%;">';
                    echo '<div class="Destinos">;

                        <table>
                            <caption style="text-align: left; padding-bottom:30px; font-weight: bold; font-size: 30px;">- Destinos Registrados ---
                            </caption>
                
                            <td style="font-weight: bold;">Nombre</td>
                            <td style="font-weight: bold;">Estado</td>
                            <td style="font-weight: bold; width: 40%;">Descripción</td>
                            <td style="font-weight: bold;">Imagen</td>
                            <td style="font-weight: bold;">Opciones</td>';
             
                            $conexion = mysqli_connect("127.0.0.1","root","123456789") or die ("Error en la conexión con la base de datos");
                            #Selección de la base de datos
                            mysqli_select_db($conexion, "cetiviajes") or die ("Error en la selección de la base de datos");
                            $sql = "SELECT * FROM `destinos` WHERE $criterio = '$busqueda'";
                            $Resultado = mysqli_query($conexion, $sql);
                
                            while($fila = mysqli_fetch_array($Resultado)){
                
                                echo '<tr><td>'.$fila["nombre"].'</td>';
                                echo '<td>'.$fila["estado"].'</td>';
                                echo '<td>'.$fila["descripcion"].'</td>';
                                echo '<td> <img src = "Destinos/'.$fila['imagen'].'"></td>';
                                echo '<td> <a href="ModificarDestino.php?destino='.$fila["nombre"].'">Editar</a> 
                                    <a href="ModificarRegistros.php?registro='.$fila["nombre"].'&tabla=destinos&criterio=nombre">Eliminar</a> </td></tr>';
                            }
                            
                
                        echo '</table>';
            
                    echo '</div>';
                    echo '</section>';

                }

                
            }

            else if(isset($_GET['hospedaje'])){
                echo '<form method = "POST">';

                echo '<input type="search" name="busqueda" placeholder="Resort Hotels" required>';
                echo '<select name="criterio" id="criterio">';
                    echo '<option value="nombre">Nombre</option>
                          <option value="costo">Coste (Menor o Igual)</option>
                          <option value="tipo">Tipo Habitación</option>
                          <option value="rating">Rating</option>
                          <option value="destino">Destino Adjunto</option>';
                echo '</select>';
                echo'<input class="Btn" style="margin-top: 4%;" name="enviar" type="submit" id="btnEnviar" value="Buscar">';
                
                echo '</form>';
                echo '</section>';

                if(isset($_POST['enviar'])){
                    $busqueda = $_POST['busqueda'];
                    $criterio = $_POST['criterio'];
                    $sql;

                    echo '<section id="Tablas_Modificar" style="width: 77%; margin-left: 5%;">';
                    echo '<div class="Hospedajes">
        
                    <table>
                        <caption style="text-align: left; padding-bottom:30px; font-weight: bold; font-size: 30px;">- Hospedajes Registrados ---
                        </caption>
            
                        <td style="font-weight: bold;">Nombre</td>
                        <td style="font-weight: bold;">Costo</td>
                        <td style="font-weight: bold;">Tipo Habitación 1</td>
                        <td style="font-weight: bold;">Tipo Habitación 2</td>
                        <td style="font-weight: bold;">Rating</td>
                        <td style="font-weight: bold;">Destino Relacionado</td>
                        <td style="font-weight: bold; width: 100px;">Opciones</td>';

                        $conexion = mysqli_connect("127.0.0.1","root","123456789") or die ("Error en la conexión con la base de datos");
                        #Selección de la base de datos
                        mysqli_select_db($conexion, "cetiviajes") or die ("Error en la selección de la base de datos");

                        if($criterio == 'costo' || $criterio == 'rating'){
                            $sql = "SELECT * FROM `hospedaje` WHERE $criterio BETWEEN 0 AND '$busqueda'";
                        }
                        else if($criterio == 'tipo'){
                            $sql = "SELECT * FROM `hospedaje` WHERE LOCATE('$busqueda', tipo_habitacion1) OR LOCATE('$busqueda', tipo_habitacion2)"; 
                        }
                        else{
                            $sql = "SELECT * FROM `hospedaje` WHERE LOCATE('$busqueda', $criterio)";
                        }
                        $Resultado = mysqli_query($conexion, $sql);
            
                        while($fila = mysqli_fetch_array($Resultado)){
            
                            echo '<tr><td>'.$fila["nombre"].'</td>';
                            echo '<td>$'.$fila["costo"].'</td>';
                            echo '<td>'.$fila["tipo_habitacion1"].'</td>';
                            echo '<td>'.$fila["tipo_habitacion2"].'</td>';
                            echo '<td>'.$fila["rating"].'</td>';
                            echo '<td>'.$fila["destino"].'</td>';
                            echo '<td> <a href="ModificarHospedaje.php?hospedaje='.$fila["nombre"].'">Editar</a> 
                            <a href="ModificarRegistros.php?registro='.$fila["nombre"].'&tabla=hospedaje&criterio=nombre">Eliminar</a> </td></tr>';
                        }
                        
            
                    echo '</table>';
                    echo '</div>';

                    echo '</section>';

                }
            }

            else if(isset($_GET['agencia'])){
                echo '<form method = "POST">';

                echo '<input type="search" name="busqueda" placeholder="Fiesta Travels" required>';
                echo '<select name="criterio" id="criterio">';
                    echo '<option value="nombre">Nombre</option>
                          <option value="transporte">Tipo Transporte</option>
                          <option value="rating">Rating</option>
                          <option value="categoria">Clase del Asiento</option>
                          <option value="coste">Costo (Menor o Igual)</option>';
                echo '</select>';
                echo'<input class="Btn" style="margin-top: 4%;" name="enviar" type="submit" id="btnEnviar" value="Buscar">';
                
                echo '</form>';
                echo '</section>';

                if(isset($_POST['enviar'])){
                    $busqueda = $_POST['busqueda'];
                    $criterio = $_POST['criterio'];
                    $sql;

                    echo '<section id="Tablas_Modificar" style="width: 77%; margin-left: 5%;">';
                    echo '<div class="Transportistas">

                    <table>
                        <caption style="text-align: left; padding-bottom:30px; font-weight: bold; font-size: 30px;">- Agencias Registrados --- 
                        </caption>
            
                        <td style="font-weight: bold;">Nombre</td>
                        <td style="font-weight: bold;">Tipo de Transporte</td>
                        <td style="font-weight: bold;">Rating</td>
                        <td style="font-weight: bold;">Categoría </td>
                        <td style="font-weight: bold;">Coste</td>
                        <td style="font-weight: bold; width: 100px;">Opciones</td>';
            
                        $conexion = mysqli_connect("127.0.0.1","root","123456789") or die ("Error en la conexión con la base de datos");
                        #Selección de la base de datos
                        mysqli_select_db($conexion, "cetiviajes") or die ("Error en la selección de la base de datos");

                        if($criterio == 'coste' || $criterio == 'rating'){
                            $sql = "SELECT * FROM `agencia` WHERE $criterio BETWEEN 0 AND '$busqueda'";
                        }
                        else{
                            $sql = "SELECT * FROM `agencia` WHERE LOCATE('$busqueda', $criterio)";
                        }
                        $Resultado = mysqli_query($conexion, $sql);
            
                        while($fila = mysqli_fetch_array($Resultado)){
            
                            echo '<tr><td>'.$fila["nombre"].'</td>';
                            echo '<td>'.$fila["transporte"].'</td>';
                            echo '<td>'.$fila["rating"].'</td>';
                            echo '<td>'.$fila["categoria"].'</td>';
                            echo '<td>$'.$fila["coste"].'</td>';
                            echo '<td> <a href="ModificarTransportista.php?transportista='.$fila["nombre"].'">Editar</a>
                            <a href="ModificarRegistros.php?registro='.$fila["nombre"].'&tabla=agencia&criterio=nombre">Eliminar</a> </td></tr>';
                        }
                        
            
                    echo '</table>';
                    echo '</div>';

                    echo '</section>';

                }
            }


            else if(isset($_GET['usuarios'])){
                echo '<form method = "POST">';

                echo '<input type="search" name="busqueda" placeholder="Fiesta Travels" required>';
                echo '<select name="criterio" id="criterio">';
                    echo '<option value="nombre">Nombre</option>
                          <option value="apellido">Apellido</option>
                          <option value="usuario">Usuario</option>
                          <option value="correo">Correo</option>
                          <option value="telefono">Telefono</option>';
                echo '</select>';
                echo'<input class="Btn" style="margin-top: 4%;" name="enviar" type="submit" id="btnEnviar" value="Buscar">';
                
                echo '</form>';
                echo '</section>';

                if(isset($_POST['enviar'])){
                    $busqueda = $_POST['busqueda'];
                    $criterio = $_POST['criterio'];
                    $sql;

                    echo '<section id="Tablas_Modificar" style="width: 77%; margin-left: 5%;">';
                    echo '<div class="Usuarios">

                    <table>
                        <caption style="text-align: left; padding-bottom:30px; font-weight: bold; font-size: 30px;">- Usuarios Registrados --- 
                        </caption>
            
                        <td style="font-weight: bold;">Nombre</td>
                        <td style="font-weight: bold;">Apellido</td>
                        <td style="font-weight: bold;">Usuario</td>
                        <td style="font-weight: bold;">Contraseña</td>
                        <td style="font-weight: bold;">Correo</td>
                        <td style="font-weight: bold;">Telefono</td>
                        <td style="font-weight: bold; width: 100px;">Opciones</td>';
            
                        $conexion = mysqli_connect("127.0.0.1","root","123456789") or die ("Error en la conexión con la base de datos");
                        #Selección de la base de datos
                        mysqli_select_db($conexion, "cetiviajes") or die ("Error en la selección de la base de datos");
                        $sql = "SELECT * FROM `usuarios` WHERE LOCATE('$busqueda', $criterio)";
                        $Resultado = mysqli_query($conexion, $sql);
            
                        while($fila = mysqli_fetch_array($Resultado)){
            
                            echo '<tr><td>'.$fila["nombre"].'</td>';
                            echo '<td>'.$fila["apellido"].'</td>';
                            echo '<td>'.$fila["usuario"].'</td>';
                            echo '<td>'.$fila["password"].'</td>';
                            echo '<td>'.$fila["correo"].'</td>';
                            echo '<td>'.$fila["telefono"].'</td>';
                            echo '<td> <a href="ModificarUsuario.php?usuario='.$fila["nombre"].'">Editar</a> 
                            <a href="ModificarRegistros.php?registro='.$fila["nombre"].'&tabla=usuarios&criterio=nombre">Eliminar</a> </td></tr>';
                        }
                        
            
                    echo '</table>';
                    echo '</div>';

                    echo '</section>';

                }
            }
        ?>

</body>

</html>