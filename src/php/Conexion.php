<?PHP

    $server = "127.0.0.1"; //Ruta del Servidor
    $database = "cetiviajes";
    $username = "root";
    $password = "123456789";

    $con = mysqli_connect($server, $username, $password, $database); //Variable para establecer conexión con BD

    if(!$con){
        echo'No exitosa';
    }else{
        echo'Conexión Establecida';
    }

    ?>