function esconderComentarios() {
  var x = document.getElementById("caja_comentarios");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}

function construirComentario() {
  var valid = true;
  var f = new Date();
  if (document.getElementById("fname").value == "") {
    alert("¡El campo del nombre está vacío!");
    return -1;
  } else {
    var comentario = "\n";
    comentario += document.getElementById("fname").value;
    comentario += " ";
    comentario += f.getDate() + "-" + (f.getMonth() + 1) + "-" + f.getFullYear();
    comentario += " ";
    comentario += f.getHours() + ":" + f.getMinutes() + ":"
    comentario += " ";
    if (!validateEmail(document.getElementById("email").value)) {
      alert("¡El correo electrónico no es válido!");
      return -1;
    } else {
      if (document.getElementById("texto").value == "") {
        alert("¡El campo del texto está vacío!");
        return -1;
      } else {
        comentario += document.getElementById("texto").value;
        return comentario;
      }
    }

  }
}

function postearComentario() {
  var comentario = construirComentario();
  if (comentario != -1)
    document.getElementById('caja_comentarios').innerHTML += comentario;
}

function validateEmail(email) {
  var re = /\S+@\S+\.\S+/;
  return re.test(email);
}

function palabraProhibida(texto) {
  let blacklisted = ['hola', 'adios'];
  let foundInText = false;
  for (var i in blacklisted) {
    if (texto.toLowerCase().includes(blacklisted[i].toLowerCase())) foundInText = true;
  }
  return foundInText;
}

function censurarPalabras() {
  let comentario = document.getElementById("texto").value;
  if (palabraProhibida(comentario)) {
    let num_asteriscos = comentario.split(" ").pop().length;
    let cadenaValida = comentario.substring(0, comentario.lastIndexOf(" "));
    let asteriscos = " ";
    for (let i = 0; i < num_asteriscos; ++i) {
      asteriscos += "*";
    }
    document.getElementById("texto").value = cadenaValida += asteriscos;
  }
}