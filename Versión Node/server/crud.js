var Usuario = require('./modelUsuarios.js')

module.exports.crearUsuarioDemo = function(callback){
  var arr = [{ email: 'invitado@mail.com', user: "invitado", password: "789789"}, { email: 'lina@mail.com', user: "Lina", password: "211012"}];
  Usuario.insertMany(arr, function(error, docs) {
    if (error){
      if (error.code == 11000){
        callback("Utilice los siguientes datos: </br>usuario: invitado | password:789789 </br>usuario: Lina | password:211012")
      }else{
        callback(error.message)
      }
    }else{
      callback(null, "El usuario 'invitado' y 'Lina' se ha registrado correctamente. </br>usuario: invitado | password:789789 </br >usuario: Lina | password:211012") 
  });
}
