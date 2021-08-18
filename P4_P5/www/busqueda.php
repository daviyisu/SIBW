<?php

    function busquedaEvento($nombre, $id) {
        $mysqli = new mysqli("mysql", "david", "davidSIBW", "SIBW");
        if ($mysqli->connect_errno) {
        echo ("Fallo al conectar: " . $mysqli->connect_error);
        }

        $stmt = $mysqli->prepare("SELECT esGestor, esSuper FROM usuarios WHERE id = ?");
        $stmt->bind_param("i", $id_sql);
        $id_sql = $id;
        $stmt->execute();
        $result = $stmt->get_result();
        $fila = $result->fetch_assoc();
        if( $fila['esGestor'] == 1 || $fila['esSuper'] == 1 ){
            $sql = "SELECT * FROM eventos WHERE nombre like '%$nombre%'"; 
        }else{
            $sql = "SELECT * FROM eventos WHERE publicado = 1 AND nombre like '%$nombre%'";
        }

        
        $result = mysqli_query($mysqli, $sql);


        $salida = '<ul>';
        if($result != false){
            while($row = mysqli_fetch_array($result)){ 
                $salida .= '<li> <a href="evento.php?ev='.$row["id"].'">'.$row["nombre"].'</a> <img src="'.$row["ruta_artista"].'"> </li>';
            }
        }
        else{
            $salida .= "<li>Sin resultados</li>";
        }

        $salida .= "</ul>";
        echo($salida);
            
    }

    if(isset($_POST["busqueda"])){
        busquedaEvento($_POST["busqueda"], $_POST["id"]);
       
    }

?>