<?PHP
	session_start();
?>

<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require 'PHPMailer/Exception.php';
    require 'PHPMailer/PHPMailer.php';
    require 'PHPMailer/SMTP.php';


    require('fpdf/fpdf.php');
    $pdf = new FPDF('P', 'mm', 'A4');
    $pdf->AddPage();
    $id = substr(md5(time()), 0, 4);
    $nombre = "";
    $correo = "";

    //Agregar Fuentes
    $pdf->AddFont('Dosis', '', 'dosis.php');

    if(isset($_SESSION["usuario"])){
        $usuario = $_SESSION["usuario"];

        $conexion = mysqli_connect("127.0.0.1","root","123456789") or die ("Error en la conexión con la base de datos");
        #Selección de la base de datos
        mysqli_select_db($conexion, "cetiviajes") or die ("Error en la selección de la base de datos");
            
        #Consulta para obtener datos
        $Resultado = mysqli_query($conexion, "SELECT * FROM `usuarios` WHERE `usuario` = '".$usuario."';");
        while($row = mysqli_fetch_array($Resultado)){
    
                $nombre = $row['nombre'];
                $correo = $row['correo'];
        }
        mysqli_close($conexion);
    
    }
    else{
        $usuario = $_SESSION["admin"];

        $conexion = mysqli_connect("127.0.0.1","root","123456789") or die ("Error en la conexión con la base de datos");
        #Selección de la base de datos
        mysqli_select_db($conexion, "cetiviajes") or die ("Error en la selección de la base de datos");
            
        #Consulta para obtener datos
        $Resultado = mysqli_query($conexion, "SELECT * FROM `admins` WHERE `usuario` = '".$usuario."';");
        while($row = mysqli_fetch_array($Resultado)){
    
                $nombre = $row['nombre'];
                $correo = $row['correo'];
        }
        mysqli_close($conexion);
    
    }


    /*
        $pdf->SetFillColor(10,10,101);
        $pdf->SetDrawColor(255,255,255);
        $pdf->SetTextColor(150,100,0);
    */

    $pdf->Image('Imagenes/621px-CETI_Logo.png', 20, 6, 30);
    $pdf->SetAutoPageBreak(true);

    $pdf->SetXY(10, 10);
    $pdf->SetFont('Dosis', '', 15);

    $pdf->Cell(50);
    $pdf->Cell(50, 10, utf8_decode('Agencia de Viajes - CETI VIAJES'), 0,0, 'L');
    $pdf->Ln(10);
    $pdf->Cell(50);
    $pdf->Cell(50, 10, utf8_decode('Llego tu momento de viajar'), 0,0, 'L');
    $pdf->Ln(20);
    $pdf->Cell(8);

    $pdf->Cell(30, 10, utf8_decode('Número de Pedido: #').$id, 0,0, 'L');
    $pdf->Cell(35);
    $pdf->Cell(40, 10, utf8_decode('Registrado a nombre de: '.$nombre.''), 0,0, 'L');
    $pdf->Ln(10);
    $pdf->Cell(8);
    $pdf->Cell(0, 10, utf8_decode('Enviado al Correo registrado: '.$correo), 0,0, 'L');
    $pdf->Ln(15);
    $pdf->Cell(5);

    $pdf->MultiCell(0, 10, utf8_decode('Ve a tu tienda de autoservicio más cercana, menciona que haras un pago de CETI VIAJES y muestra este ticket al empleado de caja') , 0, 'C');
    $pdf->Image('Imagenes/Barras.png', 40, 100, 60);
    $pdf->Image('Imagenes/frame.png', 125, 90, 40);

    $pdf->Ln(55);
    $pdf->Cell(10);
    $pdf->Cell(0, 0, utf8_decode('Reservaciones Realizadas'), 0,0, 'C');
    $pdf->Ln(6);
    $pdf->Cell(20);


        $pdf->Cell(10, 10, utf8_decode('Destino Reservado'), 0,0, 'C');
        $pdf->Cell(30);
        $pdf->Cell(50, 10, utf8_decode('Hotel'), 0,0, 'C');
        $pdf->Cell(10);
        $pdf->Cell(8, 10, utf8_decode('Reservación'), 0,0, 'C');
        $pdf->Cell(22);
        $pdf->Cell(10, 10, utf8_decode('Coste por Noche'), 0,0, 'C');
        $pdf->Cell(20);
        $pdf->Cell(10, 10, utf8_decode('SubTotal'), 0,0, 'C');
        $pdf->Ln(15);
        $pdf->Cell(5);

        $NombreArchivo = $usuario."_pedido.json";

    $Total = 0;
    $IVA = 0;

    if(file_exists($NombreArchivo)){
        $archivo = file_get_contents($NombreArchivo);
        $reservaciones = json_decode($archivo);

        foreach ($reservaciones as $reserva) {

            $pdf->Cell(40, 10, $reserva->{'destino'}, 0,0, 'C');
            $pdf->Cell(30);
            $pdf->Cell(20,10, $reserva->{'hotel'}, 0,0, 'C');
            $pdf->Cell(18);
            $pdf->Cell(20,10, $reserva->{'fecha_salida'}, 0,0, 'C');
            $pdf->Cell(10);
            $pdf->Cell(20,10, '$'.$reserva->{'coste_noche'}.'', 0,0, 'C');
            $pdf->Cell(10);
            $pdf->Cell(24,10, '$'.$reserva->{'subtotal'}.'', 0,0, 'C');

            $pdf->Ln(10);
            $pdf->Cell(5);

            $Total = $Total + $reserva->{'subtotal'};   
        }

        $IVA = ($Total*.16) + $Total;

        $pdf->Ln(15);
        $pdf->Cell(140);
        $pdf->Cell(30, 10, 'Total a Pagar: $'. $Total.'', 0,0, 'R');
        $pdf->Ln(10);
        $pdf->Cell(158);
        $pdf->Cell(30, 10, 'Total a Pagar (IVA): $'. $IVA, 0,0, 'R');
    }


    $pdf->Ln(20);
    $pdf->Cell(5);
    $pdf->Cell(0, 10, utf8_decode('Buscanos en Facebook y redes sociales como: @CETI_VIAJES') , 0,0, 'L');
    $pdf->Ln(10);
    $pdf->Cell(5);
    $pdf->Cell(0, 10, utf8_decode('O contactanos al 33467281989 para atención al cliente') , 0,0, 'L');

    $pdf->Output('Recibos/'.$usuario.'-'.$id.'_pago.pdf', 'F');
    $pdf->Output($usuario.'-'.$id.'_pago.pdf', 'I');
    //unlink($NombreArchivo);


    $Mensaje = "Gracias por reservar con nosotros, complete su compra para empezar a disfrutar";
    $file = 'Recibos/'.$usuario.'-'.$id.'_pago.pdf';

    $mail = new PHPMailer(true);
    try {
        //Server settings
        $mail->SMTPDebug = 2;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp-mail.outlook.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'marianopad@outlook.com';                     //SMTP username
        $mail->Password   = 'Iamyourfather';                               //SMTP password
        $mail->SMTPSecure = 'STARTTLS';            //Enable implicit TLS encryption
        $mail->Port = 587;
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );

        //Recipients
        $mail->setFrom('marianopad@outlook.com', 'AdminCeti');
        $mail->addAddress($correo);     //Add a recipient

        //Attachments
        $mail->addAttachment($file, 'Recibo');         //Add attachments
    
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Recibo de Compra ('.$id.') - CETIVIAJES';
        $mail->Body    = $Mensaje;
    
        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
    
?>