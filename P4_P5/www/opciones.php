<?php
  require_once "/usr/local/lib/php/vendor/autoload.php";

  $loader = new \Twig\Loader\FilesystemLoader('templates');
  $twig = new \Twig\Environment($loader);
  
  require_once 'bdUsuarios.php';


  $variablesParaTwig = [];
  
  session_start();

  if (isset($_SESSION['nickUsuario'])) {
    $variablesParaTwig['user'] = getUser($_SESSION['nickUsuario']);
    //echo("TODO BIEN BY NOW");
  }
  $mysqli = new mysqli("mysql", "david", "davidSIBW", "SIBW");
        if ($mysqli->connect_errno) {
          echo ("Fallo al conectar: " . $mysqli->connect_error);
        }
  $comentarios = array();
  $res_com = $mysqli->query("SELECT texto, fecha, id_usuario, id FROM comentarios");
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

  $variablesParaTwig['comentarios'] = $comentarios;

  $eventos = array();
  $res_ev = $mysqli->query("SELECT nombre, lugar, fecha, id, publicado FROM eventos");
  for ($i = 0; $i < $res_ev->num_rows; $i++) {
    $res_ev->data_seek($i);    //Para explorar todos los resultados de la consulta
   
    
    
      $row_ev = $res_ev->fetch_assoc();
      
      $datos_ev = array('nombre' => $row_ev['nombre'],
       'id' => $row_ev['id'],
       'fecha' => $row_ev['fecha'],
       'publicado' => $row_ev['publicado'],
       'lugar' => $row_ev['lugar']);
       
       
       array_push($eventos,$datos_ev);
  }

  $variablesParaTwig['eventos'] = $eventos;

  $usuarios = array();
  $res_user = $mysqli->query("SELECT id, nombre, email, esGestor, esModerador, esSuper FROM usuarios");
  for ($i = 0; $i < $res_user->num_rows; $i++) {
    $res_user->data_seek($i);    //Para explorar todos los resultados de la consulta
   
    
    
      $row_user = $res_user->fetch_assoc();
      
      $datos_user = array('nombre' => $row_user['nombre'],
       'id' => $row_user['id'],
       'email' => $row_user['email'],
       'esGestor' => $row_user['esGestor'],
       'esModerador' => $row_user['esModerador'],
       'esSuper' => $row_user['esSuper']);
       
       
       array_push($usuarios,$datos_user);
  }

  

  $variablesParaTwig['usuarios'] = $usuarios;



  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nick = $_POST['new_nick'];
    $pass = $_POST['new_contraseña'];
    $email = $_POST['new_email'];
    
    if (checkLogin($nick, $pass) == false) {
        session_start();
       
        $mysqli = new mysqli("mysql", "david", "davidSIBW", "SIBW");
        if ($mysqli->connect_errno) {
          echo ("Fallo al conectar: " . $mysqli->connect_error);
        }
       
        $stmt = $mysqli->prepare("UPDATE usuarios SET nombre = ?, pass = ?, email = ? WHERE nombre = ?");
        $stmt->bind_param("ssss", $nick_sql, $pass_sql, $email_sql, $old_nick);
        $nick_sql = $nick;
        $pass_sql = password_hash($pass, PASSWORD_DEFAULT);
        $email_sql = $email;
        $old_nick = $_SESSION['nickUsuario'];
        $stmt->execute();
   }
    
    header("Location: index.php");
    
    exit();
  }
  
  echo $twig->render('opciones.html', $variablesParaTwig);
?>
