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

        #Tabla{
            position: absolut;
            height: auto;
            width: 80%;
            margin-left: auto;
            margin-right: 4%;
            margin-top: 4%;
            padding: 2%;
        }

        #Tabla table img{
            height: 300px;
	        width: 220px;
        }

    </style>

</head>

<nav>
    <ul>
        <li style="float: left"><p id="Titulo">CETI VIAJES</p></li>
        <li><a href="InicioSesion.html">Iniciar Sesión</a></li>
        <li><a href="Registro.html">Registro</a></li>
        <li><a href="Destinos.php">Reservar Ahora</a></li>
        <li><a href="index.html">Inicio</a></li>
    </ul>
</nav>

<body>
    <section class="EspacioVacio"></section>

    <?PHP
        $Descripcion = array("", "Huasteca Potosina", "Bacalar", "Cascada Hierve Agua", "Pozas de Xilitla", "Islas Marietas",
                            "Playa del Carmen", "Cascadas Agua Azul", "Recinto de Mariposas Monarca", "Palenque");


        echo '<table> <tr>';

        for($contador = 1; $contador <= 9; $contador++) { 
            echo '<td>
                    <div>
                        <img src="Destinos/Img_'.$contador.'.jpg" alt="Imagen '.$contador.'"/> 
                        <a href="">'.$Descripcion[$contador].'</a>
			        </div>
                 </td>';

                if(($contador%3) == 0) {
                    echo '</tr><tr>';
                }
		}

		echo '</tr></table>';        
    ?>

</body>

<footer>
    <p>Hecho por Héctor Mariano Padilla Rodríguez - 21310386</p>
</footer>

</html>