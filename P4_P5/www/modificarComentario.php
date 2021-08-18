<?php
  require_once "/usr/local/lib/php/vendor/autoload.php";

  $loader = new \Twig\Loader\FilesystemLoader('templates');
  $twig = new \Twig\Environment($loader);
  
  require_once 'bdUsuarios.php';

  
  
    
    
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $id = $_POST['id'];
      $texto = $_POST['texto'];
    
    
      $mysqli = new mysqli("mysql", "david", "davidSIBW", "SIBW");
      if ($mysqli->connect_errno) {
        echo ("Fallo al conectar: " . $mysqli->connect_error);
      }
  
      $sql = "UPDATE comentarios SET texto = ? WHERE id=?"; // SQL with parameters
      $stmt = $mysqli->prepare($sql); 
      $stmt->bind_param("si", $texto_sql, $id_sql);
      $texto_sql = $texto;
      $texto_sql = $texto_sql . " (Comentario editado por moderador.)";
      $id_sql = $id;
      $stmt->execute();
      
      
           
      
      header("Location: index.php");
      
      exit();
    }
   
  
  
  
  
?>