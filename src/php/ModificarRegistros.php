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
        <li><a href="BuscarRegistros.php">Buscar Registro</a></li>
        <li><a href="ModificarRegistros.php">Modificar Registros</a></li>
        <li><a href="Reservas.php">Reservar Ahora</a></li>
        <li><a href="index.php">Inicio</a></li>
    </ul>
</nav>

<body>
    <section class="EspacioVacio"></section>

    <?php

        if(isset($_GET['tabla']) && isset($_GET['registro'])){
            $registro = $_GET['registro'];
            $tabla = $_GET['tabla'];
            $criterio = $_GET['criterio'];

            echo'<section id="MensajeConfirmacion">';

                echo '<p>';
                echo 'Confirme eliminar de la tabla: <br>';
                echo '<span id="Campos">'.$tabla.'</span><br>';
                echo 'El registro: <br>';
                echo '<span id="Campos">'.$registro.'</span><br>';

                echo '<form method="POST">';

                echo '<input class="ConfirmacionBtn" name="eliminar" type="submit" id="eliminar" value="Eliminar">';
                echo '<input class="ConfirmacionBtn" name="cancelar" type="submit" id="cancelar" value="Cancelar">';
                echo '<form>';
                
                

                echo '</p>';
            echo'</section>';

            if(isset($_POST['eliminar'])){

                $conexion = mysqli_connect("127.0.0.1","root","123456789") or die ("Error en la conexión con la base de datos");
                #Selección de la base de datos
                mysqli_select_db($conexion, "cetiviajes") or die ("Error en la selección de la base de datos");

                if($tabla == 'hospedaje'){
                    $Resultado = mysqli_query($conexion, "UPDATE destinos SET hospedaje=NULL WHERE hospedaje='$registro';");
                }

                $Resultado = mysqli_query($conexion, "DELETE FROM $tabla WHERE $criterio = '".$registro."';");

                if($Resultado){
                    echo '<META HTTP-EQUIV="REFRESH" CONTENT="0; URL=ModificarRegistros.php">';  
                }
            }

            if(isset($_POST['cancelar'])){
                echo '<META HTTP-EQUIV="REFRESH" CONTENT="0; URL=ModificarRegistros.php">';
            }
        }
    
    ?>

    <section id="Tablas_Modificar">
    
    <div class="Destinos">

        <table>
            <caption style="text-align: left; padding-bottom:30px; font-weight: bold; font-size: 30px;">- Destinos Registrados ---
            <a href="ModificarDestino.php" style="font-weight: normal; font-size: 25px; margin-left: 8%;">Agregar Registro</a></caption>

			<td style="font-weight: bold;">Nombre</td>
			<td style="font-weight: bold;">Estado</td>
			<td style="font-weight: bold; width: 40%;">Descripción</td>
			<td style="font-weight: bold;">Imagen</td>
            <td style="font-weight: bold;">Opciones</td>

            <?php

                $conexion = mysqli_connect("127.0.0.1","root","123456789") or die ("Error en la conexión con la base de datos");
                #Selección de la base de datos
                mysqli_select_db($conexion, "cetiviajes") or die ("Error en la selección de la base de datos");
                $Resultado = mysqli_query($conexion, "SELECT * FROM `destinos`;");

                while($fila = mysqli_fetch_array($Resultado)){

                    echo '<tr><td>'.$fila["nombre"].'</td>';
                    echo '<td>'.$fila["estado"].'</td>';
                    echo '<td>'.$fila["descripcion"].'</td>';
                    echo '<td> <img src = "Destinos/'.$fila['imagen'].'"></td>';
                    echo '<td> <a href="ModificarDestino.php?destino='.$fila["nombre"].'">Editar</a> 
                        <a href="ModificarRegistros.php?registro='.$fila["nombre"].'&tabla=destinos&criterio=nombre">Eliminar</a> </td></tr>';
                }
            ?>

        </table>

    </div>

    <div class="Hospedajes">
        
        <table>
            <caption style="text-align: left; padding-bottom:30px; font-weight: bold; font-size: 30px;">- Hospedajes Registrados ---
            <a href="ModificarHospedaje.php" style="font-weight: normal; font-size: 25px; margin-left: 8%;">Agregar Registro</a> </caption>

			<td style="font-weight: bold;">Nombre</td>
			<td style="font-weight: bold;">Costo</td>
			<td style="font-weight: bold;">Tipo Habitación 1</td>
			<td style="font-weight: bold;">Tipo Habitación 2</td>
            <td style="font-weight: bold;">Rating</td>
            <td style="font-weight: bold;">Destino Relacionado</td>
            <td style="font-weight: bold; width: 100px;">Opciones</td>

            <?php

                $conexion = mysqli_connect("127.0.0.1","root","123456789") or die ("Error en la conexión con la base de datos");
                #Selección de la base de datos
                mysqli_select_db($conexion, "cetiviajes") or die ("Error en la selección de la base de datos");
                $Resultado = mysqli_query($conexion, "SELECT * FROM `hospedaje`;");

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
            ?>

        </table>
    </div>

    <div class="Transportistas">

        <table>
            <caption style="text-align: left; padding-bottom:30px; font-weight: bold; font-size: 30px;">- Agencias Registrados --- 
            <a href="ModificarTransportista.php" style="font-weight: normal; font-size: 25px; margin-left: 8%;">Agregar Registro</a></caption>

			<td style="font-weight: bold;">Nombre</td>
			<td style="font-weight: bold;">Tipo de Transporte</td>
            <td style="font-weight: bold;">Rating</td>
            <td style="font-weight: bold;">Categoría </td>
            <td style="font-weight: bold;">Coste</td>
            <td style="font-weight: bold; width: 100px;">Opciones</td>

            <?php

                $conexion = mysqli_connect("127.0.0.1","root","123456789") or die ("Error en la conexión con la base de datos");
                #Selección de la base de datos
                mysqli_select_db($conexion, "cetiviajes") or die ("Error en la selección de la base de datos");
                $Resultado = mysqli_query($conexion, "SELECT * FROM `agencia`;");

                while($fila = mysqli_fetch_array($Resultado)){

                    echo '<tr><td>'.$fila["nombre"].'</td>';
                    echo '<td>'.$fila["transporte"].'</td>';
                    echo '<td>'.$fila["rating"].'</td>';
                    echo '<td>'.$fila["categoria"].'</td>';
                    echo '<td>$'.$fila["coste"].'</td>';
                    echo '<td> <a href="ModificarTransportista.php?transportista='.$fila["nombre"].'">Editar</a>
                    <a href="ModificarRegistros.php?registro='.$fila["nombre"].'&tabla=agencia&criterio=nombre">Eliminar</a> </td></tr>';
                }
            ?>

        </table>
    </div>

    <div class="Usuarios">

        <table>
            <caption style="text-align: left; padding-bottom:30px; font-weight: bold; font-size: 30px;">- Usuarios Registrados --- 
            <a href="ModificarUsuario.php" style="font-weight: normal; font-size: 25px; margin-left: 8%;">Agregar Registro</a></caption>

			<td style="font-weight: bold;">Nombre</td>
			<td style="font-weight: bold;">Apellido</td>
            <td style="font-weight: bold;">Usuario</td>
            <td style="font-weight: bold;">Contraseña</td>
            <td style="font-weight: bold;">Correo</td>
            <td style="font-weight: bold;">Telefono</td>
            <td style="font-weight: bold; width: 100px;">Opciones</td>

            <?php

                $conexion = mysqli_connect("127.0.0.1","root","123456789") or die ("Error en la conexión con la base de datos");
                #Selección de la base de datos
                mysqli_select_db($conexion, "cetiviajes") or die ("Error en la selección de la base de datos");
                $Resultado = mysqli_query($conexion, "SELECT * FROM `usuarios`;");

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
            ?>

        </table>
    </div>
    </section>


</body>


</html>