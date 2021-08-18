<?php
    require_once '/usr/local/lib/php/vendor/autoload.php';
    include("bd.php");

    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);

    require_once 'bdUsuarios.php';
  
  $variablesParaTwig = [];
  
  session_start();
  
  if (isset($_SESSION['nickUsuario'])) {
    $variablesParaTwig['user'] = getUser($_SESSION['nickUsuario']);
   
  }
    
    if (isset($_GET['ev'])) {
        $idEv = $_GET['ev'];
      } else {
        $idEv = -1;
      }
      $evento = getEvento($idEv);
      $variablesParaTwig['evento'] = $evento;
      $comentarios = getComentarios($idEv);
      $variablesParaTwig['comentarios'] = $comentarios;
      
      echo $twig->render('evento.html', $variablesParaTwig);
    ?>