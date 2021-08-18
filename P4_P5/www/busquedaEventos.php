<?php
  require_once "/usr/local/lib/php/vendor/autoload.php";

  $loader = new \Twig\Loader\FilesystemLoader('templates');
  $twig = new \Twig\Environment($loader);
  
  

  $variablesParaTwig = [];
 
  if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    session_start();
   
    if(isset($_GET['num']) ){
      $id =  $_GET['num'];
      
      $variablesParaTwig['id'] = $id;
      }
    
     
  }
  
  
  echo $twig->render('busquedaEvento.html', $variablesParaTwig);
  
  
?>