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
                            echo '<META HTTP-EQUIV="REFRESH" CONTENT="2; URL=index.php">';
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
                        echo '<META HTTP-EQUIV="REFRESH" CONTENT="2; URL=index.php">';
                    }

                
                }
            ?>