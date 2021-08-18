<?php
  require_once "/usr/local/lib/php/vendor/autoload.php";

  $loader = new \Twig\Loader\FilesystemLoader('templates');
  $twig = new \Twig\Environment($loader);
  
  require_once 'bdUsuarios.php';

  
  
    
    
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $id = $_POST['id'];
      $nombre = $_POST['nombre'];
      $lugar = $_POST['lugar'];
      $fecha = $_POST['fecha'];
      $texto = $_POST['texto'];
      $ruta_artista = $_POST['ruta_artista'];
      $ruta_lugar = $_POST['ruta_lugar'];
    
      $mysqli = new mysqli("mysql", "david", "davidSIBW", "SIBW");
      if ($mysqli->connect_errno) {
        echo ("Fallo al conectar: " . $mysqli->connect_error);
      }
  
      $sql = "UPDATE eventos SET descripcion = ?, nombre = ?, lugar = ?, fecha = ?, ruta_artista = ?, ruta_sitio = ? WHERE id=?"; // SQL with parameters
      $stmt = $mysqli->prepare($sql); 
      $stmt->bind_param("ssssssi", $texto_sql, $nombre_sql, $lugar_sql, $fecha_sql, $ruta_artista_sql, $ruta_sitio_sql, $id_sql);
      $texto_sql = $texto;
      $nombre_sql = $nombre;
      $lugar_sql = $lugar;
      $fecha_sql = $fecha;
      $ruta_artista_sql = $ruta_artista;
      $ruta_sitio_sql = $ruta_lugar;
      $id_sql = $id;
      $stmt->execute();
      
      
           
      
      header("Location: evento.php?ev=".$id);
      
      exit();
    }
   
  
  
  
  
?>