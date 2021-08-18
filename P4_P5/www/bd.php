<?php
  function getEvento($idEv) {
  
    $mysqli = new mysqli("mysql", "david", "davidSIBW", "SIBW");
    if ($mysqli->connect_errno) {
      echo ("Fallo al conectar: " . $mysqli->connect_error);
    }
  
    $res = $mysqli->query("SELECT id, nombre, lugar, ruta_artista, fecha, ruta_sitio, descripcion, fotografo FROM eventos WHERE id=" . $idEv); //Obtenemos información del evento
    
    $evento = array('nombre' => 'XXX', 'lugar' => 'YYY');
    
    if ($res->num_rows > 0) {
      $row = $res->fetch_assoc();
      
      $evento = array('nombre' => $row['nombre'],
       'lugar' => $row['lugar'],
       'ruta_artista' => $row['ruta_artista'],
        'ruta_sitio' => $row['ruta_sitio'],
        'descripcion' => $row['descripcion'],
        'fotografo' => $row['fotografo'],
        'web' => $row['web'],
        'fecha' => $row['fecha'],
        'id' => $row['id']);
    }
  
    
    
    return $evento;
  }

  function getComentarios($idEv){

    if(is_numeric($idEv)){  //Prevenimos las inyecciones de sentencias SQL
    $mysqli = new mysqli("mysql", "david", "davidSIBW", "SIBW");
    if ($mysqli->connect_errno) {
      echo ("Fallo al conectar: " . $mysqli->connect_error);
    }

    $comentarios = array();

    $res_com = $mysqli->query("SELECT texto, fecha, id_usuario, id FROM comentarios WHERE id_evento=" . $idEv); //La consulta que obtiene los datos de los comentarios
    for ($i = 0; $i < $res_com->num_rows; $i++) {
    $res_com->data_seek($i);    //Para explorar todos los resultados de la consulta
   
    
    
      $row = $res_com->fetch_assoc();
      $res_user = $mysqli->query("SELECT nombre FROM usuarios WHERE id=" . $row['id_usuario']); //Obtenemos el usuario que ha escrito el comentario de cada iteración
      $fila = $res_user->fetch_assoc();
      $datos = array('texto' => $row['texto'],
       'id' => $row['id'],
       'fecha' => $row['fecha'],
       'id_usuario' => $row['id_usuario'],
        'nombre' => $fila['nombre']);
       
       
       array_push($comentarios,$datos);
    
  }
    
    return $comentarios;
}else
  $mysqli->connect_error; //Si hubiese algo que no fuese un número en idEv, salta un error.
  }
?>