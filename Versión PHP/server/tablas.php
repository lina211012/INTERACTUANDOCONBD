<?php
require('conector.php');
$con = new ConectorBD();
$usuarios = new Usuarios();
$eventos = new Eventos();
//Inicializar varialbes
$response['detalle'] = "Se han encontrado los siguientes errores:</br><ol>";
$resonse['usuarios'] = "";
$response['eventos']='';

//Iniciar la función crear tabla crearTabla con la información del objeto Eventos
$result = $con->crearTabla($usuarios->nombreTabla, $usuarios->data);
if( $result == "OK"){
  $response['msg'] = 'OK';
  $response['detalle'] = "OK";
  $response['usuarios'] = 'OK';
}else{
  $response['detalle'] .= "<li>Error al crear la tabla usuarios.</li>";
}
//Iniciar la función crear tabla crearTabla con la información del objeto Eventos
$result = $con->crearTabla($eventos->nombreTabla, $eventos->data);
if( $result == "OK"){
  $response['msg'] = 'OK';
  $response['detalle'] = "OK";
  $response['eventos'] = 'OK';
}else{
  $response['detalle'] .= "<li>Error al crear la tabla eventos.</li>";
}

if($response['eventos'] =='OK' AND $response['usuarios'] == 'OK' ){
  //Crear un Índice (index) en la columna fk_usuarios de la tabla eventos
  $result =  $con->nuevaRestriccion($eventos->nombreTabla, 'ADD KEY fk_usuarios (fk_usuarios)');
  if( $result == "OK"){
    $response['Index'] = 'OK';
    $response['detalle'] = 'OK';
  }
  //Crear una relación entre las tablas eventos y usuarios asignando a la tabla eventos el valor email a través de una clave foránea
  $result =  $con->nuevaRelacion($eventos->nombreTabla, $usuarios->nombreTabla, 'fk_usuarioemail_evento', 'fk_usuarios', 'email');
    $response['Clave Foránea'] = 'OK';
    $response['detalle'] = 'OK';
  }
}else{
  $response['detalle'] .='</ul> </br>Verifique que los datos del usuario utilizado para realizar la conexión en el archivo <code>conector.php</code> cuente con permisos administrativos en phpmyadmin';
  $response['msg'] = $response['detalle'];
}

echo json_encode($response);
?>
