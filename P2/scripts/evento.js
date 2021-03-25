function esconderComentarios() {
    var x = document.getElementById("caja_comentarios");
    if (x.style.display === "none") {
      x.style.display = "block";
    } else {
      x.style.display = "none";
    }
  } 

  function postearComentario(){
    var f = new Date();
    var comentario = document.getElementById("fname").value;
    comentario += " ";
    comentario += f.getDate() + "-"+ (f.getMonth()+1)+ "-" +f.getFullYear();
    comentario += " ";
    comentario += f.getHours() + ":" + f.getMinutes() + ":"
    comentario += " ";
    comentario += document.getElementById("texto").value;
    return comentario;
  }