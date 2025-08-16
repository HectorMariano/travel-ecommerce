<?php
    session_start();
?>
<?php

    if(isset($_GET['name'])){
        $Id = $_GET['name'];
        $Subtotal = $_GET['subTotal'];
        $Ruta = $_SESSION["usuario"]."_pedido.json";

        $Archivo = file_get_contents($Ruta);
        $Reservas = json_decode($Archivo);

        $Count = 0;
        foreach($Reservas as $Reserva){

            if($Reserva->{'destino'} == $Id && $Reserva->{'subtotal'} == $Subtotal){
                break;
            }
            $Count ++;

        }

        if($Count == 0){

            unset($Reservas[$Count]);
            $Reservas = array_values($Reservas);
            $json_string = json_encode($Reservas);
            file_put_contents($Ruta, $json_string);
            unlink($Ruta);
            echo '<META HTTP-EQUIV="REFRESH" CONTENT=".1; URL=Carrito.php">';

        }else{

            unset($Reservas[$Count]);
            $Reservas = array_values($Reservas);
            $json_string = json_encode($Reservas);
            file_put_contents($Ruta, $json_string);
            echo '<META HTTP-EQUIV="REFRESH" CONTENT=".1; URL=Carrito.php">';
        }
    }

?>