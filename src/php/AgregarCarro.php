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
        #Visualizar{
            width: 99.2%;
            background-image: url("Imagenes/FondoDestino.jpg");
            background-size:cover;
            background-position:center;
            background-repeat:no-repeat;
            height: 90%;
            position: absolute;
            font-size: clamp(26px, 28px, 32px);
            font-family: courier;
         }
        #Visualizar p{
            text-align: center;
            margin-top: 15%;
            background-color: #FFFFFF;
            margin-left:auto;
            margin-right: auto;
        }
        
        footer{
            bottom: 0%;
            width: 99.2%;
            position: absolute;
        }
    </style>

</head>

<nav>
    <ul>
        <li style="float: left"><p id="Titulo">CETI VIAJES</p></li>
        <li><a href="">Cerrar Sesión</a></li>
        <li><a href="">Carrito</a></li>
        <li><a href="">Reservar Ahora</a></li>
        <li><a href="">Inicio</a></li>
    </ul>
</nav>

<body>
    <section class="EspacioVacio"></section>
    <section id="Visualizar">
        
       <?php
            if(isset ($_POST['enviar'])){

                $dias = 0;
                $subtotal = 0;

                $destino = $_POST['destino'];
                $estado = $_POST['estado'];
                $hotel = $_POST['hotel'];
                $rating_h = $_POST['rating_hotel'];
                $costo_noche = $_POST['costo_noche'];
                $agencia = $_POST['agencia'];
                $rating_agencia = $_POST['rating_agencia'];
                $costo_viaje = $_POST['costo_viaje'];
                $transporte = $_POST['transporte_agencia'];
                $categoria = $_POST['categoria_agencia'];
                $fecha_salida = $_POST['dia_salida'];
                $fecha_regreso = $_POST['dia_regreso'];

                $dias = (strtotime($fecha_regreso)-strtotime($fecha_salida))/86400;
                $dias = floor($dias);

                /**echo $destino;
                echo '<br>';
                echo $estado;
                echo '<br>';
                echo $hotel ;
                echo '<br>';
                echo $rating_h; 
                echo '<br>';
                echo $costo_noche;
                echo '<br>';
                echo $agencia ;
                echo '<br>';
                echo $rating_agencia;
                echo '<br>';
                echo $costo_viaje ;
                echo '<br>';
                echo $transporte  ;
                echo '<br>';
                echo $categoria ;
                echo '<br>';
                echo $fecha_salida ;
                echo '<br>';
                echo $fecha_regreso;*/
                
                if($dias <= 0){
                    echo '<p> Error, Ingrese fechas congruentes... </p>';
                    echo '<META HTTP-EQUIV="REFRESH" CONTENT="3; URL=Destino.php">';
                }
                else{
                    $subtotal = ($costo_noche*$dias) + $costo_viaje;
                    $pedido = array();

                    if(isset($_SESSION["usuario"])){
                        $user = $_SESSION["usuario"];
                        $ruta = $user."_pedido.json";
                    }
                    else{
                        $admin = $_SESSION["admin"];
                        $ruta = $admin."_pedido.json";
                    }
    
                    if(file_exists($ruta)){
                        //Leer Archivo
                        $archivo = file_get_contents($ruta);
                        $pedido =  json_decode($archivo, true);
            
                        $pedido[] = array('destino' => $destino, 'estado' => $estado, 'hotel' => $hotel, 'coste_noche' => $costo_noche, 'agencia' => $agencia,
                                        'tipo_transporte' => $transporte, 'categoria_asiento' => $categoria, 'coste_viaje' => $costo_viaje, 'fecha_salida' => $fecha_salida,
                                        'fecha_regreso' => $fecha_regreso, 'subtotal' => $subtotal);
            
                        $json_string = json_encode($pedido);
                        //echo $json_string;	
            
                        $file = $ruta;
                        file_put_contents($file, $json_string);
                        echo '<p>Registrando Reservación, espere un momento </p>';
                        echo '<META HTTP-EQUIV="REFRESH" CONTENT="3; URL=Reservas.php">';
            
                    }else{
                        $pedido[] = array('destino' => $destino, 'estado' => $estado, 'hotel' => $hotel, 'coste_noche' => $costo_noche, 'agencia' => $agencia,
                                        'tipo_transporte' => $transporte, 'categoria_asiento' => $categoria, 'coste_viaje' => $costo_viaje, 'fecha_salida' => $fecha_salida,
                                        'fecha_regreso' => $fecha_regreso, 'subtotal' => $subtotal);
            
                        $json_string = json_encode($pedido);
            
                        $file = $ruta;
                        file_put_contents($file, $json_string);

                        echo '<p>Registrando Reservación, espere un momento </p>';
                        echo '<META HTTP-EQUIV="REFRESH" CONTENT="3; URL=Reservas.php">';
                    }

                }

            }
        ?> 

    </section>
</body>

<footer>
    <p>Hecho por Héctor Mariano Padilla Rodríguez - 21310386</p>
</footer>

</html>




