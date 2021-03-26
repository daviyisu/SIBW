function esconderComentarios() {
  var x = document.getElementById("zonaOcultable");
  if (x.style.display === "none") {
    x.style.display = "block";    //Se muestra o no según su estado anterior
  } else {
    x.style.display = "none";
  }
}

function construirComentario() {
  var valid = true;
  var f = new Date();
  if (document.getElementById("fname").value == "") {
    alert("¡El campo del nombre está vacío!"); //Si el campo esta vacío sale la alerta
    return -1;
  } else {
    var comentario = "\n";
    comentario += document.getElementById("fname").value;
    comentario += " ";
    comentario += f.getDate() + "-" + (f.getMonth() + 1) + "-" + f.getFullYear(); //Añado la fecha y hora
    comentario += " ";
    comentario += f.getHours() + ":" + f.getMinutes() + ":"
    comentario += " ";
    if (!validateEmail(document.getElementById("email").value)) {   //Si el email no es válido, sale la alerta
      alert("¡El correo electrónico no es válido!");
      return -1;
    } else {
      if (document.getElementById("texto").value == "") { 
        alert("¡El campo del texto está vacío!");           //Si el campo del texto esta vacío se da la alerta
        return -1;
      } else {
        comentario += document.getElementById("texto").value;
        return comentario;
      }
    }

  }
}

function postearComentario() {
  var comentario = construirComentario();  //Después de construir el comentario, si no es -1 es que todo habrá ido bien así que se puede insertar
  if (comentario != -1)
    document.getElementById('caja_comentarios').innerHTML += '<div class ="comentario"><p>' + comentario + '</p></div>';
}

function validateEmail(email) {
  var re = /\S+@\S+\.\S+/; //Expresión regular para ver si el email tiene el fotmato correcto.
  return re.test(email);
}

function palabraProhibida(texto) {
  let blacklisted = ['palabra1', 'palabra2', 'palabra3']; //Palabras de ejemplo
  let foundInText = false;
  for (var i in blacklisted) {
    if (texto.toLowerCase().includes(blacklisted[i].toLowerCase())) foundInText = true; //Se comprueba si hay alguna palabra
  }                                                                       //prohibida en el texto y se pone en true si es que si
  return foundInText;
}

function censurarPalabras() {
  let comentario = document.getElementById("texto").value; //el texto se guarda en esta variable
  if (palabraProhibida(comentario)) { 
    let num_asteriscos = comentario.split(" ").pop().length;  //si se encuentra una palabra ban, se divide el texto en dos, aquí la parte ban
    let cadenaValida = comentario.substring(0, comentario.lastIndexOf(" ")); //aquí la parte buena 
    let asteriscos = " ";
    for (let i = 0; i < num_asteriscos; ++i) {
      asteriscos += "*";    //como sabemos el numero de asteriscos, hacemos un for que forma una cadena con ese número
    }
    document.getElementById("texto").value = cadenaValida += asteriscos; //se añade a la cadena buena la cadena de astericos
  }
}