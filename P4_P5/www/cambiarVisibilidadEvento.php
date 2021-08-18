<?php
  require_once "/usr/local/lib/php/vendor/autoload.php";

  $loader = new \Twig\Loader\FilesystemLoader('templates');
  $twig = new \Twig\Environment($loader);

  require_once 'bdUsuarios.php';

  
  $mysqli = new mysqli("mysql", "david", "davidSIBW", "SIBW");
  if ($mysqli->connect_errno) {
    echo ("Fallo al conectar: " . $mysqli->connect_error);
  }
  

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      
    
        $id = $_POST['id'];
  
        $stmt = $mysqli->prepare("SELECT publicado FROM eventos WHERE id = ?");
        $stmt->bind_param("i", $id_sql);
        $id_sql = $id;
        $stmt->execute();
        $result = $stmt->get_result();

        if($result != false){
            $fila = $result->fetch_assoc();
            if($fila['publicado'] == 1) {
                $stmt2 = $mysqli->prepare("UPDATE eventos SET publicado = 0 WHERE id = ?");
                $stmt2->bind_param("i", $id_sql);
                $id_sql = $id;
                $stmt2->execute();
            }
            else{
                $stmt3 = $mysqli->prepare("UPDATE eventos SET publicado = 1 WHERE id = ?");
                $stmt3->bind_param("i", $id_sql);
                $id_sql = $id;
                $stmt3->execute();
            }


            
        }
    
      
     
    
    
    header("Location: opciones.php");
    
    exit();
  }
  
  
?>
