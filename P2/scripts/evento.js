function esconderComentarios() {
  var x = document.getElementById("caja_comentarios");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}

function postearComentario() {
  var valid = true;
  var f = new Date();
  if (document.getElementById("fname").value == "") {
    alert("¡El campo del nombre está vacío!");
    return -1;
  } else {
    var comentario = document.getElementById("fname").value;
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
        censuraPalabras(document.getElementById("texto").value);
        comentario += document.getElementById("texto").value;
        return comentario;
      }
    }

  }
}

function validateEmail(email) {
  var re = /\S+@\S+\.\S+/;
  return re.test(email);
}

function censuraPalabras(texto) {
  let blacklisted = ['puta', 'puto'];
  let foundInText = false;
  for (var i in blacklisted) {
    if (texto.toLowerCase().includes(blacklisted[i].toLowerCase())) foundInText = true;
  }
  if (foundInText) {
    alert("Palabra prohibida")
  }
}
