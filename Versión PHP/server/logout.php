<?php
	session_start(); //Iniciar manejador de sesiones
	if (isset($_SESSION['email'])) {
		session_destroy();
		$response['msg'] = 'Redireccionar';
	}else{
		$response['msg'] = 'Sesion no iniciada';
	}
	echo json_encode($response); 

 ?>
