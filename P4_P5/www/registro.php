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
    $nick = $_POST['nick'];
    $email = $_POST['email'];
    $pass = $_POST['contraseña'];
  
  //  if (checkLogin($nick, $pass) == false) {
      $stmt = $mysqli->prepare("INSERT INTO usuarios (nombre, email, pass, esGestor, esModerador, esSuper) VALUES (?, ?, ?, ?, ?, ?)");
      $stmt->bind_param("sssiii", $nick_sql, $email_sql, $pass_sql, $gestor_sql, $moderador_sql, $super_sql);
      $nick_sql = $nick;
      $email_sql = $email;
      $pass_sql = password_hash($pass, PASSWORD_DEFAULT);
      $gestor_sql = 0;
      $moderador_sql = 0;
      $super_sql = 0;
      $stmt->execute();
    //}
    
    header("Location: index.php");
    
    exit();
  }
  
  echo $twig->render('registro.html', []);
?>
