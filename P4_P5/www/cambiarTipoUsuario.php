<?php
  require_once "/usr/local/lib/php/vendor/autoload.php";

  $loader = new \Twig\Loader\FilesystemLoader('templates');
  $twig = new \Twig\Environment($loader);

  require_once 'bdUsuarios.php';

  
  $mysqli = new mysqli("mysql", "david", "davidSIBW", "SIBW");
  if ($mysqli->connect_errno) {
    echo ("Fallo al conectar: " . $mysqli->connect_error);
  }
  

    $gestor = 0;
    $moderador = 0;
    $super = 0;

  
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      if($_POST['gestor']==1){
        $gestor = $_POST['gestor'];
      }

      if($_POST['moderador']==1){
        $moderador = $_POST['moderador'];
      }
    
      if($_POST['super']==1){
        $super = $_POST['super'];
      }
    
    
    $id = $_POST['id'];
  
    
  
    
      $stmt = $mysqli->prepare("UPDATE usuarios SET esGestor = ?, esModerador = ?, esSuper = ? WHERE id = ?");
      $stmt->bind_param("iiii", $gestor_sql, $moderador_sql, $super_sql, $id_sql);
      $gestor_sql = $gestor;
      $moderador_sql = $moderador;
      $super_sql = $super;
      $id_sql = $id;
    
      $stmt->execute();
     
    
    
    header("Location: opciones.php");
    
    exit();
  }
  
  
?>
