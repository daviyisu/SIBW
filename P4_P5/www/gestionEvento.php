<?php
  require_once "/usr/local/lib/php/vendor/autoload.php";

  $loader = new \Twig\Loader\FilesystemLoader('templates');
  $twig = new \Twig\Environment($loader);
  
  require_once 'bdUsuarios.php';

  $variablesParaTwig = [];
 
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();
   
    if(isset($_POST['id']) ){
      $id =  $_POST['id'];
      
      $variablesParaTwig['id'] = $id;
      }
    
     
  }
  
  
  echo $twig->render('editarEvento.html', $variablesParaTwig);
  
  
?>