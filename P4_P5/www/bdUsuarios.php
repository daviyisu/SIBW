<?php
// Este fichero es para simular una supuesta base de datos en donde se almacenan datos de usuarios registrados en nuestra aplicación
// Cada usuario se supone que tiene 3 campos: nick, pass y super:
//  - nick: apodo del usuario
//  - pass: un hash del password (lo que se almacena en la base de datos)
//  - super: un boolean que indica si el usuario es superusuario (o no)

// Lo que aparece en el "hash" se ha obtenido de:
// password_hash('passwordSuperSeguro', PASSWORD_DEFAULT)  ---->  $2y$10$mGwJK76zo6rjkZL3j6YU6uKmjNtV51jmMy8zSUUFt/uuPmzfZeQ0O
// password_hash('otroPassword', PASSWORD_DEFAULT)  ---->  $2y$10$XfxLjcJB.54YreU8SOr1y.vEeRMnuu6izd0xAZwSeuQQZGyJ1TT.y 

// Más info sobre hashes para password en PHP: https://www.sitepoint.com/hashing-passwords-php-5-5-password-hashing-api/

 // $usuarios = [ ['nick' => 'Zerjillo', 'pass' => '$2y$10$mGwJK76zo6rjkZL3j6YU6uKmjNtV51jmMy8zSUUFt/uuPmzfZeQ0O', 'super' => true],
   //             ['nick' => 'hola', 'pass' => 'pistacho', 'super' => false],
     //           ['nick' => 'Pepe', 'pass' => '$2y$10$XfxLjcJB.54YreU8SOr1y.vEeRMnuu6izd0xAZwSeuQQZGyJ1TT.y', 'super' => false]
       //       ];
  
  
  // Devuelve true si existe un usuario con esa contraseña
  function checkLogin($nick, $pass) {
    $mysqli = new mysqli("mysql", "david", "davidSIBW", "SIBW");
    if ($mysqli->connect_errno) {
      echo ("Fallo al conectar: " . $mysqli->connect_error);
    }
    
   

    $sql = "SELECT * FROM usuarios WHERE nombre=?"; // SQL with parameters
    $stmt = $mysqli->prepare($sql); 
    $stmt->bind_param("s", $nick_sql);
    $nick_sql = $nick;
    $stmt->execute();
    $result = $stmt->get_result(); // get the mysqli result
    

    
    if($result != false){
      $fila = $result->fetch_assoc();
      
      if($fila['nombre'] == $nick){
        
        if( password_verify($pass, $fila['pass']) ){
          
          return true;
      }
    }
    }else{
    
    return false;
    }
    
  }

 
  
  // Devuelve la información de un usuario a partir de su nick 
  function getUser($nick) {
    $mysqli = new mysqli("mysql", "david", "davidSIBW", "SIBW");
    if ($mysqli->connect_errno) {
      echo ("Fallo al conectar: " . $mysqli->connect_error);
    }

    $sql2 = "SELECT * FROM usuarios WHERE nombre=?"; // SQL with parameters
    $stmt2 = $mysqli->prepare($sql2); 
    $stmt2->bind_param("s", $nick_sql2);
    $nick_sql2 = $nick;
    $stmt2->execute();
    $result2 = $stmt2->get_result(); // get the mysqli result
    $row = $result2->fetch_assoc();
   
    
    return $row;
  }

?>
